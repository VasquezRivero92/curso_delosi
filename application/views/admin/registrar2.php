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
            var userID = '<?php echo $reg_id; ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/registrar2.js'); ?>"></script>
    </head>
    <body style="zoom:1;">
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="registro-cont" class="container">
                <div class="row superwidth">
                    <h2>Registro Individual - Parte 2</h2><br>
                    <div id="infoMessage"><?php echo $message; ?></div><br>
                    <?php echo form_open(); ?>
                    <table id="reg-single">
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td><label for="apat">Apellido paterno:</label></td>
                            <td><?php echo $reg_apat; ?></td>
                        </tr>
                        <tr>
                            <td><label for="amat">Apellido materno:</label></td>
                            <td><?php echo $reg_amat; ?></td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Nombres:</label></td>
                            <td><?php echo $reg_nombre; ?></td>
                        </tr>
                        <tr>
                            <td><label for="identity">DNI:</label></td>
                            <td><?php echo $reg_dni; ?></td>
                        </tr>
                        <tr id="interline"><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td><label for="empresa">Empresa:</label></td>
                            <td><?php echo form_dropdown('empresa', $emp_data, $emp_value, $emp_extra); ?></td>
                        </tr>
                        <tr>
                            <td><label for="area">Área:</label></td>
                            <td><?php echo form_dropdown('area', $are_data, $are_value, $are_extra); ?></td>
                        </tr>
                        <tr>
                            <td><label for="departamento">Departamento:</label></td>
                            <td><?php echo form_dropdown('departamento', $dep_data, $dep_value, $dep_extra); ?></td>
                        </tr>
                        <tr>
                            <td><label for="cargo">Cargo:</label></td>
                            <td><?php echo form_dropdown('cargo', $car_data, $car_value, $car_extra); ?></td>
                        </tr>
                        <tr>
                            <td><label for="planilla">Planilla:</label></td>
                            <td><?php echo form_dropdown('planilla', $pla_data, $pla_value, $pla_extra); ?></td>
                        </tr>
                        <tr>
                            <td><label for="sede">Sede:</label></td>
                            <td><?php echo form_input($sede); ?></td>
                        </tr>
                        <tr>
                            <td><label for="seccion">Sección:</label></td>
                            <td><?php echo form_input($seccion); ?></td>
                        </tr>
                        <tr>
                            <td><label for="fingpla">Fecha de ingreso a planilla (DD/MM/AAAA):</label></td>
                            <td><?php echo form_input($fingpla); ?></td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td colspan="2"><?php echo form_button($regempuser); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo form_reset($resetempuser); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo form_button($backempuser); ?></td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                </div>
            </section>
        </div>
    </body></html>