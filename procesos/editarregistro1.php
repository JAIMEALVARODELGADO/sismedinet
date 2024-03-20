<?php
require_once "../clases/conexion.php";
require_once "../clases/crudregistro.php";
$obj=new crudregistro();
/*echo "Siiiiiiiiiii";
echo "<br>".$_POST['nombre_ent'];
echo "<br>".$_POST['tipo_ident_ent'];
echo "<br>".$_POST['numero_iden_ent'];
echo "<br>".$_POST['direccion_ent'];
echo "<br>".$_POST['telefonos_ent'];
echo "<br>".$_POST['ciudad_ent'];
echo "<br>".$_POST['email_ent'];
echo "<br>".$_POST['rol_ent'];
echo "<br>".$_POST['codigoeps_ent'];
echo "<br>".$_POST['contacto_ent'];*/

$datos=array($_POST['nombre_ent'],
$_POST['tipo_ident_ent'],
$_POST['numero_iden_ent'],
$_POST['direccion_ent'],
$_POST['telefonos_ent'],
$_POST['ciudad_ent'],
$_POST['email_ent'],
$_POST['rol_ent'],
$_POST['codigoeps_ent'],
$_POST['contacto_ent']);
echo $obj->actualizar($datos);

?>