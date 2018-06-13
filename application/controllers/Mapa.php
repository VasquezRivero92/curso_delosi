<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mapa extends Nivel_Controller {


     function __construct() {
        parent::__construct();
        if ($this->ion_auth->logged_in()) {
            $this->session->position = 0;
        } else {
            redirect('/login', 'refresh');
        }
    }

    function index() {
    	$this->data['own_dir'] = $this->data['assets_dir'] . '/mapa';

        $this->data['avatar'] = $this->session->avatar ? ' av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar : 'av-' . $this->session->grupo;
        
        $this->load->view('mapa', $this->data);
    }

}
