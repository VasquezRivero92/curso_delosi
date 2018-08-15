<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxadm extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ajaxadm_model');
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
            echo $this->ajaxadm_model->update_curso($id, $value);
        } else {
            echo 'manakax';
        }
    }
 
    /*     * *******************************  registro  ******************************** */

    function reg_emp_user() {
        $valido = true;
        if ($this->input->post('id_user') != null) {
            $data['id_user'] = $this->input->post('id_user');
        } else {
            $valido = false;
        }
        if ($this->input->post('id_empresa') != null) {
            $data['id_empresa'] = $this->input->post('id_empresa');
        } else {
            $valido = false;
        }
        if ($this->input->post('id_area') != null) {
            $data['id_area'] = $this->input->post('id_area');
        } else {
            $valido = false;
        }
        if ($this->input->post('id_departamento') != null) {
            $data['id_departamento'] = $this->input->post('id_departamento');
        } else {
            $valido = false;
        }
        if ($this->input->post('id_cargo') != null) {
            $data['id_cargo'] = $this->input->post('id_cargo');
        } else {
            $valido = false;
        }
        if ($this->input->post('id_planilla') != null) {
            $data['id_planilla'] = $this->input->post('id_planilla');
        } else {
            $valido = false;
        }
        if ($this->input->post('sede') != null) {
            $data['sede'] = mb_strtoupper($this->input->post('sede'));
        } else {
            $valido = false;
        }
        if ($this->input->post('seccion') != null) {
            $data['seccion'] = mb_strtoupper($this->input->post('seccion'));
        } else {
            $valido = false;
        }
        $data['fingpla'] = strtotime($this->input->post('fingpla')) ? strtotime($this->input->post('fingpla')) : time();
        if ($valido) {
            echo json_encode($this->ajaxadm_model->reg_emp_user($data));
        } else {
            echo 'makanax';
        }
    }

    /*     * *******************************  consulta  ******************************** */

    function get_cursos() {
        if ($this->session->user_id) {
            $cursos = $this->base_model->get_cursos()->result_array();
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
        $data['menu'] = 1;
        if ($data['orden'] != null) {
            $users = $this->ajaxadm_model->consulta_usuarios($data);
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

    /*     * *******************************  consulta (Editar usuario)  ******************************** */

    function get_users_empresa() {
        if ($this->input->post('id_user') != null) {
            $users_empresa = $this->ajaxadm_model->get_users_empresa($this->input->post('id_user'))->result_array();
            echo json_encode($users_empresa);
        } else {
            echo 'manakax';
        }
    }

    function limpiar_puntos_curso() {
        $id_user = (int) $this->input->post('id_user');
        $id_curso = (int) $this->input->post('id_curso');
        if ($id_user && $id_curso) {
            echo $this->ajaxadm_model->limpiar_puntos_curso($id_user, $id_curso);
        } else {
            echo 'makanax';
        }
    }

    function edit_usuario() {
        $this->load->library('form_validation');
        $valido = true;
        $msg = 'makanax';
        if ($this->input->post('id') != null) {
            $userID = $this->input->post('id');
        } else {
            $valido = false;
        }
        if ($this->input->post('apat') != null) {
            $data['apat'] = mb_strtoupper($this->input->post('apat'));
        }
        if ($this->input->post('amat') != null) {
            $data['amat'] = mb_strtoupper($this->input->post('amat'));
        }
        if ($this->input->post('nombre') != null) {
            $data['nombre'] = mb_strtoupper($this->input->post('nombre'));
        }
        if ($this->input->post('dni') != null) {
            $data['dni'] = $this->input->post('dni');
        }
        if ($this->input->post('sexo') != null) {
            $data['sexo'] = mb_strtoupper($this->input->post('sexo'));
        } else {
            $valido = false;
        }
        if ($this->input->post('grupo') != null) {
            $data['id_grupo'] = $this->input->post('grupo');
        } else {
            $valido = false;
        }
        if ($this->input->post('nivel') != null) {
            $data['id_nivel'] = $this->input->post('nivel');
        } else {
            $valido = false;
        }
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'repetir contraseña', 'required');
            if ($this->form_validation->run() === TRUE) {
                $data['password'] = $this->input->post('password');
            } else {
                $valido = false;
                $msg = json_encode('Los passwords no son válidos');
            }
        }
        if ($this->input->post('active') != null) {
            $data['active'] = $this->input->post('active');
        } else {
            $valido = false;
        }

        if ($valido) {
            echo json_encode($this->ajaxadm_model->edit_usuario($userID, $data));
        } else {
            echo $msg;
        }
    }

    function edit_emp_user() {
        $this->load->library('form_validation');
        $valido = true;
        $msg = 'makanax';
        if ($this->input->post('id_user') != null) {
            $id_user = $this->input->post('id_user');
        } else {
            $valido = false;
        }
        if ($this->input->post('id_empresa') != null) {
            $id_empresa = $this->input->post('id_empresa');
            $data['id_empresa'] = $id_empresa;
        } else {
            $valido = false;
        }
        if ($this->input->post('id_departamento') != null) {
            $data['id_departamento'] = $this->input->post('id_departamento');
        }
        if ($this->input->post('id_cargo') != null) {
            $data['id_cargo'] = $this->input->post('id_cargo');
        }
        if ($this->input->post('id_planilla') != null) {
            $data['id_planilla'] = $this->input->post('id_planilla');
        }
        if ($this->input->post('sede') != null) {
            $data['sede'] = $this->input->post('sede');
        }
        if ($this->input->post('seccion') != null) {
            $data['seccion'] = $this->input->post('seccion');
        }
        $data['fingpla'] = strtotime($this->input->post('fingpla')) ? strtotime($this->input->post('fingpla')) : time();

        if ($valido) {
            echo json_encode($this->ajaxadm_model->edit_emp_user($id_user, $id_empresa, $data));
        } else {
            echo $msg;
        }
    }

    function eliminar_usuario_empresa() {
        $id_user = $this->input->post('id_user');
        $id_empresa = $this->input->post('id_empresa');
        if ($id_user != null && $id_empresa != null) {
            echo $this->ajaxadm_model->eliminar_usuario_empresa($id_user, $id_empresa);
        } else {
            echo "makanax";
        }
    }

    /*     * *******************************  masivo (carga inicial)  ******************************** */

    function get_empresas() {
        if ($this->session->user_id) {
            $empresas = $this->base_model->get_empresas()->result_array();
            echo json_encode($empresas);
        } else {
            echo "manakax";
        }
    }

    function get_areas() {
        if ($this->session->user_id) {
            $areas = $this->base_model->get_areas()->result_array();
            echo json_encode($areas);
        } else {
            echo "manakax";
        }
    }

    function get_departamentos() {
        if ($this->session->user_id) {
            $departamentos = $this->base_model->get_departamentos()->result_array();
            echo json_encode($departamentos);
        } else {
            echo "manakax";
        }
    }

    function get_cargos() {
        if ($this->session->user_id) {
            $result = $this->base_model->get_cargos()->result_array();
            echo json_encode($result);
        } else {
            echo "manakax";
        }
    }

    function get_planillas() {
        if ($this->session->user_id) {
            $result = $this->base_model->get_planillas()->result_array();
            echo json_encode($result);
        } else {
            echo "manakax";
        }
    }

    function get_admlvl() {
        if ($this->session->user_id) {
            $niveles = $this->base_model->get_admlvl()->result_array();
            echo json_encode($niveles);
        } else {
            echo "manakax";
        }
    }

    function get_grupos() {
        if ($this->session->user_id) {
            $grupos = $this->base_model->get_grupos()->result_array();
            echo json_encode($grupos);
        } else {
            echo "manakax";
        }
    }
    
    /*     * *******************************  masivo  ******************************** */

    function upload_eduser_excel() {
        $filename = 'eduserfile';
        if ($_FILES && $_FILES[$filename] && $_FILES[$filename]['name']) {
            if (!$_FILES[$filename]['error']) {
                $inputFile = $_FILES[$filename]['name'];
                $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
                if ($extension == 'XLSX' || $extension == 'XLS') {
                    $this->load->library('excel');
                    try {
                        $inputFile = $_FILES[$filename]['tmp_name'];
                        $inputFileType = PHPExcel_IOFactory::identify($inputFile);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFile);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $sheetData = $sheet->rangeToArray('A2:J' . $highestRow, null, false, true, false);
                    echo json_encode($this->ajaxadm_model->check_excel_users($sheetData));
                } else {
                    echo 'error-XLS-type';
                }
            } else {
                echo 'Error-' . $_FILES[$filename]['error'];
            }
        } else {
            echo 'error-No-file';
        }
    }

    function upload_eduemp_excel() {
        $filename = 'eduempfile';
        if ($_FILES && $_FILES[$filename] && $_FILES[$filename]['name']) {
            if (!$_FILES[$filename]['error']) {
                $inputFile = $_FILES[$filename]['name'];
                $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
                if ($extension == 'XLSX' || $extension == 'XLS') {
                    $this->load->library('excel');
                    try {
                        $inputFile = $_FILES[$filename]['tmp_name'];
                        $inputFileType = PHPExcel_IOFactory::identify($inputFile);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFile);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $sheetData = $sheet->rangeToArray('A2:I' . $highestRow, null, false, true, false);
                    echo json_encode($this->ajaxadm_model->get_users_to_excel($sheetData));
                } else {
                    echo 'error-XLS-type';
                }
            } else {
                echo 'Error-' . $_FILES[$filename]['error'];
            }
        } else {
            echo 'error-No-file';
        }
    }

    function upload_deluemp_excel() {
        $filename = 'deluempfile';
        if ($_FILES && $_FILES[$filename] && $_FILES[$filename]['name']) {
            if (!$_FILES[$filename]['error']) {
                $inputFile = $_FILES[$filename]['name'];
                $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
                if ($extension == 'XLSX' || $extension == 'XLS') {
                    $this->load->library('excel');
                    try {
                        $inputFile = $_FILES[$filename]['tmp_name'];
                        $inputFileType = PHPExcel_IOFactory::identify($inputFile);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFile);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $sheetData = $sheet->rangeToArray('A2:B' . $highestRow, null, false, true, false);
                    echo json_encode($this->ajaxadm_model->get_users_to_excel($sheetData));
                } else {
                    echo 'error-XLS-type';
                }
            } else {
                echo 'Error-' . $_FILES[$filename]['error'];
            }
        } else {
            echo 'error-No-file';
        }
    }

    function upload_tienda_excel() {
        $filename = 'tiendafile';
        if ($_FILES && $_FILES[$filename] && $_FILES[$filename]['name']) {
            if (!$_FILES[$filename]['error']) {
                $inputFile = $_FILES[$filename]['name'];
                $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
                if ($extension == 'XLSX' || $extension == 'XLS') {
                    $this->load->library('excel');
                    try {
                        $inputFile = $_FILES[$filename]['tmp_name'];
                        $inputFileType = PHPExcel_IOFactory::identify($inputFile);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFile);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $sheetData = $sheet->rangeToArray('A2:G' . $highestRow, null, false, true, false);
                    echo json_encode($this->ajaxadm_model->check_excel_tiendas($sheetData));
                } else {
                    echo 'error-XLS-type';
                }
            } else {
                echo 'Error-' . $_FILES[$filename]['error'];
            }
        } else {
            echo 'error-No-file';
        }
    }

    function run_ed_user() {
        $data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($data != null) {
            echo $this->ajaxadm_model->run_ed_user($data);
        } else {
            echo 'manakax';
        }
    }

    function mail_masivo() {
        $data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($data == null) {
            echo "manakax";
            return false;
        }
        $i = 0;
        $this->load->library('email');
        $this->email->set_mailtype('html');
        foreach ($data as $user) {
            $datamail = array(
                'apat' => $user['apat'],
                'amat' => $user['amat'],
                'nombre' => $user['nombre'],
                'email' => $user['email'],
                'password' => $user['password']
            );
            $message = $this->load->view('mail/registro', $datamail, true);
            $this->email->clear();
            $this->email->from('no-reply@aprendiendoaprevenir.com', $this->config->item('site_title', 'ion_auth'));
            $this->email->to($user['email']);
            $this->email->subject('Tus datos en ' . $this->config->item('site_title', 'ion_auth'));
            $this->email->message($message);
            //if ($this->email->send()) {
            $i++;
            //}
        }
        echo $i;
    }

    function run_ed_uemp() {
        $data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($data != null) {
            echo $this->ajaxadm_model->run_ed_uemp($data);
        } else {
            echo "manakax";
        }
    }

    function run_del_uemp() {
        $data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($data != null) {
            echo $this->ajaxadm_model->run_del_uemp($data);
        } else {
            echo "manakax";
        }
    }

    function run_ed_tienda() {
        $data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($data != null) {
            echo $this->ajaxadm_model->run_ed_tienda($data);
        } else {
            echo 'manakax';
        }
    }

    function reg_newdata_uemp() {
        if ($this->session->user_id) {
            $area = filter_input(INPUT_POST, 'area', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $departamento = filter_input(INPUT_POST, 'departamento', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $cargo = filter_input(INPUT_POST, 'cargo', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $planilla = filter_input(INPUT_POST, 'planilla', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $result = [];
            if ($area && count($area) && $this->ajaxadm_model->add_campo_tabla('area', $area)) {
                $result['area'] = $this->base_model->get_areas()->result_array();
            }
            if ($departamento && count($departamento) && $this->ajaxadm_model->add_campo_tabla('departamento', $departamento)) {
                $result['departamento'] = $this->base_model->get_departamentos()->result_array();
            }
            if ($cargo && count($cargo) && $this->ajaxadm_model->add_campo_tabla('cargo', $cargo)) {
                $result['cargo'] = $this->base_model->get_cargos()->result_array();
            }
            if ($planilla && count($planilla) && $this->ajaxadm_model->add_campo_tabla('planilla', $planilla)) {
                $result['planilla'] = $this->base_model->get_planillas()->result_array();
            }
            echo json_encode($result);
        } else {
            echo 'manakax';
        }
    }

    /*     * *******************************  estadisticas  ******************************** */
    function est_estatus_cali() {
        if ($this->session->user_id) {
            $empresa = (int) $this->input->post('empresa');
            $area = (int) $this->input->post('area');
            $departamento = (int) $this->input->post('departamento');
            $nivel = (int) $this->input->post('nivel');
            $id_calificacion = (int) $this->input->post('calificacion');
            $numPlayers1 = $this->ajaxadm_model->num_players_cali_1($empresa, $nivel, $area, $departamento); //Usuarios que jugaron
            $numPlayers2 = $this->ajaxadm_model->num_players_cali_2($empresa, $nivel, $area, $departamento); //Usuarios que jugaron
            $numPlayers3 = $this->ajaxadm_model->num_players_cali_3($empresa, $nivel, $area, $departamento); //Usuarios que jugaron
            $numPlayers4 = $this->ajaxadm_model->num_players_cali_4($empresa, $nivel, $area, $departamento); //Usuarios que jugaron
            $numPlayers5 = $this->ajaxadm_model->num_players_cali_5($empresa, $nivel, $area, $departamento); //Usuarios que jugaron
            echo json_encode([$numPlayers1,$numPlayers2,$numPlayers3,$numPlayers4,$numPlayers5]);
        } else {
            echo 'manakax';
        }
    }

    function est_estatus() {
        $tipo = (int) $this->input->post('tipo');
        if ($tipo == 0) {
            echo 'manakax';
            return false;
        }
        $nivel = (int) $this->input->post('nivel');

        if ($this->has_access('adm03')) {
            $areas = $this->base_model->get_areas();
        } else {
            $empresa = $this->base_model->get_empresas($this->session->user_id)->row();
            $areas = $this->base_model->get_areas_emp($empresa->id);
        }
        $resultado = [];
        foreach ($areas->result() as $itm) {
            $numPlayers = $this->ajaxadm_model->num_players_est(false, $nivel, $itm->id, false); //Usuarios que jugaron
            if ($tipo == 1) {
                $item = $numPlayers;
            } else if ($tipo == 2) {
                if ($numPlayers > 0) {
                    $numUsers = $this->ajaxadm_model->num_users_est(false, $itm->id, false); //Numero total de usuarios
                    $item = 100 * round($numPlayers / $numUsers, 4);
                } else {
                    $item = 0;
                }
            } else if ($tipo == 3) {
                if ($numPlayers > 0) {
                    $puntaje = $this->ajaxadm_model->sum_puntos_est($itm->id, $nivel); //Puntaje total obtenido
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
            $numPlayers = $this->ajaxadm_model->num_players_est($empresa, $nivel, $area, $departamento); //Usuarios que jugaron
            $numUsers = $this->ajaxadm_model->num_users_est($empresa, $area, $departamento); //Numero total de usuarios
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

    function get_sede_emps() {
        $id_empresa = $this->input->post('empresa');
        if ($id_empresa) {
            $sendID = $this->input->post('sendID') ? $this->input->post('sendID') : false;
            $ccosto = $this->ajaxadm_model->get_sede_emps($id_empresa, $sendID)->result_array();
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
            $this->session->reporte_data = $this->ajaxadm_model->reporte_data($data);
            $rtabla = $this->ajaxadm_model->reporte_tabla($data);
            $this->session->reporte_tabla = $rtabla;
            echo json_encode($rtabla);
        } else {
            echo 'makanax';
        }
    }

    //parte 1 del reporte de certificados (envio de array con la lista)
    function reporte_certif1() {
        if ($this->session->user_id) {
            echo json_encode($this->ajaxadm_model->reporte_certif1()->result_array());
        } else {
            echo 'makanax';
        }
    }

    //parte 2 del reporte de certificados (creacion de los certificados en PDF)
    function reporte_certif2() {
        $dataArray = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($dataArray == null) {
            echo 'manakax';
            return false;
        }
        $tmp = '/tmp'; //web server
        //$tmp = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir(); //xampp (lan)

        $this->load->library('Certifpdf');
        $obj_pdf = new Certifpdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetCreator('');
        $obj_pdf->SetTitle('Certificado del curso');
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->SetMargins(15, 27, 15);
        $obj_pdf->SetFont('dejavusans', '', 16);
        //OJO!!! que el texto siguiente debe ser exactamente igual al que está
        //en views/mail/pdfcertificado.php
        foreach ($dataArray as $sUser) {
            $obj_pdf->AddPage();
            $html = '<div><br><br><br>'
                    . '<div style="font-size:48px; font-weight:bold; color:#0075bc;">CONSTANCIA</div>'
                    . '<div>LA EMPRESA <b style="font-weight:bold;">' . $sUser['empresa'] . '</b> DEJA CONSTANCIA QUE:</div>'
                    . '<div style="font-weight:bold;">' . $sUser['nombre'] . '</div>'
                    . '<div>HA COMPLETADO LOS (4) CURSOS DE "EXPERTOS EN LA PREVENCIÓN", <br>REALIZADO DURANTE EL AÑO 2017';
            $obj_pdf->writeHTML($html, true, false, true, false, 'C');
        }

        /* En esta parte, la variable final cambia segun:
          I: verlo online
          D: download
          F: guardarlo en el servidor
         */
        $filename = $tmp . '/certificados_' . mdate('%Y-%m-%d_%H-%i-%s') . '.pdf';
        $obj_pdf->Output($filename, 'F');
        $obj_pdf->Close();
        echo $filename;
    }

    //parte 3 del reporte de certificados (envio de certificados por mail)
    function reporte_certif3() {
        $stringPDF = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $this->load->library('email');
        $this->email->set_mailtype('html');
        $this->email->from('no-reply@aprendiendoaprevenir.com', $this->config->item('site_title', 'ion_auth'));
        $this->email->to('aprendiendoaprevenir.sst@gmail.com');
        $this->email->to('jvasquez@factoriamedia.com');
        $this->email->subject('Certificados en PDF - ' . $this->config->item('site_title', 'ion_auth'));
        $this->email->message('Lista del certificados al ' . mdate('%d-%m-%Y %H:%i'));

        foreach ($stringPDF as $filename) {
            $this->email->attach($filename);
        }
        echo $this->email->send();
    }

    //parte 3 del reporte de certificados (descarga de certificados)
    function reporte_certif3B() {
        $stringPDF = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($stringPDF == null) {
            echo 'manakax';
            return false;
        }
        $tmp = '/tmp'; //web server
        //$tmp = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir(); //xampp (lan)
        $this->load->library('zip');
        foreach ($stringPDF as $filename) {
            $this->zip->read_file($filename);
        }
        $certif = 'certificados_' . mdate('%Y-%m-%d_%H-%i');
        $filename = $tmp . '/' . $certif . '.zip';
        $this->zip->archive($filename);
        echo $certif;
    }

}
