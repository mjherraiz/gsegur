<div class="clear"></div>
<script>

    $(function() {
        $( "#anyo" ).combobox();  
        $( "#mes" ).combobox();
        $( "#colaboradores_id" ).combobox();
         
    });
</script>

    <?php echo form_open('justificantes/generate'); ?>
    <fieldset  class="ui-widget">
        <legend>Generar Justificante</legend>
        <div class="clear"></div>
        <div class="ui-widget combo">
            <label for="mes">Mes</label>
            <div class="clear"></div>
            <?php echo comboMes(); ?>
        </div>
        <div class="clear"></div>
        <div class="ui-widget combo">
            <label for="anyo">Año</label>
            <div class="clear"></div>
            <?php echo comboAnyo(); ?>
        </div>
        <div class="clear"></div>
        <div class="ui-widget combo">
            <?php echo lang('label_colaboradores_id', 'colaboradores_id'); ?>
            <div class="clear"></div>
            <?php echo comboColaboradores(); ?> 
        </div>
        <div class="clear"></div>
        <button id="button" class="ui-button ui-widget ui-state-default ui-widget ui-widget-content ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Generar Justificante</span></button>
    </fieldset>   
    <?php echo form_close(); ?>

<div class="clear"></div>
