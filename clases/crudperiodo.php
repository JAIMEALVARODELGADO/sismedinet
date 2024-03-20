<?php
session_start();

class crudperiodo{
	
	public function agregar($datos){
		if(empty($datos[0]) or empty($datos[1]) or empty($datos[2])){
			$res=0;
		}
		else{
			$obj=new conectar();
			$conexion=$obj->conexion();
			$sql="INSERT INTO reporte(id_reporte,id_entidad,descrip_rep,fecha_ini_rep,fecha_fin_rep,observac_rep)
			VALUES (0,'$_SESSION[gid_entidad]','$datos[0]','$datos[1]','$datos[2]','$datos[3]')";
			//echo $sql;
			$res=mysqli_query($conexion,$sql);
		}
		return($res);
	}

	public function obtenDatos($idreporte){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_reporte,descrip_rep,fecha_ini_rep,fecha_fin_rep,observac_rep FROM reporte WHERE id_reporte='$idreporte'";
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_reporte' => $ver[0],
			'descrip_rep' => $ver[1], 
			'fecha_ini_rep' => $ver[2], 
			'fecha_fin_rep' => $ver[3],
			'observac_rep' => $ver[4]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="UPDATE reporte SET descrip_rep='$datos[1]',fecha_ini_rep='$datos[2]',fecha_fin_rep='$datos[3]',observac_rep='$datos[4]' WHERE id_reporte='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($idreporte){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM reporte WHERE id_reporte='$idreporte'";
		return mysqli_query($conexion,$sql);
	}

	public function cambiarestado($idreporte){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_rep FROM reporte WHERE id_reporte='$idreporte'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE reporte SET estado_rep='$estado' WHERE id_reporte='$idreporte'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
