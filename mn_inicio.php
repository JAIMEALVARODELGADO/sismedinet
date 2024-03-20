<?php
session_start();
if(isset($_POST['id_usuario'])){
	$_SESSION['gusuario_log']=$_POST['id_usuario'];
	$_SESSION['gnombreusu_log']=$_POST['nombre_usu'];
    $_SESSION['gnombre_ent']=$_POST['nombre_usu'];
    $_SESSION['gid_entidad']=$_POST['id_entidad'];
    if(!isset($_SESSION['gcontador_log'])){
        $_SESSION['gcontador_log']=$_POST['contador_log'];
    }
    else{
        $_SESSION['gcontador_log']=$_SESSION['gcontador_log']+$_POST['contador_log'];    
    }
}

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
//$consenti="SELECT nombre_ent FROM entidad WHERE id_ent='1'";
//$consenti=mysqli_query($conexion,$consenti);
//$row=mysqli_fetch_row($consenti);
//$_SESSION['gnombre_ent']=$row[0];
$sqlrep="SELECT id_reporte,descrip_rep FROM reporte WHERE estado_rep='A' AND id_entidad='$_SESSION[gid_entidad]'";
$resultrep=mysqli_query($conexion,$sqlrep);
$rowrep=mysqli_fetch_array($resultrep);
$_SESSION['gid_reporte']=$rowrep['id_reporte'];
$_SESSION['gdescrip_rep']=$rowrep['descrip_rep'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>SIS-MEDinet</title>
    <?php require_once "scripts.php";?>
    <link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
</head>
<style>
body {
    background-image: url("https://www.elindependiente.com/wp-content/uploads/2018/05/grafeno-inyeccion-medicina.jpg");
    background-repeat: no-repeat;
    height: 100%;
    background-size: cover;
}
</style>
<body>
<?php
	require("encabezado.php");
    require("menu.php");
?>        
</body>

</html>
