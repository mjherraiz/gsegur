<?php $this->load->view('template/header'); ?>
<script>
    $(function() {

        $( "#provincia" ).combobox({ 
            selected: function(event, ui) {
                $( "#poblacion > option" ).remove();     
                $( "#poblacion + input" ).val('');  
                $.getJSON('<?php echo site_url('clientes/getlocalidades') ?>/'+ui.item.value+'/',
                function(data){
                    $.each(data, function(i,item){
                        $('<option value="'+item.idpoblacion+'">'+item.poblacion+'</option>').appendTo("#poblacion");
                    });
                });
                
            }});
        $( "#poblacion" ).combobox();
        $( "#tipo" ).combobox();
        $( "#fecha_nacimiento" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'dd-mm-yy',
            yearRange: "1930:2100"
        });
		$( "#fecha_carnet" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'dd-mm-yy',
            yearRange: "1930:2100"
        });
    });
</script>
<div class="grid_12 mainbody">
    <h1>Editar Cliente</h1>
    <?php echo form_open('clientes/save'); ?>
    <div class="grid_6">
        <fieldset class="">
            <legend>Cliente</legend>
            <input type="hidden" name="id" value="<?php echo (!is_null($obj)) ? $obj->id : ""; ?>" />
            <label for="tipo">Tipo</label>
            <div class="clear"></div>
            <?php echo (!is_null($obj)) ? comboTipo($obj->tipo) : comboTipo(); ?> 
            <div class="clear"></div>
            <label for="nombre">Nombre</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all" type="text" name="nombre" value="<?php echo (!is_null($obj)) ? $obj->nombre : ""; ?>" />
            <div class="clear"></div>
            <label  for="first_apellido">Primer apellido</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="first_apellido" value="<?php echo (!is_null($obj)) ? $obj->first_apellido : ""; ?>" />
            <div class="clear"></div>
            <label for="last_apellido">Segundo apellido</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="last_apellido" value="<?php echo (!is_null($obj)) ? $obj->last_apellido : ""; ?>" />
            <div class="clear"></div>
            <label for="fecha_carnet">Fecha de carnet</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" id="fecha_carnet" name="fecha_carnet" value="<?php echo (!is_null($obj)) ? date("d-m-Y", strtotime($obj->fecha_carnet)) : ""; ?>" />
	    <div class="clear"></div>
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo (!is_null($obj)) ? date("d-m-Y", strtotime($obj->fecha_nacimiento)) : ""; ?>" />
            <div class="clear"></div>
            <label for="dni">DNI/CIF</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="dni" value="<?php echo (!is_null($obj)) ? $obj->dni : ""; ?>" />
        </fieldset>
    </div>
    <div class="grid_6">
        <fieldset class="">
            <legend>Contacto</legend>
            <label for="nombre_contacto">Nombre de contacto</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="nombre_contacto" value="<?php echo (!is_null($obj)) ? $obj->nombre_contacto : ""; ?>" />
            <div class="clear"></div>
            <label for="first_apellidos_contacto">Primer apellido de contacto</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="first_apellidos_contacto" value="<?php echo (!is_null($obj)) ? $obj->first_apellidos_contacto : ""; ?>" />
            <div class="clear"></div>
            <label for="last_apellidos_contacto">Segundo apellido de contacto</label>
            <div class="clear"></div>       
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="last_apellidos_contacto" value="<?php echo (!is_null($obj)) ? $obj->last_apellidos_contacto : ""; ?>" />
            <div class="clear"></div>
            <label for="telefono_contacto">Teléfono de contacto</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="telefono_contacto" value="<?php echo (!is_null($obj)) ? $obj->telefono_contacto : ""; ?>" />
            <div class="clear"></div>
            <label for="email_contacto">email de contacto</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="email_contacto" value="<?php echo (!is_null($obj)) ? $obj->email_contacto : ""; ?>" />
            <div class="clear"></div>
            <label for="direccion">Dirección</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="direccion" value="<?php echo (!is_null($obj)) ? $obj->direccion : ""; ?>" />
            <div class="clear"></div>               
            <label for="codigo_postal">Código postal</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="codigo_postal" value="<?php echo (!is_null($obj)) ? $obj->codigo_postal : ""; ?>" />
            <div class="clear"></div>
            <?php echo (!is_null($obj)) ? comboLocalizaciones($obj->poblacion) : comboLocalizaciones(); ?> 
        </fieldset>
    </div>
    <div class="grid_12">
        <fieldset class="">
            <legend>Notas</legend>
            <div class="clear"></div>
            <textarea class="ui-widget ui-widget-content ui-corner-all"  name="notas" rows="4" cols="20"><?php echo (!is_null($obj)) ? $obj->notas : ""; ?></textarea>
            <div class="clear"></div>
        </fieldset>
    </div>
    <div class="clear"></div>
    <button id="button" class="ui-button ui-widget ui-state-default ui-widget ui-widget-content ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Guardar</span></button>
</fieldset>   
<?php echo form_close(); ?>
<div class="clear"></div>
<h2>Pólizas</h2>
<?php $this->load->view('polizas/list'); ?>
</div>
<?php $this->load->view('clientes/upload_form'); ?>
<?php $this->load->view('template/footer'); ?>