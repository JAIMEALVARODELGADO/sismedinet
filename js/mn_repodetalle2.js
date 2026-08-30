document.addEventListener("DOMContentLoaded", function () {
    const cantidad = document.getElementById("cantidad");
    const precio_und = document.getElementById("precio_und");
    var opcion='';

    cantidad.addEventListener("input", totalizarRegistro);
    precio_und.addEventListener("input", totalizarRegistro);

  });
  
  function totalizarRegistro() {    
    const cant = parseFloat(cantidad.value) || 0;
    const precio = parseFloat(precio_und.value) || 0;
    const total = cant * precio;
    document.getElementById("total_facturado").value = total
  }

  $(document).ready(function(){
    $("#btnGuardar").click(function(){
        /* Aqui valido si el medicamento existe*/
        //validarMedicamentoIum();
        //validarMedicamentoCums();
                    
        fechafac_=new Date($('#fechafact').val());
        fechaini_=new Date(fecha_ini);
        fechafin_=new Date(fecha_fin);

        id_detalle = $("#id_detalle").val();
        if(id_detalle === '') {
            opcion = 'guardarDetalle';
        } else {
            opcion = 'editarDetalle';
        }

        if (Date.parse(fechafac_) >= Date.parse(fechaini_) && Date.parse(fechafac_) <= Date.parse(fechafin_)){
            var datos = {
                id_detalle: $("#id_detalle").val(),
                municipio: $("#municipio").val(),
                cufe: $("#cufe").val(),
                numerofact_det: $("#numerofact_det").val(),
                fechafact: $("#fechafact").val(),
                codigo_detalle: $("#codigo_detalle").val(),
                unidad_medida: $("#unidad_medida").val(),
                cantidad: $("#cantidad").val(),
                precio_und: $("#precio_und").val(),
                documento_soporte: $("#documento_soporte").val(),
                total_facturado: $("#total_facturado").val(),
                nit_entidad_operacion: $("#nit_entidad_operacion").val(),
                municipio_operacion: $("#municipio_operacion").val(),
                tipo_operacion: $("#tipo_operacion").val(),
                tipo_transaccion: $("#tipo_transaccion").val(),
                medicamento_ium: $("#medicamento_ium").val(),
                iumnivel1: $("#iumnivel1").val(),
                iumnivel2: $("#iumnivel2").val(),
                iumnivel3: $("#iumnivel3").val(),
                medicamento_cum: $("#medicamento_cum").val(),
                expediente: $("#expediente").val(),
                presentacion_comercial: $("#presentacion_comercial").val(),
                total_unidades_fac: $("#total_unidades_fac").val(),
                opcion: opcion
              };
              
            $.ajax({
                type:"POST",
                data: JSON.stringify(datos),
                url:"procesos/cruddetalle2.php",
                contentType: "application/json",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");

                        setTimeout(() => {

                        }, 1000);
                         
                        $('#frm_nuevo')[0].reset();
                        
                        $("#tablaDatadetalle").load("tabladetalle21.php");
                        
                        // Cierra el modal
                        document.getElementById("btnCerrarModal").click();

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

  })


  async function validarMedicamentoIum(){
    var codigo_ium = document.getElementById("iumnivel1").value +
                    document.getElementById("iumnivel2").value +
                    document.getElementById("iumnivel3").value;
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

function nuevoRegistro(){
    var opcion = 'consultarUltimoRegistro';

    var datos = {
        
        opcion: opcion
      };

    $.ajax({
        type:"POST",
        data: JSON.stringify(datos),
        url:"procesos/cruddetalle2.php",
        contentType: "application/json",
        success:function(r){
            if(r) {
                var registro = JSON.parse(r);
                $('#municipio').val(registro.municipio);
                $('#cufe').val(registro.cufe);
                $('#numerofact_det').val(registro.numerofact_det);
                $('#fechafact').val(registro.fechafact);
                $('#nit_entidad_operacion').val(registro.nit_entidad_operacion);
                $('#municipio_operacion').val(registro.municipio_operacion);
                $('#tipo_operacion').val(registro.tipo_operacion);
                $("#tipo_transaccion").val(registro.tipo_transaccion);
            }
        }
    });  

}

function consultarRegistro(id_detalle,descripcion_ium,descripcion_cum){
    var opcion = 'consultarRegistro';
    var datos = {
        id_detalle: id_detalle,
        opcion: opcion
      };
    
    $('#medicamento_ium').val(descripcion_ium);
    $('#medicamento_cum').val(descripcion_cum);

    $.ajax({
        type:"POST",
        data: JSON.stringify(datos),
        url:"procesos/cruddetalle2.php",
        contentType: "application/json",
        success:function(r){
            if(r) {
                var registro = JSON.parse(r);
                $('#id_detalle').val(registro.id_detalle);
                $('#municipio').val(registro.municipio);
                $('#cufe').val(registro.cufe);
                $('#numerofact_det').val(registro.numerofact_det);
                $('#fechafact').val(registro.fechafact);
                $('#codigo_detalle').val(registro.codigo_detalle);
                $('#unidad_medida').val(registro.unidad_medida);
                $('#cantidad').val(registro.cantidad);
                $('#precio_und').val(registro.precio_und);
                $('#documento_soporte').val(registro.documento_soporte);
                $('#nit_entidad_operacion').val(registro.nit_entidad_operacion);
                $('#municipio_operacion').val(registro.municipio_operacion);
                $('#tipo_operacion').val(registro.tipo_operacion);
                $("#tipo_transaccion").val(registro.tipo_transaccion);
                $('#iumnivel1').val(registro.iumnivel1);
                $('#iumnivel2').val(registro.iumnivel2);
                $('#iumnivel3').val(registro.iumnivel3);
                $('#expediente').val(registro.expediente);
                $('#presentacion_comercial').val(registro.presentacion_comercial);
                $('#total_unidades_fac').val(registro.total_unidades_fac);
            }
        }
    });
}

function eliminarRegistro(id_detalle,descripcion){
    
        var opcion = 'eliminarDetalle';
        var datos = {
            id_detalle: id_detalle,
            opcion: opcion
        };
        
        if(confirm("¿Está seguro de eliminar el registro del medicamento: " + descripcion + "?")){
            $.ajax({
                type:"POST",
                data: JSON.stringify(datos),
                url:"procesos/cruddetalle2.php",
                contentType: "application/json",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro eliminado");
                        $("#tablaDatadetalle").load("tabladetalle21.php");
                    }
                    else{
                        alertify.error("Error: Registro no eliminado");
                    }
                }
            });
        }
}