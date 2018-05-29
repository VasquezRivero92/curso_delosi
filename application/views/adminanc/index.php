<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión de usuarios - <?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
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
        <script src="<?php echo base_url($own_dir . '/js/main.js'); ?>"></script>
    </head>
    <body style="zoom:1;">
        <div id="fullcont">
            <?php echo $admin_menu; ?>
            <section id="main-cont" class="container">
                <div class="row">
                    <?php if ($this->session->userniv > 1): ?>
<!--                        <h2>Gestión de niveles</h2>-->
                        <br>
                        <table id="t-cursos">
                            <?php foreach ($cursos as $cur): ?>
                                <tr>
                                    <td class="r-nombre"><?php echo $cur->nombre; ?></td>
                                    <td class="r-check">
                                        <?php
                                        if ($cur->estado) {
                                            $check = array('', 'selected="true"');
                                        } else {
                                            $check = array('selected="true"', '');
                                        }
                                        ?>
                                        <select id="selcur-<?php echo $cur->id; ?>" class="selcur">
                                            <option value="0" <?php echo $check[0]; ?>>Inactivo</option> 
                                            <option value="1" <?php echo $check[1]; ?>>Activo</option>
                                        </select>
                                    </td>
                                    <td class="r-update">
                                        <span id="btnupdate-<?php echo $cur->id; ?>" class="btnupdate">Actualizar</span>
                                        <img id="loadupdate-<?php echo $cur->id; ?>" class="loadupdate" src="<?php echo base_url($own_dir . '/img/loading.gif'); ?>" alt=""/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </body>
</html>