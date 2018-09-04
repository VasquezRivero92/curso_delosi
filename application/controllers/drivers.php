<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends Nivel_Controller {

    private $cur = 8;

    function __construct() {
        parent::__construct();
        $cur8 = $this->base_model->get_curso($this->cur);
        if ($cur8 && $cur8->estado  || $this->session->userniv) {
            if ($this->base_model->entraadriver()||$this->base_model->entraarepartidor()) {
                $this->session->curso = $this->cur;

            } else {
                redirect('/main', 'refresh');
            }
        }else{
            redirect('/main', 'refresh');
             }
    }

    function index() {        
        // Lo normal
        $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/main';
        $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur);
      
        if(!$resul){            
            $this->session->win = 1;
            $this->session->position = 1;
        }else{
            if ($resul && $resul->intentos == 100){
                $this->session->position = 1;
                $this->session->win = 1;   
            }else if ($resul && $resul->intentos == 121){
                $this->session->position = 1;
                $this->session->win = 3;       
            }else if ($resul && $resul->intentos == 120){
                $this->session->position = 1;
                $this->session->win = 3;  
            }else if ($resul && $resul->intentos == 111){
                $this->session->position = 1;
                $this->session->win = 1;
            }else if ($resul && $resul->intentos == 110){
                $this->session->position = 1;
                $this->session->win = 3;
            }else if ($resul && $resul->intentos == 112){
                $this->session->position = 1;
                $this->session->win = 1;
            }else{            
                $this->session->position = 2;
                $this->session->win = 2;
            }  
        }
        $this->data['checked'] = $this->base_model->check_curso_user($this->session->user_id, $this->cur);
        $this->load->view('nivel' . $this->cur . '/index', $this->data);
        // echo ($this->session->win);
        // echo ($this->session->position);
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
    
    function certificado_drivers() {
        $resul = $this->base_model->get_puntaje($this->session->user_id, $this->session->curso);
        if ($resul->puntaje < 70) {
            redirect('/drivers', 'refresh');
        }
        $this->load->helper('pdf_helper');
        $fecha = $this->base_model->get_fecha_cursos($this->session->user_id, $this->session->curso)->fecha;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $dataPDF = array(
            'empresa' => $this->base_model->get_empresas($this->session->user_id)->row()->nombre,
            'nombre' => $this->data['user_login']['apat'] . ' ' . $this->data['user_login']['amat'] . ', <br>' . $this->data['user_login']['nombre'],
            'año' => ''. date('Y', $fecha),
            'dia' => ''. date('d', $fecha),
            'mes' => ''. $meses[date('n',$fecha)-1]
        );
        $this->load->view('mail/pdfcertificado_drivers', $dataPDF);
    }

    // function calificacion() {        
    //     $this->data['own_dir'] = $this->data['assets_dir'] . '/nivel' . $this->cur . '/calificacion'; 
    //     $resul = $this->base_model->get_puntaje($this->session->user_id, $this->cur); 
             

    //     if($resul->intentos == 111){

    //         $this->data['pregunta'] = $this->base_model->get_pregunta_calificacion(1)->nombre;           

    //         if($this->input->post()){
    //             $calificacion1 = $this->input->post('calificacion1');
    //             $calificacion2 = $this->input->post('calificacion2');
    //             echo $calificacion1,$calificacion2 ;
    //         }
            
    //         $this->load->view('nivel' . $this->cur . '/calificacion', $this->data);
            

    //     }else{
    //         redirect('mapa/', 'refresh');
    //     }

    // } 

}
