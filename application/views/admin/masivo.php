<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión de usuarios - <?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <!-- <link rel="icon" href="images/favicon.ico" /> -->
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/reset.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/css/base.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/mediastyle.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.ui.touch-punch.min.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/masivo.js'); ?>"></script>
    </head>
    <body style="zoom:1;">
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="masivo-cont" class="container">
                <div class="row">
                    <h2>Registro Masivo</h2><br>
                    <div id="masivo-menu">
                        <div data-id="eduser-c">Actualizar usuarios</div>
                        <div data-id="eduemp-c">Actualizar usuario - empresa</div>
                        <div data-id="deluemp-c">Eliminar usuario - empresa</div>
                        <div data-id="tienda-c">Actualizar tiendas</div>
                    </div><hr>
                    <div id="infoMessage">&nbsp;</div><br>
                    <div id="eduser-c" class="reg-multi">
                        <form id="eduser-form" action="" enctype="multipart/form-data">
                            Descargue el formato Excel para editar usuarios <?php echo anchor('formatos/editar-user.xlsx', 'desde este enlace.'); ?><br><br>
                            <input name="eduserfile" type="file" />
                            <input class="subBTN" type="submit" value="Subir Archivo" /><br><br>
                            <input id="eduser-run" class="runBTN" type="button" value="Actualizar" />
                            <!--<input id="eduser-mail" class="runBTN" type="button" value="Enviar mail masivo" />-->
                        </form>                        
                    </div>
                    <div id="eduemp-c" class="reg-multi">
                        <form id="eduemp-form" action="" enctype="multipart/form-data">
                            Descargue el formato Excel para editar la información usuario-empresa <?php echo anchor('formatos/editar-user-empresa.xlsx', 'desde este enlace.'); ?><br><br>
                            <input name="eduempfile" type="file" />
                            <input class="subBTN" type="submit" value="Subir Archivo" /><br><br>
                            <input id="eduemp-run" class="runBTN" type="button" value="Actualizar" />
                        </form>
                    </div>
                    <div id="deluemp-c" class="reg-multi">
                        <form id="deluemp-form" action="" enctype="multipart/form-data">
                            Descargue el formato Excel para eliminar la información usuario-empresa <?php echo anchor('formatos/eliminar-user-empresa.xlsx', 'desde este enlace.'); ?><br><br>
                            <input name="deluempfile" type="file" />
                            <input class="subBTN" type="submit" value="Subir Archivo" /><br><br>
                            <input id="deluemp-run" class="runBTN" type="button" value="Eliminar registros" />
                        </form>
                    </div>
                    <div id="tienda-c" class="reg-multi">
                        <form id="tienda-form" action="" enctype="multipart/form-data">
                            Descargue el formato Excel para editar tiendas <?php echo anchor('formatos/editar-tienda.xlsx', 'desde este enlace.'); ?><br><br>
                            <input name="tiendafile" type="file" />
                            <input type="submit" value="Subir Archivo" /><br><br>
                            <input id="tienda-run" class="runBTN" type="button" value="Actualizar" />
                        </form>
                    </div>
                    <br><br>S.C. = sin cambios<br>
                    <div id="exc-tabla">                                        
                    </div>
                    <table id="info">
                            <tr>
                                <th>Nuevos</th>
                                <th>Existentes</th> 
                                <th>Recibidos</th> 
                                <!-- <th>Faltantes</th>  -->
                            </tr>
                            <tr>
                                <td id="nuevos">0</td>
                                <td id="existentes">0</td>
                                <td id="recibidos">0</td>
                                <!-- <td id="faltantes">0</td> -->
                            </tr>
                    </table>
                    
                </div>
            </section>
        </div>
    </body>
</html>