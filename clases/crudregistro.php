<?php
session_start();

class crudregistro{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$consent="SELECT id_entidad FROM entidad WHERE numero_iden_ent='$datos[2]'";		
		$row=mysqli_query($conexion,$consent);
		$res=mysqli_num_rows($row);		
		$msg="";
		if($res==0){
			$sql="INSERT INTO entidad(id_entidad,nombre_ent,tipo_ident_ent,numero_iden_ent,direccion_ent,telefonos_ent,ciudad_ent,email_ent,rol_ent,codigoeps_ent,contacto_ent)
			VALUES (0,'$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]')";
			//echo $sql;
			mysqli_query($conexion,$sql);
			$msg="1";
		}
		else{
			$msg="El NIT ya fué registrado anteriormente";			
		}
		return($msg);
	}

	/*public function obtenDatos($ideps){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_eps,codigo_eps, nit_eps, nombre_eps, direccion_eps, telefono_eps, contacto_eps FROM eps WHERE id_eps='$ideps'";
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_eps' => $ver[0],
			'codigo_eps' => $ver[1], 
			'nit_eps' => $ver[2], 
			'nombre_eps' => $ver[3], 
			'direccion_eps' => $ver[4], 
			'telefono_eps' => $ver[5], 
			'contacto_eps' => $ver[6]
			);
		return $datos;
	}*/

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE  entidad SET nombre_ent ='$datos[0]',tipo_ident_ent='$datos[1]',numero_iden_ent='$datos[2]',direccion_ent='$datos[3]',telefonos_ent='$datos[4]',ciudad_ent='$datos[5]',email_ent='$datos[6]',rol_ent='$datos[7]',codigoeps_ent='$datos[8]',contacto_ent='$datos[9]' WHERE id_entidad='$_SESSION[gid_entidad]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	/*public function eliminar($ideps){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM eps WHERE id_eps='$ideps'";
		return mysqli_query($conexion,$sql);
	}*/
}
?>
