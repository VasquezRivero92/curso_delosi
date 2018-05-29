<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión de usuarios - <?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <!-- <link rel="icon" href="images/favicon.ico" /> -->
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/reset.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/base.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/mediastyle.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.ui.touch-punch.min.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
            var userID = '<?php echo $user->id; ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/editar.js'); ?>"></script>
    </head>
    <body style="zoom:1;">
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="editar-cont" class="container">
                <div class="row">
                    <h2>Editar usuario</h2><br>
                    <div id="infoMessage"></div><br>
                    <table id="reg-single">
                        <tr><td colspan="2">&nbsp;<?php echo form_open(); ?></td></tr>
                        <tr>
                            <td><label for="apat">Apellido paterno:</label></td>
                            <td><?php echo form_input($apat); ?></td>
                        </tr>
                        <tr>
                            <td><label for="amat">Apellido materno:</label></td>
                            <td><?php echo form_input($amat); ?></td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Nombres:</label></td>
                            <td><?php echo form_input($nombre); ?></td>
                        </tr>
                        <tr>
                            <td><label for="identity">DNI:</label></td>
                            <td><?php echo form_input($identity); ?></td>
                        </tr>
                        <tr>
                            <td><label for="email">E-mail:</label></td>
                            <td><?php echo form_input($email); ?></td>
                        </tr>
                        <tr>
                            <td><label for="sexo">Sexo:</label></td>
                            <td><?php echo form_radio($sexom); ?><label for="sexom">Masculino</label>
                                <br>
                                <?php echo form_radio($sexof); ?><label for="sexof">Femenino</label></td>
                        </tr>
                        <tr>
                            <td><label for="grupo">Grupo:</label></td>
                            <td><?php echo form_dropdown('grupo', $group_data, $group_value, $group_extra); ?></td>
                        </tr>
                        <tr>
                            <td><label for="nivel">Nivel de usuario:</label></td>
                            <td><?php echo form_dropdown('nivel', $level_data, $level_value, $level_extra); ?></td>
                        </tr>
                        <tr>
                            <td><label for="password">Contraseña:</label></td>
                            <td><?php echo form_input($password); ?></td>
                        </tr>
                        <tr>
                            <td><label for="password_confirm">Repetir contraseña:</label></td>
                            <td><?php echo form_input($password_confirm); ?></td>
                        </tr>
                        <tr>
                            <td><label for="puntaje">Limpiar puntaje:</label></td>
                            <td><?php
                                echo form_dropdown('puntaje', $niv_data, $niv_value, $niv_extra);
                                echo form_input($cleanpoints);
                                ?></td>
                        </tr>
                        <tr>
                            <td><label for="estado">Estado:</label></td>
                            <td><?php echo form_dropdown('estado', $est_data, $est_value, $est_extra); ?></td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td colspan="2">
                                <?php
                                echo form_input(array('id' => 'hid', 'name' => 'id', 'type' => 'hidden', 'value' => $user->id));
                                echo form_hidden($csrf);
                                echo form_input($submit);
                                ?>
                            </td>
                        </tr>
                        <tr><td colspan="2">&nbsp;<?php echo form_close(); ?></td></tr>
                        <tr><td colspan="2"><hr></td></tr>
                        <tr><td colspan="2">Registros:</td></tr>
                        <tr><td colspan="2" id="uplist_ue">&nbsp;</td></tr>
                        <tr><td colspan="2">&nbsp;<?php echo form_open('', 'id="formeditue"'); ?></td></tr>
                        <tr class="uerow">
                            <td><label for="empresa">Empresa:</label></td>
                            <td><?php echo form_dropdown('empresa', $emp_data, $emp_value, $emp_extra); ?></td>
                        </tr>
                        <tr class="uerow">
                            <td><label for="area">Área:</label></td>
                            <td><?php echo form_dropdown('area', $are_data, $are_value, $are_extra); ?></td>
                        </tr>
                        <tr class="uerow">
                            <td><label for="departamento">Departamento:</label></td>
                            <td><?php echo form_dropdown('departamento', $dep_data, $dep_value, $dep_extra); ?></td>
                        </tr>
                        <tr class="uerow">
                            <td><label for="puesto">Cargo:</label></td>
                            <td><?php echo form_dropdown('cargo', $car_data, $car_value, $car_extra); ?></td>
                        </tr>
                        <tr class="uerow">
                            <td><label for="planilla">Planilla:</label></td>
                            <td><?php echo form_dropdown('planilla', $pla_data, $pla_value, $pla_extra); ?></td>
                        </tr>
                        <tr class="uerow">
                            <td><label for="sede">Sede:</label></td>
                            <td><input name="sede" value="" id="sede" class="ucase" type="text"></td>
                        </tr>
                        <tr class="uerow">
                            <td><label for="seccion">Sección:</label></td>
                            <td><input name="seccion" value="" id="seccion" class="ucase" type="text"></td>
                        </tr>
                        <tr class="uerow">
                            <td><label for="fingpla">Fecha de ingreso (DD/MM/AAAA):</label></td>
                            <td><input name="fingpla" value="" id="fingpla" class="ucase" type="text"></td>
                        </tr>
                        <tr class="uerow"><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td colspan="2"><?php echo form_input($newreg); ?></td>
                        </tr>
                        <tr class="uerow">
                            <td colspan="2"><?php echo form_input($updreg); ?></td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr class="uerow">
                            <td colspan="2"><?php echo form_input($delreg); ?></td>
                        </tr>
                        <tr><td colspan="2">&nbsp;<?php echo form_close(); ?></td></tr>
                    </table>
                    <?php echo form_close(); ?>
                </div>
            </section>
        </div>
    </body></html>