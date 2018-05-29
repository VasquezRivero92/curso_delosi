<div>
    <h1>Código de cambio de contraseña</h1>
    <p>Usuario: <?php echo mb_strtoupper($apat) . ' ' . mb_strtoupper($amat) . ', ' . mb_strtoupper($nombre); ?></p>
    <p>Email: <?php echo mb_strtolower($email); ?></p>
    <p>Código para cambiar la contraseña: <?php echo $forgotten_password_code; ?></p>
    <p><a href="http://www.aprendiendoaprevenir.com/login">Ingrese aquí</a> para cambiar su contraseña</p>
</div>