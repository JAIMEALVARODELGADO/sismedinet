<?php
/**
 * crud
 */
class crudlogin{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
	}

	public function obtenDatos($usuario,$login){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_usuario,nombre_usu,password_usu,nombre_ent,id_entidad FROM vw_usuario WHERE nombre_usu='$usuario' AND password_usu='$login' AND estado_ent='A'";
		//echo "<br>".$sql;
		$sql=mysqli_query($conexion,$sql);
		if(mysqli_num_rows($sql)==0){
			$datos=array(
			'id_usuario' => '',
			'nombre_usu' => '',
			'id_entidad' => '');
		}
		else{
			$row=mysqli_fetch_row($sql);
			$datos=array(
			'id_usuario' => $row[0],
			'nombre_usu' => $row[3],
			'id_entidad' => $row[4]
			);
		}
		return $datos;
	}

	/*public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE eps SET codigo_eps='$datos[1]', nit_eps='$datos[2]', nombre_eps='$datos[3]', direccion_eps='$datos[4]', telefono_eps='$datos[5]', contacto_eps='$datos[6]' WHERE id_eps='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($ideps){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM eps WHERE id_eps='$ideps'";
		return mysqli_query($conexion,$sql);
	}*/
}
?>
