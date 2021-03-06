<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reclamosfrecuentes_2 extends Nivel_Controller {

    private $cur = 6;

    function __construct() {
        parent::__construct();
        if ($this->entraarecla()) {
            $this->session->curso = $this->cur;
        } else {
            redirect('/main', 'refresh');
        }
    }

    function index() {
        // Para comprobar que resolvieron el minitest del libro de reclamaciones
        $resul5 = $this->base_model->get_puntaje($this->session->user_id, 5);
        if ($this->session->user_id > 20 && (!$resul5 || $resul5->puntaje === null || $resul5->intentos < 1)) {
            redirect('/libroreclamaciones_2', 'refresh');
        }
        // Lo normal
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

    function minitest() {
        if ($this->session->position && $this->session->win == 1) {
            $this->session->position = 2;
            $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
            if ($resul && $resul->intentos > 1) {
                redirect('nivel' . $this->cur . '/', 'refresh');
            } elseif ($resul) {
                $this->data['intentos'] = (int) $resul->intentos;
            } else {
                $this->data['intentos'] = 0;
            }
            $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/minitest';
            $this->data['juego'] = 1;
            $this->data['jNum'] = 1;
            $this->load->view('nivel' . $this->cur . '/minitest', $this->data);
        } else {
            redirect('reclamosfrecuentes_2/', 'refresh');
        }
    }

    function resultados() {
        //los resultados ya estan incorporados en el minitest
        redirect('reclamosfrecuentes_2/', 'refresh');
    }

}
