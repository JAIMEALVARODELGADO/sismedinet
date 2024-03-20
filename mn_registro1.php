<?php
require("valida_sesion.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>SIS-MEDinet</title>

    <?php 
        require_once "scripts.php";
        require_once "clases/conexion.php";
        $obj=new conectar();
        $conexion=$obj->conexion();
    ?>
    <link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>
</head>

<body>
    <?php
    require("encabezado.php");
    //require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Registro de la Entidad</h4>
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" action="mn_cita21.php">
                            <div class="form-group row">
                                <label for="nombre_ent" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombre_ent" name="nombre_ent" size='10' placeholder="digite el nombre de identificación de la entidad" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tipo_ident_ent" class="col-sm-2 col-form-label">Tipo de Identificación</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" id="tipo_ident_ent" name="tipo_ident_ent">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_tipo_ident";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>                            
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="numero_iden_ent" class="col-sm-2 col-form-label">Número de Identificación (Sin dígito de verificación)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="numero_iden_ent" name="numero_iden_ent" size='10' placeholder="digite el numero de identificación de la entidad" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="direccion_ent" class="col-sm-2 col-form-label">Dirección</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="direccion_ent" name="direccion_ent" size='150' placeholder="digite la direccion de la entidad" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telefonos_ent" class="col-sm-2 col-form-label">Teléfonos</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="telefonos_ent" name="telefonos_ent" size='150' placeholder="digite el teléfono de contacto" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ciudad_ent" class="col-sm-2 col-form-label">Ciudad</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ciudad_ent" name="ciudad_ent" size='50' placeholder="digite la ciudad de la entidad" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_ent" class="col-sm-2 col-form-label">E-mail</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email_ent" name="email_ent" size='150' placeholder="digite el email de la entidad" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rol_ent" class="col-sm-2 col-form-label">Rol del Actor Reportante</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" id="rol_ent" name="rol_ent">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_rol";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>                            
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="codigoeps_ent" class="col-sm-2 col-form-label">Código de Habilitación</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="codigoeps_ent" name="codigoeps_ent" size='10' placeholder="Digite el código de habilitación, si no es prestador digite 0(cero)" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contacto_ent" class="col-sm-2 col-form-label">Nombre del Contacto</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="contacto_ent" name="contacto_ent" size='10' placeholder="Digite el nombre de la persona de contacto" required>
                                </div>
                            </div>
                            <span class="btn btn-primary" title="Guardar" onclick="validar()" id="btn_nuevo">
                                Guardar <span class="fas fa-save"></span></span>
                            </span>
                            <div class="alert alert-success" role="alert" id="alerta_guardado">
                                <br><b>Proceso finalizado, al correo que acaba de registrar le llegará el usuario y la clave de acceso para que pueda ingresar al aplicativo, esto puede tardar entre 24 y 48 horas.</b>
                                <br>Contacto: soporte.medinet@gmail.com
                                <br><span class="btn btn-secondary" title="Cerrar" onclick="cerrar()" id="btn_cerrar">
                                Cerrar <i class="fas fa-sign-out-alt"></i></span>
                            </span>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script language="javascript">
    $("#alerta_guardado").hide();
    function validar(){
        err="";
        if(document.form1.nombre_ent.value==''){err+="Nombre de la entidad\n";}
        if(document.form1.tipo_ident_ent.value==''){err+="Tipo de identificación de la entidad\n";}
        if(document.form1.numero_iden_ent.value==''){err+="Número de identificación de la entidad\n";}
        if(document.form1.email_ent.value==''){err+="E-mail de la entidad\n";}
        if(document.form1.rol_ent.value==''){err+="Rol del actor\n";}
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{            
            guardar();
        }
    }
    
    function guardar(){
        $(document).ready(function(){
            //$("#btn_nuevo").click(function(){
                datos=$('#form1').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarregistro1.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");                            
                            $("#alerta_guardado").show("slow");
                            $('#form1')[0].reset();
                        }
                        else{                            
                            alertify.error("Error: "+r);
                        }
                    }
                });
            //});
        });
    }

    function cerrar(){        
        document.form1.action="index.html";
        document.form1.submit();
    }
</script>