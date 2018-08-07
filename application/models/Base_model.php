<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('ion_auth_model');
        if (!$this->logged_in() && get_cookie($this->config->item('identity_cookie_name', 'ion_auth')) && get_cookie($this->config->item('remember_cookie_name', 'ion_auth'))) {
            $this->ion_auth_model->login_remembered_user();
        }
        $this->id_version = $this->ion_auth_model->get_id_vers();
    }

    //Para el login
    public function add_visita() {
        $visita = $this->db->select('cant')
                        ->where('fecha', date('d-m-Y'))
                        ->get('visitas')->row();
        if ($visita && $visita->cant) {
            $cant = 1 + (int) $visita->cant;
            $this->db->where('fecha', date('d-m-Y'))
                    ->update('visitas', array('cant' => $cant));
            return $cant;
        } else {
            $this->db->insert('visitas', array('fecha' => date('d-m-Y')));
            return 1;
        }
    }

    public function user_info_login() {
        if ($this->session->tipo == 'user') {
            $user = $this->get_user($this->session->identity);
            $data['id'] = $user->id;
            $data['ip_address'] = $user->ip_address;
            $data['email'] = $user->email;
            $data['dni'] = $user->dni;
            $data['created_on'] = $user->created_on;
            $data['lastlogin'] = !empty($user->last_login) ? $user->last_login : NULL;
            $data['active'] = $user->active;
            $data['nombre'] = !empty($user->nombre) ? htmlspecialchars($user->nombre, ENT_QUOTES, 'UTF-8') : NULL;
            $data['apat'] = !empty($user->apat) ? ' ' . htmlspecialchars($user->apat, ENT_QUOTES, 'UTF-8') : NULL;
            $data['amat'] = !empty($user->amat) ? ' ' . htmlspecialchars($user->amat, ENT_QUOTES, 'UTF-8') : NULL;
            $data['mapa'] = $user->mapa;
            return $data;
        } else {
            $data['id'] = $this->session->user_id;
            $data['marca'] = $this->session->marca;
            $data['formato'] = $this->session->formato;
            $data['usuario'] = $this->session->usuario;
            $data['usuario2'] = $this->session->usuario2;
            $data['nombre'] = $this->session->nombre;
            return $data;
        }
    }

    public function user_stats($menu = false) {
        $this->db->select('id_menu,curso,puntaje,estrellas')
                ->from('users_menu')
                ->where('id_user', $this->session->user_id);
        if ($menu) {
            $this->db->where('id_menu', $menu);
        }
        return $this->db->get();
    }

    public function has_access($acceso) {
        return (bool) $this->db->select('aa.id_acceso')
                        ->from('admin_acceso aa')
                        ->join('acceso a', 'aa.id_acceso = a.id')
                        ->where('aa.id_admin', $this->session->userniv)
                        ->where('a.nombre', $acceso)
                        ->limit(1)
                        ->get()
                        ->num_rows();
    }

    public function entramapa() {
        $mapa = $this->db->select('mapa')                     
                        ->where('id', $this->session->user_id)
                        ->get('users');

                return $mapa;
    }

    public function entraarecla() {
        return (bool) $this->db->select('id_user')
                        ->from('users_anc')
                        ->where('id_user', $this->session->user_id)
                        ->limit(1)
                        ->get()
                        ->num_rows();
    }

    public function entraadriver() {
        return (bool) $this->db->select('id_user')
                        ->from('users_empresa')
                        ->where('id_cargo', '385')
                        ->where('id_user', $this->session->user_id)
                        ->limit(1)
                        ->get()
                        ->num_rows();
    }

    public function usuarios_cocina() {
        return (bool) $this->db->select('id_user')
                        ->from('users_empresa')
                        ->where('id_cargo', '1')
                        ->where('id_user', $this->session->user_id)
                        ->limit(1)
                        ->get()
                        ->num_rows();
    }

     public function usuarios_ofi() {
        return (bool) $this->db->select('id_user')
                        ->from('users_empresa')
                        ->where('id_cargo', '7')
                        ->where('id_user', $this->session->user_id)
                        ->limit(1)
                        ->get()
                        ->num_rows();
    }

    /*     * ************************************************************************ */
    public function entraformulario() {
        return (bool) $this->db->select('id_user')
                        ->from('users_anc')
                        ->where('id_user', $this->session->user_id)
                        ->limit(1)
                        ->get()
                        ->num_rows();
    }
    /*     * ************************************************************************ */

    public function get_cursos($activo = true, $menu = 1) {
        $this->db->select('id,nombre,descrip,estado')
                ->where('menu', $menu)
                ->where('pos', 1);
        if ($activo) {
            $this->db->where('estado', 1);
        }
        return $this->db->order_by('id', 'asc')
                        ->get('curso');
    }

    //lo mismo pero individual
    public function get_curso($id_curso) {
        return $this->db->select('id,nombre,descrip,estado')
                        ->where('id', $id_curso)
                        ->get('curso')->row();
    }

    //Usado en los niveles
    public function check_curso_user($id_user, $id_curso) {
        return $this->db->select('id_user')
                        ->where('id_user', $id_user)
                        ->where('id_curso', $id_curso)
                        ->where('id_version', $this->id_version)
                        ->limit(1)
                        ->get('users_curso')->num_rows();
    }

   
    public function get_user($identity) {
        $this->tables = $this->config->item('tables', 'ion_auth');
        $query = $this->db->select('*')->where('dni', $identity)->limit(1)->get($this->tables['users'])->row();
        if ($query) {
            return $query;
        } else {
            return $this->db->select('*')->where('email', $identity)->limit(1)->get($this->tables['users'])->row();
        }
    }

    //Muestra el curso más alto a ingresar de los usuarios
    public function get_max_curso() {
        return $this->db->select_max('id')
                        ->where('estado', 1)
                        ->where('id < 5')
                        ->get('curso')->row()->id;
        /*
          $NCur = $this->get_cursos()->num_rows();
          $fMax = $this->session->fingpla;
          $meses = 0;
          while ($fMax <= time() && $meses < $NCur) {
          $meses++;
          $fMax = strtotime('+1 months', $fMax);
          }
          return $meses;
          return $NCur; */
    }

    /*     * ************************************************************************ */

    public function get_empresas($id_user = false) {
        //las tiendas envian el usuario2, que es el campo sede en la tabla users_empresa
        if ($id_user) {
            $this->db->select('e.id,e.nombre,e.ruc,e.descrip,ue.id_empresa,ue.sede,ue.seccion')
                    ->from('empresa e')
                    ->join('users_empresa ue', 'e.id = ue.id_empresa');
            if ($this->session->tipo == 'user') {//comparamos por id
                $this->db->where('ue.id_user', $id_user);
            } else {//comparamos por sede
                $this->db->where('ue.sede', $id_user);
            }
            return $this->db->group_by('e.id')->order_by('e.nombre')->get();
        } else {
            return $this->db->select('id,nombre,ruc,descrip')
                            ->order_by('nombre')
                            ->get('empresa');
        }
    }
    public function get_cali($id_user = false) {
        //las tiendas envian el usuario2, que es el campo sede en la tabla users_empresa
        if ($id_user) {
            $this->db->select('c.id,c.nombre')
                    ->from('calificacion c')
                    ->join('users_empresa ue', 'c.id = ue.id_calificacion');
            if ($this->session->tipo == 'user') {//comparamos por id
                $this->db->where('ue.id_user', $id_user);
            } else {//comparamos por sede
                $this->db->where('ue.sede', $id_user);
            }
            return $this->db->group_by('c.id')->order_by('c.nombre')->get();
        } else {
            return $this->db->select('id,nombre')
                            ->order_by('nombre')
                            ->get('calificacion');
        }
    }
    public function get_empresas_anc($id_user = false) {
        //las tiendas envian el usuario2, que es el campo sede en la tabla users_empresa
        if ($id_user) {
            $this->db->select('e.id,e.nombre,e.ruc,e.descrip,ue.id_empresa,ue.sede,ue.seccion')
                    ->from('empresa e')
                    ->join('users_empresa ue', 'e.id = ue.id_empresa');
            if ($this->session->tipo == 'user') {//comparamos por id
                $this->db->where('ue.id_user', $id_user);
            } else {//comparamos por sede
                $this->db->where('ue.sede', $id_user);
            }
            return $this->db->group_by('e.id')->order_by('e.nombre')->get();
        } else {
            return $this->db->select('id,nombre,ruc,descrip')
                            ->order_by('nombre')
                            ->get('empresa');
        }
    }

    public function get_areas($id_user = false) {
        if ($id_user) {
            $this->db->select('a.id, a.nombre, a.descrip')
                    ->from('area a')
                    ->join('users_empresa ue', 'a.id = ue.id_area');
            if ($this->session->tipo == 'user') {//comparamos por id
                $this->db->where('ue.id_user', $id_user);
            } else {//comparamos por sede
                $this->db->where('ue.sede', $id_user);
            }
            return $this->db->group_by('a.id')->order_by('a.nombre')->get();
        } else {
            return $this->db->select('id,nombre,descrip')
                            ->order_by('nombre')
                            ->get('area');
        }
    }

    public function get_departamentos($id_user = false) {
        if ($id_user) {
            $this->db->select('d.id, d.nombre, d.descrip')
                    ->from('departamento d')
                    ->join('users_empresa ue', 'd.id = ue.id_departamento');
            if ($this->session->tipo == 'user') {//comparamos por id
                $this->db->where('ue.id_user', $id_user);
            } else {//comparamos por sede
                $this->db->where('ue.sede', $id_user);
            }
            return $this->db->group_by('d.id')->order_by('d.nombre')->get();
        } else {
            return $this->db->select('id,nombre,descrip')
                            ->order_by('nombre')
                            ->get('departamento');
        }
    }

    public function get_area_fltrd($id_empresa) {
        $this->db->select('id_area')->from('users_empresa');
        if ($id_empresa) {
            $this->db->where('id_empresa', $id_empresa);
        }
        return $this->db->group_by('id_area')->get();
    }

    public function get_areas_emp($id_empresa) {
        return $this->db->select('DISTINCT(a.id), a.nombre, a.descrip')
                        ->from('area a')
                        ->join('users_empresa ue', 'a.id = ue.id_area')
                        ->where('ue.id_empresa', $id_empresa)
                        ->order_by('a.nombre')
                        ->get();
    }

    // public function get_cali($id_calificacion) {
    //     return $this->db->select('DISTINCT(cc.id), cc.nombre')
    //                     ->from('calificacion cc')
    //                     ->join('users_curso uc', 'cc.id = uc.id_calificacion')
    //                     ->where('uc.id_calificacion', $id_calificacion)
    //                     // ->order_by('cc.nombre')
    //                     ->get();
    // }

    public function get_dep_fltrd($id_empresa, $id_area) {
        $this->db->select('id_departamento')->from('users_empresa');
        if ($id_empresa) {
            $this->db->where('id_empresa', $id_empresa);
        }
        if ($id_area) {
            $this->db->where('id_area', $id_area);
        }
        return $this->db->group_by('id_departamento')->get();
    }

     public function get_cargo() {
        return $this->db->select('id,nombre,descrip')
                        ->from('cargo')
                        ->order_by('nombre')
                        ->get('cargo');
    }
    
    public function get_cargos() {
        return $this->db->select('id,nombre,descrip')
                        ->order_by('nombre')
                        ->get('cargo');
    }

    public function get_planillas() {
        return $this->db->select('id,nombre,descrip')
                        ->order_by('nombre')
                        ->get('planilla');
    }

    public function get_grupos() {
        return $this->db->select('id,nombre')
                        ->order_by('id', 'asc')
                        ->get('grupo');
    }

    public function get_admlvl() {
        return $this->db->select('id,nombre')
                        ->order_by('id', 'asc')
                        ->where('id <', 4)
                        ->get('admin');
    }

    public function get_sedes() {
        return $this->db->select('count(*) AS cant, sede, seccion')
                        ->from('users_empresa')
                        ->group_by('sede')
                        ->order_by('seccion', 'asc')
                        ->where('sede IS NOT NULL', null, false)
                        ->get();
    }

    
    public function get_puntaje($id_user, $id_curso) {
            return $this->db->select('puntaje,estrellas,intentos,vistas')
                        ->where('id_user', $id_user)
                        ->where('id_curso', $id_curso)
                        ->where('id_version', $this->id_version)
                        ->get('users_curso')->row();
    }

    
    
    //funciones jose
    
    public function get_pregunta_calificacion($id) {
            return $this->db->select('nombre')
                        ->where('id', $id)
                        ->get('preguntas_calificacion')->row();
    }


    public function get_puntajes1($id_user) {
        return $this->db->select('puntaje')
                        ->where('id_user', $id_user)
                        ->where('id_curso', '5')
                        //->where('id_curso', '6')
                        ->where('id_version', $this->id_version)
                        ->get('users_curso')->row();
    }
    public function get_puntajes2($id_user) {
        return $this->db->select('puntaje')
                        ->where('id_user', $id_user)
                        ->where('id_curso', '6')
                        //->where('id_curso', '6')
                        ->where('id_version', $this->id_version)
                        ->get('users_curso')->row();
    }
    
    public function get_fecha($id_user) {
        return $this->db->select ('fecha')
                        ->where('id_user', $id_user)
                        ->where('id_curso', '6')
                        //->where('id_curso', '6')
                        ->where('id_version', $this->id_version)
                        ->get('users_curso')->row();
    }
        
  
    
    public function get_update_user_curso($id_cargo) {       
        return  $this->db->select('id_user')
                          ->where('id_cargo', $id_cargo)
//                        ->where('id_cargo', 43)
//                        ->where('id_cargo', 48)
//                        ->where('id_cargo', 163)
//                        ->where('id_cargo', 7)
//                        ->where('id_cargo', 85)
//                        ->where('id_cargo', 199)
//                        ->where('id_cargo', 172)
//                        ->where('id_cargo', 367)
//                        ->where('id_cargo', 42)
//                        ->where('id_cargo', 87)
//                        ->where('id_cargo', 12)
//                        ->where('id_cargo', 215)
//                        ->where('id_cargo', 41)
//                        ->where('id_cargo', 88)
//                        ->where('id_cargo', 144)
//                        ->where('id_cargo', 184)                       
                        ->get('users_curso')->row();
}   



    public function get_puntos_driver($id_user = false){
        return $this->db->select('puntaje')
                        ->where('id_user', $id_user)
                        ->where('id_curso', '8')
                        ->get('users_curso');
    }    
    /*     * ************************************************************************ */

    public function logged_in() {
        return (bool) $this->session->userdata('identity');
    }

}