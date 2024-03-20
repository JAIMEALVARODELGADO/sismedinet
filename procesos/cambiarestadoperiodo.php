<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudperiodo.php";

	$obj=new crudperiodo();
	echo $obj->cambiarestado($_POST['idreporte']);

?>