<?php
session_start();
//session_destroy();
$_SESSION['gusuario_log']='';
$_SESSION['gnombreusu_log']='';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>SIS-MEDinet</title>
  <?php require_once "scripts.php";?>
  <link rel="shorcut icon" type="image/x icon" href="imagenes/medinet.ico">
</head>
<style>
body {
  background-image: url("https://www.elindependiente.com/wp-content/uploads/2018/05/grafeno-inyeccion-medicina.jpg");
  background-repeat: no-repeat;
  height: 100%;
  background-size: cover;
}

.login-form{
  margin-top: 60px;
  box-shadow: 0px 0px 10px 1px grey;
  border-radius: 10px;
  padding-bottom: 30px;  
  background-color: rgba(255,255,255,0.9);
}
</style>
<body>
  <div class="container">
    <div class="login-form col-md-4 offset-md-4">
      <h1 class="title">Login</h1>
      <form id="frm_login" name="frm_login" action="mn_inicio.php" target="" method="POST">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><span class="fas fa-user-check"></span></div>
          </div>
          <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" maxlength="45">
        </div>
        <br>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><span class="fab fa-keycdn"></span></div>
          </div>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="8">
        </div>
        <br>
        <button type="button" class="btn btn-primary btn-block" id="btnvalidar">Aceptar</button>  
        
        <input type="hidden" id="id_usuario" name="id_usuario">
        <input type="hidden" id="nombre_usu" name="nombre_usu">
        <input type="hidden" id="id_entidad" name="id_entidad">
        <input type="hidden" id="contador" name="contador" value=0>
        <input type="hidden" id="contador_log" name="contador_log" value=1>
      </form>
    </div>
  </div>
</body>

</html>


<script type="text/javascript">
  $('#btnvalidar').click(function(){
   datos=$('#frm_login').serialize();
   $.ajax({
    type:"POST",
    data:datos,
    url:"procesos/login.php",
    success:function(r){
    datos=jQuery.parseJSON(r);
    if(datos['id_usuario']=='' && datos['nombre_usu']==''){
      alertify.error("Usuario NO Reistrado");
      incrementar();                
    }
    else{
      alertify.success("Acceso permitido");
      $('#id_usuario').val(datos['id_usuario']);
      $('#nombre_usu').val(datos['nombre_usu']);
      $('#id_entidad').val(datos['id_entidad']);
      $('#frm_login').submit();                                   
    }
  }
});        
 });

  function incrementar(){
    cont_=document.frm_login.contador.value;
    cont_++;      
    document.frm_login.contador.value=cont_;
    if(cont_>=3){
      document.frm_login.btnvalidar.disabled=true;
      document.frm_login.usuario.disabled=true;
      document.frm_login.password.disabled=true;
      alertify.error("El usuario ha superado el numero de intentos permitidos");
    }
  }
</script>
