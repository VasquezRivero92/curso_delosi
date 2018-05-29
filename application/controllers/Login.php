<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->data['own_dir'] = $this->data['assets_dir'] . "/login";
    }

    function index() {
        if ($this->ion_auth->logged_in()) {
            if ($this->has_access('adm01')) {
                redirect('admin/', 'refresh');
            } elseif ($this->has_access('admanc01')) {
                redirect('adminanc/', 'refresh');
            } else {
                redirect('main/', 'refresh');
            }
        }
        $this->data['iewindow'] = "hide"; //show
        $this->form_validation->set_rules('username', str_replace(':', '', 'login_username_label'), 'required');
        $this->form_validation->set_rules('password', str_replace(':', '', 'login_password_label'), 'required');
        if ($this->form_validation->run() == true) {
            $this->data['iewindow'] = "hide";
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)) {
                $this->base_model->add_visita();
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                if ($this->has_access('adm01')) {
                    redirect('admin/', 'refresh');
                } elseif ($this->has_access('admanc01')) {
                    redirect('adminanc/', 'refresh');
                } else {
                    redirect('main/', 'refresh');
                }
            } elseif ($this->ion_auth->loginTienda($this->input->post('username'), $this->input->post('password'), $remember)) {
                //$this->base_model->add_visita();
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                if ($this->has_access('adm01')) {
                    redirect('admin/', 'refresh');
                } elseif ($this->has_access('admanc01')) {
                    redirect('adminanc/', 'refresh');
                }
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
            }
        }
        $this->data['message'] = (validation_errors()) ? validation_errors('<i>', '</i>') : $this->session->flashdata('message');
        $error_array = $this->form_validation->error_array();
        $input_error = "";
        $pass_error = "";
        foreach ($error_array as $val) {
            if ($val !== '') {
                $this->data['iewindow'] = "hide";
                if (strpos($val, 'username') !== false) {
                    $input_error = "error";
                } elseif (strpos($val, 'password') !== false) {
                    $pass_error = "error";
                }
            }
        }
        $this->data['form_open'] = array(
            'class' => 'clearfix',
            'id' => 'formLogin'
        );
        $this->data['username'] = array(
            'name' => 'username',
            'id' => 'username',
            'class' => 'formInput ' . $input_error,
            'type' => 'text',
            'placeholder' => 'DNI o correo',
            'value' => $this->form_validation->set_value('username')
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'class' => 'formInput ' . $pass_error,
            'placeholder' => 'Contraseña',
            'type' => 'password'
        );
        $this->data['submit'] = array(
            'name' => 'submit',
            'value' => 'LOGIN',
            'class' => 'clearfix',
            'id' => 'submit'
        );
        //para la contraseña olvidada
        $this->data['form_forgot'] = array(
            'class' => 'clearfix',
            'id' => 'formForgot'
        );
        $this->data['forgotten'] = array(
            'name' => 'f-email',
            'id' => 'f-email',
            'class' => 'textInput',
            'placeholder' => 'Ingrese su DNI',
            'type' => 'text',
            'value' => ''
        );
        $this->data['frun'] = array(
            'name' => 'f-submit',
            'id' => 'f-submit',
            'type' => 'button',
            'value' => 'ENVIAR CÓDIGO'
        );
        $this->data['fcode'] = array(
            'name' => 'f-code',
            'id' => 'f-code',
            'class' => 'textInput',
            'placeholder' => 'Código',
            'type' => 'text',
            'value' => ''
        );
        $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
        $this->data['new_password'] = array(
            'name' => 'new_password',
            'id' => 'new_password',
            'class' => 'textInput',
            'placeholder' => 'Nueva contraseña',
            'type' => 'password',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$'
        );
        $this->data['new_password_confirm'] = array(
            'name' => 'new_confirm',
            'id' => 'new_confirm',
            'class' => 'textInput',
            'placeholder' => 'Repita la nueva contraseña',
            'type' => 'password',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$'
        );
        $this->data['fchange'] = array(
            'name' => 'f-change',
            'id' => 'f-change',
            'type' => 'button',
            'value' => 'ACTUALIZAR CONTRASEÑA'
        );
        $this->load->view('login', $this->data);
    }

    function logout() {
        $this->ion_auth->logout();
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/login', 'refresh');
    }

}
