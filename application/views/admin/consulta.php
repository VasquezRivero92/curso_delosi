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
            var adminNivel =<?php echo $this->session->userniv; ?>;
        </script>
        <script src="<?php echo base_url($own_dir . '/js/consulta.js'); ?>"></script>
    </head>
    <body style="zoom:1;">
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="consulta-cont" class="container<?php if ($this->session->userniv < 3) echo ' noselect'; ?>">
                <div class="row superwidth">
                    <h2>Consulta de usuarios</h2>
                    <br>
                    <?php echo form_open('', $form_query); ?>
                    <p>Complete al menos un campo:</p>
                    <br>
                    <?php echo form_input($qapat); ?>
                    <?php echo form_input($qamat); ?>
                    <?php echo form_input($qnombre); ?>
                    <?php //echo form_input($qemail); ?>
                    <?php echo form_input($qdni); ?>
                    <hr>
                    <?php echo form_dropdown('empresa', $emp_data, $emp_value, $emp_extra); ?>
                    <?php echo form_dropdown('area', $are_data, $are_value, $are_extra); ?>
                    <?php echo form_dropdown('departamento', $dep_data, $dep_value, $dep_extra); ?>
                    <hr>
                    <?php echo form_dropdown('activo', array('1' => 'Activo', '0' => 'Cesado'), 1, array('id' => 'q-activo')); ?>
                    <?php
                    echo form_dropdown('parti', array(
                        '1' => 'Todas las personas',
                        '2' => 'Personas que jugaron',
                        '3' => 'Personas que NO jugaron'
                            ), 1, array('id' => 'q-parti'));
                    ?>
                    <br>
                    <div id="q-orden">
                        <div><?php echo form_radio($qorden_ape); ?><label for="q-orden-ape">Ordenar por apellidos</label></div>
                        <div><?php echo form_radio($qorden_ptj); ?><label for="q-orden-ptj">Ordenar por puntajes</label></div>
                    </div>
                    <hr>
                    <?php echo form_input($qrun); ?>
                    <?php echo form_close(); ?>
                    <br>
                    <img id="load-consul" src="<?php echo base_url($own_dir . '/img/loading.gif'); ?>" alt=""/>
                    <div id="ctabla-consul" class="clearfix"></div>
                    <div id="consul-empty">0 resultados.</div>
                </div>
            </section>
        </div>
    </body>
</html>