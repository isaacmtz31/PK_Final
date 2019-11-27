<form class="form" role="form" autocomplete="off">
  <div class="form-group row formularioAdministrador">
    <label class="col-lg-3 col-form-label form-control-label">Correo</label>
    <div class="col-lg-9">
      <input id="emailAdministrador" class="form-control" type="text" >
    </div>
  </div>

  <div class="form-group row formularioAdministrador">
    <label class="col-lg-3 col-form-label form-control-label">Contraseña</label>
    <div class="col-lg-9">
      <input id="contra1Administrador"  class="form-control" type="password">
    </div>
  </div>
  <div class="form-group row formularioAdministrador">
    <label class="col-lg-3 col-form-label form-control-label">Confirmación</label>
    <div class="col-lg-9">
      <input id="contra2Administrador" class="form-control" type="password" >
    </div>
  </div>
  <div class="col-sm-12">
    <h5 class="bg-danger" id="alerthAdministrador" style="color: white;"><center id="alertAdministrador"></center></h5>
  </div>
  <div class="form-group row formularioAdministrador">
    <div class="col-lg-12 text-center">
      <!-- <input type="reset" class="btn btn-secondary" value="Cancel"> -->
      <input id="registrarAdministrador" onclick="validarAdministrador()" type="button" class="btn btn-warning" value="Guardar cambios">
    </div>
  </div>
</form>
<script>
  $(".formularioAdministrador").keyup(function(event) {
       if (event.keyCode === 13) {
           $("#registrarAdministrador").click();
       }
   });
</script>
