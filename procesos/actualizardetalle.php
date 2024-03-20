<?php
require_once "../clases/conexion.php";
require_once "../clases/cruddetalle.php";
$obj=new cruddetalle();

$datos=array(
	$_POST['id_detalle'],
	$_POST['numerofact_detU'],
	$_POST['fechafact_detU'],
	$_POST['tipo_operacion_detU'],
	$_POST['tipo_transaccio_detU'],
	$_POST['iumnivel1_detU'],
	$_POST['iumnivel2_detU'],
	$_POST['iumnivel3_detU'],
	$_POST['expediente_detU'],
	$_POST['exped_consec_detU'],
	$_POST['unidad_detU'],
	$_POST['cantidad_detU'],
	$_POST['valor_unit_detU']);

echo $obj->actualizar($datos);

?>