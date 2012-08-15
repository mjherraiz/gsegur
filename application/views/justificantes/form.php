<?php $this->load->view('template/header'); ?>
<script>
    $(function() {
        $( "#anyo" ).combobox();	
    });
    $(function() {
        $( "#mes" ).combobox();
    });
    $(function() {
        $( "#polizas_id" ).combobox();
    });
</script>
<div class="grid_12 mainbody">
    <h1>Editar Comisión</h1>
    <?php echo form_open('justificantes/save'); ?>
    <fieldset class="ui-widget">
        <legend class="ui-widget">Justificantes</legend>
        <input type="hidden" name="id" value="<?php if (!is_null($obj))
        echo $obj->id;
    ?>" />
        <div class="clear"></div>
        <label for="comision">Comision</label>
        <div class="clear"></div>
        <input class="ui-widget ui-widget-content ui-corner-all"  type="text" name="comision" value="<?php if (!is_null($obj))
                   echo $obj->comision;
    ?>" />
        <div class="clear"></div>
        <label for="polizas_id">Poliza</label>
        <div class="clear"></div>
        <?php
        if (!is_null($obj)) {
            echo comboPolizas($obj->polizas_id);
        } else {
            echo comboPolizas();
        }
        ?>
        <div class="clear"></div>
        <label for="anyo">Año</label>
        <div class="clear"></div>
        <?php
        if (!is_null($obj)) {
            echo comboAnyo($obj->anyo);
        } else {
            echo comboAnyo();
        }
        ?>
        <div class="clear"></div>
        <label for="mes">Mes</label>
        <div class="clear"></div>
        <?php
        if (!is_null($obj)) {
            echo comboMes($obj->mes);
        } else {
            echo comboMes();
        }
        ?>
        <div class="clear"></div>
        <button id="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Enviar</span></button>
    </fieldset>
<?php echo form_close(); ?></div>
<?php $this->load->view('template/footer'); ?>