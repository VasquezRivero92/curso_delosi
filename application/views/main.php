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
            var grup = '<?php echo strtoupper(substr($this->session->grupo, 0, 1)); ?>';
            var entraarecla = <?php echo $entraarecla; ?>;
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
            <!-- - - - - - - - - - - - - -  Instruccion 1  - - - - - - - - - - - - - -->
            <div id="instruccion_1" class="instrucciones">
                <form id="formNewPass" class="clearfix" method="post" action="#">
                    <div id="i1txt1">Todavía no tienes una contraseña personalizada. Ingresa la que usarás a partir de ahora.</div>
                    <?php echo form_input($newPassword); ?>
                    <?php echo form_input($reNewPassword); ?>
                    <?php echo form_input($npSubmit); ?>
                </form>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 2  - - - - - - - - - - - - - -->
            <div id="instruccion_2" class="instrucciones">
                <video id="i2_video" controls preload="auto">
                    <source src="<?php echo base_url($own_dir . '/videos/video1.mp4'); ?>" type="video/mp4"/>
                    <source src="<?php echo base_url($own_dir . '/videos/video1.webm'); ?>" type="video/webm"/>
                </video>
                <div id="i2_btn">Continuar</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 3  - - - - - - - - - - - - - -->
            <div id="instruccion_3" class="instrucciones">
                <div id="i3tit_1"></div>
                <div id="i3txt_1">¡Hola, y Bienvenido a <span>EXPERTOS DE LA PREVENCIÓN!</span></div>
                <div id="i3txt_2">Has sido seleccionado a este programa por tu potencial para prevenir accidentes y el cuidado que tienes en  resguardar la seguridad y salud en el trabajo.
                    <br><br>Queremos que seas nuestro próximo <span>EXPERTO DE LA PREVENCIÓN</span>, y para ello deberás pasar por los cuatro niveles de este programa.
                    <br><br>Al final de cada nivel se te presentarán una serie de <span>DESAFÍOS DE PREVENCIÓN</span> en los que pondrás a prueba lo aprendido en cada nivel del programa.</div>
                <div id="i3btn_1">Continuar</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 4  - - - - - - - - - - - - - -->
            <div id="instruccion_4" class="instrucciones">
                <div id="i4tit_1"></div>
                <div id="i4txt_1">Tu avatar te acompañará durante todo el curso.</div>
                <div id="i4avatar_F" class="i4avatar"></div>
                <div id="i4avatar_M" class="i4avatar"></div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 5  - - - - - - - - - - - - - -->
            <div id="instruccion_5" class="instrucciones">
                <div id="i5txt1">Por medio de la presente, se le informa que el tratamiento de sus datos personales en esta plataforma se realizará para las siguientes finalidades: (i) Llevar un registro de las presentes capacitaciones, cursos, seminarios, entre otros similares; (ii) verificar mis datos personales; y, (iii) verificar el haber completado los cursos y/o capacitaciones. La empresa que se encontrará a cargo de la plataforma web es FACTORIA MEDIA ESTUDIO E.I.R.L, con domicilio en Calle La Carabella 105 Dpto 202 Urb. Ingenieros La Castellana - Santiago de Surco. Podré ejercer los Derechos de Acceso, Rectificación, Cancelación y Oposición respecto de aquellos datos que no sean necesarios para mi relación laboral mediante el envío gratuito de una comunicación escrita al email: datostrabajadores@franquiciasperu.com.</div>
                <div id="i5btn">Aceptar</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 6  - - - - - - - - - - - - - -->
            <div id="instruccion_6" class="instrucciones">
                <div id="tilde"><img src="<?php echo base_url($own_dir . '/images/tilde.png'); ?>"></div>
                <div id="i6tit_1">ELIGE A QUE MODULO QUIERES IR:</div>                
                <?php echo anchor('menu1', '&nbsp;', array('id' => 'i6btn_1', 'class' => 'i6btn')); ?>
                <?php echo anchor('menu2', '&nbsp;', array('id' => 'i6btn_2', 'class' => 'i6btn')); ?>
            </div>
        </div>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
    </body>
</html>