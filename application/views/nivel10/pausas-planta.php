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
        <script src="<?php echo base_url($own_dir . '/js/createjs-2015.11.26.min.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/planta.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/home_sc.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlPuntos1.js'); ?>"></script>
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

            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

            <div id="animation_container">
                <canvas id="canvas" width="1350" height="700"></canvas>
                <div id="dom_overlay_container"></div>
            </div>        



            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="capaResumen">
                <div id="caratulaFin1" class="caratula">
                    <div id="resumenAvatar"></div>
                    <div id="resumenPuntaje"></div>
                    <!-- <div id="resumenEstrellas"></div> -->
                    <div id="resumenBtns">
                        <div id="btnReinicio">&nbsp;</div>
                        <?php echo anchor('mapa', '&nbsp;', array('id' => 'btnContinuar')); ?> <!--<a id="btnContinuar" href="#"></a>-->
                    </div>
                    <div id="resumenOportunidad"></div>
                    <?php
                        echo anchor('pausasactivas/certificado_pausas', '&nbsp;', array('id' => 'i4Certificado', 'class' => 'disabled', 'target' => '_blank', 'style' => 'left: 823px;
                        top: 452px;'));
                    ?>    
                    <!--  -->
                    <div id="calificacion" class="formulario">
                        <div id="inst_1" class="instr">
                            <div class="instA1"></div>
                            <div id="nextInt_1" class="btnNX"></div>
                        </div>
                        <div id="inst_2" class="instr">
                            <div class="sintruct_ask">En general, los cursos cubren tus expectativas.</div>
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
            <div id="carag-atlas"></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="infoWindow">
                <div id="conteo3" class="conteo"></div>
                <div id="conteo2" class="conteo"></div>
                <div id="conteo1" class="conteo"></div>
            </div>
            <div id="PauseGame"><div id="btnReanudar"></div></div>
            <div id="TerminoTiempo"><div id="btnReiniciar"></div></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
        </div>
    </body>
</html>