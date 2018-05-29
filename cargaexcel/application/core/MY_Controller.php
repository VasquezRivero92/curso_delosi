<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('array','url'));
        $this->data['assets_dir'] = 'assets';
        $this->data['charset'] = $this->config->item('charset');
    }
    function _render_page($view,$data=null,$render=false){
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view($view,$this->viewdata,$render);
        if (!$render){ return $view_html; }
    }
}