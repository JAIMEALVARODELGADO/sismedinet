<?php
session_start();
require_once "../clases/conexion.php";
//require_once "../clases/cruddetalle.php";
//$obj=new cruddetalle();
///*$datos=array(
$opcion=$_POST['opcion'];


/*$_POST['numerofact_det'],
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
$_POST['valor_unit_det']);*/

//echo $obj->agregar($datos);
switch($opcion){
    case 'guardarDetalle':
        guardarDetalle($_POST);
        break;
}
   
function guardarDetalle($data){
    $id_reporte = $_SESSION['gid_reporte'];
    echo $id_reporte;
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

    $sql="INSERT INTO reporte_detalle021(id_reporte,fechafact_det,municipio,cufe,numerofact_det,codigo_detalle,unidad_medida,cantidad,precio_und,documento_soporte,nit_entidad_operacion,municipio_operacion,tipo_operacion,tipo_transaccion,iumnivel1,iumnivel2,iumnivel3,expediente,presentacion_comercial,total_unidades_fac)
    ";
    echo $sql;


/*$sql="INSERT INTO ium(codigo_ium,nombre_ium,nivel1_ium,nivel2_ium,nivel3_ium)
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
    
    return $msj;*/



/*id_detalle
id_reporte
fechafact_det
municipio
cufe
numerofact_det
codigo_detalle
unidad_medida
cantidad
precio_und
documento_soporte
nit_entidad_operacion
municipio_operacion
tipo_operacion
tipo_transaccion
iumnivel1
iumnivel2
iumnivel3
expediente
presentacion_comercial
total_unidades_fac*/
}

?>


