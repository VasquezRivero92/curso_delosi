<div>
    <h2>Actualización de registro</h2>
    <br>
    <table>
        <tr>
            <td>Apellido paterno: </td>
            <td><?php echo mb_strtoupper($apat); ?></td>
        </tr>
        <tr>
            <td>Apellido materno: </td>
            <td><?php echo mb_strtoupper($amat); ?></td>
        </tr>
        <tr>
            <td>Nombres: </td>
            <td><?php echo mb_strtoupper($nombre); ?></td>
        </tr>
        <tr>
            <td>DNI: </td>
            <td><?php echo mb_strtolower($dni); ?></td>
        </tr>
        <?php if (isset($password)) { ?>
            <tr>
                <td>Contraseña: </td>
                <td><?php echo $password; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Enlace: </td>
            <td><a href="http://www.aprendiendoaprevenir.com/login">Ingrese aquí</a></td>
        </tr>
    </table>
</div>