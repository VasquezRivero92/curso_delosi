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
            var intentos = $.post(bdir + 'ajax/get_intentos_pausas').done(function (data) {
                console.log("intentos: " + data);
            });         
            console.log(win);
        </script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123369182-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'UA-123369182-1');
        </script>
    </head>
    <?php
    $avatar = 'av' . strtoupper(substr($this->session->grupo, 0, 1)) . $this->session->avatar;
    $owlgrupo = $this->session->grupo;
    ?>
    <body class="<?php echo $owlgrupo;?>">
        <!-- - - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">
            <!-- - - - - - - - - - - - - -  Instruccion 1  - - - - - - - - - - - - - -->
            <div id="instruccion_1" class="instrucciones">
              <!--   <div id="i1tit_1">NIVEL UNO</div>
                <div id="i1tit_2">PREVENCIÓN</div>
                <div id="i1tit_3">POR FALTA DE</div>
                <div id="i1tit_4">ORDEN Y LIMPIEZA</div> -->
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 2  - - - - - - - - - - - - - -->
            <div id="instruccion_2" class="instrucciones">
                <div id="i2img_1"></div>
                <div id="i2tit_1"><!--INTRODUCCIÓN--></div>
               <!--  <div id="i2txt_1">Las lesiones provocadas por la falta de orden y limpieza son las más comunes dentro del ambiente de trabajo, podrían parecer las de menor importancia por lo casuales que son, pero lo cierto es que las consecuencias de estos accidentes pueden ser muy graves.
                    <br><br>Para hacer más completo tu aprendizaje al final de este nivel pondrás a prueba lo aprendido mediante unos DESAFIOS DE PREVENCIÓN.</div> -->
                <div id="i2btn_1">Continuar</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 3  - - - - - - - - - - - - - -->
            <div id="instruccion_3" class="instrucciones">
                <div id="i3tit_1"><!--PREVENCIÓN POR FALTA DE ORDEN Y LIMPIEZA--></div>
                <div id="i3txt_1"></div>
                <div id="i3btn_1" class="i3btn"></div>
                <div id="i3btn_2" class="i3btn"></div>
                <div id="i3btn_3" class="i3btn"></div>

                <p id="warning">"Recuerda que si tienes una computadora o dispositivo móvil de gama baja ingresa a la <span>"opción 2"</span>, pero si tienes una computadora o dispositivo móvil de gama media o alta puedes ingresas a la <span>"opción 1"</span>.
                    <br>¡Con esto podrás llevar tu curso de la mejor manera!
                    <br><span>Importante:</span> Si ingresas a la <span>opción 1</span> y el reto no carga o la pantalla aparece oscurecida, deberás ingresar a la <span>opción 2</span>.
                </p>

                <?php
                
                if ($this->session->win < 2) {
                    echo anchor('pausasactivas/pausas', 'Opción 1', array('id' => 'btnJugar'));
                } else {
                    echo anchor('mapa', 'Volver al inicio', array('id' => 'btnJugar'));
                }
                if ($this->session->win == 1 || $this->session->win == 2) {
                    echo anchor('pausasactivasOpcional/pausasOpcional', 'Opción 2', array('id' => 'btnJugar2'));
                } else {
                    echo anchor('mapa', 'Volver al inicio', array('id' => 'btnJugar2'));
                }
                echo anchor('mapa', ' ', array('id' => 'btnciudad'));
                ?>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 1  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_1" class="instrucciones">
                <!-- <div id="s1tit_1" class="stit_1"></div>
                <div id="s1tit_2" class="stit_2"></div> -->
                <div id="s1txt_1" class="stxt_1">Antes de realizar la Pausas Activas, revisemos<br>algunos consejos para tener una buena postura:</div>
                <div class="cont-carousel">
                    <div class="owl-carousel">
                        <div class="item" data-id=1>
                            <div id="s1i1"></div>
                            <div id="s1i2"></div>
                        </div>
                        <div class="item" data-id=2>
                            <div id="s1i3"></div>
                            <div id="s1i4"></div>
                        </div>
                         <div class="item" data-id=3>
                            <div id="s1i5"></div>
                            <div id="s1i6"></div>
                        </div>
                        <!-- <div class="item" data-id=4>                            
                            <div id="s1i7"></div>
                        </div> -->
                        <!-- <div class="item" data-id=3>
                            <div id="s1i3"></div><div id="s1i3h"></div><div id="s1i3p"></div><div class="itmHand"></div><div class="itemLoader"></div>
                        </div> -->
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <div id="sliderPage_4_1" class="instrucciones">
                <div id="i2btn_1_1">Continuar</div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 2  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_2" class="instrucciones">
                <!-- <div id="s2tit_1" class="stit_1">RIESGOS Y MEDIDAS DE PREVENCIÓN</div>
                <div id="s2tit_2" class="stit_2"></div>--> 
                <div id="s2txt_1" class="stxt_1">CABEZA Y CUELLO</div>                
                
                <div class="cont-carousel">
                    <div class="owl-carousel">      
                        <div class="item" data-id=1>
                            <div id="s2i1"></div>                            
                        </div>
                        <div class="item" data-id=2>
                            <div id="s2i2"></div>                            
                        </div>
                         <div class="item" data-id=3>
                            <div id="s2i3"></div>                            
                        </div>
                        <div class="item" data-id=4> 
                            <div id="s2i4"></div>                            
                        </div>
                        <div class="item" data-id=5>                             
                            <div id="s2i5"></div>
                        </div>
                        <div class="item" data-id=6>
                            <div id="s2i6"></div>   
                        </div>
                        <!-- <div class="item" data-id=3>
                            <div id="s1i3"></div><div id="s1i3h"></div><div id="s1i3p"></div><div class="itmHand"></div><div class="itemLoader"></div>
                        </div> -->
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <div id="sliderPage_2_1" class="instrucciones">
                <div id="i2btn_2">Continuar</div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 3  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_3" class="instrucciones">
                <!-- <div id="s3tit_1" class="stit_1">RIESGOS Y MEDIDAS DE PREVENCIÓN</div>
                <div id="s3tit_2" class="stit_2"></div>
                <div id="s3txt_1" class="stxt_1">Mantén presionado el cursor sobre la imagen<br>para ver la manera de prevenir los peligros.</div> -->
                <div class="cont-carousel">
                    <div class="owl-carousel">
                         <div class="item" data-id=1>
                            <div id="s3i1"></div>                            
                        </div>
                        <div class="item" data-id=2>
                            <div id="s3i2"></div>
                        </div>
                        <div class="item" data-id=3>
                            <div id="s3i3"></div>
                        </div>
                        <div class="item" data-id=4>
                            <div id="s3i4"></div>
                        </div>
                        <div class="item" data-id=5>
                            <div id="s3i5"></div>
                        </div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <div id="sliderPage_3_1" class="instrucciones">
                <div id="i2btn_3">Continuar</div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 4  - - - - - - - - - - - - - - - -->
            <!-- <div id="sliderPage_4" class="instrucciones">
                <div id="s4tit_1" class="stit_1">RIESGOS Y MEDIDAS DE PREVENCIÓN</div>
                <div id="s4tit_2" class="stit_2"></div>
                <div id="s4txt_1" class="stxt_1">Mantén presionado el cursor sobre la imagen<br>para ver la manera de prevenir los peligros.</div>
                <div class="no-carousel">
                    <div class="item" data-id=1>
                        <div id="s4i1"></div><div id="s4i1h"></div><div id="s4i1p"></div><div class="itmHand"></div><div class="itemLoader"></div>
                    </div>
                    <div class="item" data-id=2>
                        <div id="s4i2"></div><div id="s4i2h"></div><div id="s4i2p"></div><div class="itmHand"></div><div class="itemLoader"></div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div> -->
            <!-- - - - - - - - - - - - - -  Instruccion 4 (video)  - - - - - - - - - - - - - -->
            <!-- <div id="instruccion_4" class="instrucciones">
                <video id="i4_video" controls preload="auto">
                    <source src="<?php echo base_url($own_dir . '/videos/videoi4.mp4'); ?>" type="video/mp4"/>
                    <source src="<?php echo base_url($own_dir . '/videos/videoi4.webm'); ?>" type="video/webm"/>
                </video>
                <div id="i4btn_1">Continuar</div>
            </div> -->
        </div>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
    </body>
</html>