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
            var grup = '<?php echo strtoupper(substr($this->session->grupo, 0, 1)); ?>';
        </script>

        <script src="<?php echo base_url($own_dir . '/js/clases.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>        
        
        <script src="<?php echo base_url($own_dir . '/js/controlMovimiento.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlObjetos1.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlPuntos1.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/juego1.js'); ?>"></script>
    </head>
    <body class="playerF">
        <!-- - - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">

            <div id="instrucciones_1" class="instrucciones"></div>
            <div id="instrucciones_2" class="instrucciones">
                <div id="bg_2"></div>
                <div id="welcome_2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, vitae.</div>
                <div id="alcalde_2"></div>
                <div id="btn_cont"></div>
            </div>

            <div id="instrucciones_3" class="instrucciones">
                <div class="mapa_anim"></div>
                <div class="fug_artif fuegosArtif"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Mapa  - - - - - - - - - - - - - - - -->
            <div id="escenaJuego1" class="game">
                <div class="gameFrame">
                    <div id="gameArea1"></div>
                    <div id="Player_1">
                        <div class="sprite"></div><div class="ptje"></div>
                    </div>
                    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
                    <div id="icoPel_1" class="icoPel"></div>
                    <div id="icoPel_2" class="icoPel"></div>
                    <div id="icoPel_3" class="icoPel"></div>
                    <div id="icoPel_4" class="icoPel"></div>
                    <div id="icoPel_5" class="icoPel"></div>
                    <div id="icoPel_6" class="icoPel"></div>
                    <div id="icoPel_7" class="icoPel"></div>
                    <div id="icoPel_8" class="icoPel"></div>
                    <div id="icoPel_9" class="icoPel"></div>
                    <div id="icoPel_10" class="icoPel"></div>
                    <div id="icoPel_11" class="icoPel"></div>
                    <div id="icoPel_12" class="icoPel"></div>
                    <div id="icoPel_13" class="icoPel"></div>

                    <div id="icoPrev_1" class="icoPrev"></div>
                    <div id="icoPrev_2" class="icoPrev"></div>
                    <div id="icoPrev_3" class="icoPrev"></div>
                    <div id="icoPrev_4" class="icoPrev"></div>
                    <div id="icoPrev_5" class="icoPrev"></div>
                    <div id="icoPrev_6" class="icoPrev"></div>
                    <div id="icoPrev_7" class="icoPrev"></div>
                    <div id="icoPrev_8" class="icoPrev"></div>
                    <div id="icoPrev_9" class="icoPrev"></div>
                    <div id="icoPrev_10" class="icoPrev"></div>
                    <div id="icoPrev_11" class="icoPrev"></div>

                    <div id="fondoOPC1" class="fondoOPC">
                        <div id="powerUp_1" class="powerUp powerUp1">1</div>
                        <div id="powerUp_2" class="powerUp powerUp1">2</div>
                        <div id="powerUp_3" class="powerUp powerUp1">3</div>
                        <div id="powerUp_4" class="powerUp powerUp1">4</div>
                        <div id="powerUp_5" class="powerUp powerUp1">5</div>
                        <div id="powerUp_6" class="powerUp powerUp1">6</div>
                        <div id="powerUp_7" class="powerUp powerUp1">7</div>
                        <div id="powerUp_8" class="powerUp powerUp1">8</div>
                        <div id="powerUp_9" class="powerUp powerUp1">9</div>
                        <div id="powerUp_10" class="powerUp powerUp1">10</div>
                        <div id="powerUp_11" class="powerUp powerUp1">11</div>
                        <div id="powerUp_12" class="powerUp powerUp1">12</div>
                        <div id="powerUp_13" class="powerUp powerUp1">13</div>
                    </div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="marcador" class="gameEnv">
                <div id="CTimer"><div id="CMin">00</div><div>:</div><div id="CSeg">00</div></div>
            </div>
            <!-- <div id="icon_1" class="iconCheck"></div>
            <div id="icon_2" class="iconCheck"></div>
            <div id="icon_3" class="iconCheck"></div>
            <div id="icon_4" class="iconCheck"></div>
            <div id="icon_5" class="iconCheck"></div>
            <div id="icon_6" class="iconCheck"></div>
            <div id="icon_7" class="iconCheck"></div>
            <div id="icon_8" class="iconCheck"></div>
            <div id="icon_9" class="iconCheck"></div>
            <div id="icon_10" class="iconCheck"></div>
            <div id="icon_11" class="iconCheck"></div> -->
            <div id="pausaTouch" class="gameEnv"></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="pregWindow">
                <div id="pregMain" class="caratula">
                    <div id="pregTXT">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum quod iste voluptatibus perferendis doloremque, eaque, alias similique adipisci eveniet reiciendis.</div>
                    <div id="preg_1" class="pregOpc"><span>SI</span></div>
                    <div id="preg_2" class="pregOpc"><span>NO</span></div>
                </div>
                <div id="popAct_1" class="caratula">
                    <div id="preg_1_1" class="pregOpc">SI</div>
                    <div id="preg_1_0" class="pregOpc">NO</div>
                </div>
                <div id="popAct_2" class="caratula">
                    <div id="preg_2_1" class="pregOpc">SI</div>
                    <div id="preg_2_0" class="pregOpc">NO</div>
                </div>
                <div id="popAct_3" class="caratula">
                    <div id="preg_3_1" class="pregOpc">SI</div>
                    <div id="preg_3_0" class="pregOpc">NO</div>
                </div>
                <div id="popAct_7" class="caratula">
                    <div id="preg_7_1" class="pregOpc">SI</div>
                    <div id="preg_7_0" class="pregOpc">NO</div>
                </div>
                <div id="popAct_8" class="caratula">
                    <div id="preg_8_1" class="pregOpc">SI</div>
                    <div id="preg_8_0" class="pregOpc">NO</div>
                </div>
                <div id="popAct_9" class="caratula">
                    <div id="preg_9_1" class="pregOpc">SI</div>
                    <div id="preg_9_0" class="pregOpc">NO</div>
                </div>
                <div id="popAct_10" class="caratula">
                    <div id="preg_10_1" class="pregOpc">SI</div>
                    <div id="preg_10_0" class="pregOpc">NO</div>
                </div>
                <div id="popAct_11" class="caratula">
                    <div id="preg_11_1" class="pregOpc">SI</div>
                    <div id="preg_11_0" class="pregOpc">NO</div>
                </div>
                <div id="popAct_12" class="caratula">
                    <div id="preg_12_1" class="pregOpc">SI</div>
                    <div id="preg_12_0" class="pregOpc">NO</div>
                </div>

                <div id="popAct_0" class="caratula"><div id="preg_0" class="pregOpc">ACEPTAR</div></div>

                <!-- <div id="pregBien" class="caratula">
                    <div id="bienResp"></div>
                    <div id="bienFlechas"></div>
                    <div id="btnListo"></div>
                </div>
                <div id="pregMal" class="caratula"><div id="btnReintento"></div></div> -->
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <!-- <div id="capaResumen">
                <div id="caratulaFin1" class="caratula">
                    <div id="resumenAvatar"></div>
                    <div id="resumenPuntaje"></div>
                    <div id="resumenEstrellas"></div>
                    <div id="resumenBtns">
                        <div id="btnReinicio">&nbsp;</div>
                        <?php echo anchor('nivel1/resultados', '&nbsp;', array('id' => 'btnContinuar')); ?>
                        <a id="btnContinuar" href="#"></a>
                    </div>
                    <div id="resumenOportunidad"></div>
                </div>
            </div> -->
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="infoWindow">
                <div id="conteo3" class="conteo"></div>
                <div id="conteo2" class="conteo"></div>
                <div id="conteo1" class="conteo"></div>
            </div>
            <div id="PauseGame"><div id="btnReanudar"></div></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="objetosOcultos">                
                <img id="fondoStage_1" src="<?php echo base_url($own_dir . '/images/mapa/city.png'); ?>" alt=""/>
                <img id="canvasWall_1" src="<?php echo base_url($own_dir . '/images/mapa/wall.png'); ?>" alt=""/>
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