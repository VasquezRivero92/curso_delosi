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
        </script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/clases.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlMovimiento.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlObjetos1.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlPuntos1.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/juego1.js'); ?>"></script>
    </head>
    <body class="player<?php echo $this->session->avatar; ?>">
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
            <!-- - - - - - - - - - - - - - - -  Juego  - - - - - - - - - - - - - - - -->
            <div id="escenaJuego1" class="game">
                <div class="gameFrame">
                    <div id="gameArea1"></div>
                    <div id="Player_1">
                        <div class="sprite"></div><div class="ptje"></div>
                    </div>
                    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
                    <div id="fondoOPC1" class="fondoOPC">
                        <div id="spPel_1" class="spPel spriteP"></div>
                        <div id="spPel_2" class="spPel spriteP"></div>
                        <div id="spPel_3" class="spPel spriteP"></div>
                        <div id="spPel_4" class="spPel spriteP"></div>
                        <div id="spPel_5" class="spPel spriteP"></div>
                        <div id="spPel_6" class="spPel spriteP"></div>
                        <div id="spPel_7" class="spPel spriteP"></div>
                        <div id="spPel_8" class="spPel spriteP"></div>
                        <div id="spPel_9" class="spPel spriteP"></div>
                        <div id="spPrev_1" class="spPrev spriteP"></div>
                        <div id="spPrev_2" class="spPrev spriteP"></div>
                        <div id="spPrev_3" class="spPrev spriteP"></div>
                        <div id="spPrev_4" class="spPrev spriteP"></div>
                        <div id="spPrev_5" class="spPrev spriteP"></div>
                        <div id="icoPel_4" class="icoPel"></div>
                        <div id="icoPel_5" class="icoPel"></div>
                        <div id="powerUp_1" class="powerUp powerUp1">1</div>
                        <div id="powerUp_2" class="powerUp powerUp1">2</div>
                        <div id="powerUp_3" class="powerUp powerUp1">3</div>
                        <div id="powerUp_4" class="powerUp powerUp1">4</div>
                        <div id="powerUp_5" class="powerUp powerUp1">5</div>
                        <div id="powerUp_6" class="powerUp powerUp1">6</div>
                        <div id="powerUp_7" class="powerUp powerUp1">7</div>
                        <div id="powerUp_8" class="powerUp powerUp1">8</div>
                        <div id="powerUp_9" class="powerUp powerUp1">9</div>
                    </div>
                </div>
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
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="pregWindow">
                <div id="pregMain" class="caratula">
                    <div id="pregTXT"></div>
                    <div id="pregVista_1" class="pregVista"></div>
                    <div id="pregVista_2" class="pregVista"></div>
                    <div id="pregVista_3" class="pregVista"></div>
                    <div id="pregVista_4" class="pregVista"></div>
                    <div id="pregVista_5" class="pregVista"></div>
                    <div id="pregVista_6" class="pregVista"></div>
                    <div id="pregVista_7" class="pregVista"></div>
                    <div id="pregVista_8" class="pregVista"></div>
                    <div id="pregVista_9" class="pregVista"></div>
                    <div id="preg_1" class="pregOpc"><span>Si, caídas por apresuramiento</span></div>
                    <div id="preg_2" class="pregOpc"><span>Si, caídas a desnivel <br>por apoyo indebido</span></div>
                    <div id="preg_3" class="pregOpc"><span>Si, caídas por objetos en el piso</span></div>
                    <div id="preg_4" class="pregOpc"><span>Si, caídas por <br>líquidos derramados</span></div>
                    <div id="preg_5" class="pregOpc"><span>No hay peligros en esta escena</span></div>
                </div>
                <div id="pregBien" class="caratula">
                    <div id="bienSlide_1" class="bienSlider"><div class="bSlideB"></div></div>
                    <div id="bienSlide_2" class="bienSlider"><div class="bSlideB"></div></div>
                    <div id="bienSlide_3" class="bienSlider"><div class="bSlideB"></div></div>
                    <div id="bienSlide_4" class="bienSlider"><div class="bSlideB"></div></div>
                    <div id="bienSlide_5" class="bienSlider"><div class="bSlideB"></div></div>
                    <div id="btnListo"></div>
                </div>
                <div id="pregMal" class="caratula"><div id="btnReintento"></div></div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="capaResumen">
                <div id="caratulaFin1" class="caratula">
                    <div id="resumenAvatar"></div>
                    <div id="resumenPuntaje"></div>
                    <div id="resumenEstrellas"></div>
                    <div id="resumenBtns">
                        <div id="btnReinicio">&nbsp;</div>
                        <?php echo anchor('nivel2/resultados', '&nbsp;', array('id' => 'btnContinuar')); ?><!--<a id="btnContinuar" href="#"></a>-->
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
            <div id="infoWindow">
                <div id="conteo3" class="conteo"></div>
                <div id="conteo2" class="conteo"></div>
                <div id="conteo1" class="conteo"></div>
            </div>
            <div id="PauseGame"><div id="btnReanudar"></div></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="objetosOcultos">
                <img id="fondoStage_1" src="<?php echo base_url($own_dir . '/images/fondo1.jpg'); ?>" alt=""/>
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