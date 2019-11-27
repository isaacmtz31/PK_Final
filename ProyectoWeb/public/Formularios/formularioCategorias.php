<form class="form" role="form" autocomplete="off">
  <div class="form-group row formularioCategorias">
    <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
    <div class="col-lg-9">
      <input id="nombreCategorias" class="form-control" type="text" >
    </div>
  </div>

  <div class="form-group row formularioCategorias">
    <label class="col-lg-3 col-form-label form-control-label">Imagen</label>
    <div class="col-lg-9">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="imagenCategorias" aria-describedby="customFile">
        <label class="custom-file-label" for="customFile">Elige la Foto de la Categoria </label>
      </div>
    </div>
  </div>



  <div class="col-sm-12">
    <h5 class="bg-danger" id="alerthCategorias" style="color: white;"><center id="alertCategorias"></center></h5>
  </div>
  <div class="form-group row formularioCategorias">
    <div class="col-lg-12 text-center">
      <!-- <input type="reset" class="btn btn-secondary" value="Cancel"> -->
      <input id="registrarCat" onclick="registrarCategorias()" type="button" class="btn btn-warning" value="Guardar cambios">
    </div>
  </div>
</form>
<script>
  $(".formularioCategorias").keyup(function(event) {
       if (event.keyCode === 13) {
           $("#registrarCat").click();
       }
   });
</script>
