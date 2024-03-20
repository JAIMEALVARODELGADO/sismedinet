<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
//require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();
$hoy=date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
     <title>SIS-MEDinet</title>
     <?php require_once "scripts.php";?>
     <link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
</head>

<body>
<form id="form1" name='form1' method="POST">
    <?php
    require("encabezado.php");
    require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Informe de Registro de Medicamentos</h4>
                    </div>
                    <div class="card-body">
                        <h5>Parámetros para el Informe</h5>
                        <div class="form-group row">
                            <label for="titulo" class="col-sm-2 col-form-label">Título para el informe</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="titulo" name="titulo" size='200' value="INFORME DE REGISTRO DE MEDICAMENTOS">                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_eps" class="col-sm-2 col-form-label">Periodo</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" id="id_reporte" name="id_reporte">
                                    <?php
                                    $sql="SELECT id_reporte,descrip_rep FROM reporte WHERE id_entidad='$_SESSION[gid_entidad]' ORDER BY id_reporte DESC";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                    ?>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_persona" class="col-sm-2 col-form-label">Factura</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numerofact_det" name="numerofact_det" size='20' placeholder="digite numero de factura">                                 
                            </div>
                            <label for="id_persona" class="col-sm-2 col-form-label">Código IUM</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="codigo_ium" name="codigo_ium" size='20' placeholder="digite código IUM">                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_persona" class="col-sm-2 col-form-label">Tipo de Operación</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm" id="tipo_operacion_det" name="tipo_operacion_det">
                                    <option value=''></option>
                                    <?php
                                    $sql="SELECT codi_det,descripcion_det FROM vw_tpoperacion";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                    ?>
                                </select>                                   
                            </div>
                            <label for="id_persona" class="col-sm-2 col-form-label">Expediente</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="codigo_cum" name="codigo_cum" size='20' placeholder="digite código CUM">                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_persona" class="col-sm-2 col-form-label">Tipo de Transacción</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm" id="tipo_transaccio_det" name="tipo_transaccio_det">
                                    <option value=''></option>
                                    <?php
                                    $sql="SELECT codi_det,descripcion_det FROM vw_tptransaccion";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                    ?>
                                </select>                                   
                            </div>
                            <label for="id_persona" class="col-sm-2 col-form-label">Unidad</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm" id="unidad_det" name="unidad_det">
                                    <option value=''></option>
                                    <?php
                                    $sql="SELECT codi_det,descripcion_det FROM vw_unidad";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                    ?>
                                </select>                                    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha" class="col-sm-2 col-form-label">Rango de Fechas</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechaini" name="fechaini"> 
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechafin" name="fechafin"> 
                            </div>
                        </div>
                        <hr>
                        <h5>Campos para el informe</h5>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_numerofact_det" id="chk_numerofact_det" checked="true">Factura
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_fechafact_det" id="chk_fechafact_det" checked="true">Fecha
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_tipo_operacion_det" id="chk_tipo_operacion_det" checked="true">Tipo de Operación
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_tipo_transaccio_det" id="chk_tipo_transaccio_det" checked="true">Tipo de Transacción
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_iumnivel1_det" id="chk_iumnivel1_det" checked="true">IUM Nivel 1
                                    </label>
                                </div>
                            </div>                            
                            
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_iumnivel2_det" id="chk_iumnivel2_det" checked="true">IUM Nivel 2
                                    </label>
                                </div>
                            </div>  
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_iumnivel3_det" id="chk_iumnivel3_det" checked="true">IUM Nivel 3
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_expediente_det" id="chk_expediente_det" checked="true">Expediente
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_exped_consec_det" id="chk_exped_consec_det" checked="true">Consecutivo Expediente
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_unidad_det" id="chk_unidad_det" checked="true">Unidad
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_cantidad_det" id="chk_cantidad_det" checked="true">Cantidad
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_valor_unit_det" id="chk_valor_unit_det" checked="true">Valor Unitario
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_total" id="chk_total" checked="true">Valor Total
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_fecha_ret_det" id="chk_fecha_reg_det">Fecha de registro
                                    </label>
                                </div>
                            </div>

                        </div>                 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">                            
                            <label for="orden">
                                Ordenado por: 
                                <select class="form-control form-control-sm" name="orden" id="orden">
                                    <option value="fechafact_det">FECHA</option>
                                    <option value="numerofact_det">FACTURA</option>
                                    <option value="tipo_operacion_det">TIPO DE OPERACION</option>
                                    <option value="tipo_transaccio_det">TIPO DE TRANSACCION</option>
                                    <option value="codigo_ium">IUM</option>
                                    <option value="codigo_cum">EXPEDIENTE</option>
                                </select>
                            </label>
                            <span class="btn btn-primary" title="Buscar" onclick="actcampos()" id="btn_buscar">Buscar <i class="fas fa-search"></i></span>
                            </span>                           
                        </div>
                    </div>

                    <div id="tablaDatainforme"></div>
                    <div class="col-sm-6">
                        <span class="btn btn-success" title="Imprimir" onclick="imprimir()" id="btn_buscar">Imprimir <i class="fas fa-print"></i></span>
                        </span>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="condicion" name="condicion">
    <input type="hidden" id="campos" name="campos">
    <input type="hidden" id="sql" name="sql">
</form>
</body>

</html>

<script type="text/javascript">
    acturalizar();
    $(document).ready(function(){
        $("#tablaDatainforme").load("tablainf_consulta.php");
    });
</script>


<script type="text/javascript">
    function actualizar(){
        condicion="id_entidad='"+<?php echo $_SESSION['gid_entidad'];?>+"'";
        if($('#id_reporte').val()!=""){
            condicion+=" AND id_reporte='"+$('#id_reporte').val()+"'";
        }
        if($('#numerofact_det').val()!=""){
            condicion+=" AND numerofact_det='"+$('#numerofact_det').val()+"'";
        }
        if($('#tipo_operacion_det').val()!=""){
            condicion+=" AND tipo_operacion_det='"+$('#tipo_operacion_det').val()+"'";
        }
        if($('#tipo_transaccio_det').val()!=""){
            condicion+=" AND tipo_transaccio_det='"+$('#tipo_transaccio_det').val()+"'";
        }
        if($('#codigo_ium').val()!=""){
            condicion+=" AND codigo_ium='"+$('#codigo_ium').val()+"'";
        }
        if($('#codigo_cum').val()!=""){
            condicion+=" AND codigo_cum='"+$('#codigo_cum').val()+"'";
        }
        if($('#unidad_det').val()!=""){
            condicion+=" AND unidad_det='"+$('#unidad_det').val()+"'";
        }
        if($('#fechaini').val()!=""){
            condicion+=" AND fechafact_det between '"+$('#fechaini').val()+" 00:00' AND '"+$('#fechafin').val()+" 23:59'";
        }
        $('#condicion').val(condicion);
        $('#sql').val("SELECT "+$('#campos').val()+" FROM vw_reporte_detalle WHERE "+$('#condicion').val()+" ORDER BY "+$('#orden').val());
        $(document).ready(function(){
            datos=$('#form1').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarinforme1.php",                
            });
            $("#tablaDatainforme").load("tablainf_consulta.php");            
        });
    }

    function actcampos(){        
        var campos="";
        if($('#chk_numerofact_det').prop('checked')==true){
            campos+="numerofact_det AS FACTURA,";
        }
        if($('#chk_fechafact_det').prop('checked')==true){
            campos+="fechafact_det AS FECHA,";
        }
        if($('#chk_tipo_operacion_det').prop('checked')==true){
            campos+="tipo_operacion_desc AS OPERACION,";
        }
        if($('#chk_tipo_transaccio_det').prop('checked')==true){
            campos+="tipo_transaccion_desc AS TRANSACCION,";
        }
        if($('#chk_iumnivel1_det').prop('checked')==true){
            campos+="iumnivel1_det AS IUM_NIVEL_1,";
        }
        if($('#chk_iumnivel2_det').prop('checked')==true){
            campos+="iumnivel2_det AS IUM_NIVEL_2,";
        }
        if($('#chk_iumnivel3_det').prop('checked')==true){
            campos+="iumnivel3_det AS IUM_NIVEL_3,";
        }
        if($('#chk_expediente_det').prop('checked')==true){
            campos+="expediente_det AS EXPEDIENTE,";
        }
        if($('#chk_exped_consec_det').prop('checked')==true){
            campos+="exped_consec_det AS CONSECUTIVO,";
        }
        if($('#chk_unidad_det').prop('checked')==true){
            campos+="unidad_desc AS UNIDAD,";
        }
        if($('#chk_cantidad_det').prop('checked')==true){
            campos+="cantidad_det AS CANTIDAD,";
        }
        if($('#chk_valor_unit_det').prop('checked')==true){
            campos+="valor_unit_det AS VALOR_UND,";
        }
        if($('#chk_total').prop('checked')==true){
            campos+="total AS TOTAL,";
        }
        if($('#chk_fecha_reg_det').prop('checked')==true){
            campos+="fecha_reg_det AS FECHA_REGISTRO,";
        }
        campos=campos.slice(0,-1);        
        $('#campos').val(campos);
        actualizar();
    }

    function imprimir(){
        document.form1.action="mn_impr_informe1.php";
        document.form1.target="new";
        document.form1.submit();
    }
</script>


