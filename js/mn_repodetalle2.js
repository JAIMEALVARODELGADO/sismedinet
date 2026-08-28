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
        fechaini_=new Date($('#fecha_ini').val());
        fechafin_=new Date($('#fecha_fin').val());
       
        if (Date.parse(fechafac_) >= Date.parse(fechaini_) && Date.parse(fechafac_) <= Date.parse(fechafin_)){
            var datos = $('#frm_nuevo').serialize() + '&opcion=guardarDetalle';
            
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/cruddetalle2.php",
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