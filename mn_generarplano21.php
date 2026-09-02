<?php
session_start();
require_once "clases/conexion.php";
//require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();
$consultaent="SELECT tipo_ident_val,numero_iden_ent,codigoeps_ent,rol_val 
FROM vw_entidad WHERE id_entidad='$_SESSION[gid_entidad]'";
//echo $consultaent;
$consultaent=mysqli_query($conexion,$consultaent);
$rowent=mysqli_fetch_array($consultaent);
$codhabilitacion=$rowent['codigoeps_ent'];
$rol=$rowent['rol_val'];
$control="1|";
$control=$control.$rowent['tipo_ident_val']."|";
$control=$control.$rowent['numero_iden_ent']."|";

$consultarep="SELECT fecha_ini_rep,fecha_fin_rep FROM reporte WHERE id_reporte='$_SESSION[gid_reporte]'";
//echo "<br>".$consultarep;
$consultarep=mysqli_query($conexion,$consultarep);
$rowrep=mysqli_fetch_array($consultarep);
$control=$control.$rowrep['fecha_ini_rep']."|";
$control=$control.$rowrep['fecha_fin_rep']."|";
//echo $control;

//Aqui genero los registros de detalle
$consecutivo=0;
$consulta="SELECT MONTH(fechafact) as mes,fechafact,municipio,cufe,numerofact_det,codigo_detalle,
unidad_medida,cantidad,precio_und,documento_soporte,nit_entidad_operacion,municipio_operacion,
iumnivel1,iumnivel2,iumnivel3,expediente,presentacion_comercial,total_unidades_fac,
vw_tpoperacion.valor_det as tpoperacion_cod,
vw_tptransaccion.valor_det as tptransaccion_cod
FROM reporte_detalle021 rp
INNER JOIN vw_tpoperacion ON rp.tipo_operacion=vw_tpoperacion.codi_det
INNER JOIN vw_tptransaccion ON rp.tipo_transaccion=vw_tptransaccion.codi_det
WHERE id_reporte='$_SESSION[gid_reporte]'
ORDER BY fechafact";
echo "<br>".$consulta;
$consulta=mysqli_query($conexion,$consulta);
if(mysqli_num_rows($consulta)<>0){
    $detalle="";
    while($row=mysqli_fetch_array($consulta)){
        $consecutivo++;
        //$codigo_transaccion=$row['codigo_transaccion'];
        $mes=$row['mes'];
        //$mes='0'.$row['2'];
        //$mes=substr($mes,-2);        
        $detalle=$detalle."2|";//Tipo de registro
        $detalle=$detalle.$consecutivo."|";
        $detalle=$detalle.$codhabilitacion."|";
        $detalle=$detalle.$mes."|";
        $detalle=$detalle.$rol."|";
        $detalle=$detalle.$row['municipio']."|";
        $detalle=$detalle.$row['cufe']."|";
        $detalle=$detalle.$row['numerofact_det']."|";
        $detalle=$detalle.$row['fechafact']."|";
        $detalle=$detalle.$row['codigo_detalle']."|";
        $detalle=$detalle.$row['unidad_medida']."|";
        $detalle=$detalle.$row['cantidad']."|";
        $detalle=$detalle.$row['precio_und']."|";
        $detalle=$detalle.$row['documento_soporte']."|";
        $total=$row['cantidad']*$row['precio_und'];
        $detalle=$detalle.$total."|";
        $detalle=$detalle.$row['nit_entidad_operacion']."|";
        $detalle=$detalle.$row['municipio_operacion']."|";
        $detalle=$detalle.$row['tpoperacion_cod']."|";
        $detalle=$detalle.$row['tptransaccion_cod']."|";
        $detalle=$detalle.$row['iumnivel1']."|";
        $detalle=$detalle.$row['iumnivel2']."|";
        $detalle=$detalle.$row['iumnivel3']."|";
        $detalle=$detalle.$row['expediente']."|";
        $detalle=$detalle.$row['presentacion_comercial']."|";
        $detalle=$detalle.$row['total_unidades_fac'];

        $detalle=$detalle."\r\n";
        
        //echo "<br>Consecutivo incrementado: ".$consecutivo;
        
    }
}
//echo "<br>".$detalle;

//$consecutivo--;
$control=$control.$consecutivo."\r\n";
/*$consultamed="SELECT codigo_cum FROM vw_reporte_sismed WHERE id_reporte='$_SESSION[gid_reporte]'
GROUP BY codigo_cum";
//echo $consultamed;
$consultamed=mysqli_query($conexion,$consultamed);
$cantidadmed=mysqli_num_rows($consultamed);
$control=$control.$cantidadmed."\r\n";*/
$detalle=$control.$detalle;
echo "<br>".$detalle;

$archivo='MED100MPRE'.SUBSTR($rowrep['fecha_fin_rep'],0,4).SUBSTR($rowrep['fecha_fin_rep'],5,2).SUBSTR($rowrep['fecha_fin_rep'],8,2);
$archivo=$archivo.$rowent['tipo_ident_val'];
$archivo=$archivo.SUBSTR('000000000000'.$rowent['numero_iden_ent'],-12);
//$archivo=$archivo.".TXT";
//$scarpeta="tmp/"; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
//$sfile="planos/AF".$numero_ccob.".csv"; //ruta del archivo a generar 
$sfile="planos/".$archivo.".CSV"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$detalle); 
fclose($fp);
?>
<div class="row">
	<label class="col-sm-3 col-form-label">
	<a href="<?php echo $sfile;?>" type="button" class="btn btn-primary"><?php echo $archivo;?> <i class="fas fa-angle-double-down"></i></a>	
	</label>
</div>




