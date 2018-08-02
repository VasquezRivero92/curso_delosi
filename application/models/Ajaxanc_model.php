<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxanc_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
        $this->load->model('ion_auth_model');
        $this->tables = $this->config->item('tables', 'ion_auth');
        $this->id_version = $this->ion_auth_model->get_id_vers();
    }

    /*     * *******************************  curso  ******************************** */

    public function update_curso($id, $estado) {
        $this->db->update('curso', array('estado' => $estado), array('id' => $id));
        return $this->db->affected_rows();
    }

    /*     * *******************************  consulta  ******************************** */

    public function consulta_usuarios($data) {
        $this->load->model('base_model');
        $CCursos = $this->base_model->get_cursos(true, $data['menu'])->result();
        $this->db->select('DISTINCT(ua.id_user),u.apat,u.amat,u.nombre,u.email,u.dni,u.sexo,u.id_grupo,u.active,u.last_login')
                ->from('users u')
                ->join('users_anc ua', 'u.id = ua.id_user');
        if ($data['empresa'] || $data['area'] || $data['departamento']) {
            $this->db->join('users_empresa ue', 'u.id = ue.id_user');
        }
        if ($data['parti'] == 2) {
            $this->db->join('users_menu um', 'um.id_user = ua.id_user');
        }
        $this->db->like('u.apat', $data['apat'])
                ->like('u.amat', $data['amat'])
                ->like('u.nombre', $data['nombre'])
                ->like('u.dni', $data['dni'])
                ->where('u.active', $data['active']);
        if ($data['email']) {
            $this->db->like('u.email', $data['email']);
        }
        if ($data['empresa']) {
            $this->db->where('ue.id_empresa', $data['empresa']);
        }
        if ($data['area']) {
            $this->db->where('ue.id_area', $data['area']);
        }
        if ($data['departamento']) {
            $this->db->where('ue.id_departamento', $data['departamento']);
        }
        //si quieren ver los que jugaron los filtro, sino muestran todos
        if ($data['parti'] == 2) {
            $this->db->where('um.id_menu', $data['menu'])
                    ->where('um.puntaje IS NOT NULL', null, false);
        }
        $reporte = $this->db->order_by('u.apat', 'asc')
                        ->order_by('u.amat', 'asc')
                        ->order_by('u.nombre', 'asc')
                        ->get()->result();
        $usuarios = [];
        foreach ($reporte as $user) {
            if ($data['parti'] == 3) {//si quieren ver los que NO jugaron
                $stats = $this->db->select('id_user')
                                ->from('users_menu')
                                ->where('id_user', $user->id_user)
                                ->where('id_menu', $data['menu'])
                                ->where('puntaje IS NOT NULL', null, false)
                                ->get()->num_rows();
                if ($stats) {//si sale en el query, no lo cuenta
                    continue;
                }
            }
            $total = '0';
            $tUser = array(
                'id' => $user->id_user,
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
                $query = $this->db->select('SUM(puntaje) as puntaje, intentos')
                                ->from('users_curso')
                                ->where('id_user', $user->id_user)
                                ->where('id_curso >=', $curso->id)
                                ->where('id_curso <=', $curso->id /*+ 1*/)
                                ->where('id_version', $this->id_version)
                                ->where('puntaje IS NOT NULL', null, false)
                                ->get()->row();
                if ($query) {
                    $tUser['c' . $curso->id] = (int) $query->puntaje;
                    $tUser['r' . $curso->id] = (int) $query->intentos;
                    $total = (int) $total + (int) $query->puntaje;
                } else {
                    $tUser['c' . $curso->id] = '0';
                    $tUser['r' . $curso->id] = '0';
                }
            }
            $tUser['total'] = $total;
            $usuarios[] = $tUser;
        }
        return $usuarios;
    }

    /*     * *******************************  estadisticas  ******************************** */

    public function num_players_est($id_empresa, $curso, $id_area, $id_departamento) {
        $this->db->select('DISTINCT(ue.id_user)')
                ->from('users_curso uc')
                ->join('users_empresa ue', 'uc.id_user = ue.id_user')
                ->join('curso c', 'uc.id_curso = c.id')
                ->join('users u', 'uc.id_user = u.id');
        if ($id_empresa) {
            $this->db->where('ue.id_empresa', $id_empresa);
        }
        if ($curso) {
            $this->db->where('uc.id_curso', $curso);
        }
        if ($id_area) {
            $this->db->where('ue.id_area', $id_area);
        }
        if ($id_departamento) {
            $this->db->where('ue.id_departamento', $id_departamento);
        }
        return $this->db->where('uc.puntaje IS NOT NULL', null, false)
                        ->where('ue.sede IS NOT NULL', null, false)
                        ->where('uc.id_version', $this->id_version)
                        ->where('u.active', 1)
                        ->where('c.menu', 2)
                        ->get()->num_rows();
    }

    public function sum_puntos_est($id_area, $curso) {
        $this->db->select('DISTINCT(ue.id_user) as id, uc.puntaje')
                ->from('users_curso uc')
                ->join('users_empresa ue', 'uc.id_user = ue.id_user')
                ->join('curso c', 'uc.id_curso = c.id')
                ->join('users u', 'uc.id_user = u.id');
        if ($id_area) {
            $this->db->where('ue.id_area', $id_area);
        }
        if ($curso) {
            $this->db->where('uc.id_curso', $curso);
        }
        $array = $this->db->where('uc.puntaje IS NOT NULL', null, false)
                        ->where('uc.sede IS NOT NULL', null, false)
                        ->where('uc.id_version', $this->id_version)
                        ->where('u.active', 1)
                        //->where('c.menu', 2)
                        ->get()->result_array();
        return array_sum(array_column($array, 'puntaje'));
    }

    public function num_users_est($id_empresa, $id_area, $id_departamento) {
        $this->db->select('DISTINCT(ue.id_user)')
                ->from('users_empresa ue')
                //->join('users u', 'ue.id_user = u.id')
                ->join('users_anc ua', 'ue.id_user = ua.id_user');
        if ($id_empresa) {
            $this->db->where('ue.id_empresa', $id_empresa);
        }
        if ($id_area) {
            $this->db->where('ue.id_area', $id_area);
        }
        if ($id_departamento) {
            $this->db->where('ue.id_departamento', $id_departamento);
        }
        return $this->db->where('sede IS NOT NULL', null, false)
                        //->where('u.active', 1)
                        ->get()->num_rows();
    }

    /*     * *******************************  reporte  ******************************** */

    public function get_sede_emps($id_empresa, $id_user = false) {
        if ($id_user) {
            $query = $this->db->select('sede,seccion')->from('users_empresa')->where('id_empresa', $id_empresa);
            if ($this->session->tipo == 'tienda') {
                $query = $query->where('sede', $id_user);
            }
            return $query->group_by('sede')
                            ->order_by('sede', 'asc')
                            ->get();
        } else {
            return $this->db->select('sede,seccion')
                            ->from('users_empresa')
                            ->where('id_empresa', $id_empresa)
                            ->group_by('sede')
                            ->order_by('sede', 'asc')
                            ->get();
        }
    }

    public function reporte_data($data) {
        $emp = $this->db->select('nombre,ruc')
                        ->from('empresa')
                        ->where('id', $data['empresa'])
                        ->get()->row();
        $niv = $this->db->select('descrip,duracion')
                        ->from('curso')
                        ->where('id', $data['nivel'])
                        ->get()->row();
        return array(
            'empresa' => mb_strtoupper($emp->nombre),
            'ruc' => mb_strtoupper($emp->ruc),
            'nivel' => mb_strtoupper($niv->descrip),
            'duracion' => mb_strtoupper($niv->duracion),
            'seccion' => $data['seccion']
        );
    }

    public function reporte_tabla($data) {
        $this->db->select('u.id,u.apat,u.amat,u.nombre,u.dni,ue.seccion,uc.puntaje,uc.fecha')
                ->from($this->tables['users'] . ' u')
                ->join('users_empresa ue', 'u.id = ue.id_user')
                ->join('users_curso uc', 'u.id = uc.id_user')
                ->where('uc.id_curso', $data['nivel'])
                ->where('uc.sede', $data['sede'])
                ->where('uc.puntaje IS NOT NULL', null, false)
                ->where('uc.id_version', $this->id_version)
                ->where('u.active', $data['active']);
        if (array_key_exists('fechainic', $data)) {
            $this->db->where('uc.fecha >=', $data['fechainic']);
        }
        if (array_key_exists('fechafin', $data)) {
            $this->db->where('uc.fecha <', $data['fechafin']);
        }
        if ($data['orden'] == 'fecha') {
            $this->db->order_by('uc.fecha', 'desc');
        }
        return $this->db->order_by('u.apat', 'asc')
                        ->order_by('u.amat', 'asc')
                        ->order_by('u.nombre', 'asc')
                        ->get()->result_array();
    }

    /*     * ****************************************************************** */

    protected function _prepare_ip($ip_address) {
        return $ip_address;
    }

}
