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
            var cursos = [null, 
                         '<?php echo $curso1; ?>', 
                         '<?php echo $curso2; ?>',
                         '<?php echo $curso3; ?>', 
                         '<?php echo $curso4; ?>', 
                         '<?php echo $curso8; ?>', 
                         '<?php echo $curso9; ?>', 
                         '<?php echo $curso10; ?>'];
            var cur_intento = [null, 
                         '<?php echo $curso1_i; ?>', 
                         '<?php echo $curso2_i; ?>',
                         '<?php echo $curso3_i; ?>', 
                         '<?php echo $curso4_i; ?>'];
        </script>

        <script src="<?php echo base_url($own_dir . '/js/clases.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>        
        
        <script src="<?php echo base_url($own_dir . '/js/controlMovimiento.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlObjetos1.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlPuntos1.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/juego1.js'); ?>"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123369182-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-123369182-1');
        </script>
    </head>
    <body class="
        <?php echo $avatar; ?>" data-firstwindow="<?php echo $firstWindow; ?>" data-drivers="<?php echo $drivers; ?>" data-pared="<?php echo $pared; ?>">
        <!-- - - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">

            <div id="instrucciones_1" class="instrucciones"></div>
            <div id="instrucciones_2" class="instrucciones">
                <!-- <div id="bg_2"></div> -->
                <div id="welcome_2">
                    <!-- <strong>¡Bienvenido a la Ciudad de la Prevención!</strong><br> -->
                    <p>¡Hola! soy Zoila Prevención, te doy la bienvenida a Prevencity, nuestra ciudad segura donde aprenderás como prevenir accidentes de trabajo, estaré acompañándote durante tu recorrido en la ciudad dándote algunos TIPS.<p>
                    <p>En Prevencity encontrarás diversos lugares donde podrás ingresar, aprender y al finalizar cada curso pondrás a prueba todo lo aprendido pasando un Reto de prevención”.
                        <!-- <br> No te pierdas ninguno de las misiones, ya que muchas de ellos podrán llevarte a formar parte del <strong>Programa de Certificación de Prevención de riesgos de acuerdo a tu puesto de trabajo.</strong> -->
                    </p>
                    <p>¡Bienvenido a la ciudad Prevencity!</p>
                </div>
                <!-- <div id="alcalde_2"></div> -->
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
                        <div class="sprite"></div>
                        <div class="ptje"></div>
                    </div>
                    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
                    <div id="icoPel_1" class="icoPel"></div>
                    <div id="icoPel_2" class="icoPel"></div>
                    <div id="icoPel_3" class="icoPel"></div>
                    <div id="icoPel_4" class="icoPel"></div>
                    <div id="icoPel_5" class="icoPel"><div class="fuenteMC"></div></div>
                    <div id="icoPel_6" class="icoPel"></div>
                    <div id="icoPel_7" class="icoPel"></div>
                    <div id="icoPel_8" class="icoPel"></div>
                    <div id="icoPel_9" class="icoPel"></div>
                    <div id="icoPel_10" class="icoPel"></div>
                    <div id="icoPel_11" class="icoPel"></div>
                    <div id="icoPel_12" class="icoPel"></div>
                    <div id="icoPel_13" class="icoPel"></div>
                    <div id="icoPel_14" class="icoPel"></div>
                    <!-- <div id="icoPel_15" class="icoPel"></div> -->
                    <div id="icoPrev_1" class="icoPrev"></div>
                    <div id="icoPrev_2" class="icoPrev"></div>
                    <div id="icoPrev_3" class="icoPrev"></div>
                    <div id="icoPrev_4" class="icoPrev persona_mov1"></div>
                    <!-- <div id="icoPrev_5" class="icoPrev persona_mov1"></div> -->
                    <div id="icoPrev_6" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_7" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_8" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_9" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_10" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_11" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_12" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_13" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_14" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_15" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_16" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_17" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_18" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_19" class="icoPrev"></div>
                    <div id="icoPrev_20" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_21" class="icoPrev persona_mov1"></div>
                    <div id="icoPrev_22" class="icoPrev"></div>
                    <div id="icoPrev_23" class="icoPrev"></div>
                    <div id="icoPrev_24" class="icoPrev"></div>
                    <div id="icoPrev_25" class="icoPrev"></div>
                    <div id="icoPrev_26" class="icoPrev"></div>
                    <div id="icoPrev_27" class="icoPrev"></div>
                    <div id="icoPrev_28" class="icoPrev persona_mov1">
                        <div id="popAl_16" class="pop_alcalde"><span class="consejitos">!Auxilio¡</span></div>
                    </div>
                    <div id="icoPrev_29" class="icoPrev persona_mov1">
                        <div id="popAl_15" class="pop_alcalde"><span class="consejitos">!Auxilio¡</span></div>                    
                    </div>
                    <div id="icoPrev_30" class="icoPrev"></div>
                    <div id="icoPrev_31" class="icoPrev"></div>
                    <div id="icoPrev_32" class="icoPrev"></div>
                    <div id="icoPrev_33" class="icoPrev"></div>
                    <div id="icoPrev_34" class="icoPrev"></div>
                    <div id="icoPrev_35" class="icoPrev"></div>
                    <div id="icoPrev_36" class="icoPrev"></div>
                    <div id="icoPrev_37" class="icoPrev"></div>
                    <div id="icoPrev_38" class="icoPrev"></div>
                    <!-- <div id="icoPrev_39" class="icoPrev"></div>
                    <div id="icoPrev_40" class="icoPrev"></div>
                    <div id="icoPrev_41" class="icoPrev"></div>
                    <div id="icoPrev_42" class="icoPrev"></div> -->
                    <div id="icoPrev_43" class="icoPrev"></div>
                    <!-- <div id="icoPrev_44" class="icoPrev"></div>
                    <div id="icoPrev_45" class="icoPrev"></div>
                    <div id="icoPrev_46" class="icoPrev"></div> -->
                    <!-- <div id="icoPrev_47" class="icoPrev"></div> 
                    <div id="icoPrev_48" class="icoPrev"></div>-->
                    <div id="icoPrev_49" class="icoPrev"></div>
                    <!-- <div id="icoPrev_50" class="icoPrev"></div>
                    <div id="icoPrev_51" class="icoPrev"></div> 
                    <div id="icoPrev_52" class="icoPrev"></div>
                    <div id="icoPrev_53" class="icoPrev"></div>-->
                    <!-- <div id="icoPrev_54" class="icoPrev"></div>
                    <div id="icoPrev_55" class="icoPrev"></div> -->
                    <div id="icoPrev_56" class="icoPrev"></div>
                    <div id="icoPrev_57" class="icoPrev"></div>
                    <div id="icoPrev_58" class="icoPrev"></div>
                    <div id="icoPrev_59" class="icoPrev"></div>
                    <div id="icoPrev_60" class="icoPrev"></div>

                    <div id="fondoOPC1" class="fondoOPC">
                        <div id="powerUp_1" data-curso="1"  class="powerUp powerUp1">1</div>
                        <div id="powerUp_2" data-curso="2"  class="powerUp powerUp1">2</div>
                        <div id="powerUp_3" data-curso="3"  class="powerUp powerUp1">3</div>
                        <div id="powerUp_4" data-curso="1" class="powerUp powerUp1">4</div>
                        <div id="powerUp_5" data-curso="1" class="powerUp powerUp1">5</div>
                        <div id="powerUp_6" data-curso="1" class="powerUp powerUp1">6</div>
                        <div id="powerUp_7" data-curso="7"  class="powerUp powerUp1">7</div>
                        <div id="powerUp_8" data-curso="8" class="powerUp powerUp1">8</div>
                        <div id="powerUp_9" data-curso="9" class="powerUp powerUp1">9</div>
                        <div id="powerUp_10" data-curso="10" class="powerUp powerUp1">10</div>
                        <div id="powerUp_11" data-curso="11" class="powerUp powerUp1">11</div>
                        <div id="powerUp_12" data-curso="12"  class="powerUp powerUp1">12</div>
                        <div id="powerUp_13" data-curso="1" class="powerUp powerUp1">13</div>
                        <div id="powerUp_14" data-curso="1"  class="powerUp powerUp1">14</div>
                        <div id="powerUp_15" data-curso="1" class="powerUp powerUp1">15</div>
                        <div id="powerUp_16" data-curso="1" class="powerUp powerUp1">16</div>
                        <!-- <div id="powerUp_17" class="powerUp powerUp1">17</div> -->
                    </div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="marcador" class="gameEnv">
                <div id="topBar" class="animPers <?php echo $avatar_p; ?>">
                    <div id="i4avatar"></div>
                    <div id="i4Nombre"><?php echo strtoupper($user_login['nombre'] . ' ' . $user_login['apat'] . ' ' . $user_login['amat']); ?></div>
                    <?php echo anchor('login/logout', ' ', array('id' => 'i4Logout')); ?>
                    <div class="anim"></div>
                </div>
                <div id="botBar">
                    <div id="i4RazonSocial" class="i4txt"><?php echo $empresa; ?></div>
                    <div id="i4Puntaje" class="i4txt"><?php echo $user_stats['puntaje']; ?></div>
                    <!-- <div id="i4Estrellas" class="i4txt"><?php //echo ¥$user_stats['estrellas']; ?></div> -->                    
                    <div id="btn_curs"></div>
                </div>
                <div id="centerBar"></div>
            </div>

            <div id="pausaTouch" class="gameEnv"><!-- <span>AYUDA</span> --></div>
            <div id="pop_stat_curs" class="caratula">
                <div class="content_curs">
                    <h1 class="tit_curs">lista de cursos</h1>
                    <ul id="curso_activ">
                        <li id="CA_1" class="cur_esp">Nivel 1</li>
                        <li id="CA_2" class="cur_esp">Nivel 2</li>
                        <li id="CA_3" class="cur_esp">Nivel 3</li>
                        <li id="CA_4" class="cur_esp">Nivel 4</li>
                        <li id="CA_5" class="cur_esp">Drivers</li>
                        <li id="CA_6" class="cur_esp">Evacuación en caso de Emergencias</li>
                        <li id="CA_7" class="cur_esp">Pausas Activas</li>
                    </ul>
                    <div class="btn_Salir"></div>
                </div>
            </div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="pregWindow">
                <div id="popAct_-1" class="caratula"> <!-- restringido a los que no son drivers -->
                    <div class="pop_restring-1"><p class="textCent"></p></div>
                    <div id="preg_-1" class="CV_btn-1 pregOpc"> </div>
                </div>
                <div id="popAct_0" class="caratula"> <!-- restringido para driver a quimicos -->
                    <div class="pop_restring"><p class="textCent"></p></div>
                    <div id="preg_0" class="CV_btn-1 pregOpc"> </div>
                </div>
                <div id="popAct_1" class="caratula"> <!-- buzon consultas -->
                    <div id="accordion">
                        <div class="maestra"></div>
                        <div class="cont_accord">

                            <button id="acord_3" class="accordionMC">¿Porqué esta bloqueado el camino y no puedo continuar?</button>
                            <div id="pan_acord_3" class="panel">
                                <p>Esta barra bloquea tu camino si es que no terminaste de realizar los 4 cursos de "EXPERTOS EN LA PREVENCIÓN" que estan en el edificio de la prevención.</p>
                            </div>

                            <button id="acord_1" class="accordionMC">¿No puedo ingresar a algunos cursos?</button>
                            <div id="pan_acord_1" class="panel">
                                <p>Esto lo determina el sistema dependiendo del tipo de usuario que tengas: por ejemplo si eres usuario de planta u oficina no tendrás el acceso al curso de ‘CONDUCTORES SEGUROS’, si el curso no carga por completo o se queda cargando debido a la lentitud de la linea deberas precionar F5 del teclado ó el botón actualizar del navegador.</p>
                            </div>

                            <button id="acord_2" class="accordionMC"><span style="margin-left: 23px">Si tengo una duda respecto a uno de los cursos</span><br>¿Con quién puedo comunicarme?</button>
                            <div id="pan_acord_2" class="panel">
                                <p>Regresa al menú principal de “Asistencia de prevención”, escribe tu consulta y dale click en “enviar consulta”, te responderán en un plazo máximo de 48 horas.</p>
                            </div>

                            <button id="acord_4" class="accordionMC">¿Qué pasa si se cuelga el sistema y estoy realizando el reto?</button>
                            <div id="pan_acord_4" class="panel">
                                <p>El sistema esta diseñado para darte 2 oportunidades de realizar el reto (tener presente que toda oportunidad se cuenta desde el momento que ingresaste al reto, este programa esta adaptado para realizarse en las distintas plataformas ya sea PC o Dispositivos mobiles, las únicas formas que podrías tener problemas: es que estes usando una versión de navegador muy antigua o una PC con hardware de bajos recursos, o la linea de internet se corte y el sistema dejará de obtener los datos de la nube.</p>
                            </div>                            

                            <button id="acord_5" class="accordionMC">¿Cuánto es el puntaje mínimo para aprobar los cursos?</button>
                            <div id="pan_acord_5" class="panel">
                                <p>El puntaje mínimo para cada curso es de 70 puntos, recuerda que tienes 2 intentos por cada reto; en caso de agotarlos deberás escribir a “Asistencia de prevención” indicado el motivo.</p>
                            </div>                            

                            <button id="acord_6" class="accordionMC">No puedo descargar mi certificado ¿Qué puedo hacer?</button>
                            <div id="pan_acord_6" class="panel">
                                <p>Pueden ser por 2 motivos que no hayas terminado el curso o no tengas acceso a internet.</p>
                            </div>                            

                            <button id="acord_7" class="accordionMC">¿Puedo volver a revisar los contenidos de los cursos?</button>
                            <div id="pan_acord_7" class="panel">
                                <p>Si puedes revisar el contenido del curso, si en caso utilizaste tus 2 oportunidades en el reto no podrás realizarlo nuevamente. En caso hayas utilizado tus 2 oportunidades y obtuviste menos de 70 puntos, comunícalo a tu jefe directo o escribe en el buzón de consultas indicando el motivo y así pueda solicitar la activación de un intento adicional.</p>
                            </div>   

                            <button id="acord_8" class="accordionMC">Mi pantalla se queda en negro cuando entro al curso</button>
                            <div id="pan_acord_8" class="panel">
                                <p>Podria ocurrir si es que el computador o dispositivo no llegara a descargar todo el contenido del curso, para esto es necesario actualizar el navegador con el teclado F5 si no se corrige, verificar tu linea de internet.</p>
                            </div>  

                        </div>
                        <div id="correo_mc"></div>
                    </div>
                    <form id="formBuzon" class="clearfix" method="post" action="#">
                        <div class="opcAyuda"><p class="ayuda_MC"> </p></div>
                        <div id="pop2txt1">Si tienes alguna duda puedes escribir en la casilla de abajo y te responderemos lo antes posible.</div>
                        <textarea id="pop2ta" maxlength="400"></textarea>
                        <input id="pop2sub" class="clearfix" type="submit" value=" ">
                    </form> 
                    <div id="preg_1_1" class="aceptaCd pregOpc"> </div>
                </div>
                <div id="popAct_2" class="caratula"> <!-- drivers -->
                    <div class="drivers"></div>
                    <?php echo anchor('drivers', ' ', array('id' => 'preg_2_1','class' => 'CV_btn1 disable'));
                    echo anchor('mapa/certificado_drivers', '&nbsp;', array('id' => 'i4Certificado', 'class' => $certificado_drivers, 'target' => '_blank', 'style' => 'left: 552px;
                    top: 402px;'));
                     ?>
                    <div id="preg_2_0" class="CV_btn2 pregOpc"> </div>
                </div>
                <div id="popAct_3" class="caratula"> <!-- universisdad -->
                    <div class="prevencion"><p class="textCent"> </p></div> 
                    <div class="<?php echo $cursocheck1?>"></div>
                    <div class="<?php echo $cursocheck2?>"></div>
                    <div class="<?php echo $cursocheck3?>"></div>
                    <div class="<?php echo $cursocheck4?>"></div>                   
                    <?php
                        // echo anchor('cuestionario', '&nbsp;', array('id' => 'i4Cuestionario'));
                        echo anchor('mapa/certificado_prevencion', '&nbsp;', array('id' => 'i4Certificado_p', 'class' => $certificado_prevencion, 'target' => '_blank','style' => 'top: 402px; left: 720px;'));
                        for ($i = 4; $i > 0; $i--) {
                            $clases = 'i4Nivel disable';
                            // echo $cursocheck;                            
                            if ($maxnivel >= $i) {
                                foreach ($niveles as $niv) {
                                    if ($niv->id == $i && $niv->estado == 1){ 
                                        $clases = 'i4Nivel';
                                    }
                                }
                            }
                            echo anchor('nivel' . $i, '&nbsp;', array('id' => 'i4Nivel_' . $i, 'class' => $clases));
                        }
                    ?>
                    

                    <div id="preg_3_0" class="CV_btn2 CV_btn_3 pregOpc"> </div>
                </div>
                <div id="popAct_7" class="caratula"> <!-- pausas -->
                    <div class="pausas"><p class="textCent"></p></div>
                    <?php 
                    echo anchor('Pausasactivas', ' ', array('id' => 'preg_7_1  ','class' => 'CV_btn1 disable')); 
                    echo anchor('mapa/certificado_pausas', '&nbsp;', array('id' => 'i4Certificado', 'class' => $certificado_pausas, 'target' => '_blank', 'style' => 'left: 552px;
                    top: 402px;'));
                    ?>
                    <div id="preg_7_0" class="CV_btn2 pregOpc"></div>
                </div>
                <div id="popAct_8" class="caratula"> <!-- en construccion 1 -->
                    <div class="pop_restring_constr"><p class="textCent"></p></div>
                    <div id="preg_8_0" class="CV_btn-2 pregOpc"></div>
                </div>
                <div id="popAct_9" class="caratula"> <!-- en construccion 2 -->
                    <div class="pop_restring_constr"><p class="textCent"></p></div>
                    <div id="preg_9_0" class="CV_btn-2 pregOpc"></div>
                </div>
                <div id="popAct_10" class="caratula"> <!-- evacuando -->
                    <div class="auxilio"><p class="textCent"> </p></div>
                    <?php 
                        echo anchor('Prevencion', ' ', array('id' => 'preg_10_1','class' => 'CV_btn1 disable')); 
                        echo anchor('mapa/certificado_emergencias', '&nbsp;', array('id' => 'i4Certificado', 'class' => $certificado_emergencias, 'target' => '_blank', 'style' => 'left: 552px;
                        top: 424px;'));?>                    
                    <div id="preg_10_0" class="CV_btn2 pregOpc"> </div>
                </div>
                <div id="popAct_11" class="caratula"> <!-- museo -->
                    <div class="museo"><p class="textCent"></p></div>
                    <div id="preg_11_0" class="CV_btn-1 pregOpc"></div>
                </div>
                <div id="popAct_12" class="caratula">  <!-- quimico -->
                    <div class="quimica"><p class="textCent"></p></div>
                    <div id="preg_12_0" class="CV_btn-1 pregOpc"></div>
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