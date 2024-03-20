<?php
require_once "../clases/conexion.php";
require_once "../clases/crudperiodo.php";
$obj=new crudperiodo();

$datos=array($_POST['id_reporte'],
$_POST['descrip_repU'],
$_POST['fecha_ini_repU'],
$_POST['fecha_fin_repU'],
$_POST['observac_repU']);

echo $obj->actualizar($datos);

?>