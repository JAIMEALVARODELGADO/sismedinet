
<?php
	/**
	 * Conexion a la BD
	 */
	class conectar{
		public function conexion(){
			$conexion=mysqli_connect('localhost','root','','sismedinet_bd');
			//$conexion=mysqli_connect('localhost','delvinar_root','m3d1n3t*321','delvinar_sismedoncomed'); //conexion de produccion
			//$conexion=mysqli_connect('localhost','root','654321','sismedinet_bd');
			//$conexion=mysqli_connect('localhost','gastro_sismed','nV*o6^=#m288','gastro_sismedinet');
			mysqli_set_charset($conexion,"utf8");
			return $conexion;
		}
	}

?>
