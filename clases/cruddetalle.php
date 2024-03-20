<?php
session_start();

class cruddetalle{
	
	public function agregar($datos){
		$res="";
		//empty($datos[7]) or empty($datos[8])
		if(empty($datos[0]) or empty($datos[1]) or empty($datos[2]) or empty($datos[3]) or empty($datos[9]) or empty($datos[10]) or empty($datos[11])){			
			$res="Hay campos requeridos que no estan diligenciados.";
		}
		else{
			$obj=new conectar();
			$conexion=$obj->conexion();
			$sql="INSERT INTO reporte_detalle(id_detalle,id_reporte,numerofact_det,fechafact_det,tipo_operacion_det,tipo_transaccio_det,iumnivel1_det,iumnivel2_det,iumnivel3_det,expediente_det,exped_consec_det,unidad_det,cantidad_det,valor_unit_det)
			VALUES (0,'$_SESSION[gid_reporte]','$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]','$datos[10]','$datos[11]')";
			//echo "<br>".$sql;
			$res=mysqli_query($conexion,$sql);
		}
		return($res);
	}

	public function obtenDatos($iddetalle){
		$obj=new conectar();
		//echo $iddetalle;
		$conexion=$obj->conexion();
		$sql="SELECT id_detalle,numerofact_det,fechafact_det,tipo_operacion_det,tipo_transaccio_det,iumnivel1_det,iumnivel2_det,iumnivel3_det,expediente_det,exped_consec_det,unidad_det,cantidad_det,valor_unit_det,vw_ium.descripcion AS descripcion_ium,vw_cum.descripcion AS descripcion_cum
		FROM reporte_detalle 
		LEFT JOIN vw_ium ON vw_ium.codigo_ium=CONCAT(reporte_detalle.iumnivel1_det,reporte_detalle.iumnivel2_det,reporte_detalle.iumnivel3_det)
		LEFT JOIN vw_cum ON CONCAT(vw_cum.expediente_cum,vw_cum.consecutivo_cum)=CONCAT(reporte_detalle.expediente_det,reporte_detalle.exped_consec_det)
		WHERE id_detalle='$iddetalle'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_detalle' => $ver[0],
			'numerofact_det' => $ver[1],
			'fechafact_det' => $ver[2],
			'tipo_operacion_det' => $ver[3],
			'tipo_transaccio_det' => $ver[4],
			'iumnivel1_det' => $ver[5],
			'iumnivel2_det' => $ver[6],
			'iumnivel3_det' => $ver[7],
			'expediente_det' => $ver[8],
			'exped_consec_det' => $ver[9],
			'unidad_det' => $ver[10],
			'cantidad_det' => $ver[11],
			'valor_unit_det' => $ver[12],
			'medicamento_ium' => ($ver[13]==null?"":$ver[13]),
			'medicamento_cum' => ($ver[14]==null?"":$ver[14])
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="UPDATE reporte_detalle SET numerofact_det='$datos[1]',fechafact_det='$datos[2]',tipo_operacion_det='$datos[3]',tipo_transaccio_det='$datos[4]',iumnivel1_det='$datos[5]',iumnivel2_det='$datos[6]',iumnivel3_det='$datos[7]',expediente_det='$datos[8]',exped_consec_det='$datos[9]',unidad_det='$datos[10]',cantidad_det='$datos[11]',valor_unit_det='$datos[12]' WHERE id_detalle='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($iddetalle){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM reporte_detalle WHERE id_detalle='$iddetalle'";
		return mysqli_query($conexion,$sql);
	}
}
?>
