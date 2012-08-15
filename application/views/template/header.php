<?php doctype(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Aucar</title>
        <?php echo $assets; ?>

    </head>
    <body>
        <div class="container_12 gsegur">
            <div class="grid_12 header"> 
                <a href="<?php echo base_url('index.php'); ?>"><img title="GSegur" width="150px"src="<?php echo base_url($this->config->item('logo')); ?>"/></a>
                <div class="menu"><?php echo $menu; ?></div>
            </div>     
            <div class="clear"></div>