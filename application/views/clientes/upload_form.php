
<div class="clear"></div>    
<?php if (isset($obj)) : ?>
    <div class="grid_12">
        <h2>Archivos</h2>
        <?php echo (isset($error)) ? $error : ""; ?>

        <?php
        $this->load->helper('directory');
        $directory = DATAFOLDER . '/clientes/' . $obj->id . '/';
        $map = directory_map($directory, FALSE, TRUE);
        $this->load->helper('html');
        $attributes = array(
            'class' => 'tree',
            'id' => 'files'
        );
        echo fileList('ul', $map, $attributes, 0, $directory, 'clientes', $obj->id);
        ?>
    </div>  
    <div class="clear"></div>  
    <div class="grid_12">  
        <h2>Subir Archivo</h2>
        <?php echo form_open_multipart('clientes/upload_file'); ?>
        <input type="file" name="userfile" size="20" />
        <input type="hidden" name="clientes_id" value="<?php if (isset($obj)) echo $obj->id; ?>" />
        <input type="submit" value="Subir Archivo" />
        <?php echo form_close(); ?>
    </div>
<?php endif; ?>