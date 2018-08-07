<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxadm_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
        $this->load->model('ion_auth_model');
        $this->tables = $this->config->item('tables', 'ion_auth');
        $this->id_version = $this->ion_auth_model->get_id_vers();
    }

    /*     * *******************************  curso  ******************************** */

    public function update_curso($id, $estado) {
        $this->db->update('curso', array('estado' => $estado), array('id' => $id));
        return $this->db->affected_rows();
    }

    /*     * *******************************  registro  ******************************** */

    public function reg_emp_user($data) {
        $check = $this->db->where('id_user', $data['id_user'])
                        ->where('id_empresa', $data['id_empresa'])
                        ->limit(1)
                        ->count_all_results('users_empresa') > 0;
        if ($check) {
            return 'El registro ya existe';
        } else {
            return $this->db->insert('users_empresa', $data);
        }
    }

    /*     * *******************************  consulta  ******************************** */

    public function consulta_usuarios($data) {
        $this->load->model('base_model');
        $CCursos = $this->base_model->get_cursos(true, $data['menu'])->result();
        $this->db->select('DISTINCT(u.id),u.apat,u.amat,u.nombre,u.email,u.dni,u.sexo,u.id_grupo,u.active,u.last_login')
                ->from($this->tables['users'] . ' u');
        if ($data['empresa'] || $data['area'] || $data['departamento']) {
            $this->db->join('users_empresa ue', 'u.id = ue.id_user');
        }
        if ($data['parti'] == 2) {
            $this->db->join('users_menu um', 'um.id_user = u.id');
        }
        $this->db->like('u.apat', $data['apat'])
                ->like('u.amat', $data['amat'])
                ->like('u.nombre', $data['nombre'])
                ->like('u.dni', $data['dni'])
                ->where('u.active', $data['active']);
        if ($data['email']) {
            $this->db->like('u.email', $data['email']);
        }
        if ($data['empresa']) {
            $this->db->where('ue.id_empresa', $data['empresa']);
        }
        if ($data['area']) {
            $this->db->where('ue.id_area', $data['area']);
        }
        if ($data['departamento']) {
            $this->db->where('ue.id_departamento', $data['departamento']);
        }
        //si quieren ver los que jugaron los filtro, sino muestran todos
        if ($data['parti'] == 2) {
            $this->db->where('um.id_menu', $data['menu'])
                    ->where('um.puntaje IS NOT NULL', null, false);
        }
        $reporte = $this->db->order_by('u.apat', 'asc')
                        ->order_by('u.amat', 'asc')
                        ->order_by('u.nombre', 'asc')
                        ->get()->result();
        $usuarios = [];
        foreach ($reporte as $user) {
            if ($data['parti'] == 3) {//si quieren ver los que NO jugaron
                $stats = $this->db->select('id_user')
                                ->from('users_menu')
                                ->where('id_user', $user->id)
                                ->where('id_menu', $data['menu'])
                                ->where('puntaje IS NOT NULL', null, false)
                                ->get()->num_rows();
                if ($stats) {//si sale en el query, no lo cuenta
                    continue;
                }
            }
            $total = '0';
            $tUser = array(
                'id' => $user->id,
                'dni' => $user->dni,
                'apat' => mb_strtoupper($user->apat),
                'amat' => mb_strtoupper($user->amat),
                'nombre' => mb_strtoupper($user->nombre),
                'email' => mb_strtolower($user->email),
                'sexo' => $user->sexo,
                'id_grupo' => $user->id_grupo,
                'active' => $user->active,
                'last_login' => $user->last_login ? $user->last_login : 0
            );
            foreach ($CCursos as $curso) {
                $query = $this->db->select('puntaje, intentos, calificacion')
                                ->from('users_curso')
                                ->where('id_user', $user->id)
                                ->where('id_curso', $curso->id)
                                ->where('id_version', $this->id_version)
                                ->where('puntaje IS NOT NULL', null, false)
                                ->get()->row();
                if ($query) {
                    $tUser['c' . $curso->id] = (int) $query->puntaje;
                    $tUser['r' . $curso->id] = (int) $query->intentos;
                    $tUser['calificacion' . $curso->id] = (int) $query->calificacion;
                    $total = (int) $total + (int) $query->puntaje;
                } else {
                    $tUser['c' . $curso->id] = '0';
                    $tUser['r' . $curso->id] = '0';
                    $tUser['calificacion' . $curso->id] = '0';
                }
            }
            $tUser['total'] = $total;
            $usuarios[] = $tUser;
        }
        return $usuarios;
    }

    /*     * *******************************  consulta (Editar usuario)  ******************************** */

    public function get_users_empresa($id_user) {
        return $this->db->select('id_empresa,id_area,id_departamento,id_cargo,id_planilla,sede,seccion,fingpla')
                        ->where('id_user', $id_user)
                        ->get('users_empresa');
    }

    public function limpiar_puntos_curso($id_user, $id_curso) {
        $data = array(
            'fecha' => null,
            'puntaje' => null,
            'estrellas' => null,
            'intentos' => 0
        );
        $resul = $this->db->where('id_user', $id_user)
                ->where('id_curso', $id_curso)
                ->where('id_version', $this->id_version)
                ->update('users_curso', $data);
        $this->update_user_curso($id_user, $id_curso);
        return $resul;
    }

    public function edit_usuario($id, $data) {
        $user = $this->ion_auth_model->user($id)->row();
        $this->identity_column = $this->config->item('identity', 'ion_auth');
        if (array_key_exists($this->identity_column, $data) || array_key_exists('password', $data) || array_key_exists('email', $data)) {
            if (array_key_exists('password', $data)) {
                if (!empty($data['password'])) {
                    $data['password'] = $this->ion_auth_model->hash_password($data['password'], $user->salt);
                } else {
                    unset($data['password']);
                }
            }
        }
        $this->db->update($this->tables['users'], $data, array('id' => $user->id));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->set_error('update_unsuccessful');
            return FALSE;
        }
        $this->db->trans_commit();
        return TRUE;
    }

    public function edit_emp_user($id_user, $id_empresa, $data) {
        return $this->db->where('id_user', $id_user)
                        ->where('id_empresa', $id_empresa)
                        ->update('users_empresa', $data);
    }

    public function eliminar_usuario_empresa($id_user, $id_empresa) {
        return $this->db->where('id_user', $id_user)
                        ->where('id_empresa', $id_empresa)
                        ->delete('users_empresa');
    }

    /*     * *******************************  masivo  ******************************** */

    public function check_excel_users($ArrayExcel) {
        $ArrayReturn = [];
        foreach ($ArrayExcel as $uemp) {
            if (!$uemp[0]) {
                continue;
            }
            $tUser = $this->db->select('id')
                            ->where('dni', $uemp[0])
                            ->limit(1)
                            ->get('users')->num_rows();
            if ($tUser) {
                $tipo = 'existe';
            } else {
                $tipo = 'nuevo';
            }
            $temp = [];
            for ($i = 0; $i < count($uemp); $i++) {
                if (is_string($uemp[$i])) {
                    if (strlen(trim($uemp[$i]))) {
                        $temp[] = trim($uemp[$i]);
                    } else {
                        $temp[] = null;
                    }
                } else {
                    $temp[] = $uemp[$i];
                }
            }
            $temp[] = $tipo;
            $ArrayReturn[] = $temp;
        }
        return $ArrayReturn;
    }

    public function get_users_to_excel($ArrayExcel) {
        $this->load->model('base_model');

        $empresas = [];
        foreach ($this->base_model->get_empresas()->result() as $emp) {
            $empresas[$emp->id] = $emp->nombre;
        }

        $ArrayReturn = [];
        foreach ($ArrayExcel as $uemp) {
            $tUser = $this->db->select('id,apat,amat,nombre')->where('dni', $uemp[0])->limit(1)->get('users')->row();
            if (!$tUser) {
                continue;
            }
            $inArray = false;
            foreach ($ArrayReturn as $ARitm) {
                if ($ARitm[0] == $tUser->id && $ARitm[3] == $uemp[1]) {
                    $inArray = true;
                }
            }
            if ($inArray) {
                continue;
            }
            $id_empresa = array_search($uemp[1], $empresas);
            if (!$id_empresa) {
                continue;
            }
            if (array_key_exists(6, $uemp) && $uemp[6] && !$this->db->select('*')->where('usuario2', $uemp[6])->limit(1)->get('tienda')->num_rows()) {
                continue;
            }
            if ($this->db->select('*')->where('id_user', $tUser->id)->where('id_empresa', $id_empresa)->limit(1)->get('users_empresa')->num_rows()) {
                $tipo = 'existe';
            } else {
                $tipo = 'nuevo';
            }
            $temp = [];
            $temp[] = $tUser->id;
            $temp[] = $uemp[0];
            $temp[] = $tUser->apat . ' ' . $tUser->amat . ', ' . $tUser->nombre;
            for ($i = 1; $i < count($uemp); $i++) {
                if (is_string($uemp[$i])) {
                    if (strlen(trim($uemp[$i]))) {
                        $temp[] = trim($uemp[$i]);
                    } else {
                        $temp[] = null;
                    }
                } else {
                    $temp[] = $uemp[$i];
                }
            }
            $temp[] = $tipo;
            $ArrayReturn[] = $temp;
        }
        return $ArrayReturn;
    }

    public function check_excel_tiendas($ArrayExcel) {
        $ArrayReturn = [];
        foreach ($ArrayExcel as $tnd) {
            if (!$tnd[2] && !$tnd[3]) {
                continue;
            }
            $tUser = $this->db->select('id')
                            ->where('usuario', $tnd[3])
                            ->limit(1)
                            ->get('tienda')->num_rows();
            /*
              $tUser2 = $this->db->select('id')->where('usuario2', $tnd[2])->limit(1)->get('tienda')->row();
              $idUser = $tUser ? $tUser->id : 0;
              $idUser2 = $tUser2 ? $tUser2->id : 0;
              if ($idUser && $idUser2 && ($idUser != $idUser2)) {
              continue;
              } */
            if ($tUser) {// || $tUser2) {
                $tipo = 'existe';
            } else {
                $tipo = 'nuevo';
            }
            $temp = [];
            for ($i = 0; $i < count($tnd); $i++) {
                if (is_string($tnd[$i])) {
                    if (strlen(trim($tnd[$i]))) {
                        $temp[] = trim($tnd[$i]);
                    } else {
                        $temp[] = null;
                    }
                } else {
                    $temp[] = $tnd[$i];
                }
            }
            $temp[] = $tipo;
            $ArrayReturn[] = $temp;
        }
        return $ArrayReturn;
    }

    public function run_ed_user($data) {
        $ip_address = $this->_prepare_ip($this->input->ip_address());
        $salt = $this->ion_auth_model->store_salt ? $this->ion_auth_model->salt() : FALSE;
        $insertArray = [];
        $updateArray = [];
        foreach ($data as $itm) {
            $checkDNI = $this->db->select('id')->where('dni', $itm['dni'])->limit(1)->get($this->tables['users'])->row();
            $checkEmail = $itm['email'] ? $this->db->select('id')->where('email', $itm['email'])->limit(1)->get($this->tables['users'])->row() : false;
            //si quieren actualizar a un usuario existente con un mail que esta con otro registro
            if ($checkDNI && $checkEmail && ($checkDNI->id != $checkEmail->id)) {
                continue;
            } elseif ($checkEmail && !$checkDNI) {//si quieren ingresar un nuevo usuario con un mail existente
                $itm['email'] = null;
            }
            $temp = [];
            $datosCompletos = true;
            if ($itm['apat']) {
                $temp['apat'] = mb_strtoupper($itm['apat']);
            }
            if ($itm['amat']) {
                $temp['amat'] = mb_strtoupper($itm['amat']);
            }
            if ($itm['nombre']) {
                $temp['nombre'] = mb_strtoupper($itm['nombre']);
            }
            if ($itm['dni']) {
                $temp['dni'] = $itm['dni'];
            }
            if ($itm['sexo']) {
                $temp['sexo'] = mb_strtoupper($itm['sexo']);
            }
            if ($itm['password']) {
                $temp['password'] = $this->ion_auth_model->hash_password($itm['password'], $salt);
            }
            if ($itm['id_grupo']) {
                $temp['id_grupo'] = (int) $itm['id_grupo'];
            }

            //para comprobar que los datos obligatorios estan completos
            if (count($temp) < 7) {
                $datosCompletos = false;
            }
            if ($itm['email']) {
                $temp['email'] = mb_strtolower($itm['email']);
            } else {
                $temp['email'] = null;
            }
            $temp['id_nivel'] = (int) $itm['id_nivel'];
            $temp['ip_address'] = $ip_address;
            $temp['created_on'] = time();
            $temp['active'] = $itm['activo'];
            if ($this->ion_auth_model->store_salt) {
                $temp['salt'] = $salt;
            }
            if ($itm['existe'] == 'existe' && $checkDNI) {
                $temp['id'] = $checkDNI->id;
                $updateArray[] = $temp;
            } elseif ($itm['existe'] == 'nuevo' && !$checkDNI && $datosCompletos) {
                $insertArray[] = $temp;
            }
        }
        $sumaInsert = count($insertArray) ? $this->db->insert_batch($this->tables['users'], $insertArray) : 0;
        $sumaUpdate = count($updateArray) ? $this->db->update_batch($this->tables['users'], $updateArray, 'id') : 0;
        return $sumaInsert + $sumaUpdate;
    }

    public function run_ed_uemp($data) {
        $insertArray = [];
        $updateArray = [];
        foreach ($data as $itm) {
            $check = $this->db->select('id')->where('id_user', $itm['id_user'])->where('id_empresa', $itm['id_empresa'])->get('users_empresa')->row();
            $temp = [];
            if ($itm['id_user']) {
                $temp['id_user'] = (int) $itm['id_user'];
            }
            if ($itm['id_empresa']) {
                $temp['id_empresa'] = (int) $itm['id_empresa'];
            }
            if ($itm['id_area']) {
                $temp['id_area'] = (int) $itm['id_area'];
            }
            if ($itm['id_departamento']) {
                $temp['id_departamento'] = (int) $itm['id_departamento'];
            }
            if ($itm['id_cargo']) {
                $temp['id_cargo'] = (int) $itm['id_cargo'];
            }
            if ($itm['id_planilla']) {
                $temp['id_planilla'] = (int) $itm['id_planilla'];
            }
            if ($itm['sede']) {
                $temp['sede'] = mb_strtoupper($itm['sede']);
            }
            if ($itm['seccion']) {
                $temp['seccion'] = mb_strtoupper($itm['seccion']);
            }
            $temp['fingpla'] = strtotime($itm['fingpla']) ? strtotime($itm['fingpla']) : time();

            if ($itm['existe'] == 'existe' && $check) {
                $temp['id'] = $check->id;
                $updateArray[] = $temp;
            } elseif ($itm['existe'] == 'nuevo' && !$check && count($temp) >= 8) {
                $insertArray[] = $temp;
            }
        }
        $sumaInsert = count($insertArray) ? $this->db->insert_batch('users_empresa', $insertArray) : 0;
        $sumaUpdate = count($updateArray) ? $this->db->update_batch('users_empresa', $updateArray, 'id') : 0;
        return $sumaInsert + $sumaUpdate;
    }

    public function run_del_uemp($data) {
        $deleteArray = [];
        foreach ($data as $itm) {
            $check = $this->db->select('id')->where('id_user', $itm['id_user'])->where('id_empresa', $itm['id_empresa'])->get('users_empresa')->row();
            if ($check) {
                $deleteArray[] = $check->id;
            }
        }
        return count($deleteArray) ? $this->db->where_in('id', $deleteArray)->delete('users_empresa') : 0;
    }

    public function run_ed_tienda($data) {
        $salt = $this->ion_auth_model->store_salt ? $this->ion_auth_model->salt() : FALSE;
        $insertArray = [];
        $updateArray = [];
        foreach ($data as $itm) {
            $checkTienda = $this->db->select('id')
                            ->where('usuario', $itm['usuario'])
                            //->or_where('usuario2', $itm['usuario2'])
                            ->limit(1)
                            ->get('tienda')->row();
            $temp = [];
            $datosCompletos = true;
            $temp['marca'] = $itm['marca'] ? $itm['marca'] : null;
            $temp['formato'] = $itm['formato'] ? $itm['formato'] : null;
            if ($itm['usuario']) {
                $temp['usuario'] = $itm['usuario'];
            }
            if ($itm['usuario2']) {
                $temp['usuario2'] = $itm['usuario2'];
            }
            if ($itm['nombre']) {
                $temp['nombre'] = $itm['nombre'];
            }
            if ($itm['password']) {
                $temp['password'] = $this->ion_auth_model->hash_password($itm['password'], $salt);
            } else {
                $temp['password'] = null;
            }
            $temp['salt'] = $this->ion_auth_model->store_salt ? $salt : null;

            //para comprobar que los datos obligatorios estan completos
            if (count($temp) < 3) {
                $datosCompletos = false;
            }
            $temp['active'] = $itm['activo'];
            if ($itm['existe'] == 'existe' && $checkTienda) {
                $temp['id'] = $checkTienda->id;
                $updateArray[] = $temp;
            } elseif ($itm['existe'] == 'nuevo' && !$checkTienda && $datosCompletos) {
                $temp['id_admin'] = 1;
                $insertArray[] = $temp;
            }
        }
        $sumaInsert = count($insertArray) ? $this->db->insert_batch('tienda', $insertArray) : 0;
        $sumaUpdate = count($updateArray) ? $this->db->update_batch('tienda', $updateArray, 'id') : 0;
        return $sumaInsert + $sumaUpdate;
    }

    public function add_campo_tabla($campo, $data) {
        if ($data && count($data)) {
            $insertArray = [];
            foreach ($data as $itm) {
                $insertArray[] = array('nombre' => $itm);
            }
            return $this->db->insert_batch($campo, $insertArray);
        } else {
            return 0;
        }
    }

    /*     * *******************************  estadisticas  ******************************** */
    public function cali_est($id_empresa, $id_area, $id_departamento) {
        $this->db->select('DISTINCT(id_user)')
                ->from('users_empresa ue')
                ->join('users u', 'ue.id_user = u.id');
        if ($id_empresa) {
            $this->db->where('ue.id_empresa', $id_empresa);
        }
        if ($id_area) {
            $this->db->where('ue.id_area', $id_area);
        }
        if ($id_departamento) {
            $this->db->where('ue.id_departamento', $id_departamento);
        }
        return $this->db->where('sede IS NOT NULL', null, false)
                        ->where('u.active', 1)
                        ->get()->num_rows();
    }

    public function num_players_est($id_empresa, $curso, $id_area, $id_departamento) {
        $this->db->select('DISTINCT(ue.id_user)')
                ->from('users_curso uc')
                ->join('users_empresa ue', 'uc.id_user = ue.id_user')
                ->join('curso c', 'uc.id_curso = c.id')
                ->join('users u', 'ue.id_user = u.id');
        if ($id_empresa) {
            $this->db->where('ue.id_empresa', $id_empresa);
        }
        if ($curso) {
            $this->db->where('uc.id_curso', $curso);
        }
        if ($id_area) {
            $this->db->where('ue.id_area', $id_area);
        }
        if ($id_departamento) {
            $this->db->where('ue.id_departamento', $id_departamento);
        }
        return $this->db->where('uc.puntaje IS NOT NULL', null, false)
                        ->where('ue.sede IS NOT NULL', null, false)
                        ->where('uc.id_version', $this->id_version)
                        ->where('u.active', 1)
                        ->where('c.menu', 1)
                        ->get()->num_rows();
    }

    public function sum_puntos_est($id_area, $curso) {
        $this->db->select('DISTINCT(ue.id_user) as id, uc.puntaje')
                ->from('users_curso uc')
                ->join('users_empresa ue', 'uc.id_user = ue.id_user')
                ->join('curso c', 'uc.id_curso = c.id')
                ->join('users u', 'ue.id_user = u.id');
        if ($id_area) {
            $this->db->where('ue.id_area', $id_area);
        }
        if ($curso) {
            $this->db->where('uc.id_curso', $curso);
        }
        $array = $this->db->where('uc.puntaje IS NOT NULL', null, false)
                        ->where('uc.sede IS NOT NULL', null, false)
                        ->where('uc.id_version', $this->id_version)
                        ->where('u.active', 1)
                        ->where('c.menu', 1)
                        ->get()->result_array();
        return array_sum(array_column($array, 'puntaje'));
    }

    public function num_users_est($id_empresa, $id_area, $id_departamento) {
        $this->db->select('DISTINCT(id_user)')
                ->from('users_empresa ue')
                ->join('users u', 'ue.id_user = u.id');
        if ($id_empresa) {
            $this->db->where('ue.id_empresa', $id_empresa);
        }
        if ($id_area) {
            $this->db->where('ue.id_area', $id_area);
        }
        if ($id_departamento) {
            $this->db->where('ue.id_departamento', $id_departamento);
        }
        return $this->db->where('sede IS NOT NULL', null, false)
                        ->where('u.active', 1)
                        ->get()->num_rows();
    }

    /*     * *******************************  reporte  ******************************** */

    public function get_sede_emps($id_empresa, $id_user = false) {
        if ($id_user) {
            $query = $this->db->select('sede,seccion')->from('users_empresa')->where('id_empresa', $id_empresa);
            if ($this->session->tipo == 'tienda') {
                $query = $query->where('sede', $id_user);
            }
            return $query->group_by('sede')
                            ->order_by('sede', 'asc')
                            ->get();
        } else {
            return $this->db->select('sede,seccion')
                            ->from('users_empresa')
                            ->where('id_empresa', $id_empresa)
                            ->group_by('sede')
                            ->order_by('sede', 'asc')
                            ->get();
        }
    }

    public function reporte_data($data) {
        $emp = $this->db->select('nombre,ruc')
                        ->from('empresa')
                        ->where('id', $data['empresa'])
                        ->get()->row();
        $niv = $this->db->select('descrip,duracion')
                        ->from('curso')
                        ->where('id', $data['nivel'])
                        ->get()->row();
        return array(
            'empresa' => mb_strtoupper($emp->nombre),
            'ruc' => mb_strtoupper($emp->ruc),
            'nivel' => mb_strtoupper($niv->descrip),
            'duracion' => mb_strtoupper($niv->duracion),
            'seccion' => $data['seccion']
        );
    }

    public function reporte_tabla($data) {
        $this->db->select('u.id,u.apat,u.amat,u.nombre,u.dni,ue.seccion,uc.puntaje,uc.fecha')
                ->from($this->tables['users'] . ' u')
                ->join('users_empresa ue', 'u.id = ue.id_user')
                ->join('users_curso uc', 'u.id = uc.id_user')
                ->where('uc.id_curso', $data['nivel'])
                ->where('uc.sede', $data['sede'])
                ->where('uc.puntaje IS NOT NULL', null, false)
                ->where('uc.id_version', $this->id_version)
                ->where('u.active', $data['active']);
        if (array_key_exists('fechainic', $data)) {
            $this->db->where('uc.fecha >=', $data['fechainic']);
        }
        if (array_key_exists('fechafin', $data)) {
            $this->db->where('uc.fecha <', $data['fechafin']);
        }
        if ($data['orden'] == 'fecha') {
            $this->db->order_by('uc.fecha', 'desc');
        }
        return $this->db->order_by('u.apat', 'asc')
                        ->order_by('u.amat', 'asc')
                        ->order_by('u.nombre', 'asc')
                        ->get()->result_array();
    }

    public function reporte_certif1() {
        return $this->db->select('u.apat,u.amat,u.nombre,e.nombre as empresa')
                        ->from('users u')
                        ->join('users_curso uc', 'u.id = uc.id_user')
                        ->join('empresa e', 'e.id = uc.id_empresa')
                        ->where('uc.puntaje IS NOT NULL', null, false)
                        ->where('uc.sede IS NOT NULL', null, false)
                        ->group_by('u.id')
                        ->having('count(*) >', 3)
                        ->order_by('e.nombre', 'asc')
                        ->order_by('u.apat', 'asc')
                        ->order_by('u.amat', 'asc')
                        ->order_by('u.nombre', 'asc')
                        ->get();
    }

    /*     * ****************************************************************** */

    protected function _prepare_ip($ip_address) {
        return $ip_address;
    }

}
