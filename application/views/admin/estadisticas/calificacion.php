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
            var labels = <?php echo "['" . implode("','", $areas) . "']"; ?>;
        </script>
        <script src="<?php echo base_url($own_dir . '/js/estadisticas-calificacion.js'); ?>"></script>
    </head>
    <body style="zoom:1;">
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="estad-estatus" class="container">
                <div class="row">
                    <?php echo $estadisticas_menu; ?>
                    <h2>Cuadro de estatus</h2>
                    <br><br>
                    <div id="cont-tipo-estadistica">
                        <div id="tipo-estadistica-1" class="tipo-estadistica">Cantidad de participación</div>
                        <div id="tipo-estadistica-2" class="tipo-estadistica">Porcentaje de participación</div>
                        <div id="tipo-estadistica-3" class="tipo-estadistica">Promedio de puntaje</div>
                    </div>
                    <br><br><br>
                    <div id="cont-select">
                        <div>
                            <label for="nivel">Nivel: </label> 
                            <?php echo form_dropdown('nivel', $niv_data, $niv_value, $niv_extra); ?>
                        </div>
                    </div>
                    <br>
                    <div class="perc-txt">
                        <div id="perc-total" class="perc-txt"></div><br>
                        <div id="perc-fin" class="perc-txt"></div><br>
                        <div id="perc-falta" class="perc-txt"></div><br>
                        <?php echo anchor('admin/reporte_est', 'Descargar reporte de participación', array('id' => 'rep-est', 'target' => '_blank')); ?>
                    </div>
                    <div id="canvas-estatus">
                        <canvas id="promedio" width="400" height="800"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>