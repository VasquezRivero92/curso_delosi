<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

    //private $num = 1;

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    function up_reg_excel() {
        if ($_FILES && $_FILES['excfile'] && $_FILES['excfile']['name']) {
            if (!$_FILES['excfile']['error']) {
                $inputFile = $_FILES['excfile']['name'];
                $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
                if ($extension == 'XLSX' || $extension == 'XLS') {
                    $this->load->library('excel');
                    try {
                        $inputFile = $_FILES['excfile']['tmp_name'];
                        $inputFileType = PHPExcel_IOFactory::identify($inputFile);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFile);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    $sheet = $objPHPExcel->getSheet(0);
                    $sheetData = $sheet->rangeToArray('A1:A' . $sheet->getHighestRow(), null, false, true, false);
                    echo json_encode($sheetData);
                } else {
                    echo 'error-XLS-type';
                }
            } else {
                echo 'Error-' . $_FILES['excfile']['error'];
            }
        } else {
            echo 'error-No-file';
        }
    }

    function mail_masivo() {
        $data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($data != null) {
            $i = 0;
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'cuenta.facto06@gmail.com',
                'smtp_pass' => 'factoria01'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->load->library('email');
            $this->email->set_mailtype('html');
            foreach ($data as $user) {
                $datamail = array(
                    'email' => $user['email']
                );
                $message = $this->load->view('mail/registro', $datamail, true);
                $this->email->clear();
                $this->email->from('no-reply@aprendiendoaprevenir.com', 'Aprendiendo a prevenir');
                $this->email->to($user['email']);
                $this->email->subject('Muy pronto...');
                $this->email->message($message);
                //if ($this->email->send()) {
                $i++;
                //}
            }
            echo $i;
            $this->session->nivel = $this->session->nivel % 6;
            $this->session->nivel++;
        } else {
            echo "manakax";
        }
    }

    private function user_correo() {
        if ($this->session->nivel) {
            $this->session->nivel++;
        } else {
            $this->session->nivel = 1;
        }
        return array(
            'user' => 'cuenta.facto' . $this->session->nivel . '@gmail.com',
            'pass' => 'factoria01');
    }

}
