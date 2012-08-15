<?php $this->load->view('template/header'); ?>
<script>
    $(function() {
        $("#dialog-confirm").dialog({
            autoOpen: false,
            modal: true
        });
        $(".borrar").click(function(e) {
            e.preventDefault();
            var targetUrl = $(this).attr("href");
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "Borrar Cliente": function() {
                        $( this ).dialog( "close" );
                        window.location.href = targetUrl;
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
             $("#dialog-confirm").dialog("open");
        });
    });

</script>

<div class="grid_12 mainbody">
    <h1>Clientes</h1>
    <div class="search">
        <?php echo form_open('clientes/search'); ?>

        <button id="button" class="ui-button ui-widget ui-state-default ui-widget ui-widget-content ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Buscar</span></button>
        <input type="text" name="search" value="" class="ui-corner-all" />
        <?php echo form_close(); ?>
        <a href="<?php echo site_url('clientes/reset') ?>">Reset</span></a>
        <?php if (!empty($search)): ?>
            Se han encontrado <?php echo$total_rows ?> resultados para la busqueda "<?php echo $search ?> "
        <?php endif ?>      
    </div>
    <table id="clientes" >
        <tr>
            <th>   
                <a href="<?php echo site_url('clientes/add/') ?>">
                    Nuevo Cliente
                </a>
            </th>
            <th><span>Nombre</span>
                <span>
                    <a href="<?php echo site_url('clientes/order/nombre/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('clientes/order/nombre/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th><span>Primer Apellido</span>
                <span>
                    <a href="<?php echo site_url('clientes/order/first_apellido/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('clientes/order/first_apellido/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th> 
                <span>Segundo Apellido</span>
                <span>
                    <a href="<?php echo site_url('clientes/order/last_apellido/asc') ?>"><span class="ui-icon ui-icon-triangle-1-s"></span></a>
                    <a href="<?php echo site_url('clientes/order/last_apellido/desc') ?>"><span class="ui-icon ui-icon-triangle-1-n"></span></a>
                </span>
            </th>
            <th> 
                <span>Teléfono</span>
            </th>
            <th> 
                <span>Población</span>
            </th>
        </tr>
        <?php foreach ($query->result() as $row) { ?>
            <tr>
                <td><a href="<?php echo site_url('clientes/edit/' . $row->id) ?>">Editar</a>
                <a href="<?php echo site_url('clientes/erase/' . $row->id) ?>" class="borrar">Borrar</a></td>
                <td><?php echo $row->nombre ?></td>
                <td><?php echo $row->first_apellido ?></td>
                <td><?php echo $row->last_apellido ?></td>
                <td><?php echo $row->telefono_contacto ?></td>
                <td><?php echo getPoblacion($row->poblacion) ?></td>
            </tr>
        <?php } ?>
    </table>
    <div id="dialog-confirm" title="Borrar Cliente">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Vas a borrar un cliente ¿Estas seguro?</p>
    </div>
    <?php echo $paginator ?>
</div>

<?php $this->load->view('template/footer'); ?>
