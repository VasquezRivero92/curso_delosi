<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión de usuarios - <?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/reset.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/base.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/mediastyle.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/datepicker-es.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.ui.touch-punch.min.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
<?php
$sendID = false;
if ($this->session->userniv == 5 && $this->session->tipo == 'tienda') {
    echo 'var sendID =  "' . $this->session->usuario2 . '"';
} else {
    echo 'var sendID =  false;';
}
?>
        </script>
        <script src="<?php echo base_url($own_dir . '/js/reporte.js'); ?>"></script>
    </head>
    <body>
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="reporte-cont" class="container">
                <div class="row">
                    <br>
                    <h2>Reporte de usuarios</h2>
                    <br>
                    <?php echo form_open('', $form_reporte); ?>
                    <?php echo form_dropdown('empresa', $emp_data, $emp_value, $emp_extra); ?>
                    <?php echo form_dropdown('sede', $sede_data, $sede_value, $sede_extra); ?>
                    <?php echo form_dropdown('nivel', $niv_data, $niv_value, $niv_extra); ?>
                    <?php echo form_dropdown('activo', array('1' => 'Activos', '0' => 'Cesados'), 1, array('id' => 'q-activo')); ?>
                    <br><br>
                    <?php echo form_input($fechainic); ?>
                    <?php echo form_input($fechafin); ?>
                    <?php echo form_input($reprun); ?>
                    <br><br>
                    <div id="r-orden">
                        <div><?php echo form_radio($rorden_ape); ?><label for="r-orden-ape">Ordenar por apellidos</label></div>
                        <div><?php echo form_radio($rorden_fecha); ?><label for="r-orden-fecha">Ordenar por fecha</label></div>
                    </div>
                    <?php echo form_close(); ?>
                    <br>
                    <img id="load-reporte" src="<?php echo base_url($own_dir . '/img/loading.gif'); ?>" alt=""/>
                    <div id="ctabla-reporte"></div>
                    <div id="reporte-empty">0 resultados.</div>
                </div>
            </section>
        </div>
    </body>
</html>