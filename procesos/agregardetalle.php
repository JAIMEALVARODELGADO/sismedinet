<?php
require_once "../clases/conexion.php";
require_once "../clases/cruddetalle.php";
$obj=new cruddetalle();
$datos=array($_POST['numerofact_det'],
$_POST['fechafact_det'],
$_POST['tipo_operacion_det'],
$_POST['tipo_transaccio_det'],
$_POST['iumnivel1_det'],
$_POST['iumnivel2_det'],
$_POST['iumnivel3_det'],
$_POST['expediente_det'],
$_POST['exped_consec_det'],
$_POST['unidad_det'],
$_POST['cantidad_det'],
$_POST['valor_unit_det']);

echo $obj->agregar($datos);
?>


