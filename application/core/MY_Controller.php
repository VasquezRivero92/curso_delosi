<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load
        $this->load->database();
        $this->load->library(array('ion_auth', 'template', 'mobile_detect', 'session'));
        $this->load->helper(array('array', 'url'));
        $this->load->model('base_model');
        // Data
        $this->data['assets_dir'] = 'assets';
        $this->data['charset'] = $this->config->item('charset');
        // Any mobile device (phones or tablets)
        if ($this->mobile_detect->isMobile()) {
            $this->data['mobile'] = TRUE;
            if ($this->mobile_detect->isiOS()) {
                $this->data['ios'] = TRUE;
                $this->data['android'] = FALSE;
            } elseif ($this->mobile_detect->isAndroidOS()) {
                $this->data['ios'] = FALSE;
                $this->data['android'] = TRUE;
            } else {
                $this->data['ios'] = FALSE;
                $this->data['android'] = FALSE;
            }
            if ($this->mobile_detect->getBrowsers('IE')) {
                $this->data['mobile_ie'] = TRUE;
            } else {
                $this->data['mobile_ie'] = FALSE;
            }
        } else {
            $this->data['mobile'] = FALSE;
            $this->data['ios'] = FALSE;
            $this->data['android'] = FALSE;
            $this->data['mobile_ie'] = FALSE;
        }
    }

    /* su uso es:
      $this->_render_page('login/index', $this->data);
     */

    function _render_page($view, $data = null, $render = false) {
        $this->viewdata = (empty($data)) ? $this->data : $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if (!$render) {
            return $view_html;
        }
    }

    //para comprobar si el usuario puede entrar al menú (y cursos) de reclamaciones
    protected function entraarecla() {
        if ($this->session->user_id <= 50 || $this->has_access('admanc03') || $this->base_model->entraarecla()) {
            return true;
        } else {
            return false;
        }
    }

    protected function entraadriver() {
        if ($this->session->user_id <= 50 || $this->has_access('admanc03') || $this->base_model->entraadriver()) {
            return true;
        } else {
            return false;
        }
    }

    //para comprobar si tiene acceso a ciertos niveles de administrador
    protected function has_access($acceso) {
        if ($this->session->userniv) {
            return $this->base_model->has_access($acceso);
        } else {
            return false;
        }
    }

}

class Nivel_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->ion_auth->logged_in()) {
            $this->data['user_login'] = $this->base_model->user_info_login();
            $this->session->gav = strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
        } else {
            redirect('/login', 'refresh');
        }
    }

}
