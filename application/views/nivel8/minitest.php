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
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlTiempo.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/juego1.js'); ?>"></script>
    </head>
    <?php $avatar = 'dr' . $this->session->avatar;?>
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
                <div id="btnJugar"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Juego  - - - - - - - - - - - - - - - -->

            <div id="gamePreg" class="game">
                <div id="gPreg_1" class="gPreg">
                    <div class="driver" id="driver_1"></div>
                    <div class="moto">
                        <img id="punto_1" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <img id="punto_2" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <!-- <img id="punto_3" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/> -->
                        <img id="punto_4" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                    </div>
                    <div class="preguntas">

                        <div id="pregunta1_1">
                            <div id="p_fondo1_1" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r2.png'); ?>" alt=""/>   
                            </div>
                            <div id="tPreg_1" class="tPreg"><span>El driver se encuentra visiblemente con una molestia. ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>No pasa nada, nadie se fija en eso.</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="1"><span>El driver debe estar en condiciones aptas para iniciar su turno. Debe  recuperarse.</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Es una condición común, se puede dejar pasar.</span></div>
                        </div>

                        <div id="pregunta1_2">
                            <div id="p_fondo1_1" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r3.png'); ?>" alt=""/>    
                            </div>
                            <div id="tPreg1_2" class="tPreg"><span>Es la llanta trasera de la moto ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>
                        </div>

                        <div id="pregunta1_3">
                            <div id="p_fondo1_1" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r6.png'); ?>" alt=""/>   
                            </div>
                            <div id="tPreg_3" class="tPreg"><span>Si un cliente sufre el hurto de su cartera por un tercero</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>a) Le explicas que debe poner su</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>b) Le dices que no puedes, pero le permites</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>c) Le dices que sí puedes, y que se lo harás</span></div>
                        </div>

                        <div id="pregunta1_4">
                            <div id="p_fondo1_1" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r1.png'); ?>" alt=""/>  
                            </div>
                            <div id="tPreg_4" class="tPreg"><span>Es la luz delantera de la moto ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>                            
                        </div>
                    </div>
                    <div id="btnpass_1" class="btn_pass"><img src="<?php echo base_url($own_dir . '/images/btn_pass.png'); ?>" alt=""/><span>Siguiente</br> driver</span></div>                    
                </div>

                <div id="gPreg_2" class="gPreg">
                    <div class="driver" id="driver_2"></div>
                    <div class="moto">
                        <img id="punto2_1" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <img id="punto2_2" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <!-- <img id="punto2_3" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/> -->
                        <img id="punto2_4" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                    </div>
                    <div class="preguntas">

                        <div id="pregunta2_1">
                           <div id="p_fondo2_1" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r7.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_1" class="tPreg"><span>El driver NO esta vistiendo la casaca negra distintiva  ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="1"><span>La casaca es parte integral de su uniforme, debe usarla obligatoriamente.</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>No pasa nada, nadie se fija en eso.</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>¿Quien se fija en la casaca de todos modos? Puede manejar con otra prenda encima.</span></div>
                        </div>

                        <div id="pregunta2_2">
                            <div id="p_fondo2_2" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r4.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg1_2" class="tPreg"><span>Usa el calzado correcto ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>
                        </div>

                        <div id="pregunta2_3">
                            <div id="p_fondo2_3" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r8.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_3" class="tPreg"><span>Si un cliente sufre el hurto de su cartera por un tercero</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>a) Le explicas que debe poner su denuncia en la Comisaría más</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>b) Le dices que no puedes, pero le permites</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>c) Le dices que sí puedes, y que se lo harás</span></div>
                        </div>

                        <div id="pregunta2_4">
                            <div id="p_fondo2_4" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r5.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_4" class="tPreg"><span>Las luz trasera  y direccionales funcionan ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>                            
                        </div>
                    </div>
                    <div id="btnpass_2" class="btn_pass"><img src="<?php echo base_url($own_dir . '/images/btn_pass.png'); ?>" alt=""/><span>Siguiente</br> driver</span></div>                    
                </div>

                <div id="gPreg_3" class="gPreg">
                    <div class="driver" id="driver_3"></div>
                    <div class="moto">
                        <img id="punto3_1" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <img id="punto3_2" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <!-- <img id="punto3_3" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/> -->
                        <img id="punto3_4" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                    </div>
                    <div class="preguntas">

                        <div id="pregunta3_1">
                            <div id="p_fondo3_3" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r10.png'); ?>" alt=""/>    
                            </div>
                            <div id="tPreg_1" class="tPreg"><span>El faro frontal de la motocicleta esta roto  ¿Que se deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Una Motocicleta debe estar en optimas condiciones. Debe reemplazar ese faro lo antes posible.</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Es una condición común, se puede dejar pasar. Ademas es turno de día no las necesita.</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>La moto funciona igual sin esa luz. Puedes apoyarte en la luz de calle.</span></div>
                        </div>

                        <div id="pregunta3_2">
                           <div id="p_fondo3_2" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r6.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg1_2" class="tPreg"><span>Tiene el casco adecuado ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>
                        </div>

                        <div id="pregunta3_3">
                            <div id="p_fondo3_1" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r9.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_3" class="tPreg"><span>El faro frontal de la motocicleta esta roto  ¿Que se deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="1"><span>Una Motocicleta debe estar en optimas condiciones. Debe reemplazar ese faro lo antes posible.</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Es una condición común, se puede dejar pasar. Ademas es turno de día no las necesita.</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>La moto funciona igual sin esa luz. Puedes apoyarte en la luz de calle.</span></div>
                        </div>

                        <div id="pregunta3_4">
                            <div id="p_fondo3_4" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r8.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_4" class="tPreg"><span>El motor esta completo y funcionando ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>                            
                        </div>
                    </div>
                    <div id="btnpass_3" class="btn_pass"><img src="<?php echo base_url($own_dir . '/images/btn_pass.png'); ?>" alt=""/><span>Siguiente</br> driver</span></div>                    
                </div>

                <div id="gPreg_4" class="gPreg">
                    <div class="driver" id="driver_4"></div>
                    <div class="moto">
                        <img id="punto4_1" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <img id="punto4_2" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <!-- <img id="punto4_3" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/> -->
                        <img id="punto4_4" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                    </div>
                    <div class="preguntas">

                        <div id="pregunta4_1">
                            <div id="p_fondo4_1" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r12.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_1" class="tPreg"><span>Tiene el casco adecuado ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="1"><span>Esta normal</span></div>
                        </div>

                        <div id="pregunta4_2">
                            <div id="p_fondo4_2" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r11.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg1_2" class="tPreg"><span>Al driver le hace falta la revisión tecnica de la moto ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>No pasa nada, nadie se fija en eso. Ademas no hay tantos controles en su ruta.</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Que se consiga la revisión tecnica de la  moto de alguien más y que incie su turno.</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Un driver debe contar con toda su documentación antes de iniciar su turno,  ¡Siempre!</span></div>
                        </div>

                        <div id="pregunta4_3">
                            <div id="p_fondo4_3" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r13.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_3" class="tPreg"><span>Si un cliente sufre el hurto de su cartera por un tercero</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>a) Le explicas que debe poner su denuncia en la Comisaría más</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>b) Le dices que no puedes, pero le permites</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>c) Le dices que sí puedes, y que se lo harás</span></div>
                        </div>

                        <div id="pregunta4_4">
                            <div id="p_fondo4_4" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r3.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_4" class="tPreg"><span>Es la llanta trasera de la moto ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>                            
                        </div>
                    </div>
                    <div id="btnpass_4" class="btn_pass"><img src="<?php echo base_url($own_dir . '/images/btn_pass.png'); ?>" alt=""/><span>Siguiente</br> driver</span></div>                    
                </div>

                <div id="gPreg_5" class="gPreg">
                    <div class="driver" id="driver_5"></div>
                    <div class="moto">
                        <img id="punto5_1" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <img id="punto5_2" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                        <!-- <img id="punto5_3" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/> -->
                        <img id="punto5_4" class="punt_anim" src="<?php echo base_url($own_dir . '/images/punt_rojo.png'); ?>" alt=""/>
                    </div>
                    <div class="preguntas">

                        <div id="pregunta5_1">
                            <div id="p_fondo5_1" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r16.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_1" class="tPreg"><span>La driver se ve preparada y antenta ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="1"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>
                        </div>

                        <div id="pregunta5_2">
                            <div id="p_fondo5_2" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r15.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg1_2" class="tPreg"><span>El casco del driver esta visiblemente dañado ¿Que se deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Es una cosa menor, el visor no protege nada igual</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>El casco debera ser reemplazado de inmediato.</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Que conduzca sin casco hasta que repare el que tiene.</span></div>
                        </div>

                        <div id="pregunta5_3">
                            <div id="p_fondo5_3" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r14.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_3" class="tPreg"><span>Si un cliente sufre el hurto de su cartera por un tercero</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>a) Le explicas que debe poner su denuncia en la Comisaría más</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>b) Le dices que no puedes, pero le permites</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>c) Le dices que sí puedes, y que se lo harás</span></div>
                        </div>

                        <div id="pregunta5_4">
                            <div id="p_fondo5_4" class="p_fondo"><img src="<?php echo base_url($own_dir . '/images/pregs/p_r8.png'); ?>" alt=""/>
                            </div>
                            <div id="tPreg_4" class="tPreg"><span>El motor esta completo y funcionando ¿Que deberia hacer?</span></div>
                            <div id="btn_1_1" class="btn" data-rspt="0"><span>Nada en particular</span></div>
                            <div id="btn_1_2" class="btn" data-rspt="0"><span>Todo esta ok</span></div>
                            <div id="btn_1_3" class="btn" data-rspt="0"><span>Esta normal</span></div>                            
                        </div>
                    </div>
                    <div id="btnpass_5" class="btn_pass"><img src="<?php echo base_url($own_dir . '/images/btn_pass.png'); ?>" alt=""/><span>Siguiente</br> driver</span></div>                    
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
            <div id="PauseGame"><div id="btnReanudar"></div></div>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
            <div id="objetosOcultos"></div>
        </div>
    </body>
</html>