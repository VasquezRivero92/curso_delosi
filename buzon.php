<div>
    <h2>Consulta en el buzon de prevención</h2>
    <br>
    <table>
        <tr>
            <td>Apellido paterno: </td><td><?php echo mb_strtoupper($apat); ?></td>
        </tr>
        <tr>
            <td>Apellido materno: </td><td><?php echo mb_strtoupper($amat); ?></td>
        </tr>
        <tr>
            <td>Nombres: </td><td><?php echo mb_strtoupper($nombre); ?></td>
        </tr>
        <tr>
            <td>DNI: </td><td><?php echo mb_strtolower($dni); ?></td>
        </tr>
        <?php if (isset($email)) { ?>
            <tr>
                <td>Correo: </td><td><?php echo $email; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Empresa: </td><td><?php echo mb_strtoupper($empresa); ?></td>
        </tr>
        <tr>
            <td>Area: </td><td><?php echo mb_strtoupper($area); ?></td>
        </tr>
        <tr>
            <td>Departamento: </td><td><?php echo mb_strtoupper($departamento); ?></td>
        </tr>
        <tr>
            <td>Cargo: </td><td><?php echo mb_strtoupper($cargo); ?></td>
        </tr>
        <tr>
            <td>Planilla: </td><td><?php echo mb_strtoupper($planilla); ?></td>
        </tr>
        <tr>
            <td>Sede: </td><td><?php echo mb_strtoupper($sede); ?></td>
        </tr>
        <tr>
            <td>Sección: </td><td><?php echo mb_strtoupper($seccion); ?></td>
        </tr>
        <tr>
            <td>Consulta: </td><td><?php echo $consulta; ?></td>
        </tr>
    </table>
</div>