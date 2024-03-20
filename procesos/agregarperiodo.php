<?php
require_once "../clases/conexion.php";
require_once "../clases/crudperiodo.php";
$obj=new crudperiodo();
$datos=array($_POST['descrip_rep'],
$_POST['fecha_ini_rep'],
$_POST['fecha_fin_rep'],
$_POST['observac_rep']);

echo $obj->agregar($datos);

?>