<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
$condicion = "id_reporte='$_SESSION[gid_reporte]'";

if(isset($_GET['factura_']) and $_GET['factura_'] != ""){
	$condicion = $condicion." AND numerofact_det = '$_GET[factura_]'";
}

if(isset($_GET['fecha_']) and $_GET['fecha_'] != ""){
	$condicion = $condicion." AND fechafact_det = '$_GET[fecha_]'";
}

if(isset($_GET['operacion_']) and $_GET['operacion_'] != ""){
	$condicion = $condicion." AND tipo_operacion_det = '$_GET[operacion_]'";
}

if(isset($_GET['iumN1_']) and $_GET['iumN1_'] != ""){
	$condicion = $condicion." AND iumnivel1_det = '$_GET[iumN1_]'";
}

if(isset($_GET['iumN2_']) and $_GET['iumN2_'] != ""){
	$condicion = $condicion." AND iumnivel2_det = '$_GET[iumN2_]'";
}

if(isset($_GET['iumN3_']) and $_GET['iumN3_'] != ""){
	$condicion = $condicion." AND iumnivel3_det = '$_GET[iumN3_]'";
}

if(isset($_GET['expediente_']) and $_GET['expediente_'] != ""){
	$condicion = $condicion." AND expediente_det = '$_GET[expediente_]'";
}

require_once "clases/conexion.php";
require("procesos/mn_funciones.php");
$obj=new conectar();
$conexion=$obj->conexion();

$consfecha="SELECT fecha_ini_rep,fecha_fin_rep FROM reporte WHERE id_reporte='$_SESSION[gid_reporte]'";
$consfecha=mysqli_query($conexion,$consfecha);
$rowfecha=mysqli_fetch_row($consfecha);
$fecha_ini=$rowfecha[0];
$fecha_fin=$rowfecha[1];
$sql="SELECT id_detalle,id_reporte,numerofact_det,fechafact_det,tipo_operacion_desc,tipo_transaccion_desc,iumnivel1_det,iumnivel2_det,iumnivel3_det,expediente_det,exped_consec_det,unidad_desc,cantidad_det,valor_unit_det,total 
FROM vw_reporte_detalle_tot 
WHERE $condicion";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);

?>
<script type="text/javascript">    
    $('#fecha_ini').val('<?php echo $fecha_ini;?>');
    $('#fecha_fin').val('<?php echo $fecha_fin;?>');
</script>
<div>
	<h5><?php echo $_SESSION['gdescrip_rep'];?></h5>
	<table class="table table-hover table-sm table-bordered font13" id="tabladetalle">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Factura</td>
				<td>Fecha</td>
				<td>Operación</td>
				<td>Transacción</td>
				<td>IUM Niv 1</td>
				<td>IUM Niv 2</td>
				<td>IUM Niv 3</td>
				<td>Expediente</td>
				<td>Cons</td>
				<td>Und</td>
				<td>Cant</td>
				<td>Vr Unit</td>
				<td>Total</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				$descripcion_ium="";
				$codigo_ium=$row[6].$row[7].$row[8];
				$sqlium="SELECT descripcion FROM vw_ium WHERE codigo_ium='$codigo_ium'";
				$resultium=mysqli_query($conexion,$sqlium);
				if(mysqli_num_rows($resultium)<>0){
					$rowium=mysqli_fetch_row($resultium);
					$descripcion_ium=$rowium[0];
				}

				$descripcion_cum="";
				if(!empty($row[9]) and !empty($row[10])){
					$sqlcum="SELECT descripcion FROM vw_cum WHERE codigo_cum=CONCAT($row[9],'-',$row[10])";
					$resultcum=mysqli_query($conexion,$sqlcum);
					if(mysqli_num_rows($resultcum)<>0){
						$rowcum=mysqli_fetch_row($resultcum);
						$descripcion_cum=$rowcum[0];
					}
				}				
				?>
				<tr>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>					
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td><a href="#" title="<?php echo $descripcion_ium;?>"><?php echo $row[6];?></a></td>
					<td><?php echo $row[7];?></td>
					<td><?php echo $row[8];?></td>
					<td><a href="#" title="<?php echo $descripcion_cum;?>"><?php echo $row[9];?></a></td>
					<td><?php echo $row[10];?></td>
					<td><?php echo $row[11];?></td>
					<td><?php echo $row[12];?></td>
					<td><?php echo $row[13];?></td>
					<td><?php echo $row[14];?></td>
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="agregaFrmActualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Borrar el Registro" onclick="eliminarDatos('<?php echo $row[0]?>','<?php echo $row[9].'-'.$row[10]?>')">
							<span class="fas fa-trash"></span>
						</span>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tabladetalle').DataTable();		
	} );
</script>