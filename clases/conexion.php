
<?php
	/**
	 * Conexion a la BD
	 */
	class conectar{
		public function conexion(){
			$conexion=mysqli_connect('localhost','root','654321','sismedinet_bd');
			//$conexion=mysqli_connect('localhost','gastro_sismed','nV*o6^=#m288','gastro_sismedinet');
			mysqli_set_charset($conexion,"utf8");
			return $conexion;
		}
	}

?>
