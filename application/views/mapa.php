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
    <body class="<?php echo $avatar; ?>" data-firstwindow="<?php echo $firstWindow; ?>" data-drivers="<?php echo $drivers; ?>">
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
            <div id="instrucciones_4" class="game">
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
                <div id="topBar" class="<?php echo $avatar_p; ?>">
                    <div id="i4avatar"></div>
                    <div id="i4Nombre"><?php echo strtoupper($user_login['nombre'] . ' ' . $user_login['apat'] . ' ' . $user_login['amat']); ?></div>
                    <?php echo anchor('login/logout', ' ', array('id' => 'i4Logout')); ?>
                    <div class="anim"></div>
                </div>
                <div id="botBar">
                    <div id="i4RazonSocial" class="i4txt"><?php echo $empresa; ?></div>
                    <div id="i4Puntaje" class="i4txt"><?php echo $user_stats['puntaje']; ?></div>
                    <div id="i4Estrellas" class="i4txt"><?php echo $user_stats['estrellas']; ?></div>                    
                </div>
                <div id="centerBar"></div>
            </div>

            <div id="pausaTouch" class="gameEnv"><span>AYUDA</span></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="pregWindow">

                <div id="popAct_0" class="caratula">
                    <div class="pop_restring"><p class="textCent">Por el moemnto no puedes ingresar a este curso.</p></div>
                    
                    <br>Vuelve pronto.
                    <div id="preg_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>

                <div id="popAct_1" class="caratula">
                    <div id="i4Buzon"></div>
                    <div class="opcAyuda"><p class="ayuda_MC">PREGUNTAS  FRECUENTES</p></div>
                    <div id="preg_1_1" class="aceptaCd pregOpc">Salir</div>

                     <div id="popup2" class="popup">
                        <form id="formBuzon" class="clearfix" method="post" action="#">
                            <div id="pop2txt1">Sabemos que es importante para ti, tener todos los conceptos claros de cada nivel, si tienes una duda o consulta detállala en el siguiente recuadro y te responderemos dentro de las 24 horas.</div>
                            <textarea id="pop2ta" maxlength="400"></textarea>
                            <div id="pop2txt2">(*) Los días miércoles las respuestas a tus dudas o consultas serán en tiempo real de 8:30 a.m. a 6:00 p.m.</div>
                            <input id="pop2sub" class="clearfix" type="submit" value="ENVIAR">
                            <div id="pop2close"></div>
                        </form>
                    </div>
                   
                </div>

                <div id="popAct_2" class="caratula"> 
                    <div class="drivers"><p class="textCent">Escenario - drivers</p></div>
                    
                    <!-- <a id="preg_2_1" class="CV_btn1 disable" href="#">IR AL CURSO</a> -->
                    <?php echo anchor('drivers', 'IR AL CURSO', array('id' => 'preg_2_1','class' => 'CV_btn1 disable')); ?>
                    <!-- <div id="preg_2_1" class="CV_btn1 pregOpc">IR AL CURSO</div> -->
                    <div id="preg_2_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>


                <div id="popAct_3" class="caratula"> 
                    <div class="prevencion">
                        <p class="textCent">Escenario - Prevención en el trabajo</p>
                    </div>                    

                    <!-- <a href="#"  id="i4Certificado" class="disable"></a>
                    <a id="i4Nivel_1" class="i4Nivel" href="#"></a>
                    <a id="i4Nivel_2" class="i4Nivel disable" href="#"></a>
                    <a id="i4Nivel_3" class="i4Nivel disable" href="#"></a>
                    <a id="i4Nivel_4" class="i4Nivel disable" href="#"></a> -->
                    <?php
                echo anchor('cuestionario', '&nbsp;', array('id' => 'i4Cuestionario'));
                echo anchor('mapa/certificado_prevencion', '&nbsp;', array('id' => 'i4Certificado', 'class' => $certificado, 'target' => '_blank'));
                for ($i = 4; $i > 0; $i--) {
                    $clases = 'i4Nivel disable';
                    if ($maxnivel >= $i) {
                        foreach ($niveles as $niv) {
                            if ($niv->id == $i && $niv->estado == 1) {
                                $clases = 'i4Nivel';
                            }
                        }
                    }
                    echo anchor('nivel' . $i, '&nbsp;', array('id' => 'i4Nivel_' . $i, 'class' => $clases));
                }
                ?>
                    <div id="preg_3_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

                <div id="popAct_7" class="caratula"> 
                    <div class="pausas"><p class="textCent">Bienvenidos al Gimnasio, por el momento esta en construcción.<br>Vuelve pronto.</p></div>
                    <div id="preg_7_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>

                <div id="popAct_8" class="caratula"> 
                    <div class="pop_restring1"><p class="textCent">Muy pronto habrá novedades1, por el momento esta en construcción.
                    <br>Vuelve pronto.</p></div>
                    
                    <div id="preg_8_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>

                <div id="popAct_9" class="caratula"> 
                     <div class="pop_restring2"><p class="textCent">Muy pronto habrá novedades2, por el momento esta en construcción.<br>Vuelve pronto.</p></div>
                   
                    <div id="preg_9_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>

                <div id="popAct_10" class="caratula"> 
                    <div class="auxilio"><p class="textCent">Bienvenidos a Primeros Auxilios, por el momento esta en construcción.
                    <br>Vuelve pronto.</p></div>
                    
                    <div id="preg_10_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>

                <div id="popAct_11" class="caratula"> 
                     <div class="museo"><p class="textCent">Bienvenidos al Museo, por el momento esta en construcción.
                    <br>Vuelve pronto.</p></div>
                    
                    <div id="preg_11_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>

                <div id="popAct_12" class="caratula"> 
                     <div class="quimica"><p class="textCent">Bienvenidos a la casa de la Ciencia, por el momento esta en construcción.</p></div>
                    
                    <br>Vuelve pronto.
                    <div id="preg_12_0" class="CV_btn2 pregOpc">VOLVER</div>
                </div>

            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
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