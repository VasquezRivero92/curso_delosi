<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        if ($this->ion_auth->logged_in()) {
            if ($this->has_access('adm01')) {
                $this->load->model('admin_model');
                $this->data['own_dir'] = $this->data['assets_dir'] . '/admin';
                $this->data['admin_menu'] = $this->load->view('admin/template/menu', '', true);
            } else {
                redirect('/main', 'refresh');
            }
        } else {
            redirect('/login', 'refresh');
        }
    }

    function index() {
        
        $this->data['cursos'] = $this->base_model->get_cursos(false)->result();
        $this->_render_page('admin/index', $this->data);
    }

    
    function registrar() {
        
        if (!$this->has_access('adm02')) {
            redirect('admin/', 'refresh');
        }
        $this->load->library('form_validation');
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $this->data['message'] = false;

        $this->form_validation->set_rules('apat', 'apellido paterno', 'required');
        $this->form_validation->set_rules('amat', 'apellido materno', 'required');
        $this->form_validation->set_rules('nombre', 'nombres', 'required');
        $this->form_validation->set_rules('identity', 'dni', 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
        $this->form_validation->set_rules('email', 'email', 'is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'repetir contraseña', 'required');
        $this->form_validation->set_rules('grupo', 'grupo', 'required');
        $this->form_validation->set_rules('nivel', 'nivel', 'required');
        if ($this->input->post('subreguser')) {
            if ($this->form_validation->run() == true) {
                $identity = $this->input->post('identity');
                $data = array(
                    'password' => $this->input->post('password'),
                    'apat' => mb_strtoupper($this->input->post('apat')),
                    'amat' => mb_strtoupper($this->input->post('amat')),
                    'nombre' => mb_strtoupper($this->input->post('nombre')),
                    'email' => mb_strtolower($this->input->post('email')),
                    'sexo' => $this->input->post('sexo'),
                    'id_grupo' => $this->input->post('grupo'),
                    'id_nivel' => $this->input->post('nivel')
                );
            }
            if ($this->form_validation->run() == true && $this->admin_model->register($identity, $data)) {
                $this->data['message'] = 'Usuario registrado';
                $data_user = $this->base_model->get_user($identity);
                $this->data['reg_apat'] = $data_user->apat;
                $this->data['reg_amat'] = $data_user->amat;
                $this->data['reg_nombre'] = $data_user->nombre;
                $this->data['reg_dni'] = $data_user->dni;
                $this->data['reg_id'] = $data_user->id;

                $datamail = $data;
                $datamail['dni'] = $identity;
                $message = $this->load->view('mail/registro', $datamail, true);
                $this->load->library('email');
                $this->email->set_mailtype('html');
                $this->email->from('no-reply@cursodelosi.com', $this->config->item('site_title', 'ion_auth'));
                $this->email->to($identity);
                $this->email->subject('Tus datos en Delosi');
                $this->email->message($message);
                $this->email->send();

                $sendID = false;
                if (!$this->has_access('adm03')) {
                    $sendID = $this->session->user_id;
                }

                $this->data['emp_data'] = $this->rel_array($this->base_model->get_empresas($sendID)->result());
                $this->data['emp_value'] = $this->form_validation->set_value('empresa') ? $this->form_validation->set_value('empresa') : 1;
                $this->data['emp_extra'] = array('id' => 'empresa');
                if ($this->has_access('adm02')) {//esto ahora siempre ocurre
                    $sendID = false;
                }
                $this->data['are_data'] = $this->rel_array($this->base_model->get_areas($sendID)->result());
                $this->data['are_value'] = $this->form_validation->set_value('area') ? $this->form_validation->set_value('area') : 1;
                $this->data['are_extra'] = array('id' => 'area');

                $this->data['dep_data'] = $this->rel_array($this->base_model->get_departamentos($sendID)->result());
                $this->data['dep_value'] = $this->form_validation->set_value('departamento') ? $this->form_validation->set_value('departamento') : 1;
                $this->data['dep_extra'] = array('id' => 'departamento');

                $this->data['car_data'] = $this->rel_array($this->base_model->get_cargos()->result());
                $this->data['car_value'] = $this->form_validation->set_value('cargo') ? $this->form_validation->set_value('cargo') : 1;
                $this->data['car_extra'] = array('id' => 'cargo');

                $this->data['pla_data'] = $this->rel_array($this->base_model->get_planillas()->result());
                $this->data['pla_value'] = $this->form_validation->set_value('planilla') ? $this->form_validation->set_value('planilla') : 1;
                $this->data['pla_extra'] = array('id' => 'planilla');

                $this->data['sede'] = array(
                    'name' => 'sede',
                    'id' => 'sede',
                    'class' => 'ucase',
                    'type' => 'text'
                );
                $this->data['seccion'] = array(
                    'name' => 'seccion',
                    'id' => 'seccion',
                    'class' => 'ucase',
                    'type' => 'text'
                );
                $this->data['fingpla'] = array(
                    'name' => 'fingpla',
                    'id' => 'fingpla',
                    'type' => 'text'
                );
                $this->data['regempuser'] = array(
                    'name' => 'regempuser',
                    'content' => 'Registrar y nuevo',
                    'id' => 'regempuser'
                );
                $this->data['resetempuser'] = array(
                    'name' => 'resetempuser',
                    'value' => 'Limpiar campos',
                    'id' => 'resetempuser'
                );
                $this->data['backempuser'] = array(
                    'name' => 'backempuser',
                    'content' => 'Volver',
                    'id' => 'backempuser'
                );
                $this->_render_page('admin/registrar2', $this->data);
                return false;
            } else {
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->admin_model->messages()));
            }
        }

        $data_group = $this->rel_array($this->base_model->get_grupos()->result());
        $this->data['group_data'] = $data_group;
        $this->data['group_value'] = $this->form_validation->set_value('grupo') ? $this->form_validation->set_value('grupo') : 1;
        $this->data['group_extra'] = array('id' => 'grupo');

        $data_level = $this->rel_array($this->base_model->get_admlvl()->result());
        $this->data['level_data'] = $data_level;
        $this->data['level_value'] = $this->form_validation->set_value('nivel') ? $this->form_validation->set_value('nivel') : 0;
        $this->data['level_extra'] = array('id' => 'nivel');

        $this->data['apat'] = array(
            'name' => 'apat',
            'id' => 'apat',
            'class' => 'ucase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('apat')
        );
        $this->data['amat'] = array(
            'name' => 'amat',
            'id' => 'amat',
            'class' => 'ucase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('amat')
        );
        $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'class' => 'ucase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre')
        );
        $this->data['identity'] = array(
            'name' => 'identity',
            'id' => 'identity',
            'class' => 'lcase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('identity')
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'class' => 'lcase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email')
        );
        $this->data['sexom'] = array(
            'name' => 'sexo',
            'id' => 'sexom',
            'value' => 'M',
            'checked' => TRUE
        );
        $this->data['sexof'] = array(
            'name' => 'sexo',
            'id' => 'sexof',
            'value' => 'F'
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'value' => $this->form_validation->set_value('password')
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'value' => $this->form_validation->set_value('password_confirm')
        );
        $this->data['submit'] = array(
            'name' => 'subreguser',
            'value' => 'Registrar usuario',
            'id' => 'seg-single-sub'
        );
        $this->_render_page('admin/registrar', $this->data);
    }
    
                
    function consulta() {
        $this->load->library('form_validation');
        $this->data['form_query'] = array(
            'class' => 'clearfix',
            'id' => 'form-query'
        );
        $this->data['qapat'] = array(
            'name' => 'q-apat',
            'id' => 'q-apat',
            'class' => 'q-input ucase',
            'type' => 'text',
            'placeholder' => 'Apellido paterno'
        );
        $this->data['qamat'] = array(
            'name' => 'q-amat',
            'id' => 'q-amat',
            'class' => 'q-input ucase',
            'type' => 'text',
            'placeholder' => 'Apellido materno'
        );
        $this->data['qnombre'] = array(
            'name' => 'q-nombre',
            'id' => 'q-nombre',
            'class' => 'q-input ucase',
            'type' => 'text',
            'placeholder' => 'Nombres'
        );
        $this->data['qemail'] = array(
            'name' => 'q-email',
            'id' => 'q-email',
            'class' => 'q-input lcase',
            'type' => 'text',
            'placeholder' => 'Email'
        );
        $this->data['qdni'] = array(
            'name' => 'q-dni',
            'id' => 'q-dni',
            'class' => 'q-input ucase',
            'type' => 'text',
            'placeholder' => 'DNI'
        );
        $this->data['qrun'] = array(
            'name' => 'q-submit',
            'id' => 'q-submit',
            'type' => 'button',
            'value' => 'Consultar'
        );

        $sendID = false;
        if (!$this->has_access('adm03') && $this->session->tipo == 'user') {
            $sendID = $this->session->user_id;
        } elseif (!$this->has_access('adm03') && $this->session->tipo == 'tienda') {
            $sendID = $this->session->usuario2;
        }
        if ($sendID) {
            $tituloEmp = false;
        } else {
            $tituloEmp = '- TODAS LAS EMPRESAS -';
        }
        $this->data['emp_data'] = $this->rel_array($this->base_model->get_empresas($sendID)->result(), $tituloEmp);
        $this->data['emp_value'] = $this->form_validation->set_value('empresa') ? $this->form_validation->set_value('empresa') : 1;
        $this->data['emp_extra'] = array('id' => 'empresa');
        if ($this->has_access('adm02')) {
            $sendID = false;
        }
        $this->data['are_data'] = $this->rel_array($this->base_model->get_areas($sendID)->result(), '- TODAS LAS ÁREAS -');
        $this->data['are_value'] = $this->form_validation->set_value('area') ? $this->form_validation->set_value('area') : 1;
        $this->data['are_extra'] = array('id' => 'area');

        $this->data['dep_data'] = $this->rel_array($this->base_model->get_departamentos($sendID)->result(), '- TODOS LOS DEPARTAMENTOS -');
        $this->data['dep_value'] = $this->form_validation->set_value('departamento') ? $this->form_validation->set_value('departamento') : 1;
        $this->data['dep_extra'] = array('id' => 'departamento');

        $this->data['qorden_ape'] = array(
            'name' => 'q-orden',
            'id' => 'q-orden-ape',
            'class' => 'q-orden',
            'value' => 'ape',
            'checked' => TRUE
        );
        $this->data['qorden_ptj'] = array(
            'name' => 'q-orden',
            'id' => 'q-orden-ptj',
            'class' => 'q-orden',
            'value' => 'ptj'
        );
        $this->_render_page('admin/consulta', $this->data);
        
    }

    function reporte_consulta($ptj = false) {        
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Consulta de usuarios');
        $users = $this->session->reporte_consulta;
        if ($ptj == 'puntaje') {//burbuja si hay que ordenar por puntaje
            $sorted = false;
            while (!$sorted) {
                $sorted = true;
                foreach ($users as $i => $user) {
                    if ((count($users) > $i + 1) && ((int) $user['total'] < (int) $users[$i + 1]['total'])) {
                        $users[$i] = $users[$i + 1];
                        $users[$i + 1] = $user;
                        $sorted = false;
                    }
                }
            }
        }
        $aarea = $this->rel_array($this->base_model->get_areas()->result());
        $apla = $this->rel_array($this->base_model->get_planillas()->result());
        $acar = $this->rel_array($this->base_model->get_cargos()->result());
        $aest = array('CESADO', 'ACTIVO');
        $CCursos = $this->base_model->get_cursos()->result();
        $arrayExcel = [];
        foreach ($users as $i => $user) {
            $data = $this->admin_model->data_consulta($user['id'], $this->session->data_consulta);
            $temp = [];
            $temp[] = $data->sede;
            $temp[] = $aarea[$data->id_area];
            $temp[] = $user['dni'];
            $temp[] = $user['apat'];
            $temp[] = $user['amat'];
            $temp[] = $user['nombre'];
            $temp[] = $user['sexo'];
            $temp[] = $apla[$data->id_planilla];
            $temp[] = $acar[$data->id_cargo];
            $temp[] = $aest[$user['active']];
            $temp[] = ($user['last_login']) ? 'SI' : 'NO';
            foreach ($CCursos as $curso) {
                if ($user['c' . $curso->id] === 0) {
                    $temp[] = '';
                    $temp[] = '';
                    $temp[] = '';
                } elseif ($user['c' . $curso->id]) {
                    $temp[] = $user['c' . $curso->id];
                    $temp[] = $user['calificacion' . $curso->id];
                    $temp[] = date('d-m-Y H:i:s', $user['fecha' . $curso->id]);

                } else {
                    $temp[] = '';
                    $temp[] = '';
                    $temp[] = '';
                }
            }
            $temp[] = '' . $user['total'];
            $arrayExcel[] = $temp;
        }
        $this->excel->getActiveSheet()->fromArray($arrayExcel, null, 'A2');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sede');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Área');
        $this->excel->getActiveSheet()->setCellValue('C1', 'DNI');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Apellido paterno');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Apellido materno');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Nombres');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Sexo');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Planilla');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Cargo');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Estado');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Datos autorizados');
        $c = 10;
        $x = 0;
        $d = 0;
        foreach ($CCursos as $curso) {
            $c++;
            $x = $c + 1;
            $d = $c + 2;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, 1, $curso->nombre);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($x, 1, 'Calificación ' . $curso->descrip);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($d, 1, 'fecha ' . $curso->descrip);
            $c = $c + 2;
        }
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c + 1, 1, 'Total');
        $lCol = PHPExcel_Cell::stringFromColumnIndex($c + 1);
        $this->excel->getActiveSheet()->getStyle('A1:' . $lCol . '1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:' . $lCol . '1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('CCCCCC');
        foreach (range('A', $lCol) as $columnID) {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $filename = 'consulta_' . mdate('%Y-%m-%d_%H-%i') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    function editar_usuario() {
        if (!$this->has_access('adm02')) {
            redirect('admin/', 'refresh');
        }
        $this->load->library('form_validation');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $this->form_validation->set_rules('apat', 'apellido paterno', 'required');
        $this->form_validation->set_rules('amat', 'apellido materno', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('identity', 'dni', 'required');
        $this->form_validation->set_rules('nombre', 'nombres', 'required');
        $this->form_validation->set_rules('direccion', 'direccion', 'required');
        $this->form_validation->set_rules('grupo', 'grupo', 'required');
        $this->form_validation->set_rules('nivel', 'nivel', 'required');
        if (!$this->input->post()) {
            redirect('admin/consulta', 'refresh');
        }
        $qid = $this->input->post('q-id');
        if ($qid) {
            $user = $this->ion_auth->user($qid)->row();
        } else {
            $id = $this->input->post('id');
            $user = $this->ion_auth->user($id)->row();
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error('error_csrf');
            }
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', 'contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', 'repetir contraseña', 'required');
            }
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'apat' => mb_strtoupper($this->input->post('apat')),
                    'amat' => mb_strtoupper($this->input->post('amat')),
                    'nombre' => mb_strtoupper($this->input->post('nombre')),
                    'email' => mb_strtolower($this->input->post('email')),
                    'dni' => mb_strtolower($this->input->post('identity')),
                    'id_grupo' => (int) $this->input->post('grupo'),
                    'id_nivel' => (int) $this->input->post('nivel')
                );
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }
                if ($this->ion_auth->update($user->id, $data)) {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    $datamail = $this->ion_auth->user($id)->row();
                    if (isset($data['password'])) {
                        $datamail->password = $data['password'];
                    } else {
                        unset($datamail->password);
                    }
                    $message = $this->load->view('mail/update', $datamail, true);
                    $this->load->library('email');
                    $this->email->set_mailtype('html');
                    $this->email->from('no-reply@cursodelosi.com', $this->config->item('site_title', 'ion_auth'));
                    $this->email->to($datamail->email);
                    $this->email->subject('Tus datos actualizados en Delosi');
                    $this->email->message($message);
                    $this->email->send();
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
            }
        }

        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['user'] = $user;

        $data_group = $this->rel_array($this->base_model->get_grupos()->result());
        $this->data['group_data'] = $data_group;
        $this->data['group_value'] = $this->form_validation->set_value('grupo', $user->id_grupo);
        $this->data['group_extra'] = array('id' => 'grupo');

        $data_level = $this->rel_array($this->base_model->get_admlvl()->result());
        $this->data['level_data'] = $data_level;
        $this->data['level_value'] = $this->form_validation->set_value('nivel', $user->id_nivel);
        $this->data['level_extra'] = array('id' => 'nivel');

        $this->data['apat'] = array(
            'name' => 'apat',
            'id' => 'apat',
            'class' => 'ucase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('apat', $user->apat),
        );
        $this->data['amat'] = array(
            'name' => 'amat',
            'id' => 'amat',
            'class' => 'ucase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('amat', $user->amat),
        );
        $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'class' => 'ucase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre', $user->nombre),
        );
        $this->data['identity'] = array(
            'name' => 'identity',
            'id' => 'identity',
            'class' => 'ucase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('identity', $user->dni)
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'class' => 'lcase',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email', $user->email)
        );

        if (strtoupper($user->sexo) == 'M') {
            $sexo = array(true, false);
        } else {
            $sexo = array(false, true);
        }
        $this->data['sexom'] = array(
            'name' => 'sexo',
            'id' => 'sexom',
            'value' => 'M',
            'checked' => $sexo[0]
        );
        $this->data['sexof'] = array(
            'name' => 'sexo',
            'id' => 'sexof',
            'value' => 'F',
            'checked' => $sexo[1]
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password'
        );
        $this->data['est_data'] = array('1' => 'Activo', '0' => 'Cesado');
        $this->data['est_value'] = $this->form_validation->set_value('estado', $user->active);
        $this->data['est_extra'] = array('id' => 'estado');
        $this->data['submit'] = array(
            'name' => 'submit',
            'type' => 'button',
            'value' => 'Actualizar datos',
            'id' => 'update-sub'
        );
        $sendID = false;
        if (!$this->has_access('adm03') && $this->session->tipo == 'user') {
            $sendID = $this->session->user_id;
        } elseif (!$this->has_access('adm03') && $this->session->tipo == 'tienda') {
            $sendID = $this->session->usuario2;
        }
        $this->data['niv_data'] = $this->rel_array($this->base_model->get_cursos()->result());
        $this->data['niv_value'] = 1;
        $this->data['niv_extra'] = array('id' => 'puntaje');
        $this->data['cleanpoints'] = array(
            'name' => 'cleanpoints',
            'type' => 'button',
            'value' => 'Resetear puntos',
            'id' => 'cleanpoints'
        );
        $this->data['emp_data'] = $this->rel_array($this->base_model->get_empresas($sendID)->result());
        $this->data['emp_value'] = 1;
        $this->data['emp_extra'] = array('id' => 'empresa');
        if ($this->has_access('adm02')) {
            $sendID = false;
        }

        $this->data['are_data'] = $this->rel_array($this->base_model->get_areas($sendID)->result());
        $this->data['are_value'] = 1;
        $this->data['are_extra'] = array('id' => 'area');

        $this->data['dep_data'] = $this->rel_array($this->base_model->get_departamentos($sendID)->result());
        $this->data['dep_value'] = 1;
        $this->data['dep_extra'] = array('id' => 'departamento');

        $this->data['car_data'] = $this->rel_array($this->base_model->get_cargos()->result());
        $this->data['car_value'] = 1;
        $this->data['car_extra'] = array('id' => 'cargo');

        $this->data['pla_data'] = $this->rel_array($this->base_model->get_planillas()->result());
        $this->data['pla_value'] = 1;
        $this->data['pla_extra'] = array('id' => 'planilla');
        $this->data['newreg'] = array(
            'name' => 'newreg',
            'type' => 'button',
            'value' => 'Nuevo registro',
            'id' => 'newreg'
        );
        $this->data['updreg'] = array(
            'name' => 'updreg',
            'type' => 'button',
            'value' => 'Actualizar registro',
            'id' => 'updreg'
        );
        $this->data['delreg'] = array(
            'name' => 'delreg',
            'type' => 'button',
            'value' => 'Eliminar registro',
            'id' => 'delreg'
        );
        $this->_render_page('admin/editar_usuario', $this->data);
    }

    function masivo() {
        if (!$this->has_access('adm02')) {
            redirect('admin/', 'refresh');
        }
        $this->_render_page('admin/masivo', $this->data);
    }

    function estadisticas($param = false) {
        if (!$this->has_access('adm02')) {
            redirect('admin/', 'refresh');
        }
        $this->load->library('form_validation');
        $url = 'index';
        $sendID = false;
        if (!$this->has_access('adm03') && $this->session->tipo == 'user') {
            $sendID = $this->session->user_id;
        }
        $empresas = $this->base_model->get_empresas($sendID);
        if ($param == 'estatus') {
            $url = 'estatus';
            if ($sendID) {
                $this->data['areas'] = array_column($this->base_model->get_areas_emp($empresas->row()->id)->result_array(), 'nombre');
            } else {
                $this->data['areas'] = array_column($this->base_model->get_areas()->result_array(), 'nombre');
            }
            $this->data['niv_data'] = $this->rel_array($this->base_model->get_cursos()->result(), true);
            $this->data['niv_value'] = 1;
            $this->data['niv_extra'] = array('id' => 'nivel');
        } elseif ($param == 'avance') {
            $url = 'avance-area';

            $this->data['emp_data'] = $this->rel_array($empresas->result(), '- TODAS LAS EMPRESAS -');
            $this->data['emp_value'] = 1;
            $this->data['emp_extra'] = array('id' => 'empresa');

            $this->data['are_data'] = $this->rel_array($this->base_model->get_areas()->result(), '- TODAS LAS ÁREAS -');
            $this->data['are_value'] = 0;
            $this->data['are_extra'] = array('id' => 'area');

            $this->data['dep_data'] = $this->rel_array($this->base_model->get_departamentos()->result(), '- TODOS LOS DEPARTAMENTOS -');
            $this->data['dep_value'] = 0;
            $this->data['dep_extra'] = array('id' => 'departamento');

            $this->data['niv_data'] = $this->rel_array($this->base_model->get_cursos()->result(), '- TODOS LOS NIVELES -');
            $this->data['niv_value'] = 0;
            $this->data['niv_extra'] = array('id' => 'nivel');
        }elseif ($param == 'calificacion') {
            $url = 'calificacion';

            $this->data['emp_data'] = $this->rel_array($empresas->result(), '- TODAS LAS EMPRESAS -');
            $this->data['emp_value'] = 0;
            $this->data['emp_extra'] = array('id' => 'empresa');

            $this->data['are_data'] = $this->rel_array($this->base_model->get_areas()->result(), '- TODAS LAS ÁREAS -');
            $this->data['are_value'] = 0;
            $this->data['are_extra'] = array('id' => 'area');

            $this->data['dep_data'] = $this->rel_array($this->base_model->get_departamentos()->result(), '- TODOS LOS DEPARTAMENTOS -');
            $this->data['dep_value'] = 0;
            $this->data['dep_extra'] = array('id' => 'departamento');

            $this->data['niv_data'] = $this->rel_array($this->base_model->get_cursos()->result(), '- TODOS LOS NIVELES -');
            $this->data['niv_value'] = 0;
            $this->data['niv_extra'] = array('id' => 'nivel');

            // $this->data['cali_data'] = $this->rel_array($this->base_model->get_cali()->result(), '- TODAS LAS CALIFICACIONES -');
            // $this->data['cali_value'] = 1;
            // $this->data['cali_extra'] = array('id' => 'calificacion');

        } else {
            $this->data['visitas'] = $this->admin_model->get_visitas(7);
        }
        $this->data['estadisticas_menu'] = $this->load->view('admin/template/estadisticas_menu', '', true);
        $this->_render_page('admin/estadisticas/' . $url, $this->data);
    }

    function ranking() {
        $this->data['top'] = [];
        $sendID = false;
        if (!$this->has_access('adm02') && $this->session->tipo == 'tienda') {
            $sendID = $this->session->usuario2;
        }
        $this->data['areas'] = $this->base_model->get_areas($sendID)->result();
        $this->data['cursos'] = $this->base_model->get_cursos()->result();
        foreach ($this->data['areas'] as $itm) {
            $this->data['top'][$itm->nombre] = $this->admin_model->get_ranking(0, $itm->id, 0, 10);
        }
        $this->session->reporte_ranking = $this->data['top'];
        $this->_render_page('admin/ranking', $this->data);
    }

    function reporte_ranking() {
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Consulta de usuarios');
        $sendID = false;
        if (!$this->has_access('adm02') && $this->session->tipo == 'tienda') {
            $sendID = $this->session->usuario2;
        }
        $areas = $this->base_model->get_areas($sendID)->result();
        $top = $this->session->reporte_ranking;
        $CCursos = $this->base_model->get_cursos()->result();

        $this->excel->getActiveSheet()->setCellValue('A2', 'Nº');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Apellido paterno');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Apellido materno');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Nombres');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Email');
        $c = 4;
        foreach ($CCursos as $curso) {
            $c++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, 2, $curso->nombre);
        }
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c + 1, 2, 'Total');
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c + 2, 2, 'Fecha');
        $lCol = PHPExcel_Cell::stringFromColumnIndex($c + 2);
        $this->excel->getActiveSheet()->getStyle('A1:' . $lCol . '2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:' . $lCol . '2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('CCCCCC');

        $bordes = array(
            'borders' => array('horizontal' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
            'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        );
        $this->excel->getActiveSheet()->getStyle('A1:' . $lCol . '2')->applyFromArray($bordes);

        $initrow = 3;
        foreach ($areas as $itm) {
            $arrayExcel = [];
            $cant = count($top[$itm->nombre]);

            $this->excel->getActiveSheet()->mergeCells('A' . ($initrow - 2) . ':' . $lCol . ($initrow - 2));
            $this->excel->getActiveSheet()->setCellValue('A' . ($initrow - 2), $itm->nombre);
            foreach ($top[$itm->nombre] as $i => $user) {
                $temp = [];
                $temp[] = $i + 1;
                $temp[] = $user['apat'];
                $temp[] = $user['amat'];
                $temp[] = $user['nombre'];
                $temp[] = $user['email'];
                foreach ($CCursos as $curso) {
                    if ($user['c' . $curso->id] === 0) {
                        $temp[] = '0';
                    } elseif ($user['c' . $curso->id]) {
                        $temp[] = $user['c' . $curso->id];
                    } else {
                        $temp[] = '';
                    }
                }
                $temp[] = '' . $user['total'];
                $temp[] = '' . date('d-m-Y', $user['fecha']);
                $arrayExcel[] = $temp;
            }
            $this->excel->getActiveSheet()->fromArray($arrayExcel, null, 'A' . $initrow);
            if ($initrow > 3) {
                $f = $initrow - 1;
                $header = $this->excel->getActiveSheet()->rangeToArray('A2:' . $lCol . '2');
                $this->excel->getActiveSheet()->fromArray($header, null, 'A' . $f);
                $this->excel->getActiveSheet()->getStyle('A' . ($f - 1) . ':' . $lCol . $f)->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A' . ($f - 1) . ':' . $lCol . $f)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('CCCCCC');
                $this->excel->getActiveSheet()->getStyle('A' . ($f - 1) . ':' . $lCol . $f)->applyFromArray($bordes);
            }
            if (!$cant) {
                $this->excel->getActiveSheet()->setCellValue('E' . $initrow, 'Sin resultados');
                $this->excel->getActiveSheet()->getStyle('E' . $initrow)->getFont()->setBold(true);
                $initrow += $cant + 4;
            }else{
                $initrow += $cant + 3;
            }
        }


        foreach (range('A', $lCol) as $columnID) {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $filename = 'reporte_ranking_' . mdate('%Y-%m-%d_%H-%i') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    function reporte() {
        $this->load->library('form_validation');
        $this->data['form_reporte'] = array(
            'id' => 'form-reporte',
            'class' => 'clearfix'
        );
        $sendID = false;
        if (!$this->has_access('adm03') && $this->session->tipo == 'user') {
            $sendID = $this->session->user_id;
        } elseif (!$this->has_access('adm03') && $this->session->tipo == 'tienda') {
            $sendID = $this->session->usuario2;
        }
        $this->data['emp_data'] = $this->rel_array($this->base_model->get_empresas($sendID)->result());
        $this->data['emp_value'] = null;
        $this->data['emp_extra'] = array('id' => 'empresa');

        $data_sede = [];
        foreach ($this->base_model->get_sedes()->result() as $sede) {
            $data_sede[$sede->sede] = $sede->seccion;
        }
        $this->data['sede_data'] = $data_sede;
        $this->data['sede_value'] = null;
        $this->data['sede_extra'] = array(
            'id' => 'sede',
            'disabled' => 'disabled'
        );

        $this->data['niv_data'] = $this->rel_array($this->base_model->get_cursos()->result());
        $this->data['niv_value'] = 1;
        $this->data['niv_extra'] = array('id' => 'nivel');

        $this->data['fechainic'] = array(
            'name' => 'fechainic',
            'id' => 'fechainic',
            'class' => 'q-input',
            'type' => 'text',
            'placeholder' => 'Fecha de inicio'
        );
        $this->data['fechafin'] = array(
            'name' => 'fechafin',
            'id' => 'fechafin',
            'class' => 'q-input',
            'type' => 'text',
            'placeholder' => 'Fecha final'
        );

        $this->data['rorden_ape'] = array(
            'name' => 'r-orden',
            'id' => 'r-orden-ape',
            'class' => 'r-orden',
            'value' => 'ape',
            'checked' => TRUE
        );
        $this->data['rorden_fecha'] = array(
            'name' => 'r-orden',
            'id' => 'r-orden-fecha',
            'class' => 'r-orden',
            'value' => 'fecha'
        );
        $this->data['reprun'] = array(
            'name' => 'r-submit',
            'id' => 'r-submit',
            'type' => 'button',
            'value' => 'Vista previa',
            'disabled' => 'disabled'
        );
        $this->_render_page('admin/reporte', $this->data);
    }

    function reporte_descarga() {
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Reporte de usuarios');
        $rData = $this->session->reporte_data;
        $users = $this->session->reporte_tabla;
        $tot_users = count($users);
        $finData = $tot_users + 14;
        $foot1 = $tot_users + 16;
        $foot2 = $tot_users + 17;
        $foot3 = $tot_users + 18;
        $foot4 = $tot_users + 19;
        foreach ($users as $i => $user) {
            $users[$i]['id'] = $i + 1;
            $users[$i]['seccion'] = $rData['seccion'];
            unset($users[$i]['puntaje']);
            $users[$i]['fecha'] = date('d-m-Y', $users[$i]['fecha']);
        }
        //creacion del titulo
        $this->excel->getActiveSheet()->getStyle('B2:E2')->applyFromArray(array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)));
        $this->excel->getActiveSheet()->getStyle('B2:E2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('B2:E2');
        $this->excel->getActiveSheet()->setCellValue('B2', 'REGISTRO DE CAPACITACIÓN DE SEGURIDAD Y SALUD EN EL TRABAJO');
        //creacion de los encabezados
        $this->excel->getActiveSheet()->setCellValue('B4', 'RAZÓN SOCIAL');
        $this->excel->getActiveSheet()->setCellValue('B5', 'RUC');
        $this->excel->getActiveSheet()->setCellValue('B6', 'DOMICILIO');
        $this->excel->getActiveSheet()->setCellValue('B8', 'FECHA DE REGISTRO');
        $this->excel->getActiveSheet()->setCellValue('B10', 'TIPO DE EVENTO');
        $this->excel->getActiveSheet()->setCellValue('B11', 'CAPACITACIÓN');
        $this->excel->getActiveSheet()->setCellValue('B12', 'ENTRENAMIENTO');
        $this->excel->getActiveSheet()->setCellValue('D4', 'ACTIVIDAD ECONÓMICA');
        $this->excel->getActiveSheet()->setCellValue('D8', 'N° DE HORAS');
        $this->excel->getActiveSheet()->setCellValue('D9', 'TEMA DE CAPACITACIÓN');
        $this->excel->getActiveSheet()->setCellValue('D11', 'INDUCCIÓN');
        $this->excel->getActiveSheet()->setCellValue('D12', 'SIMULACRO DE EMERGENCIA');
        //creacion de los pies de hoja
        $this->excel->getActiveSheet()->setCellValue('C' . $foot1, 'Responsable del Registro');
        $this->excel->getActiveSheet()->setCellValue('C' . $foot2, 'Cargo');
        $this->excel->getActiveSheet()->setCellValue('C' . $foot3, 'Firma');
        $this->excel->getActiveSheet()->setCellValue('C' . $foot4, 'Fecha');
        //datos seleccionados
        $this->excel->getActiveSheet()->setCellValue('C4', $rData['empresa']);
        $this->excel->getActiveSheet()->setCellValue('C5', $rData['ruc']);
        $this->excel->getActiveSheet()->setCellValue('C8', mdate('%d/%m/%Y'));
        $this->excel->getActiveSheet()->setCellValue('C11', 'X');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Restaurantes, bares y cantinas');
        $this->excel->getActiveSheet()->setCellValue('E8', $rData['duracion']);
        $this->excel->getActiveSheet()->setCellValue('E9', $rData['nivel']);
        //llenado de datos de los usuarios
        $this->excel->getActiveSheet()->setCellValue('B14', 'Nº');
        $this->excel->getActiveSheet()->mergeCells('C14:D14');
        $this->excel->getActiveSheet()->setCellValue('C14', 'APELLIDOS');
        $this->excel->getActiveSheet()->setCellValue('E14', 'NOMBRES');
        $this->excel->getActiveSheet()->setCellValue('F14', 'DNI');
        $this->excel->getActiveSheet()->setCellValue('G14', 'SECCIÓN');
        $this->excel->getActiveSheet()->setCellValue('H14', 'FECHA DE EJECUCION');
        $this->excel->getActiveSheet()->setCellValue('I14', 'FIRMA');
        $this->excel->getActiveSheet()->fromArray($users, null, 'B15');
        //estilos
        $this->excel->getActiveSheet()->getStyle('B4:B10')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D4:D9')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B14:I14')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C' . $foot1 . ':C' . $foot4)->getFont()->setBold(true);
        $bordes0 = array(
            'borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
            'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        );
        $bordes1 = array(
            'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
            'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        );
        $this->excel->getActiveSheet()->getStyle('B4:B6')->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('C4:C6')->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('D4:D6')->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('E4:E6')->applyFromArray($bordes0);

        $this->excel->getActiveSheet()->getStyle('B8:B9')->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('C8:C9')->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('D8:D9')->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('E8:E9')->applyFromArray($bordes0);

        $this->excel->getActiveSheet()->getStyle('B10:E10')->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('B11:E12')->applyFromArray($bordes1);

        $this->excel->getActiveSheet()->getStyle('B14:H14')->applyFromArray($bordes1);
        $this->excel->getActiveSheet()->getStyle('B15:B' . $finData)->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('C15:C' . $finData)->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('D15:D' . $finData)->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('E15:E' . $finData)->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('F15:F' . $finData)->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('G15:G' . $finData)->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('H15:H' . $finData)->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('I15:I' . $finData)->applyFromArray($bordes0);
        $this->excel->getActiveSheet()->getStyle('C' . $foot1 . ':E' . $foot4)->applyFromArray($bordes0);

        foreach (range('B', 'G') as $columnID) {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $filename = 'reporte_' . mdate('%Y-%m-%d_%H-%i') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    /*     * ***************************************************************** */

    function rel_array($resulset, $todo = false) {
        $data = [];
        if ($todo === true) {
            $data[0] = '- TODO -';
        } elseif ($todo) {
            $data[0] = $todo;
        }
        foreach ($resulset as $item) {
            $data[$item->id] = $item->nombre;
        }
        return $data;
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);
        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * ******************************  Programacion interna  *********************************** */

    function reporte_total() {
        $rtotal = $this->admin_model->reporte_total();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Reporte total');

        $this->excel->getActiveSheet()->fromArray($rtotal, null, 'A2', true);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Razón Social');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Apellido paterno');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Apellido materno');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Nombres');
        $this->excel->getActiveSheet()->setCellValue('E1', 'DNI');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Tienda');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Puntaje');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Fecha');
        $this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('CCCCCC');
        foreach (range('A', 'H') as $columnID) {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $filename = 'reporte_' . mdate('%Y-%m-%d_%H-%i') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    function reporte_custom() {
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Consulta de usuarios');
        $users = $this->admin_model->reporte_custom();
        $aarea = $this->rel_array($this->base_model->get_areas()->result());
        $apla = $this->rel_array($this->base_model->get_planillas()->result());
        $acar = $this->rel_array($this->base_model->get_cargos()->result());
        $aest = array('CESADO', 'ACTIVO');
        $CCursos = $this->base_model->get_cursos()->result();
        $arrayExcel = [];
        foreach ($users as $i => $user) {
            $data = $this->admin_model->data_consulta($user['id'], $this->session->data_consulta);
            $temp = [];
            $temp[] = $data->sede;
            $temp[] = $aarea[$data->id_area];
            $temp[] = $user['dni'];
            $temp[] = $user['apat'];
            $temp[] = $user['amat'];
            $temp[] = $user['nombre'];
            $temp[] = $user['sexo'];
            $temp[] = $apla[$data->id_planilla];
            $temp[] = $acar[$data->id_cargo];
            $temp[] = $aest[$user['active']];
            $temp[] = ($user['last_login']) ? 'SI' : 'NO';
            foreach ($CCursos as $curso) {
                if ($user['c' . $curso->id] === 0) {
                    $temp[] = '0';
                } elseif ($user['c' . $curso->id]) {
                    $temp[] = $user['c' . $curso->id];
                } else {
                    $temp[] = '';
                }
            }
            $temp[] = '' . $user['total'];
            $arrayExcel[] = $temp;
        }
        $this->excel->getActiveSheet()->fromArray($arrayExcel, null, 'A2');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sede');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Área');
        $this->excel->getActiveSheet()->setCellValue('C1', 'DNI');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Apellido paterno');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Apellido materno');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Nombres');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Sexo');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Planilla');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Cargo');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Estado');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Datos autorizados');
        $c = 10;
        foreach ($CCursos as $curso) {
            $c++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, 1, $curso->nombre);
        }
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c + 1, 1, 'Total');
        $lCol = PHPExcel_Cell::stringFromColumnIndex($c + 1);
        $this->excel->getActiveSheet()->getStyle('A1:' . $lCol . '1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:' . $lCol . '1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('CCCCCC');
        foreach (range('A', $lCol) as $columnID) {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $filename = 'consulta_' . mdate('%Y-%m-%d_%H-%i') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    function clean_puntaje() {
        echo 'Registros Actualizados:<br>';
        echo $this->admin_model->clean_puntaje();
    }

    function reporte_certif() {
        if (!$this->has_access('adm03')) {
            redirect('admin/', 'refresh');
        }
        $this->load->library('form_validation');
        $this->data['form_rc'] = array(
            'id' => 'form-rc',
            'class' => 'clearfix'
        );
        $this->data['rc_download'] = array(
            'name' => 'rc-opcion',
            'class' => 'rc-opcion',
            'id' => 'rc-download',
            'value' => 'download',
            'checked' => TRUE
        );
        $this->data['rc_mail'] = array(
            'name' => 'rc-opcion',
            'class' => 'rc-opcion',
            'id' => 'rc-mail',
            'value' => 'mail'
        );
        $this->data['rc_submit'] = array(
            'name' => 'rc-submit',
            'id' => 'rc-submit',
            'type' => 'button',
            'value' => 'Go!'
        );
        $this->_render_page('admin/reporte_certif', $this->data);
    }

    function certificados_descarga($certif = false) {
        $tmp = '/tmp'; //web server
        //$tmp = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir(); //xampp (lan)
        if ($certif && file_exists($tmp . '/' . $certif . '.zip')) {
            $this->load->helper('download');
            force_download($tmp . '/' . $certif . '.zip', NULL);
        }
    }
    
        
    
    function get_update_user_curso() {
        $id_cargo = 88;
        $consulta = $this->rel_array($this->base_model->get_update_user_curso($id_cargo)->result());
        // $consulta;
        
//        $this->data['car_data']= $this->rel_array($this->base_model->get_cargos()->result());
//        $this->data['car_value'] = $this->form_validation->set_value('cargo') ? $this->form_validation->set_value('cargo') : 1;
//        $this->data['car_extra'] = array('id' => 'cargo');
  
//        $this->db->update('id_user',$consulta)
//                 ->get('user_anc');
 
        
      $this->_render_page('admin/get_update_user_curso',$consulta);
    }   
    

}
