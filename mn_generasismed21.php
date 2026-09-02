<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
/*if(isset($_POST['id_ccobroD'])){
    $_SESSION['gid_ccobro']=$_POST['id_ccobroD'];
}*/


$conrep="SELECT descrip_rep,fecha_ini_rep,fecha_fin_rep,observac_rep FROM reporte WHERE id_reporte='$_SESSION[gid_reporte]'";
//echo $conrep;
$conrep=mysqli_query($conexion,$conrep);
$rowrep=mysqli_fetch_row($conrep);
$descrip_rep=$rowrep['0'];
$fecha_ini_rep=$rowrep['1'];
$fecha_fin_rep=$rowrep['2'];
$observac_rep=$rowrep['3'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SIS-MEDinet</title>
    <link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
	<?php 
		require_once "scripts.php";
	?>
    
</head>

<body>
	<?php
	require("encabezado.php");
	require("menu.php")
	?>


	<div class="card text">		
		<div class="container">
            <div class="alert alert-secondary" role="alert">
                <div class="row">
                    <div class="col-sm-4"><label>Descripción: <?php echo $descrip_rep;?></label></div>
                    <div class="col-sm-4"><label>Fecha Inicial: <?php echo $fecha_ini_rep;?></label></div>
                    <div class="col-sm-4"><label>Fecha Final: <?php echo $fecha_fin_rep;?></label></div>
                </div>
                <div class="row">
                    <div class="col-sm-12"><label>Observación: <?php echo $observac_rep;?></label></div>
                </div>
                
            </div>
	        <div class="row">
	            <div class="col-sm-12">
	                <div class="card text-left">
	                    <div class="card-header">
	                        <h4>Generación de Archivo Plano para SISMED Cirucular 021</h4>
	                    </div>
	                    <div class="card-body">	                        
	                        <div id="generaplano"></div>
	                    </div>

	                    <div class="card-footer text-muted">
                            By Soluciones Thin & Thin
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>		
	</div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#generaplano").load("mn_generarplano21.php");
    });
</script>

