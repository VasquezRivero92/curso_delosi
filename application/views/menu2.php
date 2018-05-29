<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/animate.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/fonts/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/estGeneral.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-1.11.0.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.ui.touch-punch.min.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/libs/panicoLoader.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/owl.carousel.min.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
            var odir = '<?php echo base_url($own_dir); ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
    </head>
    <body class="<?php echo $avatar; ?>" data-firstwindow="<?php echo $firstWindow; ?>">
        <!-- - - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">
            <!-- - - - - - - - - - - - - -  Instruccion 3  - - - - - - - - - - - - - -->
            <div id="instruccion_3" class="instrucciones">
                <div id="i3bg"></div>
                <div id="i3tit_1" class="i3p1"></div>
                <div id="i3img_1" class="i3p1"></div>
                <div id="i3avatar" class="i3p1"></div>
                <div id="i3nombre" class="i3p1"><?php echo strtoupper($user_login['nombre'] . ' ' . $user_login['apat'] . ' ' . $user_login['amat']); ?></div>
                <div id="i3img_2" class="i3p1"></div>
                <div id="i3img_3" class="i3p1"></div>
                <div id="i3img_4" class="i3p2"></div>
                <div id="i3pop_1">
                    <div id="i3txt_1">Esta es tu <span>LÍNEA DE APRENDIZAJE A  EXPERTO DE LA  PREVENCIÓN</span><br>Con el objetivo de desarrollarte en los tema de Seguridad y Salud en el Trabajo y contribuyas a la generación de una Cultura Preventiva, se ha diseñado un programa hecho a tu medida.</div>
                    <div id="i3btn_1">Siguiente</div>
                </div>
                <div id="i3pop_2">
                    <div id="i3txt_2">Para convertirte en un <span>Experto de la prevención</span> deberás terminar todos los niveles del curso.</div>
                    <div id="i3txt_3">¡Contamos contigo!</div>
                    <div id="i3btn_2">Siguiente</div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 4  - - - - - - - - - - - - - -->
            <div id="instruccion_4" class="instrucciones">
                <div id="i4avatar"></div>
                <div id="i4Puntaje" class="i4txt"><?php echo $user_stats['puntaje']; ?></div>
                <div id="i4Estrellas" class="i4txt"><?php echo $user_stats['estrellas']; ?></div>
                <div id="i4Nombre"><?php echo strtoupper($user_login['nombre'] . ' ' . $user_login['apat'] . ' ' . $user_login['amat']); ?></div>
                <?php echo anchor('login/logout', 'Cerrar Sesión', array('id' => 'i4Logout')); ?>
                <div id="i4Buzon"></div>
                <?php echo anchor('menu2/certificado', '&nbsp;', array('id' => 'i4Certificado', 'class' => $certificado, 'target' => '_blank')); ?>
                <?php echo anchor('libroreclamaciones_2', '&nbsp;', array('id' => 'i4_anc', 'class' => 'i4Nivel')); ?>
            </div>
        </div>
        <div id="popup2" class="popup">
            <form id="formBuzon" class="clearfix" method="post" action="#">
                <div id="pop2txt1">Sabemos que es importante para ti, tener todos los conceptos claros de ambos niveles. Por ello, si tienes una duda o consulta detállala en el siguiente recuadro.</div>
                <textarea id="pop2ta" maxlength="400"></textarea>
                <div id="pop2txt2">Te responderemos lo más pronto posible.</div>
                <input id="pop2sub" class="clearfix" type="submit" value="ENVIAR">
                <div id="pop2close"></div>
            </form>
        </div>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
    </body>
</html>