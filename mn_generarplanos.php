<?php
session_start();
require_once "clases/conexion.php";
//require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();
$consultaent="SELECT tipo_ident_val,numero_iden_ent,codigoeps_ent,rol_val FROM vw_entidad WHERE id_entidad='$_SESSION[gid_entidad]'";
//echo $consultaent;
$consultaent=mysqli_query($conexion,$consultaent);
$rowent=mysqli_fetch_array($consultaent);
$codhabilitacion=$rowent['codigoeps_ent'];
$rol=$rowent['3'];
$control="1|";
$control=$control.$rowent['tipo_ident_val']."|";
$control=$control.$rowent['numero_iden_ent']."|";

$consultarep="SELECT fecha_ini_rep,fecha_fin_rep FROM reporte WHERE id_reporte='$_SESSION[gid_reporte]'";
//echo "<br>".$consultarep;
$consultarep=mysqli_query($conexion,$consultarep);
$rowrep=mysqli_fetch_array($consultarep);
$control=$control.$rowrep['fecha_ini_rep']."|";
$control=$control.$rowrep['fecha_fin_rep']."|";

//Aqui genero los registros de detalle
$consecutivo=1;
$consulta="SELECT id_reporte,codigo_transaccion ,month(fechafact_det),tpoperacion_cod,tptransaccion_cod,iumnivel1_det,iumnivel2_det,iumnivel3_det,expediente_det,exped_consec_det,unidad_cod
FROM vw_reporte_sismed 
WHERE id_reporte='$_SESSION[gid_reporte]'
GROUP BY codigo_transaccion 
ORDER BY codigo_transaccion";
//echo "<br>".$consulta;
$consulta=mysqli_query($conexion,$consulta);
if(mysqli_num_rows($consulta)<>0){
    //$regaf=mysqli_num_rows($consulta);
    $detalle="";
    while($row=mysqli_fetch_array($consulta)){
        $codigo_transaccion=$row['codigo_transaccion'];
        $mes=$row['2'];
        //$mes='0'.$row['2'];
        //$mes=substr($mes,-2);        
        $detalle=$detalle."2|";
        $detalle=$detalle.$consecutivo."|";
        $detalle=$detalle.$codhabilitacion."|";
        $detalle=$detalle.$mes."|";
        $detalle=$detalle.$rol."|";
        $detalle=$detalle.$row['tpoperacion_cod']."|";
        $detalle=$detalle.$row['tptransaccion_cod']."|";
        $detalle=$detalle.$row['iumnivel1_det']."|";
        $detalle=$detalle.$row['iumnivel2_det']."|";
        $detalle=$detalle.$row['iumnivel3_det']."|";
        $detalle=$detalle.$row['expediente_det']."|";
        $detalle=$detalle.$row['exped_consec_det']."|";
        $detalle=$detalle.$row['unidad_cod']."|";
        $consultadet="SELECT numerofact_det,cantidad_det,valor_unit_det,total FROM vw_reporte_sismed WHERE codigo_transaccion='$codigo_transaccion'";
        //ECHO "<br>Detalle:   ".$consultadet;
        $consultadet=mysqli_query($conexion,$consultadet);
        $contdet=1; //Contador de detalles
        $total=0;
        $cantidad=0;
        $factmin='';
        $factmax='';
        while($rowdet=mysqli_fetch_array($consultadet)){
          if($contdet==1){
            $minimo=$rowdet['valor_unit_det'];
            $maximo=$rowdet['valor_unit_det'];
            $factmin=$rowdet['numerofact_det'];
            $factmax=$rowdet['numerofact_det'];
          }
          else{
            if($rowdet['valor_unit_det']<$minimo){
              $minimo=$rowdet['valor_unit_det'];
              $factmin=$rowdet['numerofact_det'];
            }
            if($rowdet['valor_unit_det']>$maximo){
              $maximo=$rowdet['valor_unit_det'];
              $factmax=$rowdet['numerofact_det'];
            }
          }
          $total=$total+$rowdet['total'];
          $cantidad=$cantidad+$rowdet['cantidad_det'];
          $contdet++;
        }
        $detalle=$detalle.$minimo."|";
        $detalle=$detalle.$maximo."|";
        $detalle=$detalle.$total."|";
        $detalle=$detalle.$cantidad."|";
        $detalle=$detalle.$factmin."|";
        $detalle=$detalle.$factmax;
        $detalle=$detalle."\r\n";
        //echo "<br>".$detalle;
        $consecutivo++;
        
    }
}

$consecutivo--;
$control=$control.$consecutivo."|";
$consultamed="SELECT codigo_cum FROM vw_reporte_sismed WHERE id_reporte='$_SESSION[gid_reporte]'
GROUP BY codigo_cum";
//echo $consultamed;
$consultamed=mysqli_query($conexion,$consultamed);
$cantidadmed=mysqli_num_rows($consultamed);
$control=$control.$cantidadmed."\r\n";
$detalle=$control.$detalle;
//echo "<br>".$detalle;

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




