<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends Nivel_Controller {

     function __construct() {
        parent::__construct();
        $this->data['user_login'] = $this->base_model->user_info_login();
        $stats = $this->base_model->user_stats(1);
        if ($this->base_model->entraadriver()||$this->base_model->entraarepartidor()) {
            $this->data['drivers'] = 2;
        } else {
           $this->data['drivers'] = '-1'; 
        }

        if ($stats->num_rows()) {
                $this->data['user_stats'] = $stats->result_array()[0];
        } else {
                $this->data['user_stats'] = array('id_menu' => 1, 'curso' => 1, 'puntaje' => '0', 'estrellas' => '0');
        }
    }

    function index() {
        if (!$this->session->avatar) {
            redirect('/main', 'refresh');
        } else {                       
            $this->data['avatar'] = 'av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
            $this->data['avatar_p'] = 'av_' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
            //echo $this->data['avatar'];
        }
        if ($this->ion_auth->logged_in()){
            if ($this->data['user_login']['mapa'] == 1) {
                $this->data['firstWindow'] = 1;
                $this->db->where('id',$this->session->user_id)->update('users', array('mapa' => 0));                    
            } else {
                $this->data['firstWindow'] = 4;
            }
        }else {
            redirect('main', 'refresh');        }

        
        

    	$this->data['own_dir'] = $this->data['assets_dir'] . '/mapa';
        $empresaUser = $this->base_model->get_empresas($this->session->user_id)->row();
        $this->data['empresa'] = $empresaUser ? $empresaUser->nombre : '-';
        $this->data['maxnivel'] = $empresaUser ? $this->base_model->get_max_curso() : 0;
        $this->data['niveles'] = $this->base_model->get_cursos()->result();
        $this->data['certificado_prevencion'] = $this->checkCertificado_prevencion() ? '' : 'disable';
        $this->data['certificado_drivers'] = $this->checkCertificado_drivers() ? '' : 'disable';
        $this->data['certificado_pausas'] = $this->checkCertificado_pausas() ? '' : 'disable';
        $this->data['certificado_emergencias'] = $this->checkCertificado_emergencias() ? '' : 'disable';

        
        for ($i = 1; $i <= 4; $i++) {
            $resul = $this->base_model->get_puntaje($this->session->user_id, $i);            
            if (!$resul || !$resul->intentos) {
                $this->data['pared'] = 0;
                if($i == 1){
                    $this->data['cursocheck1'] =  'anim1';
                }else if($i == 2){
                    $this->data['cursocheck2'] =  'anim2';
                }else if($i == 3){
                    $this->data['cursocheck3'] =  'anim3';
                }else{
                    $this->data['cursocheck4'] =  'anim4';
                }                    
            }else{
                if($this->data['certificado_prevencion'] == 'disable'){
                    $this->data['pared'] = 0;
                }else{
                    $this->data['pared'] = 1;
                }
                if($i == 1){
                    $this->data['cursocheck1'] =  '';
                }else if($i == 2){
                    $this->data['cursocheck2'] =  '';
                }else if($i == 3){
                    $this->data['cursocheck3'] =  '';
                }else{
                    $this->data['cursocheck4'] =  '';
                }              
            }
        }

        $this->load->view('mapa', $this->data);
    }

    function certificado_prevencion() {
        if (!$this->checkCertificado_prevencion()) {
            redirect('/main', 'refresh');
        }
        $this->load->helper('pdf_helper');
        $dataPDF = array(
            'empresa' => $this->base_model->get_empresas($this->session->user_id)->row()->nombre,
            'nombre' => $this->data['user_login']['apat'] . ' ' . $this->data['user_login']['amat'] . ', <br>' . $this->data['user_login']['nombre']
        );
        $this->load->view('mail/pdfcertificado_prevencion', $dataPDF);
    }
    function certificado_drivers() {
        if (!$this->checkCertificado_drivers()) {
            redirect('/main', 'refresh');
        }
        $this->load->helper('pdf_helper');
        $dataPDF = array(
            'empresa' => $this->base_model->get_empresas($this->session->user_id)->row()->nombre,
            'nombre' => $this->data['user_login']['apat'] . ' ' . $this->data['user_login']['amat'] . ', <br>' . $this->data['user_login']['nombre']
        );
        $this->load->view('mail/pdfcertificado_drivers', $dataPDF);
    }
    function certificado_pausas() {
        if (!$this->checkCertificado_pausas()) {
            redirect('/main', 'refresh');
        }
        $this->load->helper('pdf_helper');
        $dataPDF = array(
            'empresa' => $this->base_model->get_empresas($this->session->user_id)->row()->nombre,
            'nombre' => $this->data['user_login']['apat'] . ' ' . $this->data['user_login']['amat'] . ', <br>' . $this->data['user_login']['nombre']
        );
        $this->load->view('mail/pdfcertificado_pausas', $dataPDF);
    }
    function certificado_emergencias() {
        if (!$this->checkCertificado_emergencias()) {
            redirect('/main', 'refresh');
        }
        $this->load->helper('pdf_helper');
        $dataPDF = array(
            'empresa' => $this->base_model->get_empresas($this->session->user_id)->row()->nombre,
            'nombre' => $this->data['user_login']['apat'] . ' ' . $this->data['user_login']['amat'] . ', <br>' . $this->data['user_login']['nombre']
        );
        $this->load->view('mail/pdfcertificado_emergencias', $dataPDF);
    }

    /*     * ************************************************************************ */

    protected function checkCertificado_prevencion() {
        for ($i = 1; $i <= 4; $i++) {
            $resul = $this->base_model->get_puntaje($this->session->user_id, $i);
            if (!$resul || !$resul->intentos) {
                return false;
            }
        }
        return true;
    }
    protected function checkCertificado_drivers() {
        
            $resul = $this->base_model->get_puntaje($this->session->user_id, 8);
            if (!$resul || !$resul->intentos || $resul->puntaje < 70) {
                return false;
            }
        
        return true;
    }

    protected function checkCertificado_pausas() {
        
            $resul = $this->base_model->get_puntaje($this->session->user_id, 10);
            if (!$resul || !$resul->intentos || $resul->puntaje < 70) {
                return false;
            }
        
        return true;
    }

    protected function checkCertificado_emergencias() {
        
            $resul = $this->base_model->get_puntaje($this->session->user_id, 9);
            if (!$resul || !$resul->intentos || $resul->puntaje < 70) {
                return false;
            }
        
        return true;
    }

}
