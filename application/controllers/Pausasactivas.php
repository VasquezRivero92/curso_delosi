<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pausasactivas extends Nivel_Controller {

    private $cur = 10;

    function __construct() {
        parent::__construct();
        $cur10 = $this->base_model->get_curso($this->cur);
        
        if ($cur10 && $cur10->estado || $this->session->userniv) {
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

        // $intent = $this->ajax_model->get_intentos($this->session->user_id)->row();
        // $this->data['intentos'] = $intent;

    }

    function pausas() {        
        if ($this->session->position && $this->session->win == 1) {
            $this->session->position = 2;
            $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
            if ($resul && $resul->intentos > 1) {
                redirect('pausasactivas/', 'refresh');
            } elseif ($resul) {
                $this->data['intentos'] = (int) $resul->intentos;
            } else {
                $this->data['intentos'] = 0;
            }
            $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/pausas-' . $this->session->grupo;
            $this->data['juego'] = 1;
            $this->data['jNum'] = 1;
            $this->load->view('nivel' . $this->cur . '/pausas-' . $this->session->grupo, $this->data);
        } else {
            redirect('pausasactivas/', 'refresh');
        }
    }

    function certificado_pausas() {
        $resul = $this->base_model->get_puntaje($this->session->user_id, $this->session->curso);
        // if ($resul->puntaje < 70) {
        //     redirect('/pausasactivas', 'refresh');
        // }
        $this->load->helper('pdf_helper');
        $fecha = $this->base_model->get_fecha_cursos($this->session->user_id,$this->session->curso)->fecha;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $dataPDF = array(
            'empresa' => $this->base_model->get_empresas($this->session->user_id)->row()->nombre,
            'nombre' => $this->data['user_login']['apat'] . ' ' . $this->data['user_login']['amat'] . ', <br>' . $this->data['user_login']['nombre'],
            'año' => ''. date('Y', $fecha),
            'dia' => ''. date('d', $fecha),
            'mes' => ''. $meses[date('n',$fecha)-1]
        );
        $this->load->view('mail/pdfcertificado_pausas', $dataPDF);
    }



}
