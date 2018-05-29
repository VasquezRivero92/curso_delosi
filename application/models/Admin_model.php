<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->config('ion_auth', TRUE);
        $this->load->model('ion_auth_model');
        $this->tables = $this->config->item('tables', 'ion_auth');
        $this->identity_column = $this->config->item('identity', 'ion_auth');
        $this->store_salt = $this->config->item('store_salt', 'ion_auth');
        $this->messages = array();
        $this->id_version = $this->ion_auth_model->get_id_vers();
    }

    //registro
    public function register($identity, $data = array()) {
        $manual_activation = $this->config->item('manual_activation', 'ion_auth');
        if ($this->identity_check($identity)) {
            $this->set_error('account_creation_duplicate_identity');
            return FALSE;
        }
        $salt = $this->store_salt ? $this->salt() : FALSE;
        $data[$this->identity_column] = $identity;
        $data['ip_address'] = $this->_prepare_ip($this->input->ip_address());
        $data['password'] = $this->ion_auth_model->hash_password($data['password'], $salt);
        $data['created_on'] = time();
        $data['active'] = ($manual_activation === false ? 1 : 0);
        if ($this->store_salt) {
            $data['salt'] = $salt;
        }
        $user_data = $this->_filter_data($this->tables['users'], $data);
        $this->db->insert($this->tables['users'], $user_data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    //estadisticas
    public function get_visitas($n = 1) {
        $ret_array = [];
        for ($i = 0; $i < $n; $i++) {
            $fecha = date('d-m-Y', strtotime('-' . $i . ' days'));
            $query = $this->db->select('cant')
                            ->where('fecha', $fecha)
                            ->get('visitas')->row();
            if ($query && $query->cant) {
                $ret_array[] = array('fecha' => $fecha, 'cant' => $query->cant);
            } else {
                $ret_array[] = array('fecha' => $fecha, 'cant' => '0');
            }
        }
        return $ret_array;
    }

     
    
    
    //consulta (reporte)
    public function data_consulta($id_user, $data) {
        $reporte = $this->db->select('sede,id_area,id_departamento,id_planilla,id_cargo')
                ->from('users_empresa')
                ->where('id_user', $id_user);
        if ($data['empresa']) {
            $reporte = $reporte->where('id_empresa', $data['empresa']);
        }
        if ($data['area']) {
            $reporte = $reporte->where('id_area', $data['area']);
        }
        if ($data['departamento']) {
            $reporte = $reporte->where('id_departamento', $data['departamento']);
        }
        return $reporte->limit(1)->get()->row();
    }

    //ranking
    public function get_ranking($id_empresa, $id_area, $id_departamento, $limit = 100) {
        $this->load->model('base_model');
        $CCursos = $this->base_model->get_cursos()->result();
        //$this->db->reset_query();
        $this->db->select('DISTINCT(u.id) as id,u.apat,u.amat,u.nombre,u.email,u.dni,u.id_grupo,um.fecha')
                ->from($this->tables['users'] . ' u')
                ->join('users_empresa ue', 'u.id = ue.id_user')
                ->join('users_menu um', 'u.id = um.id_user')
                ->join('curso c', 'um.curso = c.id');
        if ($id_empresa) {
            $this->db->where('ue.id_empresa', $id_empresa);
        }
        if ($id_area) {
            $this->db->where('ue.id_area', $id_area);
        }
        if ($id_departamento) {
            $this->db->where('ue.id_departamento', $id_departamento);
        }
        $reporte = $this->db->where('um.puntaje IS NOT NULL', null, false)
                //PARA QUE NO LO LEA CUANDO HAGA LA CONSULTA**************************************
                ->where('ue.sede IS NOT NULL', null, false)
                ////////////////////////////////////////////////////////////////////////////////////
                ->where('c.id_version', $this->id_version)
                ->where('u.active', 1)
                ->where('um.id_menu', 1)
                //->order_by('um.curso', 'desc')
                ->order_by('um.puntaje', 'desc')
                ->order_by('um.fecha', 'asc')
                ->limit($limit)
                ->get();
        $rankuser = [];
        foreach ($reporte->result() as $usuario) {
            $total = 0;
            $tUser = array(
                'id' => $usuario->id,
                'apat' => mb_strtoupper($usuario->apat),
                'amat' => mb_strtoupper($usuario->amat),
                'nombre' => mb_strtoupper($usuario->nombre),
                'email' => mb_strtolower($usuario->email),
                'dni' => mb_strtolower($usuario->dni),
                'id_grupo' => mb_strtolower($usuario->id_grupo)
            );
            foreach ($CCursos as $curso) {
                $query = $this->db->select('puntaje, intentos')
                                ->from('users_curso')
                                ->where('id_user', $usuario->id)
                                ->where('id_curso', $curso->id)
                                ->where('id_version', $this->id_version)
                                ->get()->row();
                if ($query) {
                    $tUser['c' . $curso->id] = (int) $query->puntaje;
                    $tUser['r' . $curso->id] = (int) $query->intentos;
                    $total = $total + (int) $query->puntaje;
                } else {
                    $tUser['c' . $curso->id] = '0';
                    $tUser['r' . $curso->id] = '0';
                }
            }
            $tUser['total'] = $total;
            $tUser['fecha'] = $usuario->fecha;
            $rankuser[] = $tUser;
        }
        return $rankuser;
    }

    /*     * ************************************************************************ */

    //Reporte total (extra)
    public function reporte_total() {
        //creamos el array de resultados
        $rankuser = [];
        //primer query, para todos los usuarios que tienen puntos (en ese menu)
        $reporte = $this->db->select('e.nombre as empresa,u.apat,u.amat,u.nombre,u.dni,uc.sede,um.puntaje,um.fecha')
                ->from($this->tables['users'] . ' u')
                ->join('users_curso uc', 'u.id = uc.id_user')
                ->join('users_menu um', 'u.id = um.id_user')
                ->join('empresa e', 'e.id = uc.id_empresa')
                ->where('um.id_menu', 1)
                ->where('uc.id_curso = um.curso')
                ->where('uc.id_version', $this->id_version)
                ->where('uc.sede IS NOT NULL', null, false)
                ->where('u.active', 1)
                ->order_by('um.puntaje', 'desc')
                ->order_by('um.fecha', 'asc')
                ->order_by('e.nombre')
                ->order_by('u.apat')
                ->order_by('u.amat')
                ->order_by('u.nombre')
                ->order_by('u.id')
                ->get();
        foreach ($reporte->result() as $usuario) {
            $tUser = array(
                'empresa' => mb_strtoupper($usuario->empresa),
                'apat' => mb_strtoupper($usuario->apat),
                'amat' => mb_strtoupper($usuario->amat),
                'nombre' => mb_strtoupper($usuario->nombre),
                'dni' => mb_strtolower($usuario->dni),
                'sede' => mb_strtoupper($usuario->sede),
                'puntaje' => (int) $usuario->puntaje,
                'fecha' => mdate('%d/%m/%Y %H:%i', $usuario->fecha)
            );
            $rankuser[] = $tUser;
        }
        //segundo query, para todos los usuarios que NO tienen puntos (en ese menu)
        $reporte2 = $this->db->select('e.nombre as empresa,u.apat,u.amat,u.nombre,u.dni,uc.sede')
                ->from($this->tables['users'] . ' u')
                ->join('users_curso uc', 'u.id = uc.id_user')
                ->join('users_menu um', 'u.id = um.id_user')
                ->join('empresa e', 'e.id = uc.id_empresa')
                ->where('u.id NOT IN (SELECT id_user from users_menu WHERE id_menu=1)')
                ->where('uc.id_curso = um.curso')
                ->where('uc.id_version', $this->id_version)
                ->where('uc.sede IS NOT NULL', null, false)
                ->where('u.active', 1)
                ->order_by('e.nombre')
                ->order_by('u.apat')
                ->order_by('u.amat')
                ->order_by('u.nombre')
                ->get();
        foreach ($reporte2->result() as $usuario) {
            $tUser = array(
                'empresa' => mb_strtoupper($usuario->empresa),
                'apat' => mb_strtoupper($usuario->apat),
                'amat' => mb_strtoupper($usuario->amat),
                'nombre' => mb_strtoupper($usuario->nombre),
                'dni' => mb_strtolower($usuario->dni),
                'sede' => mb_strtoupper($usuario->sede),
                'puntaje' => 0,
                'fecha' => null,
                'id_menu' => 1,
            );
            $rankuser[] = $tUser;
        }
        return $rankuser;
    }

    public function reporte_custom() {
        $this->load->model('base_model');
        $CCursos = $this->base_model->get_cursos()->result();
        $reporte = $this->db->query('select u.id,u.apat,u.amat,u.nombre,u.email,u.dni,u.sexo,u.id_grupo,u.active,u.last_login from users u,users_curso uc where u.id = uc.id_user and u.active = 1 and uc.id_curso = 2 and uc.puntaje is not null and uc.id_user NOT IN (SELECT id_user FROM users_curso where id_curso = 1 and puntaje is not null)')->result();
        $usuarios = [];
        foreach ($reporte as $user) {
            $total = '';
            $tUser = array(
                'id' => $user->id,
                'dni' => $user->dni,
                'apat' => mb_strtoupper($user->apat),
                'amat' => mb_strtoupper($user->amat),
                'nombre' => mb_strtoupper($user->nombre),
                'email' => mb_strtolower($user->email),
                'sexo' => $user->sexo,
                'id_grupo' => $user->id_grupo,
                'active' => $user->active,
                'last_login' => $user->last_login ? $user->last_login : 0
            );
            foreach ($CCursos as $curso) {
                $query = $this->db->select('puntaje, intentos')
                                ->from('users_curso')
                                ->where('id_user', $user->id)
                                ->where('id_curso', $curso->id)
                                ->where('id_version', $this->id_version)
                                ->where('puntaje IS NOT NULL', null, false)
                                ->where('u.active', 1)
                                ->get()->row();
                if ($query) {
                    $tUser['c' . $curso->id] = (int) $query->puntaje;
                    $tUser['r' . $curso->id] = (int) $query->intentos;
                    $total = (int) $total + (int) $query->puntaje;
                } else {
                    $tUser['c' . $curso->id] = '';
                    $tUser['r' . $curso->id] = '';
                }
            }
            $tUser['total'] = $total;
            $usuarios[] = $tUser;
        }
        return $usuarios;
    }

    /*     * ************************************************************************ */

    protected function identity_check($identity = '') {
        if (empty($identity)) {
            return FALSE;
        }
        return $this->db->where($this->identity_column, $identity)
                        ->count_all_results($this->tables['users']) > 0;
    }

    protected function _prepare_ip($ip_address) {
        return $ip_address;
    }

    protected function _filter_data($table, $data) {
        $filtered_data = array();
        $columns = $this->db->list_fields($table);
        if (is_array($data)) {
            foreach ($columns as $column) {
                if (array_key_exists($column, $data)) {
                    $filtered_data[$column] = $data[$column];
                }
            }
        }
        return $filtered_data;
    }

    public function set_error($error) {
        $this->errors[] = $error;
        return $error;
    }

}
