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
        <script src="<?php echo base_url($own_dir . '/js/ranking.js'); ?>"></script>
    </head>
    <body style="zoom:1;" class="rank-body">
        <div id="fullcont" class="clearfix">
            <?php echo $admin_menu; ?>
            <section id="ranking-cont" class="container<?php
            if ($this->session->userniv < 3) {
                echo ' noselect';
            }
            ?>">
                <div class="row superwidth">
                    <h2>Ranking de usuarios</h2>
                    <?php echo anchor('admin/reporte_ranking', 'GENERAR REPORTE', array('id' => 'ranking-reporte')); ?>
                    <?php foreach ($areas as $itm) { ?>
                        <br><br>
                        <h3><?php echo $itm->nombre ?></h3><br>
                        <?php
                        if (count($top[$itm->nombre]) < 1) {
                            echo 'Sin resultados<br>';
                            continue;
                        }
                        ?>
                        <table>
                            <tr>
                                <th>N&ordm;</th><th>Ap. paterno</th><th>Ap. materno</th><th>Nombres</th><th>Email</th>
                                <?php
                                foreach ($cursos as $cur) {
                                    echo '<th>' . $cur->descrip . '</th><!--<th>Visto</th>-->';
                                }
                                ?>
                                <th>Total</th><th>Fecha</th>
                            </tr>
                            <?php
                            foreach ($top[$itm->nombre] as $i => $usr) {
                                echo '<tr>';
                                echo '<td>' . ($i + 1) . '</td>';
                                echo '<td>' . $usr['apat'] . '</td>';
                                echo '<td>' . $usr['amat'] . '</td>';
                                echo '<td>' . $usr['nombre'] . '</td>';
                                echo '<td>' . $usr['email'] . '</td>';
                                foreach ($cursos as $cur) {
                                    echo '<td>' . $usr['c' . $cur->id] . '</td>';
                                }
                                echo '<td>' . $usr['total'] . '</td>';
                                echo '<td>' . date('d-m-Y', $usr['fecha']) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </table><br>
                    <?php } ?>
                </div>
            </section>
        </div>
    </body>
</html>