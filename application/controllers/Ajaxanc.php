<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxanc extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ajaxanc_model');
    }

    function index() {
        redirect('/', 'refresh');
    }

    /*     * *******************************  curso  ******************************** */

    function set_curso() {
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        if ($id != null && $value != null) {
            $id = (int) $id;
            $value = (int) $value;
            echo $this->ajaxanc_model->update_curso($id, $value);
        } else {
            echo 'manakax';
        }
    }

    /*     * *******************************  consulta  ******************************** */

    function get_cursos() {
        if ($this->session->user_id) {
            $cursos = $this->base_model->get_cursos(true, 2)->result_array();
            echo json_encode($cursos);
        } else {
            echo 'manakax';
        }
    }

    function consulta_usuarios() {
        $apat = $this->input->post('apat');
        $amat = $this->input->post('amat');
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $dni = $this->input->post('dni');
        $data['apat'] = ( $apat != null ) ? $apat : '';
        $data['amat'] = ( $amat != null ) ? $amat : '';
        $data['nombre'] = ( $nombre != null ) ? $nombre : '';
        $data['email'] = $email; //( $email != null ) ? $email : '';
        $data['dni'] = ( $dni != null ) ? $dni : '';
        $data['empresa'] = $this->input->post('empresa');
        $data['area'] = $this->input->post('area');
        $data['departamento'] = $this->input->post('departamento');
        $data['orden'] = $this->input->post('orden');
        $data['active'] = (int) $this->input->post('activo');
        $data['parti'] = (int) $this->input->post('parti');
        $data['menu'] = 2;
        if ($data['orden'] != null) {
            $users = $this->ajaxanc_model->consulta_usuarios($data);
            $this->session->reporte_consulta = $users;
            $this->session->data_consulta = array(
                'empresa' => (int) $data['empresa'],
                'area' => (int) $data['area'],
                'departamento' => (int) $data['departamento'],
                'orden' => $data['orden']
            );
            echo json_encode($users);
        } else {
            echo 'makanax';
        }
    }

    /*     * *******************************  estadisticas  ******************************** */

    function est_estatus() {
        $tipo = (int) $this->input->post('tipo');
        if ($tipo == 0) {
            echo 'manakax';
            return false;
        }
        $nivel = (int) $this->input->post('nivel');

        $areas = $this->base_model->get_areas();
        $resultado = [];
        foreach ($areas->result() as $itm) {
            $numPlayers = $this->ajaxanc_model->num_players_est(false, $nivel, $itm->id, false); //Usuarios que jugaron
            if ($tipo == 1) {
                $item = $numPlayers;
            } else if ($tipo == 2) {
                if ($numPlayers > 0) {
                    $numUsers = $this->ajaxanc_model->num_users_est(false, $itm->id, false); //Numero total de usuarios
                    $item = 100 * round($numPlayers / $numUsers, 4);
                } else {
                    $item = 0;
                }
            } else if ($tipo == 3) {
                if ($numPlayers > 0) {
                    $puntaje = $this->ajaxanc_model->sum_puntos_est($itm->id, $nivel); //Puntaje total obtenido
                    $item = round($puntaje / $numPlayers, 1);
                } else {
                    $item = 0;
                }
            }
            $resultado[] = $item;
        }
        echo json_encode($resultado);
    }

    function est_avance() {
        if ($this->session->user_id) {
            $empresa = (int) $this->input->post('empresa');
            $area = (int) $this->input->post('area');
            $departamento = (int) $this->input->post('departamento');
            $nivel = (int) $this->input->post('nivel');
            $numPlayers = $this->ajaxanc_model->num_players_est($empresa, $nivel, $area, $departamento); //Usuarios que jugaron
            $numUsers = $this->ajaxanc_model->num_users_est($empresa, $area, $departamento); //Numero total de usuarios
            echo json_encode([$numPlayers, ($numUsers - $numPlayers)]);
        } else {
            echo 'manakax';
        }
    }

    function get_area_fltrd() {
        $id_empresa = (int) $this->input->post('empresa');
        if ($this->session->user_id) {
            $areas = $this->base_model->get_area_fltrd($id_empresa)->result_array();
            echo json_encode($areas);
        } else {
            echo 'manakax';
        }
    }

    function get_dep_fltrd() {
        $id_empresa = (int) $this->input->post('empresa');
        $id_area = (int) $this->input->post('area');
        if ($this->session->user_id) {
            $departamentos = $this->base_model->get_dep_fltrd($id_empresa, $id_area)->result_array();
            echo json_encode($departamentos);
        } else {
            echo 'manakax';
        }
    }

    /*     * *******************************  reporte  ******************************** */

    function get_areas() {
        if ($this->session->user_id) {
            $areas = $this->base_model->get_areas()->result_array();
            echo json_encode($areas);
        } else {
            echo "manakax";
        }
    }

    function get_sede_emps() {
        $id_empresa = $this->input->post('empresa');
        if ($id_empresa) {
            $sendID = $this->input->post('sendID') ? $this->input->post('sendID') : false;
            $ccosto = $this->ajaxanc_model->get_sede_emps($id_empresa, $sendID)->result_array();
            echo json_encode($ccosto);
        } else {
            echo 'manakax';
        }
    }

    function reporte_tabla() {
        $valido = true;
        if ($this->input->post('empresa') != null) {
            $data['empresa'] = $this->input->post('empresa');
        } else {
            $valido = false;
        }
        if ($this->input->post('sede') != null) {
            $data['sede'] = $this->input->post('sede');
        } else {
            $valido = false;
        }
        if ($this->input->post('seccion') != null) {
            $data['seccion'] = $this->input->post('seccion');
        } else {
            $valido = false;
        }
        $data['active'] = (int) $this->input->post('activo');
        if ($this->input->post('fechainic') != null) {
            $data['fechainic'] = strtotime($this->input->post('fechainic'));
        }
        if ($this->input->post('fechafin') != null) {
            $data['fechafin'] = strtotime($this->input->post('fechafin') . ' +1 day');
        }
        if ($this->input->post('orden') != null) {
            $data['orden'] = $this->input->post('orden');
        } else {
            $valido = false;
        }
        if ($this->input->post('nivel') != null) {
            $data['nivel'] = $this->input->post('nivel');
        } else {
            $valido = false;
        }
        if ($valido) {
            $this->session->reporte_data = $this->ajaxanc_model->reporte_data($data);
            $rtabla = $this->ajaxanc_model->reporte_tabla($data);
            $this->session->reporte_tabla = $rtabla;
            echo json_encode($rtabla);
        } else {
            echo 'makanax';
        }
    }

}
