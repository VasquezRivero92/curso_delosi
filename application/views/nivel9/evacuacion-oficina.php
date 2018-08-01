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
    <?php
    $avatar = 'av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
    $owlgrupo = 'owl-' . $this->session->grupo;
    ?>
    <body class="player<?php echo $this->session->avatar . ' ' . $owlgrupo; ?>"><!-- la M determinar con php si es mujer o varon  -->
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

                    <!-- <div id="Filavidas1_4" class="vidaJ3 Jvida Filavidas"><div class="sprite"></div></div> -->
                    <div id="Filavidas1_3" class="vidaJ3 Jvida Filavidas"><div class="sprite"></div></div>
                    <div id="Filavidas1_2" class="vidaJ3 Jvida Filavidas"><div class="sprite"></div></div>
                    <div id="Filavidas1_1" class="vidaJ3 Jvida Filavidas"><div class="sprite"></div></div>
                    <div id="Player_1" class="player Filavidas">
                        <div class="sprite"></div><div class="ptje"></div><div class="ptje20s"></div>
                    </div>
                    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
                    <div id="fondoOPC3" class="fondoOPC">
                        <div id="mochila" class="powerUp powerUp3" data-time=20 data-nombre="mochila" style="left:831px; top:150px;"></div>
                        <div id="linterna" class="powerUp powerUp3" data-time=20 data-nombre="linterna" style="left:1814px; top:178px;"></div>

                        <div id="puerta" class="powerUp powerUp3" data-time=20 data-id="puerta" data-nombre="puerta_fin" style="left:290px; top:80px;"></div>
                        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
                        <div class="powerUp powerUp1 aJose persona_mov1" data-nombre="Jose" style="left:662px; top:742px;"></div>
                        <div class="powerUp powerUp1 aRoberto persona_mov1" data-nombre="Roberto" style="left:1190px; top:65px;"></div>
                        <div class="powerUp powerUp1 aCristina persona_mov1" data-nombre="Cristina" style="left:1484px; top:709px;"></div>

                        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
                        <!-- <div class="enemigo enemigoA" data-movx=-400 data-dur-anim=8000 data-delay=500 style="left:1650px; top:730px;"></div>
                        <div class="enemigo enemigoA" data-movx=-350 data-dur-anim=5000 data-delay=1000 style="left:700px; top:250px;"></div> -->
                        
                    </div>
                    <div class="enemigo enemigoA" style="left:0px; top:0px;"></div>
                    <div class="enemigo enemigoB" style="left:0px; top:0px;"></div>
                    <div class="enemigo enemigoC" style="left:0px; top:0px;"></div>

                </div>
            </div>
            <!--  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="icon_Cristina" class="iconPersonaje"></div>
            <div id="icon_Jose" class="iconPersonaje"></div>
            <div id="icon_mochila" class="iconPersonaje"></div>
            <div id="icon_linterna" class="iconPersonaje"></div>
            <div id="icon_Roberto" class="iconPersonaje"></div>

            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="celeb1_Cristina" class="celebracion"></div>
            <div id="celeb1_Paulo" class="celebracion"></div>
            <div id="celeb1_Roberto" class="celebracion"></div>
            <div id="celeb1_Jose" class="celebracion"></div>
            <div id="celeb1_puerta_fin" class="celebracion"></div>
            <div id="celeb1_mochila" class="celebracion"></div>
            <div id="celeb1_linterna" class="celebracion"></div>
            <div id="celeb1_falta_items" class="celebracion"></div>

            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
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
            <div id="capaResumen">
                <div id="caratulaFin1" class="caratula">
                    <div id="resumenAvatar"></div>
                    <div id="resumenPuntaje"></div>
                    <!-- <div id="resumenEstrellas"></div> -->
                    <div id="resumenBtns">
                        <div id="btnReinicio">&nbsp;</div>
                        <?php echo anchor('mapa', '&nbsp;', array('id' => 'btnContinuar')); ?><!-- <a id="btnContinuar" href="#"></a> -->
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
            <div id="TerminoTiempo"><div id="btnReiniciar"></div></div>
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