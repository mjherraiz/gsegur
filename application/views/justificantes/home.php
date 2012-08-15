<?php $this->load->view('template/header'); ?>
<div class="grid_12 mainbody">
    <h1>Comisiones</h1>
    <div class="search">
        <?php echo form_open('justificantes/search'); ?>
        <button id="button" class="ui-button ui-widget ui-state-default ui-widget ui-widget-content ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Buscar</span></button>
        <input type="text" name="search" value="" class="ui-corner-all" />
        <?php echo form_close(); ?>
        <a href="<?php echo site_url('justificantes/reset') ?>">Reset</span></a>
        <?php if (!empty($search)): ?>
            Se han encontrado <?php echo$total_rows ?> resultados para la busqueda "<?php echo $search ?> "
        <?php endif ?>   
    </div>
    <table id="justificantes">
        <tr>
            <th><a href="<?php echo site_url('justificantes/add/') ?>">Nuevo Justificante</a></th>
            <th>
                <span>Id Colaborador</span>
                <span>
                    <a href="<?php echo site_url('justificantes/order/id_colaborador/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('justificantes/order/id_colaborador/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th>
                <span>Nombre colaborador</span>
                <span>
                    <a href="<?php echo site_url('justificantes/order/first_apellido/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('justificantes/order/last_apellido/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th>
                <span>Población colaborador</span>
                <span>
                    <a href="<?php echo site_url('justificantes/order/poblacion/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('justificantes/order/poblacion/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th>
                <span>Número Póliza</span>
                <span>
                    <a href="<?php echo site_url('justificantes/order/npoliza/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('justificantes/order/npoliza/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th>
                <span>Cliente</span>
                <span><a href="<?php echo site_url('justificantes/order/primer_apellido/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('justificantes/order/segundo_apellido/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th><span>Comisión</span></th>
            <th><span>Mes</span>
            </th>
            <th><span>Año</span></th>
        </tr>
        <?php foreach ($query->result() as $row) { ?>
            <tr>
                <td><a href="<?php echo site_url('justificantes/edit/' . $row->id) ?>">Editar</a></td>
                <td><?php echo $row->id_colaborador ?></td>
                <td><?php echo $row->nombre_colaborador . ' ' . $row->primer_apellido . ' ' . $row->segundo_apellido ?></td>
                <td><?php echo $row->poblacion ?></td>
                <td><?php echo $row->npoliza ?></td> 
                <td><?php echo $row->clientes_nombre . ' ' . $row->first_apellido . ' ' . $row->last_apellido ?></td>
                <td><?php echo $row->comision ?></td> 
                <td><?php echo $row->mes ?></td>
                <td><?php echo $row->anyo ?></td>    
            </tr>
        <?php } ?>
    </table>
    <?php echo $paginator ?>
</div>
<?php if(count($query->result())>0):?>
<?php $this->load->view('justificantes/generatepdf'); ?>
<?php endif?>
<?php $this->load->view('template/footer'); ?>
