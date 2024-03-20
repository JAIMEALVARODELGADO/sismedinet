<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>SIS-MEDinet</title>
    <?php require_once "scripts.php";?>
    <link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
    <!--<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">-->
    <!--<script type="text/javascript" src="../librerias/js/jquery.js"></script>-->
    <!--<script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>-->
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
                        <h4>Periodos de Reporte</h4>
                        <h6>Gestión de periodos para reporte</h6>
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevoperiodo" title="Agrega Nuevo Periodo">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDataperiodo"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Modal Nuevo -->
    <div class="modal fade" id="modalnuevoperiodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Periodo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Descripción del periodo</label>
                        <input type="text" maxlength="45" class="form-control input-sm" id="descrip_rep" name="descrip_rep" placeholder="Descripción corta del periodo">
                        <label>Fecha Inicial</label>
                        <input type="date" class="form-control input-sm" id="fecha_ini" name="fecha_ini">
                        <label>Fecha Final</label>
                        <input type="date" class="form-control input-sm" id="fecha_fin" name="fecha_fin">
                        <label>Observación</label>
                        <input type="text" maxlength="200" class="form-control input-sm" id="observac_rep" name="observac_rep" placeholder="Observación">
                        <input type="hidden" class="form-control input-sm" id="fecha_ini_rep" name="fecha_ini_rep">
                        <input type="hidden" class="form-control input-sm" id="fecha_fin_rep" name="fecha_fin_rep">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary" onclick="validar()">Guardar <span class="fas fa-save"></span>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modaleditarperiodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Periodo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Descripción del periodo</label>
                        <input type="hidden" id="id_reporte" name="id_reporte">
                        <input type="text" maxlength="45" class="form-control input-sm" id="descrip_repU" name="descrip_repU" placeholder="Descripción corta del periodo">
                        <label>Fecha Inicial</label>
                        <input type="date" class="form-control input-sm" id="fecha_iniU" name="fecha_iniU">
                        <label>Fecha Final</label>
                        <input type="date" class="form-control input-sm" id="fecha_finU" name="fecha_finU">
                        <label>Observación</label>
                        <input type="text" maxlength="200" class="form-control input-sm" id="observac_repU" name="observac_repU" placeholder="Observación">
                        <input type="hidden" class="form-control input-sm" id="fecha_ini_repU" name="fecha_ini_repU">
                        <input type="hidden" class="form-control input-sm" id="fecha_fin_repU" name="fecha_fin_repU">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnActualizar" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDataperiodo").load("tablaperiodos.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            $('#fecha_ini_rep').val($('#fecha_ini').val());
            $('#fecha_fin_rep').val($('#fecha_fin').val());
            datos=$('#frm_nuevo').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarperiodo.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataperiodo").load("tablaperiodos.php");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });

        $('#btnActualizar').click(function(){
            $('#fecha_ini_repU').val($('#fecha_iniU').val());
            $('#fecha_fin_repU').val($('#fecha_finU').val());
            datos=$('#frm_editar').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarperiodo.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataperiodo").load("tablaperiodos.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });
    });
</script>


<script type="text/javascript">
    function FrmActualizar(idreporte){
        $.ajax({
            type:"POST",
            data:"idreporte="+idreporte,
            url:"procesos/obtenDatosperiodo.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_reporte').val(datos['id_reporte']);
                $('#descrip_repU').val(datos['descrip_rep']);
                $('#fecha_iniU').val(datos['fecha_ini_rep']);
                $('#fecha_finU').val(datos['fecha_fin_rep']);
                $('#observac_repU').val(datos['observac_rep']);
                
            }
        })
    }

    function cambiarestado(idreporte){
        $.ajax({
            type:"POST",
            data:"idreporte="+idreporte,
            url:"procesos/cambiarestadoperiodo.php",
            success:function(r){
                if(r==1){
                    $("#tablaDatacupsprof").load("tablacupsprof.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }

    function eliminarDatos(idreporte,descripcion){
        alertify.confirm('Eliminar Periodo', 'Desea Eliminar este periodo? '+descripcion, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idreporte="+idreporte,
                    url:"procesos/eliminarreporte.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataperiodo").load("tablaperiodos.php");
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

</script>
