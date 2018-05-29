<section id="header-cont" class="container">
    <header class="row">
        <ul id="menu">
            <?php
            if ($this->session->tipo == 'user') {
                echo '<li>' . anchor('main/', 'Ir al curso', array('target' => '_blank')) . '</li>';
            }
            echo '<li>' . anchor('admin/', 'Niveles') . '</li>';
            if ($this->session->userniv > 1) {
                echo '<li>' . anchor('admin/registrar', 'Registro') . '</li>';
            }
            echo '<li>' . anchor('admin/consulta', 'Consulta') . '</li>';
            if ($this->session->userniv > 1) {
                echo '<li>' . anchor('admin/masivo', 'Masivo') . '</li>';
            }
            if ($this->session->userniv > 1) {
                echo '<li>' . anchor('admin/estadisticas', 'Estadísticas') . '</li>';
            }
            ?>
            <?php echo '<li>' . anchor('admin/ranking', 'Ranking') . '</li>'; ?>
            <?php echo '<li>' . anchor('admin/reporte', 'Reporte') . '</li>'; ?>
            <?php echo '<li>' . anchor('login/logout', 'Salir') . '</li>'; ?>
        </ul>
    </header>
</section>