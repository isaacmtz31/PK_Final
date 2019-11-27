<form class="form" role="form" autocomplete="off">
  <div class="form-group row formularioKarte">
    <label class="col-lg-3 col-form-label form-control-label">Correo</label>
    <div class="col-lg-9">
      <input id="emailKarte" class="form-control" type="text" >
    </div>
  </div>

  <div class="col-sm-12">
    <h5 class="bg-danger" id="alerthKarte" style="color: white;"><center id="alertKarte"></center></h5>
  </div>
  <div class="form-group row formularioKarte">
    <div class="col-lg-12 text-center">
      <!-- <input type="reset" class="btn btn-secondary" value="Cancel"> -->
      <input id="registrarKarte" onclick="validarKarte()" type="button" class="btn btn-warning" value="Guardar cambios">
    </div>
  </div>
</form>
<script>
  $(".formularioKarte").keyup(function(event) {
       if (event.keyCode === 13) {
           $("#registrarKarte").click();
       }
   });
</script>
