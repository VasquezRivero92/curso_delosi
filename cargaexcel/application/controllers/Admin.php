<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MY_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        $this->load->library('session');
        $this->session->nivel = 1;
        $this->_render_page('registrar', $this->data);
    }
}