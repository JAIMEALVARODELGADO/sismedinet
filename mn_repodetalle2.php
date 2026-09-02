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
    <script src="js/mn_repodetalle2.js"></script>
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
                        <h4>Captura de Medicamentos Cirucular 021</h4>
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

                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#nuevodetalle" title="Agrega Nuevo Registro" onclick="nuevoRegistro()">
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
    <div class="modal fade" id="nuevodetalle" name='nuevodetalle' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" class="form-control input-sm" id="id_detalle" name="id_detalle"> 
                        <label>Municipio FEV</label>
                        <select class="form-control" id="municipio" name="municipio">
                            <option value=""></option>
                            <?php
                            $sql="select m.codigo_mun, CONCAT(m.nombre_mun,' ',m.codigo_mun,' ',d.nombre) as descripcion
                            from municipio m
                            inner join departamento d  on d.codigo_dep = m.codigo_dep
                            order by m.nombre_mun";
                            $result=mysqli_query($conexion,$sql);
                            $listas="<option value=''></option>";
                            while($row=mysqli_fetch_array($result)){
                                echo "<option value='$row[codigo_mun]'>$row[descripcion]</option>";
                            }
                            ?>
                        </select>
                        <label>CUFE FEV</label>
                        <input type="text" maxlength="96" class="form-control input-sm" id="cufe" name="cufe">
                        <label>Número de la Factura FEV</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="numerofact_det" name="numerofact_det">
                        <label>Fecha de emisión de la Factura</label>
                        <input type="date" class="form-control input-sm" id="fechafact" name="fechafact">
                        <label>Código del detalle del producto en FEV</label>
                        <input type="text" maxlength="50" class="form-control input-sm" id="codigo_detalle" name="codigo_detalle">
                        <label>Unidad de medida en FEV</label>
                        <input type="text" maxlength="2" class="form-control input-sm" id="unidad_medida" name="unidad_medida">
                        <label>Cantidad FEV</label>
                        <input type="number" maxlength="16" class="form-control input-sm" id="cantidad" name="cantidad" class="form-control input-sm"">
                        <label>Precio Unitario FEV</label>
                        <input type="number" maxlength="16" class="form-control input-sm" id="precio_und" name="precio_und">
                        <label>Documento soporte del precio</label>
                        <input type="text" maxlength="96" class="form-control input-sm" id="documento_soporte" name="documento_soporte">
                        <label>Total Facturado FEV</label>
                        <input type="number" maxlength="16" class="form-control input-sm" id="total_facturado" name="total_facturado" disabled>
                        
                        <label>NIT de la entidad con la que se realizó la operación</label>
                        <input type="text" maxlength="9" class="form-control input-sm" id="nit_entidad_operacion" name="nit_entidad_operacion">
                        <label>Municipio de la entidad en la que se realizó la transacción</label>
                        <select class="form-control" id="municipio_operacion" name="municipio_operacion">
                            <option value=""></option>
                            <?php
                            $sql="select m.codigo_mun, CONCAT(m.nombre_mun,' ',m.codigo_mun,' ',d.nombre) as descripcion
                            from municipio m
                            inner join departamento d  on d.codigo_dep = m.codigo_dep
                            order by m.nombre_mun";
                            $result=mysqli_query($conexion,$sql);
                            $listas="<option value=''></option>";
                            while($row=mysqli_fetch_array($result)){
                                echo "<option value='$row[codigo_mun]'>$row[descripcion]</option>";
                            }
                            ?>
                        </select>
                        <label>Tipo de Operación</label>
                        <select class="form-control" id="tipo_operacion" name="tipo_operacion">
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
                        <select class="form-control" id="tipo_transaccion" name="tipo_transaccion">
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
                        <input type="text" maxlength="8" class="form-control input-sm" id="iumnivel1" name="iumnivel1">
                        <label>IUM de Segundo Nivel</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="iumnivel2" name="iumnivel2">
                        <label>IUM de Tercer Nivel</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="iumnivel3" name="iumnivel3">

                        <label>Medicamento según CUM</label>
                        <input type="text" maxlength="120" class="form-control input-sm" id="medicamento_cum" name="medicamento_cum">
                        <label>Número de Expediente</label>
                        <input type="text" maxlength="9" class="form-control input-sm" id="expediente" name="expediente">
                        <label>Presentación Comercial</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="presentacion_comercial" name="presentacion_comercial">
                        <label>Total de unidades facturadas en unidades minimas de dispensación</label>
                        <input type="number" maxlength="16" class="form-control input-sm" id="total_unidades_fac" name="total_unidades_fac">
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCerrarModal" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnGuardar" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatadetalle").load("tabladetalle21.php");
    });
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
            $("#iumnivel1").val(data[1]);
            $("#iumnivel2").val(data[2]);
            $("#iumnivel3").val(data[3]);
        });

        $("#medicamento_cum").autocomplete("procesos/autocomp_cum.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#medicamento_cum").result(function(event, data, formatted) {
            $("#expediente").val(data[1]);
            $("#presentacion_comercial").val(data[2]);
        });

    });

</script>
