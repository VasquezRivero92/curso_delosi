<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carga Excel para mails masivos</title>
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/reset.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/base.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/style.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script type="text/javascript">
            var ajax_dir = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url($assets_dir . '/js/registrar.js'); ?>"></script>
    </head>
    <body>
        <div id="fullcont" class="clearfix">
            <section class="container">
                <div class="row">
                    <br>
                    <form id="exc-form" action="" enctype="multipart/form-data">
                        <input id="exc-input" name="excfile" type="file" />
                        <input id="exc-submit" type="submit" value="Subir Archivo" />
                    </form>
                    <br>
                    <input id="cant-mails" name="cant-mails" type="text" placeholder="tamaño de paquete" value="50" />
                    <input id="mail-masivo" type="button" value="Enviar mail masivo" /><br>
                    <span id="load-msg"></span><br><br>
                    <div id="exc-tabla"></div>
                </div>
            </section>
        </div>
    </body>
</html>