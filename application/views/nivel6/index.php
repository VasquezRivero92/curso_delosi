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
    <body class="<?php echo $avatar . ' ' . $owlgrupo; ?>">
        <!-- - - - - - - - - - - - - - - - -  Loader  - - - - - - - - - - - - - - - - -->
        <div id="qLoverlay" class="resizeWindow">
            <div id="img_loader01"><div></div></div>
        </div>
        <div id="historia" class="resizeWindow">
            <!-- - - - - - - - - - - - - -  Instruccion 1  - - - - - - - - - - - - - -->
            <div id="instruccion_1" class="instrucciones">
                <div id="i1tit_1">Reclamos frecuentes</div>
                <div id="i1tit_2">Segunda fase</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 3  - - - - - - - - - - - - - -->
            <div id="instruccion_3" class="instrucciones">
                <div id="i3tit_1"></div>
                <div id="i3txt_1">Selecciona un tema para iniciar.</div>
                <div id="i3btn_1" class="i3btn">PARTE 1<span>Cuestionamientos a <br>calidad del producto</span></div>
                <div id="i3btn_2" class="i3btn">PARTE 2<span>Hurtos en el<br>establecimiento</span></div>
                <div id="i3btn_3" class="i3btn">PARTE 3<span>Accidentes de<br>clientes</span></div>
                <div id="i3btn_4" class="i3btn">PARTE 4<span>Consumos no<br>reconocidos</span></div>
                <?php
                if ($this->session->win < 2) {
                    echo '<div id="i3txt_2"><span>Ahora es momento de aplicar tus conocimientos. Tendrás <br>5 minutos para completar un test especialmente diseñado para <br>medir lo aprendido. Presiona el boton de la derecha para iniciar.</span></div>';
                    echo anchor('reclamosfrecuentes_2/minitest', 'MINI-TEST DISPONIBLE', array('id' => 'btnJugar'));
                    echo anchor('reclamosfrecuentes_2/minitest', '&nbsp;', array('id' => 'btnJugar2'));
                } else {
                    echo '<div id="i3txt_2"><span>Ya completaste este Mini-test<span></div>';
                    echo anchor('main', 'Volver al inicio', array('id' => 'btnJugar'));
                }
                ?>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 1  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_1" class="instrucciones">
                <div id="s1tit_1" class="stit_1">PARTE 1</div>
                <div id="s1tit_2" class="stit_2">Cuestionamientos a calidad del producto</div>
                <div class="cont-carousel">
                    <div class="owl-carousel">
                        <div class="item">
                            <img id="s1i1" src="<?php echo base_url($own_dir . '/images/slider/s1i1.png'); ?>" alt=""/>
                            <div id="s1t1A" class="s1t1">Producto vencido</div>
                            <div id="s1t1B" class="s1t1">Elemento <br>extraño</div>
                            <div id="s1t1C" class="s1t1">Producto crudo</div>
                            <div id="s1t1D" class="s1t1">Supuesta intoxicación<br>por producto en<br>mal estado</div>
                            <div id="s1t1E">Algunos clientes podrían interponer alguna queja o reclamo por los siguientes motivos:</div>
                            <div id="s1t1F">Si te encuentras en alguno de esos, recuerda lo siguiente:</div>
                        </div>
                        <div class="item">
                            <div id="s1t2" class="stxt"><span>Escucha al cliente y ofrécele el cambio del producto.</span></div>
                            <img id="s1i2" src="<?php echo base_url($own_dir . '/images/slider/s1i2.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s1t3" class="stxt"><span>Hazle saber que cumplimos con altos estándares de calidad <br>en la preparación y expendio de nuestros productos.</span></div>
                            <img id="s1i3" src="<?php echo base_url($own_dir . '/images/slider/s1i3.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s1t4" class="stxt"><span>Puedes ofrecerle una cortesía si lo consideras conveniente.</span></div>
                            <img id="s1i4" src="<?php echo base_url($own_dir . '/images/slider/s1i4.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s1t7" class="stxt"><span>Intenta recuperar el producto. Si el cliente no acepta, pídele 
                                    <br>que te deje entonces una parte del mismo. Si el cliente tampoco 
                                    <br>acepta, no insistir.</span></div>
                            <img id="s1i7" src="<?php echo base_url($own_dir . '/images/slider/s1i7.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <img id="s1i8" src="<?php echo base_url($own_dir . '/images/slider/s1i8.png'); ?>" alt=""/>
                            <img id="s1i9" src="<?php echo base_url($own_dir . '/images/slider/s1i9.png'); ?>" alt=""/>
                            <div id="s1t8" class="stxt"></div>
                            <ul id="s1t9" class="stxt">Recuerda:
                                <li>Si colocó libro de reclamaciones y no sabes 
                                    <br>qué responder en ese momento, la mejor respuesta 
                                    <br>que puedes dar es: "Se escuchó atentamente el reclamo 
                                    <br>del cliente y se le indicó que se le brindará una respuesta 
                                    <br>dentro del plazo legal".</li>
                                <li>Si pudiste recuperar el producto o una parte de él, 
                                    <br>de inmediato comunícate con tu Gerente de Área a fin 
                                    <br>que se contacte con el área de calidad.</li>
                                <li>Si el cliente indica que presenta un cuadro de intoxicación 
                                    <br>en ese momento, ofrécele si desea acudir a una Clínica 
                                    <br>para atenderse. Si el reclamo lo presenta días después 
                                    <br>infórmaselo a tu Gerente de Área para que coordine 
                                    <br>la respuesta con Servicio al Cliente.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 2  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_2" class="instrucciones">
                <div id="s2tit_1" class="stit_1">PARTE 2</div>
                <div id="s2tit_2" class="stit_2">Hurtos en el establecimiento</div>
                <div class="cont-carousel">
                    <div class="owl-carousel">
                        <div class="item">
                            <div id="s2t1" class="stxt"><span>Un hurto ocurre cuando un sujeto toma un objeto ajeno 
                                    <br>sin que medie  violencia hacia la víctima (ej. hurto de maletín, 
                                    <br>celular sin que el cliente se percate).</span></div>
                            <img id="s2i1" src="<?php echo base_url($own_dir . '/images/slider/s2i1.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s2t3" class="stxt"><span>Si el cliente te solicita visualizar los videos, consúltalo de inmediato 
                                    <br>con tu Gerente de Área para validar el flujo de visualización.</span></div>
                            <img id="s2i3" src="<?php echo base_url($own_dir . '/images/slider/s2i3.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s2t8" class="stxt"><span>Si el cliente quiere que le entregues una copia, tomar fotos 
                                    <br>o grabar directamente, explícale que no podrán ser entregados 
                                    <br>dado que tenemos un deber de confidencialidad respecto 
                                    <br>a las personas que aparecen en el video.</span></div>
                            <img id="s2i8" src="<?php echo base_url($own_dir . '/images/slider/s2i8.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s2t2" class="stxt"><span>Explícale también que debe presentar su denuncia para que 
                                    <br>la Policía nos remita el oficio solicitándonos el video.</span></div>
                            <img id="s2i2" src="<?php echo base_url($own_dir . '/images/slider/s2i2.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s2t5" class="stxt"><span>Si el cliente te interpone un reclamo en el que verificaste que fue cometido por terceras 
                                    <br>personas, podrías indicarle: “Nos apena mucho lo que nos comenta dado que buscamos 
                                    <br>que todas las experiencias de nuestros clientes sean agradables. Sin embargo, no nos es 
                                    <br>posible asumir responsabilidad por lo ocurrido, dado que el objeto hurtado se encontraba 
                                    <br>bajo su custodia y fue cometido por personas ajenas a nuestro establecimiento”.</span></div>
                            <img id="s2i5" src="<?php echo base_url($own_dir . '/images/slider/s2i5.png'); ?>" alt=""/>
                        </div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 3  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_3" class="instrucciones">
                <div id="s3tit_1" class="stit_1">PARTE 3</div>
                <div id="s3tit_2" class="stit_2">Accidentes de clientes</div>
                <div class="cont-carousel">
                    <div class="owl-carousel">
                        <div class="item">
                            <div id="s3t1" class="stxt"><span>Un accidente puede ocurrir antes, durante o después de efectuado 
                                    <br>un consumo en nuestra tienda. En cualquier caso, igual debemos 
                                    <br>prestar la ayuda necesaria. De requerir atención médica, debes:</span></div>
                            <img id="s3i1" src="<?php echo base_url($own_dir . '/images/slider/s3i1.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t2" class="stxt"><span>Consultar las clínicas afiliadas cuya relación debes tener a la mano 
                                    <br>en tu tienda.</span></div>
                            <img id="s3i2" src="<?php echo base_url($own_dir . '/images/slider/s3i2.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t3" class="stxt"><span>Ofrecerle al cliente trasladarlo a una de nuestras clínicas afiliadas.</span></div>
                            <img id="s3i3" src="<?php echo base_url($own_dir . '/images/slider/s3i3.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t4" class="stxt"><span> Si el cliente no está en condiciones de moverse, llama 
                                    <br>inmediatamente a los bomberos a fin que puedan trasladarlo 
                                    <br>a una clínica afiliada.</span></div>
                            <img id="s3i4" src="<?php echo base_url($own_dir . '/images/slider/s3i4.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t5" class="stxt"><span>Luego, debes dirigirte a la Clínica con el cliente. No olvides llevar a  la Clínica, la  Hoja 
                                    <br>de Reclamo de Accidentes Personales debidamente llenada y firmada por el administrador 
                                    <br>de la tienda o área, incluyendo el sello del Gerente de la Tienda. <b>Tómale una foto <br>o sacarle una copia para que sea tu cargo.</b></span></div>
                            <img id="s3i5" src="<?php echo base_url($own_dir . '/images/slider/s3i5.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t6" class="stxt"><span>Se pedirá al funcionario de la clínica que llame a Rímac para 
                                    <br>confirmar la cobertura del accidente vía la póliza 9001-527433 
                                    <br>o aquella que corresponda.</span></div>
                            <img id="s3i6" src="<?php echo base_url($own_dir . '/images/slider/s3i6.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t7" class="stxt"><span>Si el cliente no quisiera acudir a alguna de nuestras clínicas afiliadas, acompáñalo a la clínica que él desee.</span></div>
                            <img id="s3i7" src="<?php echo base_url($own_dir . '/images/slider/s3i7.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t8" class="stxt"><span>No olvides contactarte de inmediato con tu Gerente de Área 
                                    <br>quien te dará el alcance en la Clínica afiliada o en la que se encuentre 
                                    <br>el cliente y abrirá los canales de comunicación correspondientes.</span></div>
                            <img id="s3i8" src="<?php echo base_url($own_dir . '/images/slider/s3i8.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t9" class="stxt"><span>Recuerda sacar copia a todos los documentos que se emitan 
                                    <br>en las atenciones médicas y pedirle sus datos al cliente (nombres completos, teléfono, correo electrónico).</span></div>
                            <img id="s3i9" src="<?php echo base_url($own_dir . '/images/slider/s3i9.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s3t10" class="stxt"><span>Finalmente, no olvides revisar el protocolo de accidentes 
                                    <br>para que te sea de ayuda.</span></div>
                            <img id="s3i10" src="<?php echo base_url($own_dir . '/images/slider/s3i10.png'); ?>" alt=""/>
                        </div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 4  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_4" class="instrucciones">
                <div id="s4tit_1" class="stit_1">PARTE 4</div>
                <div id="s4tit_2" class="stit_2">Consumos no reconocidos</div>
                <div class="cont-carousel">
                    <div class="owl-carousel">
                        <div class="item">
                            <div id="s4t1" class="stxt"><span>Son aquellos reclamos por el cual un cliente  indica no haber hecho 
                                    <br>uso de su tarjeta para consumir en nuestro local; es decir, 
                                    <br><b>NO</b> reconoce haber colocado su firma ni su DNI en el voucher. 
                                    <br>A fin de evitar estos reclamos debemos:</span></div>
                            <img id="s4i1" src="<?php echo base_url($own_dir . '/images/slider/s4i1.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s4t2" class="stxt"><span>Revisar que la persona del DNI sea la misma que la que está  
                                    <br>efectuando el pago. Pedirle al cliente que su firma consignada 
                                    <br>en el voucher sea igual o similar a la que figura en su DNI.</span></div>
                            <img id="s4i2" src="<?php echo base_url($own_dir . '/images/slider/s4i2.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s4t3" class="stxt"><span>Consulta con tu Gerente de Área si cuentan con el sistema del pago 
                                    <br>rápido (por montos menores a 60 soles no es necesario consignar 
                                    <br>la firma y DNI) en tu local.</span></div>
                            <img id="s4i3" src="<?php echo base_url($own_dir . '/images/slider/s4i3.png'); ?>" alt=""/>
                        </div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
        </div>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
    </body>
</html>