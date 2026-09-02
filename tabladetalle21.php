<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");

// Leer JSON enviado por AJAX
$input = json_decode(file_get_contents("php://input"), true);

$condicion = "id_reporte='" . $_SESSION['gid_reporte'] . "'";

if (!empty($input['factura_'])) {
    $condicion .= " AND numerofact_det = '" . $input['factura_'] . "'";
}

if (!empty($input['fecha_'])) {
    $condicion .= " AND fechafact = '" . $input['fecha_'] . "'";
}

if (!empty($input['operacion_'])) {
    $condicion .= " AND tipo_operacion = '" . $input['operacion_'] . "'";
}

if (!empty($input['iumN1_'])) {
    $condicion .= " AND iumnivel1 = '" . $input['iumN1_'] . "'";
}

if (!empty($input['iumN2_'])) {
    $condicion .= " AND iumnivel2 = '" . $input['iumN2_'] . "'";
}

if (!empty($input['iumN3_'])) {
    $condicion .= " AND iumnivel3 = '" . $input['iumN3_'] . "'";
}

if (!empty($input['expediente_'])) {
    $condicion .= " AND expediente = '" . $input['expediente_'] . "'";
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

$sql = "SELECT rp.id_detalle,rp.id_reporte,rp.numerofact_det,rp.fechafact,rp.iumnivel1,rp.iumnivel2,rp.iumnivel3,
rp.expediente,rp.presentacion_comercial,rp.unidad_medida,rp.cantidad,rp.precio_und,rp.total_unidades_fac,
rp.precio_und*rp.total_unidades_fac as total,rp.documento_soporte,rp.nit_entidad_operacion,rp.municipio_operacion,
tp.descripcion_det AS tipo_operacion_desc, 
tt.descripcion_det AS tipo_transaccion_desc
FROM reporte_detalle021 rp 
INNER JOIN vw_tpoperacion tp ON rp.tipo_operacion = tp.codi_det 
INNER JOIN vw_tptransaccion tt ON rp.tipo_transaccion = tt.codi_det
WHERE $condicion ORDER BY rp.numerofact_det DESC";
//print_r($sql);

$result=mysqli_query($conexion,$sql);

?>
<script type="text/javascript">    
    var fecha_ini="<?php echo $fecha_ini;?>";
    var fecha_fin="<?php echo $fecha_fin;?>";
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
				<td>Pres.Comer</td>
				<td>Und FEV</td>
				<td>Cant. FEV</td>
				<td>Precio Unit FEV</td>
				<td>Total</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_array($result)){
				$descripcion_ium="";
				$codigo_ium=$row['iumnivel1'].$row['iumnivel2'].$row['iumnivel3'];
				$sqlium="SELECT descripcion FROM vw_ium WHERE codigo_ium='$codigo_ium'";
				$resultium=mysqli_query($conexion,$sqlium);
				if(mysqli_num_rows($resultium)<>0){
					$rowium=mysqli_fetch_row($resultium);
					$descripcion_ium=$rowium[0];
				}

				$descripcion_cum="";

				if(!empty($row['expediente']) and !empty($row['presentacion_comercial'])){
				    $sqlcum = "SELECT descripcion 
                       FROM vw_cum 
                       WHERE codigo_cum = CONCAT('" . $row['expediente'] . "', '-', '" . $row['presentacion_comercial'] . "')";
					$resultcum=mysqli_query($conexion,$sqlcum);
					if(mysqli_num_rows($resultcum)<>0){
						$rowcum=mysqli_fetch_row($resultcum);
						$descripcion_cum=$rowcum[0];
					}
				}
				
				?>
				<tr>
					<td><?php echo $row['numerofact_det'];?></td>
					<td><?php echo $row['fechafact'];?></td>					
					<td><?php echo $row['tipo_operacion_desc'];?></td>
					<td><?php echo $row['tipo_transaccion_desc'];?></td>
					<td><a href="#" title="<?php echo $descripcion_ium;?>"><?php echo $row['iumnivel1'];?></a></td>
					<td><?php echo $row['iumnivel2'];?></td>
					<td><?php echo $row['iumnivel3'];?></td>
					<td><a href="#" title="<?php echo $descripcion_cum;?>"><?php echo $row['expediente'];?></a></td>
					<td><?php echo $row['presentacion_comercial'];?></td>
					<td><?php echo $row['unidad_medida'];?></td>
					<td style="text-align: right;"><?php echo number_format($row['cantidad'], 0, ',', '.');?></td>
					<td style="text-align: right;"><?php echo number_format($row['precio_und'], 0, ',', '.');?></td>
					<td style="text-align: right;"><?php echo number_format($row['total'], 0, ',', '.'); ?></td>
					
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#nuevodetalle" title="Editar El Registro" 
						onclick="consultarRegistro('<?php echo $row['id_detalle'];?>','<?php echo $descripcion_ium;?>','<?php echo $descripcion_cum;?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>

					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Borrar el Registro" onclick="eliminarRegistro('<?php echo $row['id_detalle']?>','<?php echo $row['expediente'].'-'.$row['presentacion_comercial']?>')">
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

