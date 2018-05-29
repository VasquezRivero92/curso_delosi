<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu2 extends MY_Controller {
    /* Para ver los datos de algun array
      echo '<pre>';
      var_dump($array_aqui);
      echo '</pre>'; */

    function __construct() {
        parent::__construct();
        if ($this->ion_auth->logged_in()) {
            if (!$this->entraarecla()) {
                redirect('/menu1', 'refresh');
            }
            $this->session->position = 0;
            $this->data['user_login'] = $this->base_model->user_info_login();
            $stats = $this->base_model->user_stats(2);
            if ($stats->num_rows()) {
                $this->data['user_stats'] = $stats->result_array()[0];
            } else {
                $this->data['user_stats'] = array('id_menu' => 1, 'curso' => 1, 'puntaje' => '', 'estrellas' => '');
            }
        } else {
            redirect('/login', 'refresh');
        }
    }

    function index() {
        if (!$this->session->avatar) {
            redirect('/main', 'refresh');
        } else {
            $this->data['avatar'] = ' av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
        }
        if ($this->session->first_login) {
            $this->data['firstWindow'] = 3;
            $this->session->first_login = false;
        } else {
            $this->data['firstWindow'] = 4;
        }
        $this->load->library('form_validation');
        $this->data['own_dir'] = $this->data['assets_dir'] . '/menu2';
        $this->data['niveles'] = $this->base_model->get_cursos(true, 2)->result();
        $this->data['certificado'] = $this->checkCertificado() ? '' : 'disable';
        $this->load->view('menu2', $this->data);
    }

    function certificado() {
        if (!$this->checkCertificado()) {
            redirect('/main', 'refresh');
        }
        $this->load->helper('pdf_helper');
        
        //$result1 = $this->base_model->get_puntajes1($this->session->user_id)->puntaje;
        //$result2 = $this->base_model->get_puntajes2($this->session->user_id)->puntaje;
        $fecha = $this->base_model->get_fecha($this->session->user_id)->fecha;
        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        
        
        
        $dataPDF = array(
            'empresa' => $this->base_model->get_empresas($this->session->user_id)->row()->nombre,
            'nombre' => $this->data['user_login']['apat'] . ' ' . $this->data['user_login']['amat'] . ', <br>' . $this->data['user_login']['nombre'],
            //'puntaje' => $result1 + $result2,
            'año' => ''. date('Y', $fecha),
            'dia' => ''. date('d', $fecha),
            'mes' => ''. $meses[date('n',$fecha)-1]
        );
        $this->load->view('mail/pdfcertificado2', $dataPDF);
            }
    
    /*     * ************************************************************************ */

    protected function checkCertificado() {
        for ($i = 5; $i <= 6; $i++) {
            $resul = $this->base_model->get_puntaje($this->session->user_id, $i);            
            if (!$resul || !$resul->intentos) {
                return false;
            }
        }
        return true;
    }
    
    

}
