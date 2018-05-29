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
        <script src="<?php echo base_url($assets_dir . '/js/jquery.tinyscrollbar.min.js'); ?>"></script>
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
                <div id="i1tit_1">Atendiendo</div>
                <div id="i1tit_2">a</div>
                <div id="i1tit_3">nuestros clientes</div>
                <div id="i1tit_4">Libro de reclamaciones</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 2  - - - - - - - - - - - - - -->
            <div id="instruccion_2" class="instrucciones">
                <div id="i2img_1"></div>
                <div id="i2tit_1"></div>
                <div id="i2txt_1">Queremos que este curso sea tu principal herramienta para manejar adecuadamente los reclamos de nuestros clientes. De esa forma, entregamos lo mejor  de nosotros y cuidamos la experiencia en nuestros restaurantes a fin de llevar momentos de felicidad alrededor de la mesa.
                    <br>Por ello, este curso se divide en 2 fases. La primera te permitirá conocer el correcto uso y llenado del libro de reclamaciones y en la segunda presentaremos los casos más frecuentes de reclamos. Cada curso tendrá un mini test que te permitirá evaluar tus conocimientos.
                    <br>¡Adelante!</div>
                <div id="i2btn_1">Continuar</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 5  - - - - - - - - - - - - - -->
            <div id="instruccion_5" class="instrucciones">
                <div id="i5tit_1">Libro de reclamaciones</div>
                <div id="i5tit_2">Primera fase</div>
            </div>
            <!-- - - - - - - - - - - - - -  Instruccion 3  - - - - - - - - - - - - - -->
            <div id="instruccion_3" class="instrucciones">
                <div id="i3tit_1"></div>
                <div id="i3txt_1">Selecciona un tema para iniciar.</div>
                <div id="i3btn_1" class="i3btn">PARTE 1<span>Solicitud del libro <br>de Reclamaciones</span></div>
                <!--<div id="i3btn_2" class="i3btn">PARTE 2<span>Características del <br>libro de Reclamaciones</span></div>-->
                <div id="i3btn_3" class="i3btn">PARTE 2<span>Llenando el libro de <br>Reclamaciones</span></div>
                <div id="i3btn_4" class="i3btn">PARTE 3<span>¿Puedo anular una<br>hoja de Reclamaciones?</span></div>
                <?php
                if ($this->session->win < 2) {
                    echo '<div id="i3txt_2"><span>Ahora es momento de aplicar tus conocimientos. Tendrás <br>5 minutos para completar un test especialmente diseñado para <br>medir lo aprendido. Presiona el boton de la derecha para iniciar.</span></div>';
                    echo anchor('libroreclamaciones_2/minitest', 'MINI-TEST DISPONIBLE', array('id' => 'btnJugar'));
                    echo anchor('libroreclamaciones_2/minitest', '&nbsp;', array('id' => 'btnJugar2'));
                } else {
                    echo '<div id="i3txt_2"><span>Ya completaste este Mini-test<span></div>';
                    echo anchor('main', 'Volver al inicio', array('id' => 'btnJugar'));
                    echo anchor('Reclamosfrecuentes_2', 'Reclamos frecuentes', array('id' => 'btnJugar','style' => 'left: 815px;'));
                }
                                       
                ?>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 1  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_1" class="instrucciones">
                <div id="s1tit_1" class="stit_1">PARTE 1</div>
                <div id="s1tit_2" class="stit_2">Solicitud del libro de reclamaciones</div>
                <div class="cont-carousel">
                    <div class="owl-carousel">
                        <div class="item">
                            <div id="s1t1" class="stxt"><span>Si un cliente desea presentar un reclamo o una queja se deberá <br>entregar el Libro de reclamaciones. <b>Recuerda</b> el cliente tiene  derecho <br>a solicitarlo y es nuestro deber entregárselo <b>inmediatamente</b>.</span></div>
                            <img id="s1i1" src="<?php echo base_url($own_dir . '/images/slider/s1i1.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s1t2" class="stxt"><span>Una vez que le entregues el libro, ayúdalo en sus dudas <br>e inquietudes para su <b>correcto llenado</b>.</span></div>
                            <img id="s1i2" src="<?php echo base_url($own_dir . '/images/slider/s1i2.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s1t3" class="stxt"><span>Comunícate con tu Gerente de Área para ver la mejor <br>respuesta al reclamo. </span></div>
                            <img id="s1i3" src="<?php echo base_url($own_dir . '/images/slider/s1i3.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <img id="s1i4" src="<?php echo base_url($own_dir . '/images/slider/s1i4.png'); ?>" alt=""/>
                            <img id="s1i5" src="<?php echo base_url($own_dir . '/images/slider/s1i5.png'); ?>" alt=""/>
                            <img id="s1i6" src="<?php echo base_url($own_dir . '/images/slider/s1i6.png'); ?>" alt=""/>
                            <div id="s1t4">Recuerda:</div>
                            <ul id="s1t5" class="stxt">
                                <li>Siempre debes entregar el libro de reclamaciones cuando nos lo soliciten, así la persona que reclame no haya efectuado algún consumo en el local.</li>
                                <li>Si un cliente pregunta por qué no tenemos el libro exhibido en la tienda, le debes explicar que  de acuerdo a ley lo que debe estar exhibido es el <b>letrero (aviso)</b> del libro de reclamaciones. <b>El libro físico lo debemos custodiar en la oficina gerencial y entregarlo cuando sea requerido.</b></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 3  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_3" class="instrucciones">
                <div id="s3tit_1" class="stit_1">PARTE 2</div>
                <div id="s3tit_2" class="stit_2">Llenado del libro de reclamaciones</div>

                <div id="s3t1">A continuación te presentamos el formato 
                    <br>del libro de reclamaciones a fin que puedas 
                    <br>identificar cada uno de sus elementos. 
                    <br><b>Dar click en cada espacio numerado.</b>
                    <br>Debes ingresar y leer  todos los items 
                    <br>de la pantalla para terminar esta sección.</div>
                <div id="s3t2" class="stxt"><span>HAZ CLICK sobre cada punto resaltado <br>para volver a la vista general.</span></div>
                <div id="s3det_1" class="s3det">Aquí el cliente debe colocar la fecha en que se interpone el reclamo.</div>
                <div id="s3det_2" class="s3det">El cliente debe llenar <br>todos sus datos.</div>
                <div id="s3det_3" class="s3det">No olvides pedirle que te deje siempre su correo electrónico. En caso el cliente se niegue, no insistir.</div>
                <div id="s3det_4" class="s3det">Si el cliente es menor de edad, se completarán también los datos de uno de los padres o representantes del menor.</div>
                <div id="s3det_5" class="s3det">Explícale al cliente que debe marcar la opción reclamo si está referido a la disconformidad de los productos o servicios que le prestamos (ej. cuestionamiento a calidad de producto). Si no desea, no insistir.</div>
                <div id="s3det_6" class="s3det">Explícale al cliente que debe marcar la opción queja si no está relacionado  a los productos o servicios que le ofrecemos (ej. mala atención, baños sucios). Si no desea, no insistir.</div>
                <div id="s3det_7" class="s3det">Aquí el cliente colocará el detalle de su reclamo.</div>
                <div id="s3det_8" class="s3det">El cliente indicará qué es lo que concretamente solicita, <br>(ej. "Solicito la devolución de mi dinero").</div>
                <div id="s3det_9" class="s3det">Aquí el cliente colocará su firma.</div>
                <div id="s3det_10" class="s3det">Aquí nosotros debemos colocar la misma fecha en que se interpone el reclamo.</div>
                <div id="s3det_11" class="s3det">
                    <div class="viewport">
                        <div class="overview">
                            Aquí nosotros colocaremos nuestros descargos. Recuerda:
                            <ul>
                                <li>Debemos ser empáticos con el cliente, por lo que inicia tu descargo con la frase: <b>"Nos apena lo que el cliente comenta"</b></li>
                                <li>No indiques frases como “Lamento lo sucedido” ya que puede ser considerado como asunción de responsabilidad.</li>
                                <li>Si el reclamo está referido a calidad de producto indícale que trabajamos con altos estándares en la preparación de nuestros alimentos. Si lo consideras necesario, ofrécele una cortesía u ofrécele la devolución de su dinero como parte de Nuestra Política de Atención al Cliente.</li>
                                <li>Si ofreciste una cortesía que se hará efectiva en otro momento, debes detallar en qué consiste  y el plazo de vigencia (ej. 1 cena formada por 1 plato de fondo más 1 bebida sin alcohol y 1 postre. Válido para hacerlo efectivo hasta el xx.xx.xx).</li>
                                <li>Cuando no tengas una respuesta que dar en ese momento, la mejor respuesta que puedes dar al cliente es: <b>"Se escuchó atentamente el reclamo del cliente y se le indicó que se le brindará una respuesta dentro del plazo legal"</b>. De inmediato infórmalo a tu Gerente de Área para que de atención al reclamo</li>
                            </ul>
                        </div>
                    </div>
                    <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                </div>
                <div id="s3det_12" class="s3det"><b>Es obligatorio</b> consignar sello y firma del Gerente de Turno que atiende el reclamo.</div>
                <div id="s3det_13" class="s3det">Si el cliente aceptara alguna propuesta de solución que le dimos, debe marcar el recuadro. Solo en este caso, no es necesario que firme nuevamente el documento de "Conformidad" que tenemos en tienda.</div>
                <div id="s3det_14" class="s3det">Si el cliente aceptó nuestra propuesta, también debe consignar su firma nuevamente. Si no lo hace, se entiende que no lo aceptó.</div>
                <div id="s3CHoja"><img id="s3Hoja" src="<?php echo base_url($own_dir . '/images/hoja.svg'); ?>" alt=""/></div>
                <div id="s3btn_1" class="s3btn"><div>1</div></div>
                <div id="s3btn_2" class="s3btn"><div>2</div></div>
                <div id="s3btn_3" class="s3btn"><div>3</div></div>
                <div id="s3btn_4" class="s3btn"><div>4</div></div>
                <div id="s3btn_5" class="s3btn"><div>5</div></div>
                <div id="s3btn_6" class="s3btn"><div>6</div></div>
                <div id="s3btn_7" class="s3btn"><div>7</div></div>
                <div id="s3btn_8" class="s3btn"><div>8</div></div>
                <div id="s3btn_9" class="s3btn"><div>9</div></div>
                <div id="s3btn_10" class="s3btn"><div>10</div></div>
                <div id="s3btn_11" class="s3btn"><div>11</div></div>
                <div id="s3btn_12" class="s3btn"><div>12</div></div>
                <div id="s3btn_13" class="s3btn"><div>13</div></div>
                <div id="s3btn_14" class="s3btn"><div>14</div></div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Slider 4  - - - - - - - - - - - - - - - -->
            <div id="sliderPage_4" class="instrucciones">
                <div id="s4tit_1" class="stit_1">PARTE 3</div>
                <div id="s4tit_2" class="stit_2">¿Puedo anular una hoja de reclamacion?</div>
                <div class="cont-carousel">
                    <div class="owl-carousel">
                        <div class="item">
                            <div id="s4t1" class="stxt"><span>Está prohibido anular un reclamo o queja, aun cuando haya <br>sido solucionado en el mismo Libro de Reclamaciones.</span></div>
                            <img id="s4i1" src="<?php echo base_url($own_dir . '/images/slider/s4i1.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s4t2" class="stxt"><span>Sin embargo, existen ciertas situaciones (excepciones) en las <br>que sí es posible anular la hoja del Libro de Reclamaciones, <br>y son las siguientes:</span></div>
                            <img id="s4i2" src="<?php echo base_url($own_dir . '/images/slider/s4i2.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s4t3" class="stxt"><span>Cliente se salta el número de hoja y deja el correlativo anterior <br>en blanco. Por tanto se anula el que dejó en blanco (no hay datos).</span></div>
                            <img id="s4i3" src="<?php echo base_url($own_dir . '/images/slider/s4i3.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s4t4" class="stxt"><span>El cliente solo pone su nombre y no llenó nada más.</span></div>
                            <img id="s4i4" src="<?php echo base_url($own_dir . '/images/slider/s4i4.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s4t5" class="stxt"><span>Se consignó un solo dato (ej: fecha), y no se llenó nada más.</span></div>
                            <img id="s4i5" src="<?php echo base_url($own_dir . '/images/slider/s4i5.png'); ?>" alt=""/>
                        </div>
                        <div class="item">
                            <div id="s4t6" class="stxt"><span>En estos casos, se traza una línea diagonal sobre la hoja. <br><b>Nota: Gerente de Área no olvides que este reclamo también se debe ingresar al SIREC del Indecopi para no afectar la correlatividad de los reclamos.</b></span></div>
                            <img id="s4i6" src="<?php echo base_url($own_dir . '/images/slider/s4i6.png'); ?>" alt=""/>
                        </div>
                    </div>
                </div>
                <div class="btnVolver"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Popup 1  - - - - - - - - - - - - - - - -->
            <div id="popup_1" class="instrucciones">
                <div id="pop1tit_1">Recuerda:</div>
                <ul id="pop1txt_1">
                    <li>El Gerente de Tienda o Turno debe enviar la foto y transcripción al Gerente de Área dentro de las 24 horas de interpuesto el reclamo.</li>
                    <li>El Gerente de Área debe ingresar los reclamos a la Plataforma SIREC siguiendo el flujo establecido.</li>
                    <li>El plazo legal máximo para dar respuesta a los reclamos es de 30 días calendario, prorrogable por 30 días más previo aviso al consumidor y siempre que haya sustento de la prórroga.</li>
                    <li>Si el cliente no te permite llenar tu descargo, no insistas, y repórtaselo de inmediato a tu Gerente de Área para que brinde una respuesta por Servicio al Cliente.</li>
                </ul>
                <div id="pop1btn_1">Entendido</div>
            </div>
        </div>
    </body>
</html>