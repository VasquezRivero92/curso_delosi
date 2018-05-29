<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//require_once('application/helpers/tcpdf/config/lang/eng.php');
require_once 'application/helpers/tcpdf/tcpdf.php';

class Certifpdf extends TCPDF {
    /* public function __construct() {
      parent::__construct();
      } */

    public function Header() {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        //la imagen tiene que ser de 1772 * 1181
        $this->Image(base_url('/assets/main/images/BGCertificado.png'), 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }

}
