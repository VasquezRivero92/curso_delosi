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
                <div id="i4tit_1">¡Lo &nbsp;lograste! &nbsp;Eres &nbsp;un &nbsp;Experto &nbsp;de &nbsp;la &nbsp;Prevencion, 
                    <br>gracias &nbsp;por &nbsp;tu &nbsp;esfuerzo 
                    <br>en &nbsp;cada &nbsp;nivel &nbsp;y &nbsp;ganas 
                    <br>de &nbsp;aprender &nbsp;a &nbsp;Prevenir.</div>
                <div id="i4txt_1">Ahora que has pasado por los 4 niveles y tienes 
                    <br>mayor conocimiento sobre los temas de Prevención, 
                    <br>necesitamos de tu apoyo para que pongas  
                    <br>en práctica todo lo aprendido y así crear 
                    <br>Ambientes Seguros en tu lugar de trabajo</div>
                <div id="i4txt_2">¡Contamos Contigo!</div>
                <?php echo anchor('mapa', 'Volver a la ciudad', array('id' => 'i4btn_1')); ?>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 5 (constancia)  - - - - - - - - - - - - - -->
            <div id="instruccion_5" class="instrucciones">
                <div id="i5tit_1">CONSTANCIA NIVEL 4</div>
                <div id="i5txt_1">Yo, <span><?php echo strtoupper($apenombres); ?></span>, declaro haber completado el curso de Prevención al manipular cargas y actividades de posición de pie o sentado de manera satisfactoria y, asimismo, de haber realizado la prueba sobre el curso de Prevención al manipular cargas y actividades de posición de pie o sentado (reto).
                <br>
                    <p style="text-align: center; font-size: 18px; color: red;" >Al final los 4 cursos podrás descargar<br>tu certificado.</p>
            </div>
                <div id="i5btn_1">Aceptar</div>
                <?php echo anchor('nivel4/constancia', 'Descargar contancia', array('id' => 'i5btn_2')); ?>

                <?php
                    echo anchor('nivel4/certificado_prevencion', '&nbsp;', 
                    array('id' => 'i4Certificado', 'class' => $certificado_prevencion, 'target' => '_blank', 'style' => 'left: 580px; top: 503px;'));
                ?>    

            </div>
        </div>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
    </body>
</html>