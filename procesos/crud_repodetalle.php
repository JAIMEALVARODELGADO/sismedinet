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
    case 'consultar_cum':
        $codigo_cum = $_GET['codigo_cum'];
        echo consultar_cum($codigo_cum);
        break;
    case 'nuevo_cum':
        echo nuevo_cum($_POST);
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

function consultar_cum($codigo_cum){
    $obj=new conectar();
    //echo $codigo_cum;
    $conexion=$obj->conexion();
    $sql="SELECT id_cums ,codigo_cum ,expediente_cum ,producto_cum ,consecutivo_cum 
    FROM cums cu
    WHERE cu.codigo_cum = '$codigo_cum'";
    //echo "<pre>".$sql;
    $con=mysqli_query($conexion,$sql);
    $datos = mysqli_fetch_array($con);
    return json_encode($datos);
}

function nuevo_cum($data){
    $obj=new conectar();
    $conexion=$obj->conexion();
    
    $sql="INSERT INTO cums(codigo_cum,expediente_cum,producto_cum,consecutivo_cum)
          VALUES('$data[codigo_cum]',
                 '$data[expediente_cum]',
                 '$data[producto_cum]',
                 '$data[consecutivo_cum]')";
    //echo $sql;
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado && mysqli_affected_rows($conexion) > 0){
        $msj = "CUM agregado correctamente";
    } else {
        $msj = "Error al agregar IUM: " . mysqli_error($conexion);
    }
    
    return $msj;
}
?>