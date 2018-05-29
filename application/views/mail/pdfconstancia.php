<?php

tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'CONSTANCIA NIVEL ' . $niv;
$obj_pdf->SetTitle($title);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
$obj_pdf->SetFont(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN);
$html = '<table style="border:5px solid #00a2bb;" border="0" cellspacing="0" cellpadding="20">'
        . '<tr><td>'
        . '<h1 style="color:#ff3650;">' . $title . '</h1>'
        . '<br>Yo, ' . $nombre
        . ', declaro haber completado el curso de ' . $curso
        . ' de manera satisfactoria y, asimismo, de haber realizado la prueba sobre el curso de ' . $curso
        . ' (reto).'
        . '</td></tr></table>';
$obj_pdf->writeHTML($html, true, false, true, false, '');
//En esta parte, la variable final cambia segun:
//I para verlo online
//D para download
$obj_pdf->Output('constancia_n' . $niv . '_' . mdate('%Y-%m-%d_%H-%i') . '.pdf', 'D');
