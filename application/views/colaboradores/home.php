<?php $this->load->view('template/header'); ?>
<div class="grid_12 mainbody">
    <h1>Colaboradores</h1>
    <div class="search">
        <?php echo form_open('colaboradores/search'); ?>
        <button id="button" class="ui-button ui-widget ui-state-default  ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Buscar</span></button>  
        <input type="text" name="search" value="" class="ui-corner-all" />   
        <?php echo form_close(); ?>
        <a href="<?php echo site_url('colaboradores/reset') ?>">Reset</span></a>
        <?php if (!empty($search)): ?>
            Se han encontrado <?php echo$total_rows ?> resultados para la busqueda "<?php echo $search ?> "
        <?php endif ?>  
    </div>
    <table id="colaboradores">
        <tr>
            <th><a href="<?php echo site_url('colaboradores/add/') ?>">Nuevo Colaborador</a></th>
            <th>
			<span>N_Colaborador</span>
			<span>
                    <a href="<?php echo site_url('colaboradores/order/N_Colaborador/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('colaboradores/order/N_Colaborador/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span> 
			</th>
               
			   <th> <span>Nombre</span>
                <span>
                    <a href="<?php echo site_url('colaboradores/order/nombre/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('colaboradores/order/nombre/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span> 
            </th>
            <th>
                <span>Primer Apellido</span>
                <span>
                    <a href="<?php echo site_url('colaboradores/order/primer_apellido/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('colaboradores/order/primer_apellido/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span> 
            </th>
            <th>
                <span>Segundo Apellido</span>
                <span>
                    <a href="<?php echo site_url('colaboradores/order/segundo_apellido/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('colaboradores/order/segundo_apellido/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th><span>Teléfono</span></th>
            <th><span>Email</span></th>
            <th><span>Población</span></th>
        </tr>
        <?php foreach ($query->result() as $row) { ?>
            <tr>
                <td><a href="<?php echo site_url('colaboradores/edit/' . $row->id) ?>">Editar</a></td>
				<td><?php echo $row->N_Colaborador ?></td>
                <td><?php echo $row->nombre ?></td>
                <td><?php echo $row->primer_apellido ?></td>
                <td><?php echo $row->segundo_apellido ?></td>
                <td><?php echo $row->telefono ?></td>
                <td><?php echo $row->email ?></td>
                <td><?php echo getPoblacion($row->poblacion) ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php echo $paginator ?>
</div>
<?php $this->load->view('template/footer'); ?>