<?php doctype(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Aucar</title>
        <?php echo $assets; ?>

    </head>
    <body>
        <div class="container_16">
            <?php echo $menu; ?>
            <div class="clear"></div>

            <table id="comisiones" >
                <tr>
            
                    <th>Comision</th>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Número de poliza</th>
                    <th>Colaborador</th>
                    <th>Cliente </th>
                </tr>
                <?php foreach ($query->result() as $row) { ?>
                    <tr>
             
                        <td><?php echo $row->comision ?></td>
                        <td><?php echo $row->mes ?></td>
                        <td><?php echo $row->anyo ?></td>
                        <td><?php //echo $row->numero_poliza ?></td>
                        <td><?php echo $row->colaborador ?></td>  
                        <td><?php echo $row->cliente_nombre ?></td>
                    </tr>
                <?php } ?>
            </table>
            <?php echo $paginator ?>
        </div>
        <!-- end .container_16 -->

    </body>
</html>
