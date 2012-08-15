<table id="polizas">
    <tr>
        <th>Ver Poliza</th>
        <th>npoliza</th>
        <th>Ramo</th>
        <th>Modalidad</th>
        <th>Fecha válido hasta</th>
    </tr>
    <?php
    if (isset($polizas)) {
        foreach ($polizas as $row) {
            ?>

            <tr>
                <td><a href="<?php echo site_url('polizas/edit/' . $row['id']) ?>">Ver Poliza</a></td>  
                <td><?php echo $row['npoliza'] ?></td>
                <td><?php echo $row['ramo']->nombre ?></td>
                <td><?php echo $row['modalidad']->nombre ?></td>
                <td><?php echo date('d-m-Y',strtotime($row['fecha_valido_hasta'])) ?></td>

            </tr>
        <?php
        }
    }
    ?>
</table>