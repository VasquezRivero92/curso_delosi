<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ajax_model');
    }

    function index() {
        redirect('/', 'refresh');
    }

    /*     * *******************************  Login  ******************************** */

    function forgot_password() {
        $fdni = $this->input->post('fdni');
        if ($fdni == null) {
            echo 'manakax';
            return false;
        }
        $this->load->model('ion_auth_model');
        if ($this->ion_auth_model->identity_check($fdni) && $this->ion_auth_model->forgotten_password($fdni)) {
            $user = $this->base_model->get_user($fdni);
            $datamail = array(
                'forgotten_password_code' => $user->forgotten_password_code,
                'dni' => $user->dni,
                'email' => $user->email,
                'apat' => $user->apat,
                'amat' => $user->amat,
                'nombre' => $user->nombre
            );
            $message = $this->load->view('mail/forgot_password', $datamail, true);

            $this->load->library('email');
            $this->email->set_mailtype('html');
            $this->email->from('no-reply@aprendiendoaprevenir.com', $this->config->item('site_title', 'ion_auth'));
            if ($user->email) {
                $this->email->to($user->email);
            } else {
                $this->email->to($this->delomail);
            }
            $this->email->subject('Solicitud de nueva contraseña en Aprendiendo a prevenir');
            $this->email->message($message);
            $this->email->send();
            $msg = 'El código de verificación fue enviado a su correo';
        } else {
            $msg = 'El mail ingresado no está registrado';
        }
        echo json_encode($msg);
    }

    function change_forgot_password() {
        $fdni = $this->input->post('fdni');
        $fcode = $this->input->post('fcode');
        $new_password = $this->input->post('new_password');
        $new_confirm = $this->input->post('new_confirm');
        $datos_completos = true;
        if (!$fdni) {
            $datos_completos = false;
        }
        if (!$fcode) {
            $datos_completos = false;
        }
        if (!$new_password) {
            $datos_completos = false;
        }
        if (!$new_confirm) {
            $datos_completos = false;
        }
        if (!$datos_completos) {
            echo 'manakax';
            return false;
        }
        if ($this->ion_auth_model->identity_check($fdni)) {
            $user = $this->ion_auth->forgotten_password_check($fcode);
            if ($user && $fdni == $user->dni) {
                $this->load->library('form_validation');
                $this->load->library('email');
                $this->email->set_mailtype('html');
                $this->form_validation->set_rules('new_password', 'contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
                $this->form_validation->set_rules('new_confirm', 'contraseña', 'required');
                if ($this->form_validation->run() != false) {
                    if ($this->ion_auth->reset_password($fdni, $new_password)) {
                        $datamail = array(
                            'password' => $new_password,
                            'dni' => $fdni,
                            'email' => $user->email,
                            'apat' => $user->apat,
                            'amat' => $user->amat,
                            'nombre' => $user->nombre
                        );
                        $message = $this->load->view('mail/update', $datamail, true);
                        $this->email->from('no-reply@aprendiendoaprevenir.com', $this->config->item('site_title', 'ion_auth'));
                        if ($user->email) {
                            $this->email->to($user->email);
                        } else {
                            $this->email->to($this->delomail);
                        }
                        $this->email->subject('Tus datos actualizados en ' . $this->config->item('site_title', 'ion_auth'));
                        $this->email->message($message);
                        $this->email->send();
                        $msg = $this->ion_auth->messages();
                    } else {
                        $msg = $this->ion_auth->errors();
                    }
                } else {
                    $msg = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                }
            } else {
                $msg = 'El código ingresado es incorrecto';
            }
        } else {
            $msg = 'El mail ingresado no está registrado';
        }
        echo json_encode($msg);
    }

    /*     * *******************************  Menu  ******************************** */

    function change_password() {
        $new_password = $this->input->post('np_new');
        $new_confirm = $this->input->post('np_confirm');
        $datos_completos = true;
        if (!$new_password) {
            $datos_completos = false;
        }
        if (!$new_confirm) {
            $datos_completos = false;
        }
        if (!$datos_completos) {
            echo 'manakax';
            return false;
        }
        $user = $this->ion_auth->user()->row();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->email->set_mailtype('html');
        $this->form_validation->set_rules('np_new', 'Contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[np_confirm]');
        $this->form_validation->set_rules('np_confirm', 'Repetir Contraseña', 'required');
        if ($this->form_validation->run() != false) {
            if ($this->ion_auth->reset_password($user->email, $new_password)) {
                $this->session->old_last_login = time();
                $datamail = array(
                    'password' => $new_password,
                    'email' => $user->email,
                    'apat' => $user->apat,
                    'amat' => $user->amat,
                    'nombre' => $user->nombre
                );
                $message = $this->load->view('mail/update', $datamail, true);
                $this->email->from('no-reply@aprendiendoaprevenir.com', $this->config->item('site_title', 'ion_auth'));
                if ($user->email) {
                    $this->email->to($user->email);
                } else {
                    $this->email->to($this->delomail);
                }
                $this->email->subject('Tus datos actualizados en ' . $this->config->item('site_title', 'ion_auth'));
                $this->email->message($message);
                $this->email->send();
                $msg = $this->ion_auth->messages();
            } else {
                $msg = $this->ion_auth->errors();
            }
        } else {
            $msg = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }
        echo json_encode($msg);
    }

    function set_avatar() {
        $avatar = $this->input->post('avatar');
        if ($avatar != null && $this->session->user_id) {
            $user_id = (int) $this->session->user_id;
            $avatar = (int) $avatar;
            echo $this->ajax_model->update_avatar($user_id, $avatar);
        } else {
            echo "manakax";
        }
    }

    /*     * *******************************  Main  ******************************** */

    function send_buzon() {
        $texto = $this->input->post('texto');
        if (!$texto) {
            echo 'manakax';
            return false;
        }
        $this->load->library('email');
        $this->email->set_mailtype('html');
        $this->session->old_last_login = time();
        $datamail = $this->getdatamail($texto);
        $message = $this->load->view('mail/buzon', $datamail, true);
        $this->email->from('no-reply@aprendiendoaprevenir.com', $this->config->item('site_title', 'ion_auth'));
        // $this->email->to('dsoto@franquiciasperu.com');
        $this->email->to(array('aprendiendoaprevenir.sst@gmail.com','aprendiendoaprevenir@franquiciasperu.com','igastelu@factoriamedia.com','jvasquez@factoriamedia.com','dsoto@franquiciasperu.com'));
        // $this->email->to('aprendiendoaprevenir@franquiciasperu.com');
        // $this->email->to('igastelu@factoriamedia.com');
        // $this->email->to('jvasquez@factoriamedia.com');
        $this->email->subject('Consulta en buzón - ' . $this->config->item('site_title', 'ion_auth'));
        $this->email->message($message);
        $this->email->send();
        echo json_encode('Su consulta fue enviada');
    }

    function send_buzon_reclamaciones() {
        $texto = $this->input->post('texto');
        if (!$texto) {
            echo 'manakax';
            return false;
        }
        $this->load->library('email');
        $this->email->set_mailtype('html');
        $this->session->old_last_login = time();
        $datamail = $this->getdatamail($texto);
        $message = $this->load->view('mail/buzon', $datamail, true);
        $this->email->from('no-reply@aprendiendoaprevenir.com', $this->config->item('site_title', 'ion_auth'));
        $this->email->to('mcabrejos@franquiciasperu.com');
        $this->email->to('jvasquez@factoriamedia.com');
        $this->email->subject('Consulta en buzón de reclamaciones- ' . $this->config->item('site_title', 'ion_auth'));
        $this->email->message($message);
        $this->email->send();
        echo json_encode('Su consulta fue enviada');
    }

    protected function getdatamail($texto) {
        $user = $this->base_model->user_info_login();
        $buzon_info = $this->ajax_model->buzon_info($user['id']);
        return array(
            'dni' => $user['dni'],
            'email' => $user['email'],
            'apat' => $user['apat'],
            'amat' => $user['amat'],
            'nombre' => $user['nombre'],
            'consulta' => $texto,
            'empresa' => $buzon_info->empresa,
            'area' => $buzon_info->area,
            'departamento' => $buzon_info->departamento,
            'cargo' => $buzon_info->cargo,
            'planilla' => $buzon_info->planilla,
            'sede' => $buzon_info->sede,
            'seccion' => $buzon_info->seccion
        );
    }

    /*     * ******************************  Cursos  ******************************* */

    function init_curso() {
        //cuando abres el curso, crea el registro o aumenta las vistas
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            echo $this->ajax_model->init_curso($user_id, $id_curso);
        } else {
            echo "manakax";
        }
    }

    function init_curso_driver() {
        //cuando abres el curso, crea el registro o aumenta las vistas
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            echo $this->ajax_model->init_curso_driver($user_id, $id_curso);
        } else {
            echo "manakax";
        }
    }

    function init_calificacion() {
        //cuando abres el curso, crea el registro o aumenta las vistas
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            echo $this->ajax_model->init_calificacion($user_id, $id_curso);
        } else {
            echo "manakax";
        }
    }

    // function rev_calificacion() {
    //     if ($this->session->user_id && $this->session->curso) {
    //         $user_id = (int) $this->session->user_id;
    //         $id_curso = (int) $this->session->curso;
    //         echo $this->ajax_model->rev_calificacion($user_id, $id_curso);
    //     } else {
    //         echo "manakax";
    //     }
    // }

    function set_intentos() {
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            echo $this->ajax_model->set_intentos($user_id, $id_curso);
        } else {
            echo "manakax";
        }
    }

    function set_intentos_drivers_1() {
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            echo $this->ajax_model->set_intentos_drivers_1($user_id, $id_curso);
        } else {
            echo "manakax";
        }
    }

    function set_intentos_drivers_2() {
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            echo $this->ajax_model->set_intentos_drivers_2($user_id, $id_curso);
        } else {
            echo "manakax";
        }
    }

    function get_intentos_drivers() {
            if ($this->session->user_id && $this->session->curso) {
                $user_id = (int) $this->session->user_id;
                $id_curso = (int) $this->session->curso;
                echo $this->ajax_model->get_intentos($user_id, $id_curso);
            } else {
                echo "manakax";
            }
        }

    function get_puntaje() {
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            echo $this->ajax_model->get_puntaje($user_id, $id_curso);
        } else {
            echo "manakax";
        }
    }
    
    function set_puntaje() {
        $puntaje = $this->input->post('puntaje');
        $estrellas = $this->input->post('estrellas');
        $check = $this->input->post('check');
        if ($this->session->user_id && $this->session->curso && $check) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            $puntaje = (int) $puntaje;
            $estrellas = (int) $estrellas;
            $this->session->win = $this->session->position;
            echo $this->ajax_model->update_puntaje($user_id, $id_curso, $puntaje, $estrellas);
        } else {
            echo 'manakax';
        }
    }

     function set_calificacion() {
        $calificacion = $this->input->post('calificacion');
        // $check = $this->input->post('check');
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            $calificacion = (int) $calificacion;
            echo $this->ajax_model->update_calificacion($user_id, $id_curso, $calificacion);
        } else {
            echo 'manakax';
        }
    }

    function set_constancia() {
        if ($this->session->user_id && $this->session->curso) {
            $user_id = (int) $this->session->user_id;
            $id_curso = (int) $this->session->curso;
            echo $this->ajax_model->set_constancia($user_id, $id_curso);
        } else {
            echo 'manakax';
        }
    }

}
