<?php
//require("mn_funciones.php");
require_once "../clases/conexion.php";

$obj=new conectar();
$conexion=$obj->conexion();

$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql = "SELECT DISTINCT nivel1_ium,nivel2_ium,nivel3_ium,descripcion FROM vw_ium WHERE descripcion LIKE '%$q%'";
//echo $sql;
$rsd=mysqli_query($conexion,$sql);
if($rsd){
    while($rs=mysqli_fetch_row($rsd)){
        $niv1 = $rs[0];
        $niv2 = $rs[1];
        $niv3 = $rs[2];
        $cname = $rs[3];
        echo "$cname|$niv1|$niv2|$niv3\n";
    }
}
?>
<p><font color="#000000">no encontrado</font></p>
