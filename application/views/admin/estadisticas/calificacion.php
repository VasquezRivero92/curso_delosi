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
        <script src="<?php echo base_url($own_dir . '/js/Chart.bundle.min.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/estadisticas-calificacion.js'); ?>"></script>
    </head>
    <body style="zoom:1;">
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="estad-avance" class="container">
                <div class="row">
                    <?php echo $estadisticas_menu; ?>
                    <h2>Cuadro de avance detallado</h2>
                    <br><br>
                    <div id="cont-select">
                        <?php echo form_dropdown('empresa', $emp_data, $emp_value, $emp_extra); ?>
                        <?php echo form_dropdown('area', $are_data, $are_value, $are_extra); ?>
                        <?php echo form_dropdown('departamento', $dep_data, $dep_value, $dep_extra); ?>
                        <?php echo form_dropdown('nivel', $niv_data, $niv_value, $niv_extra); ?>
                        <!-- <?php echo form_dropdown('calificacion', $cali_data, $cali_value, $cali_extra); ?> -->
                    </div>
                    <br>
                    <canvas id="promedio" ></canvas>
                    <br>
                    <table>
                        <!-- <tr>
                            <td>Universo de usuarios seleccionado:</td><td id="perc-total"></td>
                        </tr>
                        <tr>
                            <td>Usuarios que participaron:</td><td id="perc-fin"></td>
                        </tr>
                        <tr>
                            <td>Usuarios que falta participar:</td><td id="perc-falta"></td>
                        </tr> -->
                    </table>
                    <br><br>
                </div>
            </section>
        </div>
    </body>
</html>