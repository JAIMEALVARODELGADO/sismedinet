<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");

// Leer JSON enviado por AJAX
$input = json_decode(file_get_contents("php://input"), true);

$condicion = "id_reporte='" . $_SESSION['gid_reporte'] . "'";

if (!empty($input['factura'])) {
    $condicion .= " AND numerofact_det = '" . $input['factura'] . "'";
}

if (!empty($input['fecha_'])) {
    $condicion .= " AND fechafact_det = '" . $input['fecha_'] . "'";
}

if (!empty($input['operacion_'])) {
    $condicion .= " AND tipo_operacion_det = '" . $input['operacion_'] . "'";
}

if (!empty($input['iumN1_'])) {
    $condicion .= " AND iumnivel1_det = '" . $input['iumN1_'] . "'";
}

if (!empty($input['iumN2_'])) {
    $condicion .= " AND iumnivel2_det = '" . $input['iumN2_'] . "'";
}

if (!empty($input['iumN3_'])) {
    $condicion .= " AND iumnivel3_det = '" . $input['iumN3_'] . "'";
}

if (!empty($input['expediente_'])) {
    $condicion .= " AND expediente_det = '" . $input['expediente_'] . "'";
}
//echo $condicion;
require_once "clases/conexion.php";
require("procesos/mn_funciones.php");
$obj = new conectar();
$conexion = $obj->conexion();

$consfecha = "SELECT fecha_ini_rep,fecha_fin_rep FROM reporte WHERE id_reporte='" . $_SESSION['gid_reporte'] . "'";
$consfecha = mysqli_query($conexion, $consfecha);
$rowfecha = mysqli_fetch_row($consfecha);
$fecha_ini = $rowfecha[0];
$fecha_fin = $rowfecha[1];

/*$sql = "SELECT id_detalle,id_reporte,numerofact_det,fechafact_det,tipo_operacion_desc,tipo_transaccion_desc,
        iumnivel1_det,iumnivel2_det,iumnivel3_det,expediente_det,exped_consec_det,unidad_desc,cantidad_det,
        valor_unit_det,total 
        FROM vw_reporte_detalle_tot 
        WHERE $condicion ORDER BY numerofact_det DESC";*/


$sql = "SELECT id_detalle,id_reporte,numerofact_det,fechafact_det
FROM reporte_detalle021 
WHERE $condicion ORDER BY numerofact_det DESC";
echo "<br>".$sql;
/**
tipo_operacion_desc,tipo_transaccion_desc,
iumnivel1_det,iumnivel2_det,iumnivel3_det,expediente_det,exped_consec_det,unidad_desc,cantidad_det,
valor_unit_det,total 
 */

/*

municipio
cufe
numerofac
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
total_unidades_fac
*/
$result = mysqli_query($conexion, $sql);
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
			while($row=mysqli_fetch_array($result)){
				$descripcion_ium="";
				$codigo_ium=$row['iumnivel1_det'].$row['iumnivel2_det'].$row['iumnivel3_det'];
				$sqlium="SELECT descripcion FROM vw_ium WHERE codigo_ium='$codigo_ium'";
				$resultium=mysqli_query($conexion,$sqlium);
				if(mysqli_num_rows($resultium)<>0){
					$rowium=mysqli_fetch_row($resultium);
					$descripcion_ium=$rowium[0];
				}

				$descripcion_cum="";

				if(!empty($row['expediente_det']) and !empty($row['unidad_desc'])){
				    $sqlcum = "SELECT descripcion 
                       FROM vw_cum 
                       WHERE codigo_cum = CONCAT('" . $row['expediente_det'] . "', '-', '" . $row['unidad_desc'] . "')";
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
	/*$(document).ready(function() {
		$('#tabladetalle21').DataTable();		
	} );*/
</script>