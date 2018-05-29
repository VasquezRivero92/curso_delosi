<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión de usuarios - <?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
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
        <script src="<?php echo base_url($own_dir . '/js/reporte_certif.js'); ?>"></script>
    </head>
    <body>
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="reporte-cont" class="container">
                <div class="row">
                    <br>
                    <h2>Reporte de certificados</h2>
                    <br>
                    <?php echo form_open('', $form_rc); ?>
                    <div><?php echo form_radio($rc_download); ?><label for="rc-download">Descargar</label></div>
                    <div><?php echo form_radio($rc_mail); ?><label for="rc-mail">Enviar por mail (aprendiendoaprevenir.sst@gmail.com)</label></div>
                    <br>
                    <?php echo form_input($rc_submit); ?>
                    <br><br>
                    <img id="rc-load" src="<?php echo base_url($own_dir . '/img/loading.gif'); ?>" alt=""/>
                    <br>
                    <div id="rc-mensaje"></div>
                    <?php echo form_close(); ?>
                </div>
            </section>
        </div>
    </body>
</html>