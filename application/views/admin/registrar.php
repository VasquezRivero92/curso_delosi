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
        </script>
        <script src="<?php echo base_url($own_dir . '/js/registrar.js'); ?>"></script>
    </head>
    <body style="zoom:1;">
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="registro-cont" class="container">
                <div class="row superwidth">
                    <h2>Registro de usuarios</h2><br>
                    <?php
                    if ($message) {
                        echo '<div id="infoMessage">' . $message . '</div><br>';
                    }
                    ?>
                    <?php echo form_open(); ?>
                    <table id="reg-single">
                        <tr><td colspan="2">&nbsp;</td></tr>
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
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td colspan="2" id="reg-button"><?php echo form_submit($submit); ?></td>
                        </tr>
                        <tr><td colspan="2">&nbsp;</td></tr>
                    </table>
                    <?php echo form_close(); ?>
                </div>
            </section>
        </div>
    </body>
</html>