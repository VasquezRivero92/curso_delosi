<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/animate.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/fonts/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/style.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-1.11.0.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.ui.touch-punch.min.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/libs/panicoLoader.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/owl.carousel.min.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
            var odir = '<?php echo base_url($own_dir); ?>';
            var grup = '<?php echo strtoupper(substr($this->session->grupo, 0, 1)); ?>';
            var win = <?php echo $this->session->win; ?>;
            
             
        </script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
    </head>
    <?php
    $avatar = 'av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
    $owlgrupo = 'owl-' . $this->session->grupo;
    ?>
<<<<<<< HEAD
    <body class="<?php echo $avatar . ' ' . $owlgrupo; ?> ">
=======
    <body class="<?php echo $avatar . ' ' . $owlgrupo; ?>">
>>>>>>> d9bd8707ae1199414123af2ad198c95d3a67c210
        <!-- - - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">
            <!-- - - - - - - - - - - - - -  Instruccion 1  - - - - - - - - - - - - - -->
            <div id="instruccion_1" class="instrucciones">
                <div id="i1tit_1">LOS</div>
                <div id="i1tit_2">MEJORES</div>
                <div id="i1tit_3">DRIVERS</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 2  - - - - - - - - - - - - - -->
            <div id="instruccion_2" class="instrucciones">
                <div id="i2img_1"></div>
                <div id="i2tit_1">felicitaciones</div>
                <div id="i2tit_2">Driver</div>
                <div id="i2txt_1">Has sido seleccionado  para formar parte del grupo “Los mejores drivers”  
                    Recibiras información vital para tu desenvolverte en tu día a día y pondremos a prueba tu preparación para que formes parte de esta elite de conductores.
                    <br><br>Bienvenido a este curso especialmente diseñado para ti:</div>
                <div id="i2btn_1">Continuar</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 3  - - - - - - - - - - - - - -->
            <div id="instruccion_3" class="instrucciones">
                <div id="i3tit_1">LOS MEJORES DRIVERS</div>
                <div id="i3btn_1" class="i3btn"></div>
                <div id="i3btn_2" class="i3btn"></div>
                <div id="i3btn_3" class="i3btn"></div>
                <div id="i3btn_4" class="i3btn"></div>
                <?php
                if ($this->session->win == 1) {
                    echo '<div id="i3txt_2" >Haz clic para iniciar el juego</div>';
                    echo anchor('drivers/minitest', 'Iniciar Juego', array('id' => 'btnJugar'));
                }elseif ($this->session->win == 3) {
                    echo '<div id="i3txt_2" >Haz clic para iniciar el juego</div>';
                    echo anchor('drivers/moto', 'Iniciar Juego', array('id' => 'btnJugar2'));
                }else {
                    echo '<div id="i3txt_2">Ya completaste este juego</div>';
                    echo anchor('main', 'Juegos completados', array('id' => 'btnJugar','id' => 'btnJugar','style' => 'pointer-events:none'));
                }
                ?>
            </div

            <!-- - - - - - - - - - - - - - - -  Slider 1  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_1" class="instrucciones">
                
                <div class="cont-carousel">
                    <div class="owl-carousel" id="owl-1">
                        <div class="item">                            
                            <img id="s1i1" src="<?php echo base_url($own_dir . '/images/slider/s1i1.png'); ?>" alt=""/>
                            <div id="s1t1" class="stxt"><span>Es básico que conozcas todas las partes de una<br>motocicleta y sus funciones, así como la información<br>técnica del modelo con el que cuentas.</span></div>
                        </div>
                        <div class="item">                            
                            <img id="s1i2" src="<?php echo base_url($own_dir . '/images/slider/s1i2.png'); ?>" alt=""/>
                            <div id="s1t2" class="stxt"><span>Debes estar plenamente familiarizado con la ubicación y<br>afinamiento de los controles de tu motocicleta, así como de<br>sus propios alcances y límites.  La coordinación entre tú y tu<br>vehículo es muy importante para evitar accidentes.</span></div>
                        </div>
                        <div class="item">                            
                            <img id="s1i3" src="<?php echo base_url($own_dir . '/images/slider/s1i3.png'); ?>" alt=""/>
                            <img id="s1i3_2_1" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s1i3_2_2" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s1i3_2_3" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s1i3_2_4" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>

                            
                            <img id="s1i3_1_1" src="<?php echo base_url($own_dir . '/images/slider/s1i3_1.png'); ?>" alt=""/>
                            <img id="s1i3_1_2" src="<?php echo base_url($own_dir . '/images/slider/s1i3_1.png'); ?>" alt=""/>
                            <img id="s1i3_0_1"  src="<?php echo base_url($own_dir . '/images/slider/s1i3_g1.png'); ?>" alt=""/>
                            <img id="s1i3_0_2"  src="<?php echo base_url($own_dir . '/images/slider/s1i3_g2.png'); ?>" alt=""/>
                            <img id="s1i3_0_3"  src="<?php echo base_url($own_dir . '/images/slider/s1i3_g3.png'); ?>" alt=""/>
                            <img id="s1i3_0_4"  src="<?php echo base_url($own_dir . '/images/slider/s1i3_g4.png'); ?>" alt=""/>                            
                        </div>                        
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 2  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_2" class="instrucciones">
                <div id="sliderPage_2_1"></div>
                
                 <div id="s2t1" class="stxt img_disabled"><span>COMO DRIVER TU INDUMENTARIA ES DIFERENTE<br>AL RESTO DE LOS COLABORADORES DENTRO DE LA TIENDA<br>DEBES ASEGURAR DE CONTAR SIEMPRE<br>CON LA ROPA ADECUADA PARA TU LABOR:</span></div>
                <div class="cont-carousel">
                    <div class="owl-carousel" id="owl-2">
                        <div class="item">                            
                            <img id="s2i1" src="<?php echo base_url($own_dir . '/images/slider/s2i1.png'); ?>" alt=""/>
                            <img id="s2i1_1_1" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s2i1_1_2" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s2i1_1_3" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s2i1_1_4" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>

                            <img id="s2i1_2_1" src="<?php echo base_url($own_dir . '/images/slider/s1i3_1.png'); ?>" alt=""/>
                            <img id="s2i1_0_1"  src="<?php echo base_url($own_dir . '/images/slider/s2i1_g1.png'); ?>" alt=""/>
                            <img id="s2i1_0_2"  src="<?php echo base_url($own_dir . '/images/slider/s2i1_g2.png'); ?>" alt=""/>
                            <img id="s2i1_0_3"  src="<?php echo base_url($own_dir . '/images/slider/s2i1_g3.png'); ?>" alt=""/>
                            <img id="s2i1_0_4"  src="<?php echo base_url($own_dir . '/images/slider/s2i1_g4.png'); ?>" alt=""/>                            
                        </div>
                        <div class="item">                            
                            <img id="s2i2" src="<?php echo base_url($own_dir . '/images/slider/s2i2.png'); ?>" alt=""/>
                            <div id="s2t2" class="stxt"><span>Tu primera responsabilidad es con tu bienestar y capacidad<br>física, las condiciones de tu labor exigen que estes atento al<br>camino y al tráfico.</span></div>  
                        </div>
                        <div class="item">                            
                            <img id="s2i3" src="<?php echo base_url($own_dir . '/images/slider/s2i3.png'); ?>" alt=""/>
                            <div id="s2t3" class="stxt"><span>El estar bajo los efectos  del alcohol, de una medicación fuerte,<br>o alguna dolencia corporal   afectará la capacidad de<br>reacción del conductor, perjudicando su seguridad<br> y la de los demás.</span></div>  
                        </div>
                        <div class="item">                            
                            <img id="s2i4" src="<?php echo base_url($own_dir . '/images/slider/s2i4.png'); ?>" alt=""/>
                            <img id="s2i4_2_5" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s2i4_2_6" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s2i4_2_7" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s2i4_2_8" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                            <img id="s2i4_2_9" class="punt_anim" src="<?php echo base_url($own_dir . '/images/slider/s1i3_2.png'); ?>" alt=""/>
                                                        
                            <img id="s2i4_1_1" src="<?php echo base_url($own_dir . '/images/slider/s1i3_1.png'); ?>" alt=""/>
                            <img id="s2i4_1_2" src="<?php echo base_url($own_dir . '/images/slider/s1i3_1.png'); ?>" alt=""/>
                            <img id="s2i4_0_1"  src="<?php echo base_url($own_dir . '/images/slider/s2i3_g1.png'); ?>" alt=""/>
                            <img id="s2i4_0_2"  src="<?php echo base_url($own_dir . '/images/slider/s2i3_g2.png'); ?>" alt=""/>
                            <img id="s2i4_0_3"  src="<?php echo base_url($own_dir . '/images/slider/s2i3_g3.png'); ?>" alt=""/>
                            <img id="s2i4_0_4"  src="<?php echo base_url($own_dir . '/images/slider/s2i3_g4.png'); ?>" alt=""/>   
                            <img id="s2i4_0_5"  src="<?php echo base_url($own_dir . '/images/slider/s2i3_g5.png'); ?>" alt=""/>                           
                        </div>                     
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 3  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_3" class="instrucciones">
                
                <div class="cont-carousel">
                    <div class="owl-carousel" id="owl-3">
                        <div class="item">                            
                            <img id="s3i1" src="<?php echo base_url($own_dir . '/images/slider/s3i1.png'); ?>" alt=""/>
                            <div id="s3t1" class="stxt"><span>Conduce a una velocidad moderada, y siendo consiente de la<br>velocidad máxima permitida.</span></div>
                        </div>
                        <div class="item">                            
                            <img id="s3i2" src="<?php echo base_url($own_dir . '/images/slider/s3i2.png'); ?>" alt=""/>
                            <div id="s3t2" class="stxt"><span>Estate atento a todas las señales de tránsito<br>que encuentres, y respétalas.</span></div>
                        </div>
                        <div class="item">                            
                            <img id="s3i3" src="<?php echo base_url($own_dir . '/images/slider/s3i3.png'); ?>" alt=""/>
                            <div id="s3t3" class="stxt"><span>Mantén una distancia segura (lateral y frontal)<br>con los otros vehículos.</span></div>
                        </div>
                        <div class="item">                            
                            <img id="s3i4" src="<?php echo base_url($own_dir . '/images/slider/s3i4.png'); ?>" alt=""/>
                            <div id="s3t4" class="stxt"><span>Usa el carril completo para transitar, es tu derecho, no<br>conduzcas entre las hileras de los vehículos, te expones a<br>varios tipos de accidentes.</span></div>
                        </div>
                        <div class="item">                            
                            <img id="s3i5" src="<?php echo base_url($own_dir . '/images/slider/s3i5.png'); ?>" alt=""/>
                            <div id="s3t5" class="stxt"><span>Siempre debes de comunicar tus intensiones mediante<br>el uso de las luces direccionales y la luz del freno.</span></div>
                        </div>
                        <div class="item">                            
                            <img id="s3i6" src="<?php echo base_url($own_dir . '/images/slider/s3i6.png'); ?>" alt=""/>
                            <div id="s3t6" class="stxt"><span>Siempre debes de comunicar tus intensiones mediante<br>el uso de las luces direccionales y la luz del freno.</span></div>
                        </div>
                        <div class="item">                            
                            <img id="s3i7" src="<?php echo base_url($own_dir . '/images/slider/s3i7.png'); ?>" alt=""/>
                            <div id="s3t7" class="stxt"><span>Y recuerda que el peatón y los ciclistas  tienen la preferencia.<br>¡Cuídalos!</span></div>
                        </div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 4  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_4" class="instrucciones">
                <div class="cont-carousel">
                    <div class="owl-carousel" id="owl-3">
            <div class="item">               
                <div class="s4_1" style="">
                    <img id="s4i_1" src="<?php echo base_url($own_dir . '/images/slider/s4_1.png'); ?>" alt=""/>
                </div>
            </div>
            <div class="item">  
                <div class="s4_2" style="style=;left: -14px !important;">
                    <img id="s4i_2" src="<?php echo base_url($own_dir . '/images/slider/s4_2.png'); ?>" alt=""/>
                </div>
            </div>
            <div class="item" id="s4t1">  
                <div class="s4_3" style="left: -25px !important;">
                    <img id="s4i_3" src="<?php echo base_url($own_dir . '/images/slider/s4_3.png'); ?>" alt=""/>
                </div>
            </div>
            <div class="item" id="s4t1">  
                <div class="s4_4">
                    <img id="s4i_4" src="<?php echo base_url($own_dir . '/images/slider/s4_4.png'); ?>" alt=""/>
                </div>
            </div>
            <div class="item" id="s4t1">  
                <div class="s4_5">
                    <img id="s4i_5" src="<?php echo base_url($own_dir . '/images/slider/s4_5.png'); ?>" alt=""/>
                </div>
            </div>
            </div>
            <div class="s4b2">
                <div class="s4s1">
                    <img id="s4i1" src="<?php echo base_url($own_dir . '/images/slider/img_4_1.png'); ?>" alt=""/>
                </div>
                <div class="s4s2">
                    <img id="s4i2" src="<?php echo base_url($own_dir . '/images/slider/img_4_2.png'); ?>" alt=""/>
                </div>
                <div class="s4s3">
                    <img id="s4i3" src="<?php echo base_url($own_dir . '/images/slider/img_4_3.png'); ?>" alt=""/>
                </div>
                <div class="s4s4">
                    <img id="s4i4" src="<?php echo base_url($own_dir . '/images/slider/img_4_4.png'); ?>" alt=""/>
                </div>
                <div class="s4s5">
                    <img id="s4i5" src="<?php echo base_url($own_dir . '/images/slider/img_4_5.png'); ?>" alt=""/>
                </div>                
            </div>
        </div>
        <div class="btnVolver"></div>
<<<<<<< HEAD
    <!-- </div>  -->              
            </div>
            
=======
    </div>               
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 4 (video)  - - - - - - - - - - - - - -->
            <div id="instruccion_4" class="instrucciones">
                <!-- - - - - - - - - - - - - -  Instruccion 4 (video)  <video id="i4_video" controls preload="auto">
                    <source src="<?php echo base_url($own_dir . '/videos/videoi4.mp4'); ?>" type="video/mp4"/>
                    <source src="<?php echo base_url($own_dir . '/videos/videoi4.webm'); ?>" type="video/webm"/>
                </video>- - - - - - - - - - - - - -->
                <div id="i4btn_1">Continuar</div>
            </div>
>>>>>>> d9bd8707ae1199414123af2ad198c95d3a67c210
        </div>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
    </body>
</html>