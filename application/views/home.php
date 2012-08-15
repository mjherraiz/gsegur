<?php $this->load->view('template/header'); ?>
<div class="grid_12 mainbody">
    <h1>Vencimiento de pólizas</h1>
    <table>
        <tr>
            <th>Meses: <?php echo date('m', strtotime('now'))?> al <?php echo date('m', strtotime('60 days'))?> </th>
            <th>Número de póliza</th>
            <th>Nombre</th>
            <th>Primer Apellido</th>
            <th>DNI</th>
            <th>Fecha Válido Hasta</th>
            <th>Teléfono</th>
            <th>Email</th>
        </tr>
        <?php foreach ($polizas as $row) : ?>
            <tr>
                <td><a href="<?php echo site_url('polizas/edit/' . $row->id_poliza) ?>">Ver Póliza</a></td>
                <td><?php echo $row->npoliza . '&nbsp;'; ?></td> 
                <td><?php echo $row->nombre . '&nbsp;'; ?></td> 
                <td><?php echo $row->first_apellido . '&nbsp;'; ?></td> 
                <td><?php echo $row->dni . '&nbsp;'; ?></td> 
                <td><?php echo date('d-m-Y', strtotime($row->fecha_valido_hasta)) . '&nbsp;'; ?></td> 
                <td><?php echo $row->telefono_contacto . '&nbsp;'; ?></td> 
                <td><?php echo $row->email_contacto . '&nbsp;'; ?></td> 
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php $this->load->view('template/footer'); ?>