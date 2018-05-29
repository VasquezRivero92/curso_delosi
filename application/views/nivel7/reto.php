<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/animate.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/fonts/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/estGeneral.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/estJuego.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-1.11.0.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.ui.touch-punch.min.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/libs/panicoLoader.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/libs/utils.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
            var odir = '<?php echo base_url($own_dir); ?>';
            var grupo = '<?php echo $this->session->grupo; ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlTiempo.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/juego1.js'); ?>"></script>
    </head>
    <?php $avatar = 'av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar; ?>
    <body class="<?php echo $avatar . ' g-' . $this->session->grupo; ?>">
        <!-- - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">
            <div id="instrucciones_1" class="instrucciones"></div>
            <div id="instrucciones_2" class="instrucciones">
                <div id="btnNext_2" class="btnNext"></div>
            </div>
            <div id="instrucciones_5" class="instrucciones">
                <div id="btnJugar"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Juego  - - - - - - - - - - - - - - - -->
            <div id="gamePreg" class="game">
                <div id="gPreg_1" class="gPreg">
                    <div id="ciPreg_1" class="ciPreg"><div id="imgPreg_1" class="imgPreg"></div></div>
                    <div id="tPreg_1" class="tPreg"><span>¿Cuál de los siguientes temas pertenece al Nivel 1 “Prevención por falta de orden y limpieza”?</span></div>
                    <div id="btnPlay_1" class="btnPlay"></div>
                    <div id="btn_1_1" class="btn"><span>a. Limpieza de superficies de equipos y/o pisos</span></div>
                    <div id="btn_1_2" class="btn"><span>b. Manipulación de cargas</span></div>
                    <div id="btn_1_3" class="btn"><span>c. A y b son correctas</span></div>
                    <div id="btn_1_4" class="btn"><span>d. Ninguna de las anteriores</span></div>
                </div>
                <div id="gPreg_2" class="gPreg">
                    <div id="ciPreg_2" class="ciPreg"><div id="imgPreg_2" class="imgPreg"></div></div>
                    <div id="tPreg_2" class="tPreg"><span>Las vías de evacuación deben estar permanentemente…</span></div>
                    <div id="btnPlay_2" class="btnPlay"></div>
                    <div id="btn_2_1" class="btn"><span>a. Obstruidas</span></div>
                    <div id="btn_2_2" class="btn"><span>b. Con algunas cajas, pero ordenadas</span></div>
                    <div id="btn_2_3" class="btn"><span>c. Libre</span></div>
                    <div id="btn_2_4" class="btn"><span>d. B y C son correctas</span></div>
                </div>
                <div id="gPreg_3" class="gPreg">
                    <div id="ciPreg_3" class="ciPreg"><div id="imgPreg_3" class="imgPreg"></div></div>
                    <div id="tPreg_3" class="tPreg"><span>Las caídas pueden prevenirse, sin embargo suceden por…</span></div>
                    <div id="btnPlay_3" class="btnPlay"></div>
                    <div id="btn_3_1" class="btn"><span>a. Líquidos derramados en el piso</span></div>
                    <div id="btn_3_2" class="btn"><span>b. Por distracción</span></div>
                    <div id="btn_3_3" class="btn"><span>c. A y b son correctas</span></div>
                    <div id="btn_3_4" class="btn"><span>d. Ninguna de las anteriores</span></div>
                </div>
                <div id="gPreg_4" class="gPreg">
                    <div id="ciPreg_4" class="ciPreg"><div id="imgPreg_4" class="imgPreg"></div></div>
                    <div id="tPreg_4" class="tPreg"><span>¿Cuál es el peso máximo de manipulación de carga?</span></div>
                    <div id="btnPlay_4" class="btnPlay"></div>
                    <div id="btn_4_1" class="btn"><span>a. 15 kg mujeres / 25 kg hombres</span></div>
                    <div id="btn_4_2" class="btn"><span>b. 10 kg mujeres / 30 kg hombres</span></div>
                    <div id="btn_4_3" class="btn"><span>c. Depende de la fuerza de la persona</span></div>
                    <div id="btn_4_4" class="btn"><span>d. Ninguna de las anteriores</span></div>
                </div>
                <div id="gPreg_5" class="gPreg">
                    <div id="ciPreg_5" class="ciPreg"><div id="imgPreg_5" class="imgPreg"></div></div>
                    <div id="tPreg_5" class="tPreg"><span>Al sentarte tu espalda debe mantenerse…</span></div>
                    <div id="btnPlay_5" class="btnPlay"></div>
                    <div id="btn_5_1" class="btn"><span>a. Recta</span></div>
                    <div id="btn_5_2" class="btn"><span>b. Como me sienta más cómoda</span></div>
                    <div id="btn_5_3" class="btn"><span>c. No hay una regla general</span></div>
                    <div id="btn_5_4" class="btn"><span>d. Depende de la silla</span></div>
                </div>
                <div id="gPreg_6" class="gPreg">
                    <div id="ciPreg_6" class="ciPreg"><div id="imgPreg_6" class="imgPreg"></div></div>
                    <div id="tPreg_6" class="tPreg"><span>Los accidentes de trabajo suceden porque…</span></div>
                    <div id="btnPlay_6" class="btnPlay"></div>
                    <div id="btn_6_1" class="btn"><span>a. Algunas personas no tienen suerte</span></div>
                    <div id="btn_6_2" class="btn"><span>b. Es parte del trabajo</span></div>
                    <div id="btn_6_3" class="btn"><span>c. Por actos o condiciones inseguras</span></div>
                    <div id="btn_6_4" class="btn"><span>d. Ninguna de las anteriores</span></div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="marcador">
                <div id="CTimer"><div id="CMin">00</div><div>:</div><div id="CSeg">00</div></div>
                <div id="icon_1" class="iconCheck"></div>
                <div id="icon_2" class="iconCheck"></div>
                <div id="icon_3" class="iconCheck"></div>
                <div id="icon_4" class="iconCheck"></div>
                <div id="icon_5" class="iconCheck"></div>
                <div id="icon_6" class="iconCheck"></div>
                <div id="pausaTouch"></div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="pregWindow">
                <div id="pregBien" class="caratula"><div id="btnPBien"></div></div>
                <div id="pregTime" class="caratula"><div id="btnPTime"></div></div>
                <div id="pregMal" class="caratula">
                    <div id="txtPM_1"><span>- la pregunta seleccionada va aquí -</span></div>
                    <div id="txtPM_2"><span>- la explicación va aquí -</span></div>
                    <div id="btnPMal"></div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="capaResumen">
                <div id="caratulaFin1" class="caratula">
                    <div id="resumenAvatar"></div>
                    <div id="resumenPuntaje"></div>
                    <div id="resumenEstrellas"></div>
                    <div id="resumenBtns">
                        <div id="btnReinicio">&nbsp;</div>
                        <?php echo anchor('main', '&nbsp;', array('id' => 'btnContinuar')); ?>
                    </div>
                    <div id="resumenOportunidad"></div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="PauseGame"><div id="btnReanudar"></div></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="objetosOcultos"></div>
        </div>
    </body>
</html>