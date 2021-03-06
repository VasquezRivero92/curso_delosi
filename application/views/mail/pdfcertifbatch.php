<?php

tcpdf();

class MYPDF extends TCPDF {

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

$obj_pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle('Certificado del curso');
//$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetFont('dejavusans', '', 16);

foreach ($arrayUser as $sUser) {
    $obj_pdf->AddPage();
    $html = '<div><br><br><br>'
            . '<div style="font-size:48px; font-weight:bold; color:#0075bc;">CONSTANCIA</div>'
            . '<div>LA EMPRESA <b style="font-weight:bold;">' . $sUser['empresa'] . '</b> DEJA CONSTANCIA QUE:</div>'
            . '<div style="font-weight:bold;">' . $sUser['nombre'] . '</div>'
            . '<div>HA COMPLETADO LOS (4) CURSOS DE "EXPERTOS EN LA PREVENCIÓN", <br>REALIZADO DURANTE EL AÑO 2018';
    $obj_pdf->writeHTML($html, true, false, true, false, 'C');
}

//En esta parte, la variable final cambia segun:
//I: verlo online
//D: download
//F: guardarlo en el servidor
$obj_pdf->Output('constancia_n_' . mdate('%Y-%m-%d_%H-%i') . '.pdf', 'D');
