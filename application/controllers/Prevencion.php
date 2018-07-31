<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prevencion extends Nivel_Controller {

    private $cur = 9;

    function __construct() {
        parent::__construct();
        $cur9 = $this->base_model->get_curso($this->cur);
        if ($cur9 && $cur9->estado  || $this->session->userniv) {
            $this->session->curso = $this->cur;
        } else {
            redirect('/main', 'refresh');
        }
    }

    function index() {        
        $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/main';
        $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
        if ($resul && $resul->puntaje !== null && $resul->intentos > 1) {
            $this->session->position = 2;
            $this->session->win = 2;
        } else {
            $this->session->position = 1;
            $this->session->win = 1;
        }
        $this->data['checked'] = $this->base_model->check_curso_user($this->session->user_id, $this->cur);
        $this->load->view('nivel' . $this->cur . '/index', $this->data);
    }

    function evacuacion() {        
        if ($this->session->position && $this->session->win == 1) {
            $this->session->position = 2;
            $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
            if ($resul && $resul->intentos > 1) {
                redirect('Prevencion/', 'refresh');
            } elseif ($resul) {
                $this->data['intentos'] = (int) $resul->intentos;
            } else {
                $this->data['intentos'] = 0;
            }
            $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/evacuacion-' . $this->session->grupo;
            $this->data['juego'] = 1;
            $this->data['jNum'] = 1;

            $this->load->view('nivel' . $this->cur . '/evacuacion-' . $this->session->grupo, $this->data);
        } else {
            redirect('prevencion/', 'refresh');
        }
    }



}
