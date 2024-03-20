<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudperiodo.php";

	$obj=new crudperiodo();
	echo $obj->eliminar($_POST['idreporte']);

?>