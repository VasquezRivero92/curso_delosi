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
        <!-- <script src="<?php //echo base_url($own_dir . '/js/createjs-2015.11.26.min.js'); ?>"></script> -->
        <script src="<?php echo base_url($own_dir . '/js/actividad.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/home_sc.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <!-- <script src="<?php //echo base_url($own_dir . '/js/controlPuntos1.js'); ?>"></script> -->
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
            <!-- <div id="instrucciones_6" class="instrucciones">
                <div id="btnPrev_6" class="btnPrev"></div>
                <div id="btnJugar"></div>
            </div> -->

            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

            <div id="content">
                <div id="Actividad1" class="Actividad">
                    <div id="cardSlots1">
                        <div id="cTiempo1_1" class="cTiempo1 ui-droppable"></div>
                    </div>
                    <div id="cardPile1">
                        <div id="dato1_1" class="dato1 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>CABEZA Y CUELLO</strong></span></div>
                        <div id="dato1_2" class="dato1 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA PIERNAS</strong></span></div>
                        <div id="dato1_3" class="dato1 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA OJOS</strong></span></div>
                    </div>
                </div>
                <div id="Actividad2" class="Actividad">
                    <div id="cardSlots2">
                        <div id="cTiempo2_1" class="cTiempo2 ui-droppable"></div>
                    </div>
                    <div id="cardPile2">
                        <div id="dato2_1" class="dato2 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>CABEZA Y CUELLO</strong></span></div>
                        <div id="dato2_2" class="dato2 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>BRAZOS Y TRONCO</strong></span></div>
                        <div id="dato2_3" class="dato2 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA CABELLO</strong></span></div>
                    </div>
                </div>
                <div id="Actividad3" class="Actividad">
                    <div id="cardSlots3">
                        <div id="cTiempo3_1" class="cTiempo3 ui-droppable"></div>
                    </div>
                    <div id="cardPile3">
                        <div id="dato3_1" class="dato3 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA PIERNAS</strong></span></div>
                        <div id="dato3_2" class="dato3 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>CABEZA Y CUELLO</strong></span></div>
                        <div id="dato3_3" class="dato3 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA NARIZ</strong></span></div>
                    </div>
                </div>
                <div id="Actividad4" class="Actividad">
                    <div id="cardSlots4">
                        <div id="cTiempo4_1" class="cTiempo4 ui-droppable"></div>
                    </div>
                    <div id="cardPile4">
                        <div id="dato4_1" class="dato4 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>BRAZOS Y TRONCO</strong></span></div>
                        <div id="dato4_2" class="dato4 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA CEJAS</strong></span></div>
                        <div id="dato4_3" class="dato4 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA PIERNAS</strong></span></div>
                    </div>
                </div>
                <div id="Actividad5" class="Actividad">
                    <div id="cardSlots5">
                        <div id="cTiempo5_1" class="cTiempo5 ui-droppable"></div>
                    </div>
                    <div id="cardPile5">
                        <div id="dato5_1" class="dato5 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA PIERNAS</strong></span></div>
                        <div id="dato5_2" class="dato5 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>BRAZOS Y TRONCO</strong></span></div>
                        <div id="dato5_3" class="dato5 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA OJOS</strong></span></div>
                    </div>
                </div>
                <div id="Actividad6" class="Actividad">
                    <div id="cardSlots6">
                        <div id="cTiempo6_1" class="cTiempo6 ui-droppable"></div>
                    </div>
                    <div id="cardPile6">
                        <div id="dato6_1" class="dato6 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA PIERNAS</strong></span></div>
                        <div id="dato6_2" class="dato6 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>BRAZOS Y TRONCO</strong></span></div>
                        <div id="dato6_3" class="dato6 ui-draggable"><span>PAUSAS ACTIVAS PARA<br><strong>PARA CABELLO</strong></span></div>
                    </div>
                </div>
                <p class="txt_abst">ARRASTRA LA ETIQUETA ROJA CORRECTA AL EJERCICIO</p>
                <div id="icon_1" class="iconCheck"></div>
                <div id="icon_2" class="iconCheck"></div>
                <div id="icon_3" class="iconCheck"></div>
                <div id="icon_4" class="iconCheck"></div>
                <div id="icon_5" class="iconCheck"></div>
                <div id="icon_6" class="iconCheck"></div>

                <div id="marcador" class="gameEnv">
                    <div id="CTimer"><div id="CMin">0</div><div>:</div><div id="CSeg">00</div></div>
                </div>

                <div id="pregWindow">
                    <div id="pregBien" class="caratula">
                        <div id="btnPBien"></div>
                    </div>
                    <div id="pregMal" class="caratula">
                        <div id="btnPMal"></div>
                    </div>
                </div>



            </div>

            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="capaResumen">
                <div id="caratulaFin1" class="caratula">
                    <div id="resumenAvatar" class="avatarGen"></div>
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