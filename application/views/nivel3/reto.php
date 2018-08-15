<!doctype html>
<html>
    <head>
        <meta http-equiv="Cache-Control" content="max-age=10800, must-revalidate" />
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
        <script src="<?php echo base_url($own_dir . '/js/jquery.jSlots.js'); ?>"></script>
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
            <div id="tragamonedas" class="game">
                <ul class="slot">
                    <li data-id="1"></li>
                    <li data-id="2"></li>
                    <li data-id="3"></li>
                    <li data-id="4"></li>
                </ul>
                <div id="btnUp_1" class="btn btnUp"></div><div id="btnDown_1" class="btn btnDown"></div>
                <div id="btnUp_2" class="btn btnUp"></div><div id="btnDown_2" class="btn btnDown"></div>
                <div id="btnUp_3" class="btn btnUp"></div><div id="btnDown_3" class="btn btnDown"></div>
                <div id="btnUp_4" class="btn btnUp"></div><div id="btnDown_4" class="btn btnDown"></div>
                <div id="btnPlay"></div>
                <div id="btnComprobar"></div>
                <div id="slideImagen"></div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="CTimer"><div id="CMin">00</div><div>:</div><div id="CSeg">00</div></div>
            <div id="pausaTouch" class="gameEnv"></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="pregWindow">
                <div id="pregBien" class="caratula"><div id="btnListo"></div></div>
                <div id="pregMal" class="caratula">
                    <div id="rImg1" class="rImg"></div>
                    <div id="rImg2" class="rImg"></div>
                    <div id="rImg3" class="rImg"></div>
                    <div id="rImg4" class="rImg"></div>
                    <div id="btnFin"></div>
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
                        <?php echo anchor('nivel3/resultados', '&nbsp;', array('id' => 'btnContinuar')); ?>
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
            <div id="objetosOcultos">
                <img src="<?php echo base_url($own_dir . '/images/preg/preg1.png'); ?>" alt=""/>
                <img src="<?php echo base_url($own_dir . '/images/preg/preg2.png'); ?>" alt=""/>
                <img src="<?php echo base_url($own_dir . '/images/preg/preg3.png'); ?>" alt=""/>
                <img src="<?php echo base_url($own_dir . '/images/preg/preg4.png'); ?>" alt=""/>
            </div>
        </div>
    </body>
</html>