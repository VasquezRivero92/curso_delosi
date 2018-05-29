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
                    <div id="tPreg_1" class="tPreg"><span>Si un cliente sufre el hurto de su cartera por un tercero ajeno a nuestra empresa, y te exige que le entregues los videos:</span></div>
                    <div id="btnPlay_1" class="btnPlay"></div>
                    <div id="btn_1_1" class="btn"><span>a) Le explicas que debe poner su denuncia en la Comisaría más cercana a fin que la Policía nos lo requiera mediante un oficio.</span></div>
                    <div id="btn_1_2" class="btn"><span>b) Le dices que no puedes, pero le permites tomar fotos como muestra de empatía.</span></div>
                    <div id="btn_1_3" class="btn"><span>c) Le dices que sí puedes, y que se lo harás llegar tan pronto coordines la descarga.</span></div>
                </div>
                <div id="gPreg_2" class="gPreg">
                    <div id="ciPreg_2" class="ciPreg"><div id="imgPreg_2" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q2.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_2" class="tPreg"><span>Marca LAS CORRECTAS. Si ocurre un accidente de un cliente, y es trasladada a un Centro Médico, debemos:</span></div>
                    <div id="btnPlay_2" class="btnPlay"></div>
                    <div id="btn_2_1" class="btn"><span>a) Llevar la Hoja de Reclamo de Accidentes Personales debidamente llenada y firmada por el administrador de la tienda o área, incluyendo el sello de la cadena.</span></div>
                    <div id="btn_2_2" class="btn"><span>b) Comunicarnos con nuestro bróker y nuestro Gerente de Área.</span></div>
                    <div id="btn_2_3" class="btn"><span>c) Tomar fotos a todos los documentos que se emitan.</span></div>
                    <div id="btn_2_4" class="btn"><span>d) Todas son correctas.</span></div>
                </div>
                <div id="gPreg_3" class="gPreg">
                    <div id="ciPreg_3" class="ciPreg"><div id="imgPreg_3" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q3.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_3" class="tPreg"><span>Marca LA INCORRECTA. A fin de evitar consumos no reconocidos, debemos:</span></div>
                    <div id="btnPlay_3" class="btnPlay"></div>
                    <div id="btn_3_1" class="btn"><span>a) Pedirle al cliente que consigne su firma de manera similar a la que figura en su DNI.</span></div>
                    <div id="btn_3_2" class="btn"><span>b) Esperar a que nos llegue la denuncia por consumos no reconocidos.</span></div>
                    <div id="btn_3_3" class="btn"><span>c) Revisar que la persona que nos entrega la tarjeta sea quien figura en el DNI.</span></div>
                </div>
                <div id="gPreg_4" class="gPreg">
                    <div id="ciPreg_4" class="ciPreg"><div id="imgPreg_4" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q4.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_4" class="tPreg"><span>MARCA LAS CORRECTAS. Si un cliente indica que la pieza de pollo está en mal estado debemos:</span></div>
                    <div id="btnPlay_4" class="btnPlay"></div>
                    <div id="btn_4_1" class="btn"><span>a) Indicarle nuestro speech de calidad de producto.</span></div>
                    <div id="btn_4_2" class="btn"><span>b) Tratar de recuperar el producto.</span></div>
                    <div id="btn_4_3" class="btn"><span>c) Ofrecerle la devolución de su dinero o una cortesía de ser conveniente.</span></div>
                    <div id="btn_4_4" class="btn"><span>d) Todas son correctas.</span></div>
                </div>
                <div id="gPreg_5" class="gPreg">
                    <div id="ciPreg_5" class="ciPreg"><div id="imgPreg_5" class="imgPreg"><img src="<?php echo base_url($own_dir . '/images/pregs/q5.png'); ?>" alt=""/></div></div>
                    <div id="tPreg_5" class="tPreg"><span>Marca LA INCORRECTA. Si ante un reclamo por supuesto producto descompuesto, llego a recuperar el producto, debo:</span></div>
                    <div id="btnPlay_5" class="btnPlay"></div>
                    <div id="btn_5_1" class="btn"><span>a) Desecharlo inmediatamente.</span></div>
                    <div id="btn_5_2" class="btn"><span>b) Comunicarme con mi Gerente de Área a fin que active al área de calidad.</span></div>
                    <div id="btn_5_3" class="btn"><span>c) Tomar en cuentas las indicaciones del área de calidad para la conservación del producto.</span></div>
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
                        <?php echo anchor('main', '&nbsp;', array('id' => 'btnContinuar')); ?>
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