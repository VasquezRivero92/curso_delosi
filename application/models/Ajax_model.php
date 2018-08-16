<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
        $this->load->model('ion_auth_model');
        $this->tables = $this->config->item('tables', 'ion_auth');
        $this->id_version = $this->ion_auth_model->get_id_vers();
    }

    /*     * *******************************  Menu  ******************************** */

    public function update_avatar($id_user, $avatar) {
        $this->db->update($this->tables['users'], array('avatar' => $avatar), array('id' => $id_user));
        if ($avatar == 1) {
            $this->session->avatar = 'M';
        } else {
            $this->session->avatar = 'F';
        }
        return $this->db->affected_rows();
    }

    public function buzon_info($id_user) {
        return $this->db->select('e.nombre as empresa, e.ruc, a.nombre as area, d.nombre as departamento, c.nombre as cargo, pl.nombre as planilla, ue.sede, ue.seccion')
                        ->from('users_empresa ue')
                        ->join('empresa e', 'ue.id_empresa = e.id')
                        ->join('area a', 'ue.id_area = a.id')
                        ->join('departamento d', 'ue.id_departamento = d.id')
                        ->join('cargo c', 'ue.id_cargo = c.id')
                        ->join('planilla pl', 'ue.id_planilla = pl.id')
                        ->where('ue.id_user', $id_user)
                        ->limit(1)
                        ->get()->row();
    }

    /*     * ******************************  Cursos  ******************************* */

    public function init_curso($id_user, $id_curso) {
        $checkUserCurso = $this->checkUserCurso('vistas', $id_user, $id_curso);
        $data = $this->dataUserCurso($id_user, $id_curso);
        if ($checkUserCurso) {
            $data['vistas'] = (int) $checkUserCurso->vistas + 1;            
            return $this->db->where('id_user', $id_user)
                            ->where('id_curso', $id_curso)
                            ->where('id_version', $this->id_version)
                            ->update('users_curso', $data);
        } else {
            return $this->db->insert('users_curso', $data);
        }
    }

    public function init_curso_driver($id_user, $id_curso) {
        $checkUserCurso = $this->checkUserCurso('vistas', $id_user, $id_curso);
        $data = $this->dataUserCurso($id_user, $id_curso);        
        if ($checkUserCurso) {
            $data['vistas'] = (int) $checkUserCurso->vistas + 1;            
            return $this->db->where('id_user', $id_user)
                            ->where('id_curso', $id_curso)
                            ->where('id_version', $this->id_version)
                            ->update('users_curso', $data);
        } else {
            $data['intentos'] = (string) '100';
            return $this->db->insert('users_curso', $data);
        }
    }

    public function update_calificacion($id_user, $id_curso, $calificacion) {
        $checkUserCurso = $this->checkUserCurso('id_user,calificacion', $id_user, $id_curso);
        if ($checkUserCurso) {
            $data = array(
                'calificacion' => $calificacion
            );
            $resul = $this->db->where('id_user', $id_user)
                    ->where('id_curso', $id_curso)
                    ->where('id_version', $this->id_version)
                    ->update('users_curso', $data);
        }
        $this->update_user_curso($id_user, $id_curso);
        return $resul;
    }


    public function set_intentos($id_user, $id_curso) {
        $checkInt = $this->checkUserCurso('intentos,puntaje,estrellas', $id_user, $id_curso);
        if ($checkInt) {
            $intentos = $checkInt->intentos ? ((int) $checkInt->intentos + 1) : 1;
            if ($intentos >= 2) {
                $puntaje = $checkInt->puntaje ? (int) $checkInt->puntaje : 0;
                $estrellas = $checkInt->estrellas ? (int) $checkInt->estrellas : 0;
                $data = array(
                    'intentos' => $intentos,
                    'puntaje' => $puntaje,
                    'estrellas' => $estrellas
                );
                $this->session->win = $this->session->position;
            } else {
                $data = array('intentos' => $intentos);
            }
            $resul = $this->db->where('id_user', $id_user)
                    ->where('id_curso', $id_curso)
                    ->where('id_version', $this->id_version)
                    ->update('users_curso', $data);
            if ($intentos >= 2) {
                $this->update_user_curso($id_user, $id_curso);
            }
            return $intentos;
        } else {
            $data = $this->dataUserCurso($id_user, $id_curso);
            $data['fecha'] = time();
            $data['puntaje'] = 0;
            $data['estrellas'] = 0;
            $data['intentos'] = 1;
            $resul = $this->db->insert('users_curso', $data);
            return 1;
        }
    }


    public function set_calificacion($id_user, $id_curso) {
        $checkInt = $this->checkUserCurso('calificacion', $id_user, $id_curso);
        if ($checkInt) {
            $calificacion = $checkInt->calificacion ? (int) $checkInt->calificacion : 1;
            return $calificacion;
        } 
    }

    public function set_intentos_drivers_1($id_user, $id_curso) {
        $checkInt = $this->checkUserCurso('intentos,puntaje,estrellas', $id_user, $id_curso);
        if ($checkInt) {

            $puntos = ((string)$checkInt->intentos);
            $minitest = $puntos ? substr(($puntos),-2,1): 1;
            $minitest_2 = $puntos ? $minitest +1: 0;
            $moto = $checkInt->intentos ? substr(($puntos),-1,1): 0;

            $intentos = $minitest_2;
            
            if ($intentos >= 2) {
                $puntaje = $checkInt->puntaje ? (string) $checkInt->puntaje : 0;
                $estrellas = $checkInt->estrellas ? (string) $checkInt->estrellas : 0;
                $data = array(
                    'intentos' => '1' . $intentos . $moto,
                    'puntaje' => $puntaje,
                    'estrellas' => $estrellas
                );
                $this->session->win = $this->session->position;
            } else {
                $data = array('intentos' => '1' . $intentos . $moto,);
            }
            $resul = $this->db->where('id_user', $id_user)
                    ->where('id_curso', $id_curso)
                    ->where('id_version', $this->id_version)
                    ->update('users_curso', $data);
            if ($intentos >= 2) {
                $this->update_user_curso($id_user, $id_curso);
            }
            return '1' . $intentos . $moto;
        } else {
            $data = $this->dataUserCurso($id_user, $id_curso);
            $data['fecha'] = time();
            $data['puntaje'] = 0;
            $data['estrellas'] = 0;
            $data['intentos'] = '1'. $intentos . $moto;
            $resul = $this->db->insert('users_curso', $data);
            return 100;
        }
    }

    public function set_intentos_drivers_2($id_user, $id_curso) {
        $checkInt = $this->checkUserCurso('intentos,puntaje,estrellas', $id_user, $id_curso);
        if ($checkInt) {

            $puntos = ((string)$checkInt->intentos);
            $minitest = $puntos ? substr(($puntos),-2,1): 0;            
            $moto = $checkInt->intentos ? substr(($puntos),-1,1): 1;
            $moto_2= $puntos ? $moto +1: 0;

            $intentos = $moto_2;

            if ($intentos >= 2) {
                $puntaje = $checkInt->puntaje ? (string) $checkInt->puntaje : 0;
                $estrellas = $checkInt->estrellas ? (string) $checkInt->estrellas : 0;
                $data = array(
                    'intentos' => '1' . $minitest . $intentos,
                    'puntaje' => $puntaje,
                    'estrellas' => $estrellas
                );
                $this->session->win = $this->session->position;
            } else {
                $data = array('intentos' => '1' . $minitest . $intentos,);
            }
            $resul = $this->db->where('id_user', $id_user)
                    ->where('id_curso', $id_curso)
                    ->where('id_version', $this->id_version)
                    ->update('users_curso', $data);
            if ($intentos >= 2) {
                $this->update_user_curso($id_user, $id_curso);
            }
            return '1' . $minitest . $intentos;
        } else {
            $data = $this->dataUserCurso($id_user, $id_curso);
            $data['fecha'] = time();
            $data['puntaje'] = 0;
            $data['estrellas'] = 0;
            $data['intentos'] = '1' . $minitest . $intentos;
            $resul = $this->db->insert('users_curso', $data);
            return 100;
        }
    }

    public function get_intentos($id_user, $id_curso) {
        $checkInt = $this->checkUserCurso('intentos,puntaje,estrellas', $id_user, $id_curso);
        
            $intentos = $checkInt->intentos ? ((string) $checkInt->intentos) : 1;
           
            return $intentos;
        
    }

    public function get_puntaje($id_user, $id_curso) {
        $checkInt = $this->checkUserCurso('intentos,puntaje,estrellas', $id_user, $id_curso);
        
            $puntaje = $checkInt->puntaje ? ((int) $checkInt->puntaje) : 0;
           
            return $puntaje;
        
    }

    public function update_puntaje($id_user, $id_curso, $puntaje, $estrellas) {
        $checkUserCurso = $this->checkUserCurso('id_user,puntaje,estrellas', $id_user, $id_curso);
        if ($checkUserCurso) {
            if ($checkUserCurso->puntaje && (int) $checkUserCurso->puntaje > $puntaje) {
                $puntaje = (int) $checkUserCurso->puntaje;
            }
            if ($checkUserCurso->estrellas && (int) $checkUserCurso->estrellas > $estrellas) {
                $estrellas = (int) $checkUserCurso->estrellas;
            }
            $data = array(
                'fecha' => time(),
                'puntaje' => $puntaje,
                'estrellas' => $estrellas
            );
            $resul = $this->db->where('id_user', $id_user)
                    ->where('id_curso', $id_curso)
                    ->where('id_version', $this->id_version)
                    ->update('users_curso', $data);
        } else {
            $data = $this->dataUserCurso($id_user, $id_curso);
            $data['fecha'] = time();
            $data['puntaje'] = $puntaje;
            $data['estrellas'] = $estrellas;
            $data['intentos'] = 1;
            $resul = $this->db->insert('users_curso', $data);
        }
        $this->update_user_curso($id_user, $id_curso);
        return $resul;
    }

    public function set_constancia($id_user, $id_curso) {
        $data = array('constancia' => 1);
        $resul = $this->db->where('id_user', $id_user)
                ->where('id_curso', $id_curso)
                ->where('id_version', $this->id_version)
                ->update('users_curso', $data);
        return $resul;
    }

    //para no hacer lo mismo a cada rato en las funciones de update
    protected function checkUserCurso($field, $id_user, $id_curso) {
        return $this->db->select($field)
                        ->where('id_user', $id_user)
                        ->where('id_curso', $id_curso)
                        ->where('id_version', $this->id_version)
                        ->limit(1)
                        ->get('users_curso')->row();
    }

    protected function checkUserCali($id_user, $id_curso) {
        return $this->db->select('id_pregunta')
                        ->where('id_user', $id_user)
                        ->where('id_curso', $id_curso)
                        ->get('calificacion_curso')->row();
    }

    //para no hacer lo mismo a cada rato en las funciones de insert
    protected function dataUserCurso($id_user, $id_curso) {
        $data = $this->db->select('id_empresa, id_area, id_departamento, id_cargo, id_planilla, sede')
                ->where('id_user', $id_user)
                ->limit(1)
                ->get('users_empresa')
                ->row();
        return array(
            'id_user' => $id_user,
            'id_curso' => $id_curso,
            'id_version' => $this->id_version,
            'id_empresa' => $data->id_empresa,
            'id_area' => $data->id_area,
            'id_departamento' => $data->id_departamento,
            'id_cargo' => $data->id_cargo,
            'id_planilla' => $data->id_planilla,
            'sede' => $data->sede,
            'id_grupo' => $this->session->id_grupo
        );
    }



    protected function update_user_curso($id_user, $id_curso) {
        $id_menu = $this->db->select('menu')->from('curso')->where('id', $id_curso)->limit(1)->get()->row()->menu;
        //Obtengo el curso del usuario de la DB (si existe)
        $dbCurso = $this->db->select('curso')
                ->where('id_user', $id_user)
                ->where('id_menu', $id_menu)
                ->limit(1)
                ->get('users_menu');
        $sum = $this->db->select('SUM(uc.puntaje) as ptj,SUM(uc.estrellas) as est')
                        ->from('users_curso uc')
                        ->join('curso c', 'uc.id_curso = c.id')
                        ->where('uc.id_user', $id_user)
                        ->where('uc.id_version', $this->id_version)
                        ->where('c.menu', $id_menu)
                        ->get()->row();
        $user_version = $this->db->select_max('uc.id_version')
                        ->from('users_curso uc')
                        ->join('curso c', 'uc.id_curso = c.id')
                        ->where('uc.id_user', $id_user)
                        ->where('c.menu', $id_menu)
                        ->limit(1)
                        ->get()->row()->id_version;
        if ($dbCurso->num_rows() && ($this->id_version <= $user_version)) {
            $user_curso = $dbCurso->row()->curso;
            $curso = ($id_curso >= $user_curso) ? $id_curso : $user_curso;
        } else {
            $curso = $id_curso;
        }
        $data = array(
            'id_user' => $id_user,
            'id_menu' => $id_menu,
            'curso' => $curso,
            'puntaje' => $sum->ptj,
            'estrellas' => $sum->est,
            'fecha' => time()
        );
        if ($dbCurso->num_rows()) {
            $this->db->where('id_user', $id_user)->where('id_menu', $id_menu)->update('users_menu', $data);
        } else {
            $this->db->insert('users_menu', $data);
        }
        return $curso;
    }

}
