<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>SIS-MEDinet</title>
    <?php require_once "scripts.php";?>
    <link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
    <link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>
</head>

<body>
    <?php    
    require("encabezado.php");
    require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Captura de Medicamentos</h4>
                    </div>
                    <!--                  -->
                    <div>
                        <table class="table table-hover table-sm table-bordered font13" id="tablaparametros">
                            <thead style="background-color: #62748E; color: white; font-weight: bold;">
                                <tr>
                                    <td align="center">Factura</td>
                                    <td align="center">Fecha</td>
                                    <td align="center">Operación</td>
                                    <td align="center">IUM Niv 1</td>
                                    <td align="center">IUM Niv 2</td>
                                    <td align="center">IUM Niv 3</td>
                                    <td align="center">Expediente</td>
                                    <td></td>
                                </tr>
                            </thead>

                            <tbody style="background-color: white">
                                <tr>
                                    <td align="center"><input id="factura_" name="factura_" type="text" size="10"></td>
                                    <td align="center"><input id="fecha_" name="fecha_" type="date"></td>
                                    <td align="center">
                                        <select id="operacion_" name="operacion_">
                                            <option value=''></option>
                                            <?php
                                            $sqlOpera="SELECT codi_det,descripcion_det FROM vw_tpoperacion ORDER BY codi_det";
                                            $resultOpera=mysqli_query($conexion,$sqlOpera);
                                            while($rowOpera=mysqli_fetch_array($resultOpera)){
                                                echo "<option value='$rowOpera[codi_det]'>$rowOpera[descripcion_det]</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td align="center"><input id="iumN1_" name="iumN1_" type="text" size="10"></td>
                                    <td align="center"><input id="iumN2_" name="iumN2_" type="text" size="10"></td>
                                    <td align="center"><input id="iumN3_" name="iumN3_" type="text" size="10"></td>
                                    <td align="center"><input id="expediente_" name="expediente_" type="text" size="10"></td>
                                    <td align="center">
                                        <span class="btn btn-primary" title="Filtrar" onclick="filtrar()" id="btn_filtrar"> <i class="fas fa-search"></i></span>
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                    <!--                  -->


                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#nuevodetalle" title="Agrega Nuevo Registro">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatadetalle"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevodetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Registro de Medicamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Número de la Factura</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="numerofact_det" name="numerofact_det">
                        <label>Fecha de la Factura</label>
                        <input type="date" class="form-control input-sm" id="fechafact" name="fechafact">
                        <label>Tipo de Operación</label>
                        <select class="form-control" id="tipo_operacion_det" name="tipo_operacion_det">
                            <option value=""></option>
                            <?php
                            $sql="SELECT codi_det,descripcion_det FROM vw_tpoperacion ORDER BY codi_det";
                            $result=mysqli_query($conexion,$sql);
                            $listas="<option value=''></option>";
                            while($row=mysqli_fetch_row($result)){
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                            ?>
                        </select>
                        <label>Tipo de Transacción</label>
                        <select class="form-control" id="tipo_transaccio_det" name="tipo_transaccio_det">
                            <option value=""></option>
                            <?php
                            $sql="SELECT codi_det,descripcion_det FROM vw_tptransaccion ORDER BY codi_det";
                            $result=mysqli_query($conexion,$sql);
                            $listas="<option value=''></option>";
                            while($row=mysqli_fetch_row($result)){
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                            ?>
                        </select>
                        <label>Medicamento según IUM</label>
                        <input type="text" maxlength="120" class="form-control input-sm" id="medicamento_ium" name="medicamento_ium">
                        <label>IUM de Primer Nivel</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="iumnivel1_det" name="iumnivel1_det">
                        <label>IUM de Segundo Nivel</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="iumnivel2_det" name="iumnivel2_det">
                        <label>IUM de Tercer Nivel</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="iumnivel3_det" name="iumnivel3_det">
                        <label>Medicamento según CUM</label>
                        <input type="text" maxlength="120" class="form-control input-sm" id="medicamento_cum" name="medicamento_cum">
                        <label>Expediente</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="expediente_det" name="expediente_det">
                        <label>Consecutivo</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="exped_consec_det" name="exped_consec_det">
                        </select>
                        <label>Unidad en la que se factura</label>
                        <select class="form-control" id="unidad_det" name="unidad_det">
                            <option value=""></option>
                            <?php
                            $sql="SELECT codi_det,descripcion_det FROM vw_unidad ORDER BY codi_det";
                            $result=mysqli_query($conexion,$sql);
                            $listas="<option value=''></option>";
                            while($row=mysqli_fetch_row($result)){
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                            ?>
                        </select>
                        <label>Cantidad</label>
                        <input type="text" maxlength="16" class="form-control input-sm" id="cantidad_det" name="cantidad_det">
                        <label>Valor Unitario</label>
                        <input type="text" maxlength="16" class="form-control input-sm" id="valor_unit_det" name="valor_unit_det">
                        <input type="hidden" name="fechafact_det" id="fechafact_det">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_detalle" name="id_detalle">
                        <label>Número de la Factura</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="numerofact_detU" name="numerofact_detU">
                        <label>Fecha de la Factura</label>
                        <input type="date" class="form-control input-sm" id="fechafactU" name="fechafactU">
                        <label>Tipo de Operación</label>
                        <select class="form-control" id="tipo_operacion_detU" name="tipo_operacion_detU">
                            <option value=""></option>
                            <?php
                            $sql="SELECT codi_det,descripcion_det FROM vw_tpoperacion ORDER BY codi_det";
                            $result=mysqli_query($conexion,$sql);
                            $listas="<option value=''></option>";
                            while($row=mysqli_fetch_row($result)){
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                            ?>
                        </select>
                        <label>Tipo de Transacción</label>
                        <select class="form-control" id="tipo_transaccio_detU" name="tipo_transaccio_detU">
                            <option value=""></option>
                            <?php
                            $sql="SELECT codi_det,descripcion_det FROM vw_tptransaccion ORDER BY codi_det";
                            $result=mysqli_query($conexion,$sql);
                            $listas="<option value=''></option>";
                            while($row=mysqli_fetch_row($result)){
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                            ?>
                        </select>
                        <label>Medicamento según IUM</label>
                        <input type="text" maxlength="120" class="form-control input-sm" id="medicamento_iumU" name="medicamento_iumU">
                        <label>IUM de Primer Nivel</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="iumnivel1_detU" name="iumnivel1_detU">
                        <label>IUM de Segundo Nivel</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="iumnivel2_detU" name="iumnivel2_detU">
                        <label>IUM de Tercer Nivel</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="iumnivel3_detU" name="iumnivel3_detU">
                        <label>Medicamento según CUM</label>
                        <input type="text" maxlength="120" class="form-control input-sm" id="medicamento_cumU" name="medicamento_cumU">
                        <label>Expediente</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="expediente_detU" name="expediente_detU">
                        <label>Consecutivo</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="exped_consec_detU" name="exped_consec_detU">
                        </select>
                        <label>Unidad en la que se factura</label>
                        <select class="form-control" id="unidad_detU" name="unidad_detU">
                            <option value=""></option>
                            <?php
                            $sql="SELECT codi_det,descripcion_det FROM vw_unidad ORDER BY codi_det";
                            $result=mysqli_query($conexion,$sql);
                            $listas="<option value=''></option>";
                            while($row=mysqli_fetch_row($result)){
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                            ?>
                        </select>
                        <label>Cantidad</label>
                        <input type="text" maxlength="16" class="form-control input-sm" id="cantidad_detU" name="cantidad_detU">
                        <label>Valor Unitario</label>
                        <input type="text" maxlength="16" class="form-control input-sm" id="valor_unit_detU" name="valor_unit_detU">
                        <input type="hidden" name="fechafact_detU" id="fechafact_detU">
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="fecha_ini" id="fecha_ini">
    <input type="hidden" name="fecha_fin" id="fecha_fin">
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatadetalle").load("tabladetalle.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            /* Aqui valido si el medicamento existe*/
            validarMedicamentoIum();
            validarMedicamentoCums();

            $('#fechafact_det').val($('#fechafact').val());            
            fechafac_=new Date($('#fechafact').val());
            fechaini_=new Date($('#fecha_ini').val());
            fechafin_=new Date($('#fecha_fin').val());            
            if (Date.parse(fechafac_) >= Date.parse(fechaini_) && Date.parse(fechafac_) <= Date.parse(fechafin_)){
                datos=$('#frm_nuevo').serialize();            
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregardetalle.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");
                            setTimeout(() => {

                            }, 1000);
                             
                            //$('#frm_nuevo')[0].reset();
                            $('#medicamento_ium').val("");
                            $('#iumnivel1_det').val("");
                            $('#iumnivel2_det').val("");
                            $('#iumnivel3_det').val("");
                            $('#medicamento_cum').val("");
                            $('#expediente_det').val("");
                            $('#exped_consec_det').val("");
                            $('#unidad_det').val("");
                            $('#cantidad_det').val("");
                            $('#valor_unit_det').val("");
                            $("#tablaDatadetalle").load("tabladetalle.php");                            
                        }
                        else{
                            alertify.error("Error: Registro no guardado");
                        }
                    }
                });                    
            }else{
                alertify.error("Fecha de la factura fuera de rango");
            }
        });

        $('#btnActualizar').click(function(){
            $('#fechafact_detU').val($('#fechafactU').val());            
            fechafac_=new Date($('#fechafactU').val());
            fechaini_=new Date($('#fecha_ini').val());
            fechafin_=new Date($('#fecha_fin').val());            
            if (Date.parse(fechafac_) >= Date.parse(fechaini_) && Date.parse(fechafac_) <= Date.parse(fechafin_)){
                datos=$('#frm_editar').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/actualizardetalle.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatadetalle").load("tabladetalle.php");
                            alertify.success("Registro guardado");
                        }
                        else{
                            alertify.error("Error: El registro no guardado");
                        }
                    }
                });
            }
            else{
                alertify.error("Fecha de la factura fuera de rango");
            }
        });

    }); 

    function eliminarDatos(iddetalle,descripcion){
        alertify.confirm('Eliminar Registro', 'Desea Eliminar este expediente? '+descripcion, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"iddetalle="+iddetalle,
                    url:"procesos/eliminardetalle.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatadetalle").load("tabladetalle.php");
                            alertify.success("Registro Eliminado!");
                        }else{
                            alertify.error("Registro NO Eliminado!");
                        }
                    }
                })

            }
            ,function(){

            });
    }

    async function validarMedicamentoIum(){
        var codigo_ium = document.getElementById("iumnivel1_det").value +
                        document.getElementById("iumnivel2_det").value +
                        document.getElementById("iumnivel3_det").value;
        if (codigo_ium.trim() === '' || codigo_ium === null || codigo_ium ==='000') {
            alert("El codigo no se guarda")
            return true;
        }
        try {
            var opcion = 'consultar_ium';
            const url = 'procesos/crud_repodetalle.php?opcion=' + opcion +
                        '&codigo_ium=' + codigo_ium;

            const respuesta = await fetch(url);
            const datos = await respuesta.json();

            if (datos === null && confirm("El código IUM no existe. ¿Desea crearlo?")) {
                guardarNuevoMedicamentoIUM();
                return null;
            }
        
        } catch (error) {
            console.error('Error:', error);
            return null;
        }
    }

    async function guardarNuevoMedicamentoIUM(){
    let nombre_ium = document.getElementById("medicamento_ium").value;
    let codigo_ium = document.getElementById("iumnivel1_det").value +
                    document.getElementById("iumnivel2_det").value + 
                    document.getElementById("iumnivel3_det").value;
    let iumnivel1_det = document.getElementById("iumnivel1_det").value;
    let iumnivel2_det = document.getElementById("iumnivel2_det").value;
    let iumnivel3_det = document.getElementById("iumnivel3_det").value;
    
    try {
        // Crear el objeto FormData
        const formData = new FormData();
        formData.append('opcion', 'nuevo_ium');
        formData.append('nombre_ium', nombre_ium);
        formData.append('codigo_ium', codigo_ium);
        formData.append('nivel1_ium', iumnivel1_det);
        formData.append('nivel2_ium', iumnivel2_det);
        formData.append('nivel3_ium', iumnivel3_det);

        const respuesta = await fetch('procesos/crud_repodetalle.php', {
            method: 'POST',
            body: formData
        });

        const datos = await respuesta.text(); 
        alertify.success(datos);
        
        return datos;
    
        } catch (error) {
            console.error('Error:', error);
            alertify.error('Error al guardar el medicamento');
            return null;
        }
    }

    async function validarMedicamentoCums(){
        var codigo_cum = document.getElementById("expediente_det").value +'-'+
                        document.getElementById("exped_consec_det").value;
        //alert(codigo_cum);
        if (codigo_cum ==='-') {
            //alert("El codigo no se guarda")
            return true;
        }
        try {
            var opcion = 'consultar_cum';
            const url = 'procesos/crud_repodetalle.php?opcion=' + opcion +
                        '&codigo_cum=' + codigo_cum;

            const respuesta = await fetch(url);
            const datos = await respuesta.json();

            if (datos === null && confirm("El código CUM no existe. ¿Desea crearlo?")) {
                guardarNuevoMedicamentoCUM();
                return null;
            }
        
        } catch (error) {
            console.error('Error:', error);
            return null;
        }
    }

    async function guardarNuevoMedicamentoCUM(){
        let producto_cum = document.getElementById("medicamento_cum").value;
        let codigo_cum = document.getElementById("expediente_det").value +'-'+
                    document.getElementById("exped_consec_det").value;
        let expediente_cum = document.getElementById("expediente_det").value;
        let consecutivo_cum = document.getElementById("exped_consec_det").value;

        try {
            // Crear el objeto FormData
            const formData = new FormData();
            formData.append('opcion', 'nuevo_cum');
            formData.append('producto_cum', producto_cum);
            formData.append('codigo_cum', codigo_cum);
            formData.append('expediente_cum', expediente_cum);
            formData.append('consecutivo_cum', consecutivo_cum);

            const respuesta = await fetch('procesos/crud_repodetalle.php', {
                method: 'POST',
                body: formData
            });

            const datos = await respuesta.text(); 
            alertify.success(datos);
            
            return datos;
        
            } catch (error) {
                console.error('Error:', error);
                alertify.error('Error al guardar el medicamento');
                return null;
            }
    }

</script>

<script type="text/javascript">
    function agregaFrmActualizar(iddetalle){        
        $.ajax({
            type:"POST",
            data:"iddetalle="+iddetalle,
            url:"procesos/obtenDatosdetalle.php",
            success:function(r){
                //datos=jQuery.parseJSON(r);
                var datos = JSON.parse(r);                
                $('#id_detalle').val(datos['id_detalle']);
                $('#numerofact_detU').val(datos['numerofact_det']);
                $('#fechafactU').val(datos['fechafact_det']);
                $('#tipo_operacion_detU').val(datos['tipo_operacion_det']);
                $('#tipo_transaccio_detU').val(datos['tipo_transaccio_det']);
                $('#iumnivel1_detU').val(datos['iumnivel1_det']);
                $('#iumnivel2_detU').val(datos['iumnivel2_det']);
                $('#iumnivel3_detU').val(datos['iumnivel3_det']);
                $('#expediente_detU').val(datos['expediente_det']);
                $('#exped_consec_detU').val(datos['exped_consec_det']);
                $('#unidad_detU').val(datos['unidad_det']);
                $('#cantidad_detU').val(datos['cantidad_det']);
                $('#valor_unit_detU').val(datos['valor_unit_det']);
                $('#fechafact_detU').val(datos['fechafact_det']);
                $('#medicamento_iumU').val(datos['medicamento_ium']);
                $('#medicamento_cumU').val(datos['medicamento_cum']);

            }
        })
    }

</script>

<script type="text/javascript">
    $().ready(function() {
        $("#medicamento_ium").autocomplete("procesos/autocomp_ium.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#medicamento_ium").result(function(event, data, formatted) {
            $("#iumnivel1_det").val(data[1]);
            $("#iumnivel2_det").val(data[2]);
            $("#iumnivel3_det").val(data[3]);
        });

        $("#medicamento_cum").autocomplete("procesos/autocomp_cum.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#medicamento_cum").result(function(event, data, formatted) {
            $("#expediente_det").val(data[1]);
            $("#exped_consec_det").val(data[2]);
        });

        $("#medicamento_iumU").autocomplete("procesos/autocomp_ium.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#medicamento_iumU").result(function(event, data, formatted) {
            $("#iumnivel1_detU").val(data[1]);
            $("#iumnivel2_detU").val(data[2]);
            $("#iumnivel3_detU").val(data[3]);
        });

        $("#medicamento_cumU").autocomplete("procesos/autocomp_cum.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#medicamento_cumU").result(function(event, data, formatted) {
            $("#expediente_detU").val(data[1]);
            $("#exped_consec_detU").val(data[2]);
        });
    });

    /*function filtrar(){
        var factura_ = document.getElementById("factura_").value;
        var fecha_ = document.getElementById("fecha_").value;
        var operacion_ = document.getElementById("operacion_").value;
        var iumN1_ = document.getElementById("iumN1_").value;
        var iumN2_ = document.getElementById("iumN2_").value;
        var iumN3_ = document.getElementById("iumN3_").value;
        var iumN3_ = document.getElementById("iumN3_").value;
        var expediente_ = document.getElementById("expediente_").value;
        var url="tabladetalle.php?factura_="+factura_
        +"&fecha_="+fecha_
        +"&operacion_="+operacion_
        +"&iumN1_="+iumN1_
        +"&iumN2_="+iumN2_
        +"&iumN3_="+iumN3_
        +"&expediente_="+expediente_;

        $("#tablaDatadetalle").load(url);
    }*/

    function filtrar() {
    var datos = {
        factura_: document.getElementById("factura_").value,
        fecha_: document.getElementById("fecha_").value,
        operacion_: document.getElementById("operacion_").value,
        iumN1_: document.getElementById("iumN1_").value,
        iumN2_: document.getElementById("iumN2_").value,
        iumN3_: document.getElementById("iumN3_").value,
        expediente_: document.getElementById("expediente_").value
    };
    //alert();
    //console.log(datos);
    $.ajax({
        url: "tabladetalle.php",
        type: "POST",
        data: JSON.stringify(datos),
        contentType: "application/json",
        success: function(respuesta) {
            $("#tablaDatadetalle").html(respuesta);
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición:", error);
        }
        });
    }

</script>
