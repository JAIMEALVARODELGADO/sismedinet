<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudperiodo.php";

	$obj=new crudperiodo();
	echo json_encode($obj->obtenDatos($_POST['idreporte']));

?>