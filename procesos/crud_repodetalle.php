<?php
session_start();

require_once "../clases/conexion.php";

if(isset($_POST['opcion'])){
    $opcion = $_POST['opcion'];
}
else{
    $opcion = $_GET['opcion'];
}

switch ($opcion) {
    case 'consultar_ium':
        $codigo_ium = $_GET['codigo_ium'];
        echo consultar_ium($codigo_ium);
        break;
    case 'nuevo_ium':
        echo nuevo_ium($_POST);
        break;

    default:
        echo "Opción no válida.";
        break;
}

function consultar_ium($codigo_ium){
    $obj=new conectar();
    //echo $iddetalle;
    $conexion=$obj->conexion();
    $sql="SELECT id_ium,codigo_ium,nombre_ium,nivel1_ium,nivel2_ium,nivel3_ium
    FROM ium i
    WHERE codigo_ium='$codigo_ium'";
    //echo "<pre>".$sql;
    $con=mysqli_query($conexion,$sql);
    //$ver=mysqli_fetch_row($row);
    $datos = mysqli_fetch_array($con);
    return json_encode($datos);
}

function nuevo_ium($data){
    $obj=new conectar();
    $conexion=$obj->conexion();
    
    $sql="INSERT INTO ium(codigo_ium,nombre_ium,nivel1_ium,nivel2_ium,nivel3_ium)
          VALUES('$data[codigo_ium]',
                 '$data[nombre_ium]',
                 '$data[nivel1_ium]',
                 '$data[nivel2_ium]',
                 '$data[nivel3_ium]')";
    
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado && mysqli_affected_rows($conexion) > 0){
        $msj = "IUM agregado correctamente";
    } else {
        $msj = "Error al agregar IUM: " . mysqli_error($conexion);
    }
    
    return $msj;
}
?>