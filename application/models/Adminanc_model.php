<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminanc_model extends CI_Model {

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
    
    public function get_usuarios_update() {
        $this->load->model('base_model');
        $list_usuarios = $this->base_model->get_update_user_curso()->result_array();
        $this->db->update('users_anc', $list_usuarios, array('id_user' => ['id_user']));
    }
       
    //consulta (reporte)
    public function data_consulta($id_user, $data) {
        $reporte = $this->db->select('sede,id_area,id_departamento,id_planilla,id_cargo')
                ->from('users_empresa ue')
                //->join('users_anc ua', 'u.id_user = ue.id_user')
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
        $CCursos = $this->base_model->get_cursos(false, 2)->result();
        //$this->db->reset_query();
        $this->db->select('DISTINCT(u.id) as id,u.apat,u.amat,u.nombre,u.email,u.dni,u.id_grupo,um.fecha')
                ->from($this->tables['users'] . ' u')
                ->join('users_anc ua','u.id= ua.id_user')
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
                ->where('ue.sede IS NOT NULL', null, false)
                ->where('c.id_version', $this->id_version)
                ->where('u.active', 1)
                ->where('um.id_menu', 2)
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
                $query = $this->db->select('puntaje as puntaje, intentos')
                                ->from('users_curso')
                                ->where('id_user', $usuario->id)
                                ->where('id_curso >=', $curso->id)
                                ->where('id_curso <=', $curso->id/*+1*/)
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
