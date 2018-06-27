<!doctype html>
<html><head>
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
        <script src="<?php echo base_url($own_dir . '/js/libs/webkitAudioContextMonkeyPatch.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
            var odir = '<?php echo base_url($own_dir); ?>';
            var grupo = '<?php echo $this->session->grupo; ?>'
        </script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/clases.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlMovimiento.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlObjetos1.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlPuntos1.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/juego1.js'); ?>"></script>
    </head>    
    <?php $avatar = 'av' . $this->session->avatar;?>
    <body class="playerM <?php echo $avatar . ' g-' . $this->session->grupo; ?>" ><!-- la M determinar con php si es mujer o varon  -->
       <!-- - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">
            <div id="instrucciones_1" class="instrucciones"></div>
            <div id="instrucciones_2" class="instrucciones">
                <div id="btnNext_2" class="btnNext"></div>
            </div>
            <div id="instrucciones_3" class="instrucciones">
                <div id="btnPrev_3" class="btnPrev"></div>
                <div id="btnNext_3" class="btnNext"></div>
            </div>
            <div id="instrucciones_4" class="instrucciones">
                <div id="btnPrev_4" class="btnPrev"></div>
                <div id="btnNext_4" class="btnNext"></div>
            </div>
            <div id="instrucciones_5" class="instrucciones">
                <div id="btnPrev_5" class="btnPrev"></div>
                <div id="btnJugar"></div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="marcador" class="gameEnv">
                <div id="CTimer"><div id="CMin">00</div><div>:</div><div id="CSeg">00</div></div>
            </div>
            <div id="icon_1" class="iconCheck"></div>
            <div id="icon_2" class="iconCheck"></div>
            <div id="icon_3" class="iconCheck"></div>
            <div id="icon_4" class="iconCheck"></div>
            <div id="icon_5" class="iconCheck"></div>

            <div id="pausaTouch" class="gameEnv"></div>
            <!-- - - - - - - - - - - - - - - -  Juego  - - - - - - - - - - - - - - - -->
            <div id="escenaJuego1" class="game">
                <div class="gameFrame">
                    <div id="gameArea1" class="gameArea"></div>
                    <div id="Player_1">
                        <div id="warning_MC"></div>
                        <div class="sprite"></div><div class="ptje"><span>...</span></div>
                    </div>
                    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

                    <div class="enemigo enemigoD" style="top: 220px; z-index: 25;">
                        <div id="enemy_1" class="carsEnem"></div>
                    </div>
                    <div class="enemigo enemigoD" style="top: 390px; z-index: 38;">
                        <div id="enemy_2" class="carsEnem"></div>
                    </div>
                    <div class="enemigo enemigoD" style="top: 542px; z-index: 60;">
                        <div id="enemy_3" class="carsEnem"></div>
                    </div>
                    <div class="enemigo enemigoD" style="top: 230px; z-index: 25;">
                        <div id="enemy_4" class="carsEnem"></div>
                    </div>
                    <div class="enemigo enemigoD" style="top: 380px; z-index: 38;">
                        <div id="enemy_5" class="carsEnem"></div>
                    </div>
                    <div class="enemigo enemigoD" style="top: 552px; z-index: 60;">
                        <div id="enemy_6" class="carsEnem"></div>
                    </div>
                    <div class="enemigo enemigoD" style="top: 220px; z-index: 25;">
                        <div id="enemy_7" class="carsEnem"></div>
                    </div>

                    <div class="enemigo enemigoD acera_mc"></div>
                    <div class="enemigo enemigoD acera_mc1"></div>

                    <div id="fondoOPC1" class="fondoOPC"></div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="pregWindow">
                <div id="pregMain" class="caratula">
                    <div id="pregTXT"><span>xxx</span></div>
                    <div id="image_ref_1" class="img_ask"></div>
                    <div id="preg_1" class="pregOpc"><span>Objetos Sobresalientes1</span></div>
                    <div id="preg_2" class="pregOpc"><span>Objetos Sobresalientes2</span></div>
                    <div id="preg_3" class="pregOpc"><span>Objetos Sobresalientes3</span></div>
                </div>
                <div id="pregBien" class="caratula">
                    <div id="bienResp"></div>
                    <div id="bienFlechas"></div>
                    <div id="btnListo"></div>
                </div>
                <div id="pregMal" class="caratula">
                    <div id="bad_A1"><span>xxxxxx</span></div>
                    <div id="bad_A2"><span>cccccc</span></div>
                    <div id="btnReintento"></div>
                </div>
            </div>
            <div id="reset_time" class="caratula">
                <div id="btnReset"></div>
            </div>

            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="capaResumen">
                <div id="caratulaFin1" class="caratula">
                    <div id="resumenAvatar"></div>
                    <div id="resumenMensaje"></div>
                    <div id="resumenPuntaje"></div>
                    <div id="resumenEstrellas"></div>
                    <div id="resumenBtns">
                        <div id="btnReinicio">&nbsp;</div>
                        <?php echo anchor('drivers', '&nbsp;', array('id' => 'btnContinuar')); ?>
                    </div>
                    <div id="resumenOportunidad"></div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="infoWindow">
                <div id="conteo3" class="conteo"></div>
                <div id="conteo2" class="conteo"></div>
                <div id="conteo1" class="conteo"></div>
            </div>
            <div id="PauseGame"><div id="btnReanudar"></div></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="objetosOcultos">
                <img id="fondoStage_1" src="<?php echo base_url($own_dir . '/images/fondo1.png'); ?>" alt=""/>
                <img id="canvasWall_1" src="<?php echo base_url($own_dir . '/images/fondoC1.png'); ?>" alt=""/>
            </div>
        </div>
        <!-- - - - - - - - - - - - - - - -  Controles  - - - - - - - - - - - - - - - -->
        <div id="contKeyControls" class="touchElement">
            <div id="circleExt">
                <div id="DBtn_0" class="dirBtn"></div>
                <div id="DBtn_1" class="dirBtn"></div>
                <div id="DBtn_2" class="dirBtn"></div>
                <div id="DBtn_3" class="dirBtn"></div>
            </div>
        </div>
    </body>
</html>