<?php
session_start();
require_once "../clases/conexion.php";

$data = json_decode(file_get_contents("php://input"), true);
//print_r($data); // aquí tienes tu array asociativo con todos los campos
$opcion=$data['opcion'];


switch($opcion){
    case 'guardarDetalle':
        guardarDetalle($data);
        break;
    case 'consultarUltimoRegistro':
        consultarUltimoRegistro();
        break;
    case 'consultarRegistro':
        consultarRegistro($data);
        break;
    case 'editarDetalle':
        editarDetalle($data);
        break;
    case 'eliminarDetalle':
        eliminarDetalle($data);
        break;
}
   
function guardarDetalle($data){
    $obj = new conectar();
    $conexion = $obj->conexion();

    $id_reporte = $_SESSION['gid_reporte'];
    $municipio = $data['municipio'];
    $cufe = $data['cufe'];
    $numerofact_det = $data['numerofact_det'];
    $fechafact = $data['fechafact'];
    $codigo_detalle = $data['codigo_detalle'];
    $unidad_medida = $data['unidad_medida'];
    $cantidad = $data['cantidad'];
    $precio_und = $data['precio_und'];
    $documento_soporte = $data['documento_soporte'];
    $total_facturado = $data['total_facturado'];
    $nit_entidad_operacion = $data['nit_entidad_operacion'];
    $municipio_operacion = $data['municipio_operacion'];
    $tipo_operacion = $data['tipo_operacion'];
    $tipo_transaccion = $data['tipo_transaccion'];
    $iumnivel1 = $data['iumnivel1'];
    $iumnivel2 = $data['iumnivel2'];
    $iumnivel3 = $data['iumnivel3'];
    $expediente = $data['expediente'];
    $presentacion_comercial = $data['presentacion_comercial'];
    $total_unidades_fac = $data['total_unidades_fac'];

    $sql="INSERT INTO reporte_detalle021(id_reporte,fechafact,municipio,cufe,numerofact_det,codigo_detalle,unidad_medida,cantidad,precio_und,documento_soporte,nit_entidad_operacion,municipio_operacion,tipo_operacion,tipo_transaccion,iumnivel1,iumnivel2,iumnivel3,expediente,presentacion_comercial,total_unidades_fac)
    VALUES($id_reporte,'$fechafact','$municipio','$cufe','$numerofact_det','$codigo_detalle','$unidad_medida',$cantidad,$precio_und,'$documento_soporte','$nit_entidad_operacion','$municipio_operacion','$tipo_operacion','$tipo_transaccion','$iumnivel1','$iumnivel2','$iumnivel3','$expediente','$presentacion_comercial',$total_unidades_fac)
    ";
    //echo $sql;
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado && mysqli_affected_rows($conexion) > 0){
        $rtn = 1;
    } else {
        $rtn = 0;
    }
    echo json_encode($rtn);

}

function consultarUltimoRegistro(){
    $obj = new conectar();
    $conexion = $obj->conexion();

    $id_reporte = $_SESSION['gid_reporte'];
    $sql = "SELECT * FROM reporte_detalle021 WHERE id_reporte=$id_reporte ORDER BY id_detalle DESC LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0){
        $ultimoRegistro = mysqli_fetch_assoc($resultado);
        echo json_encode($ultimoRegistro);
    } else {
        echo json_encode(null);
    }
}

function consultarRegistro($data){
    $obj = new conectar();
    $conexion = $obj->conexion();

    $id_detalle = $data['id_detalle'];
    $sql = "SELECT * FROM reporte_detalle021 WHERE id_detalle=$id_detalle";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0){
        $registro = mysqli_fetch_assoc($resultado);
        echo json_encode($registro);
    } else {
        echo json_encode(null);
    }
}


function editarDetalle($data){
    $obj = new conectar();
    $conexion = $obj->conexion();

    $id_detalle = $data['id_detalle'];
    $municipio = $data['municipio'];
    $cufe = $data['cufe'];
    $numerofact_det = $data['numerofact_det'];
    $fechafact = $data['fechafact'];
    $codigo_detalle = $data['codigo_detalle'];
    $unidad_medida = $data['unidad_medida'];
    $cantidad = $data['cantidad'];
    $precio_und = $data['precio_und'];
    $documento_soporte = $data['documento_soporte'];
    $total_facturado = $data['total_facturado'];
    $nit_entidad_operacion = $data['nit_entidad_operacion'];
    $municipio_operacion = $data['municipio_operacion'];
    $tipo_operacion = $data['tipo_operacion'];
    $tipo_transaccion = $data['tipo_transaccion'];
    $iumnivel1 = $data['iumnivel1'];
    $iumnivel2 = $data['iumnivel2'];
    $iumnivel3 = $data['iumnivel3'];
    $expediente = $data['expediente'];
    $presentacion_comercial = $data['presentacion_comercial'];
    $total_unidades_fac = $data['total_unidades_fac'];

    $sql="UPDATE reporte_detalle021 SET fechafact='$fechafact',
    municipio='$municipio',
    cufe='$cufe',
    numerofact_det='$numerofact_det',
    codigo_detalle='$codigo_detalle',
    unidad_medida='$unidad_medida',
    cantidad='$cantidad',
    precio_und='$precio_und',
    documento_soporte='$documento_soporte',
    nit_entidad_operacion='$nit_entidad_operacion',
    municipio_operacion='$municipio_operacion',
    tipo_operacion='$tipo_operacion',
    tipo_transaccion='$tipo_transaccion',
    iumnivel1='$iumnivel1',
    iumnivel2='$iumnivel2',
    iumnivel3='$iumnivel3',
    expediente='$expediente',
    presentacion_comercial='$presentacion_comercial',
    total_unidades_fac='$total_unidades_fac' WHERE id_detalle=$id_detalle
    ";
    //echo $sql;
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado && mysqli_affected_rows($conexion) > 0){
        $rtn = 1;
    } else {
        $rtn = 0;
    }
    echo json_encode($rtn);
}

function eliminarDetalle($data){
    $obj = new conectar();
    $conexion = $obj->conexion();

    $id_detalle = $data['id_detalle'];
    $sql = "DELETE FROM reporte_detalle021 WHERE id_detalle=$id_detalle";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado && mysqli_affected_rows($conexion) > 0){
        $rtn = 1;
    } else {
        $rtn = 0;
    }
    echo json_encode($rtn);
}
?>