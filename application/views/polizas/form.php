<?php $this->load->view('template/header'); ?>
<script>
    $(function() {
        $( "#fecha_valido_hasta" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'dd-mm-yy',
            yearRange: "1930:2100"
        });
        $( "#fecha_efecto" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'dd-mm-yy',
            yearRange: "1930:2100"
        });
    });

    $(function() {  
        $( "#clientes_id" ).combobox();
        $( "#ramos_id" ).combobox();
        $( "#companyias_id" ).combobox();
        $( "#modalidades_id" ).combobox();
        $( "#colaboradores_id" ).combobox();
        $( "#segundo_titular" ).combobox();
         
    });
</script>
<div class="grid_12 mainbody">
    <h1>Editar Poliza</h1>
    <?php echo form_open('polizas/save'); ?>

    <input type="hidden" name="id" value="<?php echo (!is_null($obj)) ? $obj->id : ""; ?>" />
    <div class="grid_6">
        <fieldset class="">
            <legend>Poliza</legend>
            <label for="companyias_id">Compañía</label>
            <div class="clear"></div>
            <?php echo (!is_null($obj)) ? comboCompanyia($obj->companyias_id) : comboCompanyia(); ?>
            <div class="clear"></div>
            <label for="npoliza">Número de póliza</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content  ui-corner-all"  type="text" name="npoliza" value="<?php echo (!is_null($obj)) ? $obj->npoliza : ""; ?>" /> 
            <div class="clear"></div>
            <label for="suplemento">Suplemento</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="suplemento" value="<?php echo (!is_null($obj)) ? $obj->suplemento : ""; ?>" /> 
            <div class="clear"></div>
            <label for="ramos_id">Ramo</label>
            <div class="clear"></div>
            <?php echo (!is_null($obj)) ? comboRamos($obj->ramos_id) : comboRamos(); ?>
            <div class="clear"></div>
            <label for="modalidades_id">Modalidad</label>
            <div class="clear"></div>
            <?php echo (!is_null($obj)) ? comboModalidades($obj->modalidades_id) : comboModalidades(); ?>
            <div class="clear"></div>
            <label for="riesgo">Riesgo</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="riesgo" value="<?php echo (!is_null($obj)) ? $obj->riesgo : ""; ?>" /> 
            <div class="clear"></div>
            <label for="identificador">Identificador</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="identificador" value="<?php echo (!is_null($obj)) ? $obj->identificador : ""; ?>" /> 
            <div class="clear"></div>
            <label for="descripcion_identificador">Descripción identificador</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="descripcion_identificador" value="<?php echo (!is_null($obj)) ? $obj->descripcion_identificador : ""; ?>" /> 
            <div class="clear"></div>
            <label for="fecha_efecto">Fecha de efecto</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="fecha_efecto" id="fecha_efecto" value="<?php echo (!is_null($obj)) ? date("d-m-Y", strtotime($obj->fecha_efecto)) : ""; ?>" /> 
            <div class="clear"></div>
            <label for="fecha_valido_hasta">Fecha de válido hasta</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="fecha_valido_hasta" id="fecha_valido_hasta" value="<?php echo (!is_null($obj)) ? date("d-m-Y", strtotime($obj->fecha_valido_hasta)) : ""; ?>" /> 
            <div class="clear"></div>
            <label for="vitalicio">Vitalicio</label>
            <input type="checkbox" id="vitalicio" name="vitalicio[]" value="1" <?php echo (!is_null($obj) && $obj->vitalicio == 1) ? 'checked' : ' ' ?> />
            <div class="clear"></div>
        </fieldset>
    </div>
    <div class="grid_6"> 
        <fieldset class="">
            <legend class="">Cliente</legend>
            <label for="clientes_id">Cliente</label>
            <div class="clear"></div>
            <?php echo (!is_null($obj)) ? comboClientes($obj->clientes_id) : comboClientes(); ?>
            <div class="clear"></div>
            <label for="n_cuenta">Número de cuenta</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="n_cuenta" value="<?php echo (!is_null($obj)) ? $obj->n_cuenta : ""; ?>" /> 
            <div class="clear"></div>
            <label for="segundo_titular">Segundo titular</label>
            <div class="clear"></div>
            <?php echo (!is_null($obj)) ? combosegundo_titular($obj->segundo_titular) : combosegundo_titular(); ?>
            <div class="clear"></div>
            <label for="descripcion_segundo_titular">Descripción segundo titular</label>
            <div class="clear"></div>
            <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="descripcion_segundo_titular" value="<?php echo (!is_null($obj)) ? $obj->descripcion_segundo_titular : ""; ?>" /> 
            <div class="clear"></div>
        </fieldset>
        <fieldset class="">
            <legend class="">Colaborador</legend>
            <label for="colaboradores_id">Colaborador</label>
            <div class="clear"></div>
            <?php echo (!is_null($obj)) ? comboColaboradores($obj->colaboradores_id) : comboColaboradores(); ?>
            <div class="clear"></div>
        </fieldset>
    </div>
    <div class="clear"></div>
    <button id="button" class="ui-button ui-widget ui-state-default ui-widget ui-widget-content ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"><?php echo lang('enviar'); ?></span></button>
    <?php echo form_close(); ?>
</div>
<div class="clear"></div>
<?php $this->load->view('polizas/upload_form'); ?>
<?php $this->load->view('template/footer'); ?>