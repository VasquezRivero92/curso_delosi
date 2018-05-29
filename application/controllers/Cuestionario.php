<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cuestionario extends Nivel_Controller {

    private $cur = 7;

    function __construct() {
        parent::__construct();
        $cur7 = $this->base_model->get_curso($this->cur);
        if ($cur7 && $cur7->estado || $this->session->userniv) {
            $this->session->curso = $this->cur;
        } else {
            redirect('/main', 'refresh');
        }
    }

    function index() {
        $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
        if ($resul && $resul->intentos > 1) {
            redirect('main/', 'refresh');
        } elseif ($resul) {
            $this->data['intentos'] = (int) $resul->intentos;
        } else {
            $this->data['intentos'] = 0;
        }
        $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/reto';
        $this->data['juego'] = 1;
        $this->data['jNum'] = 1;
        $this->load->view('nivel' . $this->cur . '/reto', $this->data);
    }

    function resultados() {
        redirect('main/', 'refresh');
        $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
        if ($resul && $resul->intentos) {
            $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/resultados';
            $this->data['resul'] = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
            $this->load->view('nivel' . $this->cur . '/resultados', $this->data);
        } else {
            redirect('main/', 'refresh');
        }
    }

}
