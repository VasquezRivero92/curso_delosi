<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nivel1 extends Nivel_Controller {

    private $cur = 1;

    function __construct() {
        parent::__construct();
        if ($this->base_model->get_max_curso() >= $this->cur || $this->session->userniv) {
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

    function reto() {
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
            $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/reto-' . $this->session->grupo;
            $this->data['juego'] = 1;
            $this->data['jNum'] = 1;
            $this->load->view('nivel' . $this->cur . '/reto-' . $this->session->grupo, $this->data);
        } else {
            redirect('nivel' . $this->cur . '/', 'refresh');
        }
    }

    function resultados() {
        for ($i = 1; $i <= 4; $i++) {
            $resul = $this->base_model->get_puntaje($this->session->user_id, $i);
            if (!$resul || !$resul->intentos || $resul->puntaje < 70) {
                $this->data['certificado_prevencion'] = 'disabled';
                break;
            }else{
                $this->data['certificado_prevencion'] = '';
            }
        }

        $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
        if ($resul && $resul->intentos) {
            $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/resultados';
            $this->data['resul'] = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
            $this->load->view('nivel' . $this->cur . '/resultados', $this->data);
        } else {
            redirect('nivel' . $this->cur . '/', 'refresh');
        }
       
       
        
    } 

    function certificado_prevencion() {
        $this->load->helper('pdf_helper');
        for ($i = 1; $i <= 4; $i++) {
            $resul = $this->base_model->get_puntaje($this->session->user_id, $i);
            if (!$resul || !$resul->intentos || $resul->puntaje < 70) {
                redirect('/nivel1', 'refresh');
            }
        }
        $dataPDF = array(
            'empresa' => $this->base_model->get_empresas($this->session->user_id)->row()->nombre,
            'nombre' => $this->data['user_login']['apat'] . ' ' . $this->data['user_login']['amat'] . ', <br>' . $this->data['user_login']['nombre']
        );
        $this->load->view('mail/pdfcertificado_prevencion', $dataPDF);
    }

}
