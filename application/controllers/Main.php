<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

    function __construct() {
        parent::__construct();
        if ($this->ion_auth->logged_in()) {
            $this->session->position = 0;
        } else {
            redirect('/login', 'refresh');
        }
    }

    function index() {
        $this->load->library('form_validation');
        $this->data['own_dir'] = $this->data['assets_dir'] . '/main';
        $this->data['entraarecla'] = (int)$this->entraarecla();
        $this->data['avatar'] = $this->session->avatar ? ' av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar : 'av-' . $this->session->grupo;
        if ($this->session->old_last_login) {
            $this->base_model->add_visita();
                     
            if ($this->session->avatar) {
                if ($this->entraarecla()) {
                    $this->data['firstWindow'] = 6;
                }else{
                    redirect('/mapa', 'refresh');
                }
            } else {
                $this->data['firstWindow'] = 4;
            }
            
        } else {
            $this->data['firstWindow'] = 1;
            $this->session->old_last_login = time();
            $this->session->first_login = true;
        }        

        $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
        $this->data['newPassword'] = array(
            'name' => 'newPassword',
            'id' => 'newPassword',
            'class' => 'formInput',
            'type' => 'password',
            'placeholder' => 'Nueva contraseña',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$'
        );
        $this->data['reNewPassword'] = array(
            'name' => 'reNewPassword',
            'id' => 'reNewPassword',
            'class' => 'formInput',
            'type' => 'password',
            'placeholder' => 'Repetir nueva contraseña',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$'
        );
        $this->data['npSubmit'] = array(
            'name' => 'submit',
            'id' => 'i1submit',
            'type' => 'submit',
            'value' => 'Actualizar contraseña'
        );
        $this->load->view('main', $this->data);
    }

}
