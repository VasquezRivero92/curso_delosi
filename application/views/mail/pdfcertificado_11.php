<?php

tcpdf();

class MYPDF extends TCPDF {

    public function Header() {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $this->Image(base_url('/assets/main/images/BGCertificado_11.png'), 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }

}

$obj_pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle('Certificado del curso');
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetFont('dejavusans', '', 16);
$obj_pdf->AddPage();
$html = '<div>'
        . '<br><br><br><br>'
        . '<div style="color:#424243; font-size: 12px;"> La empresa <b style="font-weight:bold; color:#000000;">' . $empresa . '</b> otorga la</div>'
        . '<div style="color:#19AAE8; font-weight:bold; font-size: 30px;" >CONSTANCIA</div>'
        . '<span style="color:#424243; font-size: 12px;">a<br></span>'
        . '<div style="font-weight:bold; ">' . $nombre . '</div>'
        . '<div style="color:#424243; font-size: 12px;">Por haber completado de manera satisfactoria el curso</div>'
        . '<div style="font-weight:bold;">"USO DE EXTINTORES"</div>'
        . '<div style="top:20px; color:#424243; font-size: 12px;"> realizado el <b style="font-weight:bold; color:#000000;">' . $dia .'</b> de <b style="font-weight:bold; color:#000000;">' . $mes .'</b> del <b style="font-weight:bold; color:#000000;">' . $año .'</b></div></div>';
$obj_pdf->writeHTML($html, true, false, true, false, 'C');
//En esta parte, la variable final cambia segun:
//I para verlo online
//D para download
$obj_pdf->Output('constancia_n_' . mdate('%Y-%m-%d_%H-%i') . '.pdf', 'I');
