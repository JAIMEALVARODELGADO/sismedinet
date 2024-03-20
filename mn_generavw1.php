<?php
session_start();
//require("valida_sesion.php");
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
                        <h4>Generando Vistas</h4>
                    </div>
                    <div class="card-body">

                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        <span class="sr-only">100% Complete</span>
                      </div>  
                    </div>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            $error=0;
                            $cont=1;

                            $sql="CREATE OR REPLACE VIEW vw_menu AS
                            SELECT menu_usuario.id_musu,menu_usuario.id_usuario,menu_usuario.id_menu,
                            entidad.nombre_ent AS nombre_ent,
                            menu.orden_menu,menu.opcion_menu,menu.nivel_menu,menu.dependencia_menu,menu.tienesub_menu,menu.url_menu
                            FROM menu_usuario
                            INNER JOIN usuario ON usuario.id_usuario=menu_usuario.id_usuario
                            INNER JOIN menu ON menu.id_menu=menu_usuario.id_menu
                            INNER JOIN entidad ON entidad.id_entidad=usuario.id_entidad";                            
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_menu NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_usuario AS 
                            SELECT usuario.id_usuario,usuario.nombre_usu,usuario.password_usu,usuario.fechareg_usu,entidad.id_entidad,entidad.nombre_ent,entidad.tipo_ident_ent,entidad.numero_iden_ent,entidad.password_gen_ent,entidad.estado_ent
                                FROM usuario
                                INNER JOIN entidad ON entidad.id_entidad=usuario.id_entidad";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_usuario NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_conceptos AS
                            SELECT detalle_grupo.codi_det,detalle_grupo.id_grupo,detalle_grupo.descripcion_det,detalle_grupo.valor_det,grupos.descripcion_grupo
                            FROM detalle_grupo
                            INNER JOIN grupos ON grupos.id_grupo=detalle_grupo.id_grupo";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_conceptos NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;                        

                            $sql="CREATE OR REPLACE VIEW vw_tipo_ident AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=1";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tipo_ident NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_rol AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=2";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_rol NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_tpoperacion AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=3";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tpoperacion NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_tptransaccion AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=4";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tptransaccion NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_unidad AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=5";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_unidad NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_ium AS
                            SELECT ium.codigo_ium,ium.nombre_ium,ium.nivel1_ium,ium.nivel2_ium,ium.nivel3_ium,CONCAT (ium.codigo_ium,' ',ium.nombre_ium) AS descripcion FROM ium";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_ium NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_cum AS
                            SELECT cums.id_cums,cums.codigo_cum,cums.expediente_cum,cums.producto_cum,cums.consecutivo_cum,CONCAT(cums.expediente_cum,'-',cums.consecutivo_cum,' ',cums.producto_cum,' ',cums.descripcioncomerc_cum,'-',cums.principioactivo_cum) AS descripcion FROM cums";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_cum NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            //En esta vista se consolidan todos los medicamentos
                            $sql="CREATE OR REPLACE VIEW vw_reporte_detalle_tot AS
                            SELECT reporte_detalle.id_detalle,reporte_detalle.id_reporte,reporte_detalle.numerofact_det,reporte_detalle.fechafact_det,reporte_detalle.tipo_operacion_det,reporte_detalle.tipo_transaccio_det,reporte_detalle.iumnivel1_det,reporte_detalle.iumnivel2_det,reporte_detalle.iumnivel3_det,reporte_detalle.expediente_det,reporte_detalle.exped_consec_det,reporte_detalle.unidad_det,reporte_detalle.cantidad_det,reporte_detalle.valor_unit_det,(reporte_detalle.cantidad_det*reporte_detalle.valor_unit_det) AS total,reporte_detalle.fecha_reg_det,
                            reporte.id_entidad,
                            CONCAT(reporte_detalle.iumnivel1_det,reporte_detalle.iumnivel2_det,reporte_detalle.iumnivel3_det) AS codigo_ium,
                            CONCAT(reporte_detalle.expediente_det,'-',reporte_detalle.exped_consec_det) AS codigo_cum,
                            vw_tpoperacion.descripcion_det AS tipo_operacion_desc,vw_tpoperacion.valor_det AS tpoperacion_cod,
                            vw_tptransaccion.descripcion_det AS tipo_transaccion_desc,vw_tptransaccion.valor_det AS tptransaccion_cod,
                            vw_unidad.descripcion_det AS unidad_desc, vw_unidad.valor_det AS unidad_cod
                            FROM reporte_detalle
                            INNER JOIN reporte ON reporte.id_reporte=reporte_detalle.id_reporte
                            INNER JOIN vw_tpoperacion ON vw_tpoperacion.codi_det=reporte_detalle.tipo_operacion_det
                            INNER JOIN vw_tptransaccion ON vw_tptransaccion.codi_det=reporte_detalle.tipo_transaccio_det
                            INNER JOIN vw_unidad ON vw_unidad.codi_det=reporte_detalle.unidad_det
                            WHERE reporte_detalle.expediente_det<>'' AND reporte_detalle.exped_consec_det<>''";
                            //echo $sql;
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_reporte_detalle NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            //En esta vista se consolidan los medicamentos que tienen CUM
                            $sql="CREATE OR REPLACE VIEW vw_reporte_detalle AS
                            SELECT reporte_detalle.id_detalle,reporte_detalle.id_reporte,reporte_detalle.numerofact_det,reporte_detalle.fechafact_det,reporte_detalle.tipo_operacion_det,reporte_detalle.tipo_transaccio_det,reporte_detalle.iumnivel1_det,reporte_detalle.iumnivel2_det,reporte_detalle.iumnivel3_det,reporte_detalle.expediente_det,reporte_detalle.exped_consec_det,reporte_detalle.unidad_det,reporte_detalle.cantidad_det,reporte_detalle.valor_unit_det,(reporte_detalle.cantidad_det*reporte_detalle.valor_unit_det) AS total,reporte_detalle.fecha_reg_det,
                            reporte.id_entidad,
                            CONCAT(reporte_detalle.iumnivel1_det,reporte_detalle.iumnivel2_det,reporte_detalle.iumnivel3_det) AS codigo_ium,
                            CONCAT(reporte_detalle.expediente_det,'-',reporte_detalle.exped_consec_det) AS codigo_cum,
                            vw_tpoperacion.descripcion_det AS tipo_operacion_desc,vw_tpoperacion.valor_det AS tpoperacion_cod,
                            vw_tptransaccion.descripcion_det AS tipo_transaccion_desc,vw_tptransaccion.valor_det AS tptransaccion_cod,
                            vw_unidad.descripcion_det AS unidad_desc, vw_unidad.valor_det AS unidad_cod
                            FROM reporte_detalle
                            INNER JOIN reporte ON reporte.id_reporte=reporte_detalle.id_reporte
                            INNER JOIN vw_tpoperacion ON vw_tpoperacion.codi_det=reporte_detalle.tipo_operacion_det
                            INNER JOIN vw_tptransaccion ON vw_tptransaccion.codi_det=reporte_detalle.tipo_transaccio_det
                            INNER JOIN vw_unidad ON vw_unidad.codi_det=reporte_detalle.unidad_det
                            WHERE reporte_detalle.expediente_det<>'' AND reporte_detalle.exped_consec_det<>''";
                            //echo $sql;
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_reporte_detalle NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            //En esta vista se consolidan los medicamentos que NO tienen CUM
                            $sql="CREATE OR REPLACE VIEW vw_reporte_detalle2 AS
                            SELECT reporte_detalle.id_detalle,reporte_detalle.id_reporte,reporte_detalle.numerofact_det,reporte_detalle.fechafact_det,reporte_detalle.tipo_operacion_det,reporte_detalle.tipo_transaccio_det,reporte_detalle.iumnivel1_det,reporte_detalle.iumnivel2_det,reporte_detalle.iumnivel3_det,reporte_detalle.expediente_det,reporte_detalle.exped_consec_det,reporte_detalle.unidad_det,reporte_detalle.cantidad_det,reporte_detalle.valor_unit_det,(reporte_detalle.cantidad_det*reporte_detalle.valor_unit_det) AS total,reporte_detalle.fecha_reg_det,
                            reporte.id_entidad,
                            CONCAT(reporte_detalle.iumnivel1_det,reporte_detalle.iumnivel2_det,reporte_detalle.iumnivel3_det) AS codigo_ium,
                            CONCAT(reporte_detalle.expediente_det,'-',reporte_detalle.exped_consec_det) AS codigo_cum,
                            vw_tpoperacion.descripcion_det AS tipo_operacion_desc,vw_tpoperacion.valor_det AS tpoperacion_cod,
                            vw_tptransaccion.descripcion_det AS tipo_transaccion_desc,vw_tptransaccion.valor_det AS tptransaccion_cod,
                            vw_unidad.descripcion_det AS unidad_desc, vw_unidad.valor_det AS unidad_cod
                            FROM reporte_detalle
                            INNER JOIN reporte ON reporte.id_reporte=reporte_detalle.id_reporte
                            INNER JOIN vw_tpoperacion ON vw_tpoperacion.codi_det=reporte_detalle.tipo_operacion_det
                            INNER JOIN vw_tptransaccion ON vw_tptransaccion.codi_det=reporte_detalle.tipo_transaccio_det
                            INNER JOIN vw_unidad ON vw_unidad.codi_det=reporte_detalle.unidad_det
                            WHERE reporte_detalle.expediente_det='' AND reporte_detalle.exped_consec_det=''";
                            //echo $sql;
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_reporte_detalle NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_entidad AS
                            SELECT entidad.id_entidad,entidad.nombre_ent,entidad.numero_iden_ent,entidad.direccion_ent,entidad.telefonos_ent,entidad.ciudad_ent,entidad.email_ent,entidad.codigoeps_ent,
                            vw_tipo_ident.valor_det AS tipo_ident_val,
                            vw_rol.valor_det AS rol_val
                            FROM entidad
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=entidad.tipo_ident_ent
                            INNER JOIN vw_rol ON vw_rol.codi_det=entidad.rol_ent";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_entidad NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_reporte_sismed AS
                            SELECT id_reporte,numerofact_det,CONCAT(year(fechafact_det),month(fechafact_det),tpoperacion_cod,tptransaccion_cod,codigo_cum,unidad_cod) AS codigo_transaccion,fechafact_det,tpoperacion_cod,tptransaccion_cod,iumnivel1_det,iumnivel2_det,iumnivel3_det,codigo_cum,expediente_det,exped_consec_det,unidad_cod,cantidad_det,valor_unit_det,total FROM vw_reporte_detalle
                            UNION
                            SELECT id_reporte,numerofact_det,CONCAT(year(fechafact_det),month(fechafact_det),tpoperacion_cod,tptransaccion_cod,codigo_ium,unidad_cod) AS codigo_transaccion,fechafact_det,tpoperacion_cod,tptransaccion_cod,iumnivel1_det,iumnivel2_det,iumnivel3_det,codigo_cum,expediente_det,exped_consec_det,unidad_cod,cantidad_det,valor_unit_det,total FROM vw_reporte_detalle2
                            ";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_entidad NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            incrementar($cont);
                            $cont++;
                            //echo $cont;
                            if($error<>0){
                                ?>
                                <b>Atención:</b>
                                <br>Comunique los anteriores errores al personal de soporte técnico de MEDINET
                                <?php
                            }
                            ?>                            
                        </div>                        
                        <div class="alert alert-success" role="alert">
                            <br>Proceso finalizado
                        </div>
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

<?php
function incrementar($c_){
    $totvistas=16;
    $por_vistas=($c_*100)/$totvistas;
    if($por_vistas>98){
        $por_vistas=100;
    }    
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            incrementabarra(<?php echo $por_vistas;?>);
        });
    </script>
    <?php
}

?>
<script type="text/javascript">
    function incrementabarra(valor){
        valor=valor+"%";        
        $(".progress-bar").animate({
        width: valor
        },1);        
    }

</script>