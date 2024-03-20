    <?php
    $ahora=hoy();
    $cons="SELECT nombre_ent,CONCAT(tipo_ident_val,' ',numero_iden_ent) AS identificacion, direccion_ent,telefonos_ent,ciudad_ent FROM vw_entidad WHERE id_entidad='$_SESSION[gid_entidad]'";
    //echo $cons;
    $cons=mysqli_query($conexion,$cons);
    $row=mysqli_fetch_row($cons);
    $nombre_ent=$row[0];
    $identi_ent=$row[1];
    $direccion_ent=$row[2];
    $telefono_ent=$row[3];
    $ciudad=$row[4];
    ?>
    <div class="row">
        <div class="col-sm-12" align="center"><h4><?php echo $nombre_ent;?></h4></div>
    </div>
    <div class="row">
        <div class="col-sm-12" align="center"><h7><?php echo $identi_ent;?></h7></div>
    </div>
    <div class="row">
        <div class="col-sm-12" align="center"><h7><?php echo $direccion_ent;?></h7></div>
    </div>
    <div class="row">
        <div class="col-sm-12" align="center"><h7><?php echo $telefono_ent;?></h7></div>
    </div>
    <div class="row">
        <div class="col-sm-12" align="center"><h7><?php echo $ciudad;?></h7></div>
    </div>
    <div class="row">
        <div class="col-sm-12" align="right">Fecha y Hora de impresión:<?php echo $ahora;?></h7></div>
    </div>