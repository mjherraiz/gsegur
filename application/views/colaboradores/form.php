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
    });
</script>
<div class="grid_12 mainbody">
    <h1>Editar Colaborador</h1>
    <?php echo form_open('colaboradores/save'); ?>

    <fieldset class="">
        <legend class="">Colaborador</legend>
        <input type="hidden" name="id" value="<?php echo (!is_null($obj)) ? $obj->id : ""; ?>" />
		<label for="N_Colaborador">N Colaborador</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="N_Colaborador" value="<?php echo (!is_null($obj)) ? $obj->N_Colaborador : ""; ?>" />
        <div class="clear"></div>
		
        <label for="nombre">Nombre</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="nombre" value="<?php echo (!is_null($obj)) ? $obj->nombre : ""; ?>" />
        <div class="clear"></div>
        <label for="primer_apellido">Primer apellido</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="primer_apellido" value="<?php echo (!is_null($obj)) ? $obj->primer_apellido : ""; ?>" />
        <div class="clear"></div>
        <label for="segundo_apellido">Segundo apellido</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="segundo_apellido" value="<?php echo (!is_null($obj)) ? $obj->segundo_apellido : ""; ?>" />
        <div class="clear"></div>
        <label for="direccion">Dirección</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="direccion" value="<?php echo (!is_null($obj)) ? $obj->direccion : ""; ?>" />
        <div class="clear"></div>
        <?php echo (!is_null($obj)) ? comboLocalizaciones($obj->poblacion) : comboLocalizaciones(); ?> 

        <label for="codigo_postal">Código postal</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="codigo_postal" value="<?php echo (!is_null($obj)) ? $obj->codigo_postal : ""; ?>" />
        <div class="clear"></div>
        <label for="telefono">Teléfono</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="telefono" value="<?php echo (!is_null($obj)) ? $obj->telefono : ""; ?>" />
        <div class="clear"></div>
        <label for="email">email</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="email" value="<?php echo (!is_null($obj)) ? $obj->email : ""; ?>" />
    </fieldset>
    <div class="clear"></div>
    <button id="button" class="ui-button ui-widget ui-state-default  ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Guardar</span></button>
    <?php echo form_close(); ?> 
</div>
<?php $this->load->view('template/footer'); ?>
