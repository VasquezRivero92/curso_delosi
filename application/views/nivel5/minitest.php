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
            var grupo = '<?php echo $this->session->grupo; ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/controlTiempo.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/juego1.js'); ?>"></script>
    </head>
    <?php $avatar = 'av' . $this->session->avatar; ?>
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
            <div id="instrucciones_5" class="instrucciones">
                <div id="btnJugar"></div>
            </div>
            <!-- - - - - - - - - - - - - - - -  Juego  - - - - - - - - - - - - - - - -->
            <div id="gamePreg" class="game">
                <div id="gPreg_1" class="gPreg">
                    <div id="ciPreg_1" class="ciPreg"><div id="imgPreg_1" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q1.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_1" class="tPreg"><span>Si un cliente te indica por qué no tienes el libro de reclamaciones exhibido, tú debes responderle:</span></div>
                    <div id="btnPlay_1" class="btnPlay"></div>
                    <div id="btn_1_1" class="btn"><span>a) Lo siento mucho, tiene razón. En este momento le traigo el libro.</span></div>
                    <div id="btn_1_2" class="btn"><span>b) Disculpe, lo que tiene que estar exhibido es el <b>Aviso</b> del Libro de reclamaciones, no el mismo libro, conforme a Ley. Por lo cual, ni bien me lo solicitó, yo se lo traje.</span></div>
                    <div id="btn_1_3" class="btn"><span>c) No lo tengo porque está guardado en la oficina. Sin embargo, ahora se lo traigo.</span></div>
                </div>
                <div id="gPreg_2" class="gPreg">
                    <div id="ciPreg_2" class="ciPreg"><div id="imgPreg_2" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q2.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_2" class="tPreg"><span>Si el cliente aceptara la propuesta de solución aceptada por nosotros, debe:</span></div>
                    <div id="btnPlay_2" class="btnPlay"></div>
                    <div id="btn_2_1" class="btn"><span>a) Marcar el casillero de “Acuerdo aceptado para solucionar el reclamo”, y consignar su firma.</span></div>
                    <div id="btn_2_2" class="btn"><span>b) Colocar su firma en la Sección de “Acciones Tomadas por el Proveedor”.</span></div>
                    <div id="btn_2_3" class="btn"><span>c) No debe firmar nada.</span></div>
                </div>
                <div id="gPreg_3" class="gPreg">
                    <div id="ciPreg_3" class="ciPreg"><div id="imgPreg_3" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q3.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_3" class="tPreg"><span>Si un cliente solicita el libro de reclamaciones, el Gerente de Turno debe:</span></div>
                    <div id="btnPlay_3" class="btnPlay"></div>
                    <div id="btn_3_1" class="btn"><span>a) Decirle que espere un poco, que tú puedes solucionar su problema.</span></div>
                    <div id="btn_3_2" class="btn"><span>b) Decirle que  se lo traerás en seguida y llamar al Gerente de Área para ir coordinando la respuesta al reclamo.</span></div>
                    <div id="btn_3_3" class="btn"><span>c) Decirle que no se lo puedo entregar.</span></div>
                </div>
                <div id="gPreg_4" class="gPreg">
                    <div id="ciPreg_4" class="ciPreg"><div id="imgPreg_4" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q4.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_4" class="tPreg"><span>Una vez interpuesto el reclamo, el Gerente de Turno debe:</span></div>
                    <div id="btnPlay_4" class="btnPlay"></div>
                    <div id="btn_4_1" class="btn"><span>a) Remitir el formato e imagen al Gerente de Área dentro de las 24 horas de interpuesto adjuntando la foto y transcripción.</span></div>
                    <div id="btn_4_2" class="btn"><span>b) Lo debo reportar de forma mensual a mi Gerente de Área.</span></div>
                    <div id="btn_4_3" class="btn"><span>c) Lo debo reportar cada semana a mi Gerente de Área.</span></div>
                </div>
                <div id="gPreg_5" class="gPreg">
                    <div id="ciPreg_5" class="ciPreg"><div id="imgPreg_5" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q5.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_5" class="tPreg"><span>Es un supuesto por el que puedo anular un reclamo:</span></div>
                    <div id="btnPlay_5" class="btnPlay"></div>
                    <div id="btn_5_1" class="btn"><span>a) Se dio por solucionado el reclamo del cliente.</span></div>
                    <div id="btn_5_2" class="btn"><span>b) El cliente por error se saltó una hoja del libro.</span></div>
                    <div id="btn_5_3" class="btn"><span>c) No entendí la letra del cliente.</span></div>
                </div>
                <div id="gPreg_6" class="gPreg">
                    <div id="ciPreg_6" class="ciPreg"><div id="imgPreg_6" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q6.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_6" class="tPreg"><span>Si el cliente no me dejó escribir en la sección de “Acciones Tomadas al Proveedor”, el Gerente de Turno debe:</span></div>
                    <div id="btnPlay_6" class="btnPlay"></div>
                    <div id="btn_6_1" class="btn"><span>a) Dar por solucionado el reclamo ya que no me dejó escribir.</span></div>
                    <div id="btn_6_2" class="btn"><span>b) Dar respuesta en mi copia del libro de reclamaciones.</span></div>
                    <div id="btn_6_3" class="btn"><span>c) Comunicarle a la brevedad a mi Gerente de Área a fin que coordine una respuesta con Servicio al Cliente.</span></div>
                </div>
                <div id="gPreg_7" class="gPreg">
                    <div id="ciPreg_7" class="ciPreg"><div id="imgPreg_7" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q7.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_7" class="tPreg"><span>Marca LA INCORRECTA. Si el cliente encuentra un cabello en su producto, y coloca el libro de reclamaciones por dicho hecho, una posible respuesta puede ser:</span></div>
                    <div id="btnPlay_7" class="btnPlay"></div>
                    <div id="btn_7_1" class="btn"><span>a) “Lamentamos lo sucedido, generalmente nunca nos pasa”.</span></div>
                    <div id="btn_7_2" class="btn"><span>b) “Nuestra empresa cuenta con altos estándares de calidad y estrictos procesos de control en la preparación de alimentos”.</span></div>
                    <div id="btn_7_3" class="btn"><span>c) “Como parte de nuestra Política de Atención al cliente, le ofrecimos la devolución de su dinero, lo cual fue aceptado por el cliente”.</span></div>
                </div>
                <div id="gPreg_8" class="gPreg">
                    <div id="ciPreg_8" class="ciPreg"><div id="imgPreg_8" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q8.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_8" class="tPreg"><span>Marca LA INCORRECTA. Si en caso le ofrecieras al cliente una cortesía para revertir su experiencia con la marca, debo</span></div>
                    <div id="btnPlay_8" class="btnPlay"></div>
                    <div id="btn_8_1" class="btn"><span>a) Delimitar la cortesía indicando detalladamente en qué consiste e indicando el periodo de vigencia.</span></div>
                    <div id="btn_8_2" class="btn"><span>b) Solamente le indico que regrese cuando guste.</span></div>
                    <div id="btn_8_3" class="btn"><span>c) Hacer seguimiento a que se haga efectiva la cortesía ofrecida a través del Gerente de Área.</span></div>
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
                <div id="icon_6" class="iconCheck"></div>
                <div id="icon_7" class="iconCheck"></div>
                <div id="icon_8" class="iconCheck"></div>
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
                        <?php echo anchor('reclamosfrecuentes_2', '&nbsp;', array('id' => 'btnContinuar')); ?>
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