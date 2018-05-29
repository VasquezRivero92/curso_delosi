<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Variants extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        echo mdate('%d/%m/%Y - %H:%i:%s') . ' (' . time() . ')<br>';
        //echo mdate('%d/%m/%Y - %H:%i:%s','1518026176') . '<br>';
        $this->load->library('user_agent');
        echo $this->agent->agent_string() . '<br>'; /*
          echo $this->agent->platform() . '<br>';
          echo $this->agent->browser() . '<br>';
          echo $this->agent->version() . '<br>';
          echo $this->agent->robot() . '<br>';
          echo $this->agent->mobile() . '<br>';
          echo $this->agent->referrer() . '<br>'; */
    }

    function sede_seccion() {
        $inputFile = './prueba/dUEmp_09_22.xlsx';
        if (!file_exists($inputFile)) {
            exit($inputFile . ' no existe.');
        }
        $this->load->library('excel');
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $sheetData = $sheet->rangeToArray('A10001:H' . $highestRow, null, false, true, false);
        $updateArray = [];
        $aemp = $this->rel_array($this->base_model->get_empresas()->result());
        $this->load->database();
        foreach ($sheetData as $data) {
            $user = $this->db->select('id')->where('dni', $data[0])->limit(1)->get('users')->row();
            $id_empresa = array_search($data[1], $aemp);
            if (!$user || !$id_empresa) {
                continue;
            }
            $check = $this->db->select('id')
                            ->where('id_user', $user->id)
                            ->where('id_empresa', $id_empresa)
                            ->get('users_empresa')->row();
            if (!$check) {
                continue;
            }
            $updateArray[] = array(
                'id' => (int) $check->id,
                'sede' => $data[6],
                'seccion' => $data[7]
            );
        }
        echo 'Total: ' . $highestRow . '<br>';
        echo 'Cant. update (pre): ' . count($updateArray) . '<br>';
        $sumaUpdate = count($updateArray) ? $this->db->update_batch('users_empresa', $updateArray, 'id') : 0;
        echo 'Cant. update (post): ' . $sumaUpdate;
    }

    function area_dep_pla() {
        $inputFile = './prueba/CAR-user-empresa_6VER.xlsx';
        if (!file_exists($inputFile)) {
            exit($inputFile . ' no existe.');
        }
        $this->load->library('excel');
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $sheetData = $sheet->rangeToArray('A2:H' . $highestRow, null, false, true, false);
        $updateArray = [];
        $aemp = $this->rel_array($this->base_model->get_empresas()->result());
        $aarea = $this->rel_array($this->base_model->get_areas()->result());
        $adep = $this->rel_array($this->base_model->get_departamentos()->result());
        $acar = $this->rel_array($this->base_model->get_cargos()->result());
        $apla = $this->rel_array($this->base_model->get_planillas()->result());
        $this->load->database();
        foreach ($sheetData as $data) {
            $user = $this->db->select('id')->where('dni', $data[0])->limit(1)->get('users')->row();
            $id_empresa = array_search($data[1], $aemp);
            if (!$user || !$id_empresa) {
                continue;
            }
            $check = $this->db->select('id')
                            ->where('id_user', $user->id)
                            ->where('id_empresa', $id_empresa)
                            ->get('users_empresa')->row();
            if (!$check) {
                continue;
            }
            $updateArray[] = array(
                'id' => (int) $check->id,
                'id_area' => array_search(trim($data[2]), $aarea),
                'id_departamento' => array_search(trim($data[3]), $adep),
                'id_cargo' => array_search(trim($data[4]), $acar),
                'id_planilla' => array_search(trim($data[5]), $apla)
            );
        }
        echo 'Total: ' . $highestRow . '<br>';
        echo 'Cant. update (pre): ' . count($updateArray) . '<br>';
        $sumaUpdate = count($updateArray) ? $this->db->update_batch('users_empresa', $updateArray, 'id') : 0;
        echo 'Cant. update (post): ' . $sumaUpdate;
    }

    protected function rel_array($resulset) {
        $data = [];
        foreach ($resulset as $item) {
            $data[$item->id] = $item->nombre;
        }
        return $data;
    }

    /*     * ************************************************************************ */

    function mailnivel2() {
        $this->load->database();
        $this->load->library('form_validation');
        $reporte = $this->db->select('email')
                ->from('users')
                ->like('email', 'franquiciasperu')
                ->or_like('email', 'factoriamedia')
                ->order_by('email')
                ->get();
        if ($this->input->post('submit')) {
            $this->load->library('email');
            $this->email->set_mailtype('html');
            $i = 0;
            foreach ($reporte->result() as $itm) {
                $datamail = array('email' => $itm->email);
                $message = $this->load->view('mail/nivel2', $datamail, true);
                $this->email->clear();
                $this->email->from('no-reply@aprendiendoaprevenir.com', 'Aprendiendo a prevenir');
                $this->email->to($itm->email);
                $this->email->subject('¡Ingresa al nivel 2!');
                $this->email->message($message);
                //if ($this->email->send()) {
                $i++;
                echo $itm->email . ': ok<br>';
                /* } else {
                  echo $itm->email . ': NO ENVIADO<br>';
                  } */
            }
            echo 'Emails enviados: ' . $i . '<br><br>';
        } else {
            foreach ($reporte->result() as $itm) {
                echo $itm->email . '<br>';
            }
            $submit = array(
                'name' => 'submit',
                'value' => 'submit',
                'id' => 'submit'
            );
            echo form_open();
            echo '<br>' . form_submit($submit) . '<br>';
            echo form_close();
        }
        echo 'Total: ' . $reporte->num_rows() . '<br>';
    }

    function tienda_admin() {
        $this->load->database();
        echo 'updating...<br>';
        echo $this->db->where('password IS NOT NULL', null, false)->update('tienda', array('id_admin' => 1));
        echo '<br>All OK!!';
    }

    /*     * ************************************************************************ */

    function cursolegal() {
        $inputFile = './prueba/cursolegal.xlsx';
        if (!file_exists($inputFile)) {
            exit($inputFile . ' no existe.');
        }
        $this->load->library('excel');
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $sheet = $objPHPExcel->getSheet(1);
        echo '<table border=1><tr>';
        echo '<td colspan=2>' . $sheet->getTitle() . '</td></tr>';
        $highestRow = $sheet->getHighestRow();
        $sheetData = $sheet->rangeToArray('A2:B' . $highestRow, null, false, true, false);
        $this->load->database();
        $faltan = 0;
        foreach ($sheetData as $data) {
            $dni = trim($data[1]);

            $user = $this->db->select('u.id, g.nombre')
                            ->from('users u')
                            ->join('grupo g', 'u.id_grupo = g.id')
                            ->where('dni', $dni)->limit(1)
                            ->get()->row();
            if ($user) {
                continue;
            } else {
                echo '<tr>';
                echo '<td>' . $dni . '</td>';
                echo '<td>' . $data[0] . '</td>';
                $faltan++;
                echo '</tr>';
            }
        }
        echo '</table>Faltan en total: ' . $faltan;
    }

}
