<?php $this->load->view('template/header'); ?>

<div class="grid_12 mainbody">
    <h1>Polizas</h1>
    <div class="search">
        <?php echo form_open('polizas/search'); ?>

        <button id="button" class="ui-button ui-widget ui-state-default ui-widget ui-widget-content ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Buscar</span></button>
        <input type="text" name="search" value="" class="ui-corner-all" />

        <?php echo form_close(); ?>
        <a href="<?php echo site_url('polizas/reset') ?>">Reset</span></a>
        <?php if (!empty($search)): ?>
            Se han encontrado <?php echo$total_rows ?> resultados para la busqueda "<?php echo $search ?> "
        <?php endif ?>    
    </div>

    <table id="polizas" >
        <tr>
            <th><a href="<?php echo site_url('polizas/add/') ?>">Nueva Póliza</a></th>
            <th>
                <span>Nombre</span>
                <span>
                    <a href="<?php echo site_url('polizas/order/first_apellido/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('polizas/order/first_apellido/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th>
                <span>DNI</span>
                <span>
                    <a href="<?php echo site_url('polizas/order/dni/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('polizas/order/dni/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th>
                <span>Compañia</span>
                <span>
                    <a href="<?php echo site_url('polizas/order/companyia/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('polizas/order/companyia/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th>
                <span>Npoliza</span>
                <span>
                    <a href="<?php echo site_url('polizas/order/npoliza/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('polizas/order/npoliza/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th>
                <span>Ramo</span>
                <span>
                    <a href="<?php echo site_url('polizas/order/ramo/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('polizas/order/ramo/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th><span>Identificador</span></th>
            <th><span>Descripción identificador</span></th>
            <th><span>Riesgo</span></th>
            <th><span>Fecha Validez
                    <span>
                        <a href="<?php echo site_url('polizas/order/fecha_valido_hasta/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                        <a href="<?php echo site_url('polizas/order/fecha_valido_hasta/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                    </span>

                </span></th>
        </tr>
        <?php foreach ($query->result() as $row) { ?>
            <tr>
                <td><a href="<?php echo site_url('polizas/edit/' . $row->id) ?>">Editar</a></td>
                <td><?php echo $row->nombre . ' ' . $row->first_apellido . ' ' . $row->last_apellido ?></td>
                <td><?php echo $row->dni ?></td>
                <td><?php echo $row->companyia ?></td>
                <td><?php echo $row->npoliza ?></td>
                <td><?php echo $row->ramo ?></td> 
                <td><?php echo $row->identificador ?></td>
                <td><?php echo $row->descripcion_identificador ?></td>
                <td><?php echo $row->riesgo ?></td>
                <td><?php echo date("d-m-Y", strtotime($row->fecha_valido_hasta)) ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php echo $paginator ?>
</div>
<?php $this->load->view('template/footer'); ?>