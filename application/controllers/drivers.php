<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends Nivel_Controller {

    private $cur = 8;

    function __construct() {
        parent::__construct();
        if ($this->entraadriver()) {
            $this->session->curso = $this->cur;

        } else {
            redirect('/main', 'refresh');
        }
    }

    function index() {        
        // Lo normal
        $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/main';
        $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
        
        if ($resul && $resul->puntaje == null && $resul->intentos == 100 || $resul->puntaje !== null){
            $this->session->position = 1;
            $this->session->win = 1;            
        }else if ($resul && $resul->puntaje == null && $resul->intentos == 121 || $resul->puntaje !== null){
            $this->session->position = 1;
            $this->session->win = 3;            
        }else if ($resul && $resul->puntaje == null && $resul->intentos == 120 || $resul->puntaje !== null){
            $this->session->position = 1;
            $this->session->win = 3;            
        }else if ($resul && $resul->puntaje == null && $resul->intentos == 111 || $resul->puntaje !== null){
            $this->session->position = 1;
            $this->session->win = 1;
        }else if ($resul && $resul->puntaje == null && $resul->intentos == 110 || $resul->puntaje !== null){
            $this->session->position = 1;
            $this->session->win = 3;
        }else if ($resul && $resul->puntaje == null && $resul->intentos == 112 || $resul->puntaje !== null){
            $this->session->position = 1;
            $this->session->win = 1;
        }else{            
            $this->session->position = 2;
            $this->session->win = 2;            
        }    
        $this->data['checked'] = $this->base_model->check_curso_user($this->session->user_id, $this->cur);
        $this->load->view('nivel' . $this->cur . '/index', $this->data);
    }

    function minitest() {
        
        if ($this->session->position && $this->session->win == 1) {
            $this->session->position = 2;
            $this->session->win = 3;
            $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);    
            $minitest = $resul->intentos ? substr(($resul->intentos),-2,1): 0;
            $moto = $resul->intentos ? substr(($resul->intentos),-1,1): 0;        
            if ($resul && $minitest >= 2) {
                redirect('drivers/', 'refresh');
            } elseif ($resul) {
                $this->data['intentos'] = (int) $minitest;
            } else {
                $this->data['intentos'] = 0;
            }
            $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/minitest';
            $this->data['juego'] = 1;
            $this->data['jNum'] = 1;
            $this->load->view('nivel' . $this->cur . '/minitest', $this->data);
        } else {
            redirect('drivers/', 'refresh');
        }
    }


    function moto() {
        
        if ($this->session->position && $this->session->win == 3) {
            $this->session->position = 2;
            $this->session->win = 1;
            $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
            $minitest = $resul->intentos ? substr(($resul->intentos),-2,1): 0;
            $moto = $resul->intentos ? substr(($resul->intentos),-1,1): 0;            
            if ($resul && $moto >= 2) {
                redirect('drivers/', 'refresh');
            } elseif ($resul) {
                $this->data['intentos'] = (int) $moto;
            } else {
                $this->data['intentos'] = 0;
            }
            $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/moto';
            $this->data['juego'] = 1;
            $this->data['jNum'] = 1;
            $this->load->view('nivel' . $this->cur . '/moto', $this->data);
        } else {
            redirect('drivers/', 'refresh');
        }
    }    

}
