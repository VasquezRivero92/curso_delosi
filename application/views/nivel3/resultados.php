<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/animate.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/fonts/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/style.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-1.11.0.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.ui.touch-punch.min.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/libs/panicoLoader.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
            var odir = '<?php echo base_url($own_dir); ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
    </head>
    <?php
    $avatar = 'av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
    $owlgrupo = 'owl-' . $this->session->grupo;
    $apenombres = $user_login['apat'] . ' ' . $user_login['amat'] . ', ' . $user_login['nombre'];
    ?>
    <body class="<?php echo $avatar . ' ' . $owlgrupo; ?>">
        <!-- - - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">
            <!-- - - - - - - - - - - - - -  Instruccion 4 (video)  - - - - - - - - - - - - - -->
            <div id="instruccion_4" class="instrucciones">
                <div id="i4tit_1">¡Recuerda &nbsp;siempre &nbsp;manipular &nbsp;equipos &nbsp;o &nbsp;herramientas &nbsp;solo &nbsp;si &nbsp;has &nbsp;sido &nbsp;capacitado, &nbsp;tu &nbsp;familia &nbsp;te &nbsp;espera &nbsp;en &nbsp;casa!</div>
                <div id="i4txt_1">¿Sabías qué? El 95% de accidentes son ocasionados 
                    <br>por actos inseguros...
                    <br><br>Es importante que si identificamos un acto inseguro 
                    <br>podamos intervenir y corregir en el momento de manera 
                    <br>amable, solo así evitaremos que ocurra un accidente.
                    <br><br>Con tu apoyo podremos Generar una Cultura Preventiva.</div>
                <div id="i4txt_2">¡Contamos Contigo!</div>
                <div id="i4btn_1">Volver a status</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 5 (constancia)  - - - - - - - - - - - - - -->
            <div id="instruccion_5" class="instrucciones">
                <div id="i5tit_1">CONSTANCIA NIVEL 3</div>
                <div id="i5txt_1">Yo, <span><?php echo strtoupper($apenombres); ?></span>, declaro haber completado el curso de Prevención con instrumentos de trabajo de manera satisfactoria y, asimismo, de haber realizado la prueba sobre el curso de Prevención con instrumentos de trabajo (reto).</div>
                <div id="i5btn_1">Aceptar</div>
            </div>
            <div id="instruccion_6" class="instrucciones"></div>
        </div>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
    </body>
</html>