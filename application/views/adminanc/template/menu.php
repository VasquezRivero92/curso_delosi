<section id="header-cont" class="container">
    <header class="row">
        <ul id="menu">
            <?php if ($this->session->tipo == 'user') {
                echo '<li>' . anchor('main/', 'Ir al curso', array('target' => '_blank')) . '</li>';
            } ?>
            <?php echo '<li>' . anchor('adminanc/', 'Niveles') . '</li>'; ?>
            <?php echo '<li>' . anchor('adminanc/consulta', 'Consulta') . '</li>'; ?>
            <?php
            //if ($this->session->userniv == 4 || $this->session->userniv == 10) {
            //    echo '<li>' . anchor('adminanc/estadisticas', 'Estadísticas') . '</li>';
            //}
            ?>
            <?php echo '<li>' . anchor('adminanc/ranking', 'Ranking') . '</li>'; ?>
<?php echo '<li>' . anchor('adminanc/reporte', 'Reporte') . '</li>'; ?>
<?php echo '<li>' . anchor('login/logout', 'Salir') . '</li>'; ?>
        </ul>
    </header>
</section>