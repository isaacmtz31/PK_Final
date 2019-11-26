<div class="card">
  <div class="card-header">
    <h4>Formulario Usuario</h4>
  </div>
  <div class="card-body">
    <form class="form" role="form" autocomplete="off">
      <div class="form-group row formularioUsuario">
        <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
        <div class="col-lg-9">
          <input id="Nombre" class="form-control" type="text" >
        </div>
      </div>
      <div class="form-group row formularioUsuario">
        <label class="col-lg-3 col-form-label form-control-label">Apellido</label>
        <div class="col-lg-9">
          <input id="Apellido" class="form-control" type="text" >
        </div>
      </div>
      <div class="form-group row formularioUsuario">
        <label class="col-lg-3 col-form-label form-control-label">Correo</label>
        <div class="col-lg-9">
          <input id="email" class="form-control" type="email">
        </div>
      </div>
      <div class="form-group row formularioUsuario">
        <label class="col-lg-3 col-form-label form-control-label">Edad</label>
        <div class="col-lg-9">
          <input id="edad" class="form-control" type="number" min="12" max="100">
        </div>
      </div>
      <div class="form-group row formularioUsuario">
        <label class="col-lg-3 col-form-label form-control-label">Imagenes</label>
        <div class="col-lg-9">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="imagenUsuario" aria-describedby="customFile">
            <label class="custom-file-label" for="customFile">Elige la Foto de Perfil</label>
          </div>
        </div>
      </div>
      <div class="form-group row formularioUsuario">
        <label class="col-lg-3 col-form-label form-control-label">Genero</label>
        <div class="col-lg-9">
          <div class="maxl">
            <label class="radio inline">
              <input id="Masculino" type="radio" name="gender" value="Masculino" checked>
              <span> Masculino </span>
            </label>
            <label class="radio inline">
              <input id="Femenino" type="radio" name="gender" value="Femenino">
              <span>Femenino </span>
            </label>
          </div>

        </div>
      </div>

      <div class="form-group row formularioUsuario">
        <label class="col-lg-3 col-form-label form-control-label">Contraseña</label>
        <div class="col-lg-9">
          <input id="contra1"  class="form-control" type="password">
        </div>
      </div>
      <div class="form-group row formularioUsuario">
        <label class="col-lg-3 col-form-label form-control-label">Confirmación</label>
        <div class="col-lg-9">
          <input id="contra2" class="form-control" type="password" >
        </div>
      </div>
      <div class="col-sm-12">
        <h5 class="bg-danger" id="alerth" style="color: white;"><center id="alert"></center></h5>
      </div>
      <div class="form-group row formularioUsuario">
        <div class="col-lg-12 text-center">
          <!-- <input type="reset" class="btn btn-secondary" value="Cancel"> -->
          <input id="registrarUsuario" onclick="validarUsuario()" type="button" class="btn btn-warning" value="Guardar cambios">
        </div>
      </div>
    </form>

  </div>
</div>
<script>
  $(".formularioUsuario").keyup(function(event) {
       if (event.keyCode === 13) {
           $("#registrarUsuario").click();
       }
   });
</script>
