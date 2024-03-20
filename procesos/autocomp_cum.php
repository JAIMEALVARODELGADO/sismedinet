<?php
//require("mn_funciones.php");
require_once "../clases/conexion.php";

$obj=new conectar();
$conexion=$obj->conexion();

$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql = "SELECT DISTINCT expediente_cum,consecutivo_cum,descripcion FROM vw_cum WHERE descripcion LIKE '%$q%'";
//echo $sql;
$rsd=mysqli_query($conexion,$sql);
if($rsd){
    while($rs=mysqli_fetch_row($rsd)){
        $exped= $rs[0];
        $conse = $rs[1];
        $cname = $rs[2];
        echo "$cname|$exped|$conse\n";
    }
}
?>
<p><font color="#000000">no encontrado</font></p>
