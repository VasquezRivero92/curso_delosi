<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mapa extends Nivel_Controller {


     function __construct() {
        parent::__construct();
        $this->data['user_login'] = $this->base_model->user_info_login();
        $stats = $this->base_model->user_stats(1);
        if ($this->entraadriver()) {
            
        } else {
            
        }
        if ($stats->num_rows()) {
                $this->data['user_stats'] = $stats->result_array()[0];
        } else {
                $this->data['user_stats'] = array('id_menu' => 1, 'curso' => 1, 'puntaje' => '', 'estrellas' => '');
        }
        
    }

    function index() {
        if (!$this->session->avatar) {
            redirect('/main', 'refresh');
        } else {
            $this->data['firstWindow'] = 4;
            $this->data['avatar'] = 'av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
            $this->data['avatar_p'] = 'av_' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
            //echo $this->data['avatar'];
        }
    	$this->data['own_dir'] = $this->data['assets_dir'] . '/mapa';
        $empresaUser = $this->base_model->get_empresas($this->session->user_id)->row();
        $this->data['empresa'] = $empresaUser ? $empresaUser->nombre : '-';
        $this->data['maxnivel'] = $empresaUser ? $this->base_model->get_max_curso() : 0;
        $this->data['niveles'] = $this->base_model->get_cursos()->result();
        $this->data['certificado'] = $this->checkCertificado_prevencion() ? '' : 'disable';

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
        $this->load->view('mail/pdfcertificado', $dataPDF);
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

}
