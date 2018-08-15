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
                    <div id="tPreg_1" class="tPreg"><span>Si necesito levantar una caja ¿Qué debo tener en cuenta?</span></div>
                    <div id="btnPlay_1" class="btnPlay"></div>
                    <div id="btn_1_1" class="btn"><span>a. Verificar que el peso permitido sea el correcto (15kg en mujeres y 25kg en hombres)</span></div>
                    <div id="btn_1_2" class="btn"><span>b. Verificar que el peso permitido sea el correcto (10kg en mujeres y 25kg en hombres)</span></div>
                    <div id="btn_1_3" class="btn"><span>c. Siempre se deben de flexionar las piernas y mantener la espalda recta</span></div>
                    <div id="btn_1_4" class="btn"><span>d. A y C son correctas</span></div>
                </div>
                <div id="gPreg_2" class="gPreg">
                    <div id="ciPreg_2" class="ciPreg"><div id="imgPreg_2" class="imgPreg"></div></div>
                    <div id="tPreg_2" class="tPreg"><span>¿Cuál es el peso máximo para trasladar una carga?</span></div>
                    <div id="btnPlay_2" class="btnPlay"></div>
                    <div id="btn_2_1" class="btn"><span>a. Mujeres: 15kg / Hombres: 25kg</span></div>
                    <div id="btn_2_2" class="btn"><span>b. No existe un peso máximo para trasladar una carga</span></div>
                    <div id="btn_2_3" class="btn"><span>c. Mujeres: 30kg / Hombres: 50kg</span></div>
                    <div id="btn_2_4" class="btn"><span>d. Hombres y mujeres: 25kg</span></div>
                </div>
                <div id="gPreg_3" class="gPreg">
                    <div id="ciPreg_3" class="ciPreg"><div id="imgPreg_3" class="imgPreg"></div></div>
                    <div id="tPreg_3" class="tPreg"><span>¿Cada cuánto tiempo de trabajo continuo debo hacer una pausa?</span></div>
                    <div id="btnPlay_3" class="btnPlay"></div>
                    <div id="btn_3_1" class="btn"><span>a. No hay tiempo para hacer pausas</span></div>
                    <div id="btn_3_2" class="btn"><span>b. Cada vez que me sienta cansado(a)</span></div>
                    <div id="btn_3_3" class="btn"><span>c. Cada 2 horas</span></div>
                    <div id="btn_3_4" class="btn"><span>d. Cada 3 horas</span></div>
                </div>
                <div id="gPreg_4" class="gPreg">
                    <div id="ciPreg_4" class="ciPreg"><div id="imgPreg_4" class="imgPreg"></div></div>
                    <div id="tPreg_4" class="tPreg"><span>¿Si trabajo mucho tiempo de pie que debo hacer?</span></div>
                    <div id="btnPlay_4" class="btnPlay"></div>
                    <div id="btn_4_1" class="btn"><span>a. Hacer una pausa cada 5 minutos</span></div>
                    <div id="btn_4_2" class="btn"><span>b. Alternar el peso en ambos miembros inferiores</span></div>
                    <div id="btn_4_3" class="btn"><span>c. A y B son correctas</span></div>
                    <div id="btn_4_4" class="btn"><span>d. Ninguna de las anteriores</span></div>
                </div>
                <div id="gPreg_5" class="gPreg">
                    <div id="ciPreg_5" class="ciPreg"><div id="imgPreg_5" class="imgPreg"></div></div>
                    <div id="tPreg_5" class="tPreg"><span>La extensión de los brazos, máximo, debe de quedar en un ángulo de ___&deg; respecto a los hombros</span></div>
                    <div id="btnPlay_5" class="btnPlay"></div>
                    <div id="btn_5_1" class="btn"><span>a. 0&deg;</span></div>
                    <div id="btn_5_2" class="btn"><span>b. 180&deg;</span></div>
                    <div id="btn_5_3" class="btn"><span>c. 90&deg;</span></div>
                    <div id="btn_5_4" class="btn"><span>d. Ninguna de las anteriores</span></div>
                </div>
                <div id="gPreg_6" class="gPreg">
                    <div id="ciPreg_6" class="ciPreg"><div id="imgPreg_6" class="imgPreg"></div></div>
                    <div id="tPreg_6" class="tPreg"><span>¿Cuál es la postura correcta al sentarnos?</span></div>
                    <div id="btnPlay_6" class="btnPlay"></div>
                    <div id="btn_6_1" class="btn"><span>a. Espalda recta</span></div>
                    <div id="btn_6_2" class="btn"><span>b. Como me sienta más cómodo</span></div>
                    <div id="btn_6_3" class="btn"><span>c. A Y B</span></div>
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
                        <?php echo anchor('nivel4/resultados', '&nbsp;', array('id' => 'btnContinuar')); ?>
                    </div>
                    <div id="resumenOportunidad"></div>
                    <!--  -->
                    <div id="calificacion" class="formulario">
                        <div id="inst_1" class="instr">
                            <div class="instA1"></div>
                            <div id="nextInt_1" class="btnNX"></div>
                        </div>
                        <div id="inst_2" class="instr">
                            <div class="sintruct_ask">Tras terminar este curso, siento que he aprendido algo nuevo respecto al tema desarrollado</div>
                            <div id="calfA_1" class="A_1 btn_ar btn_CAL_A"></div>
                            <div id="calfA_2" class="A_2 btn_ar btn_CAL_A"></div>
                            <div id="calfA_3" class="A_3 btn_ar btn_CAL_A"></div>
                            <div id="calfA_4" class="A_4 btn_ar btn_CAL_A"></div>
                            <div id="calfA_5" class="A_5 btn_ar btn_CAL_A"></div>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="PauseGame"><div id="btnReanudar"></div></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="objetosOcultos"></div>
        </div>
    </body>
</html>