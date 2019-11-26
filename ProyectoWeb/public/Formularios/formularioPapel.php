<form class="form" role="form" autocomplete="off">
  <div class="form-group row formularioPapel">
    <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
    <div class="col-lg-9">
      <input id="nombrePapel" class="form-control" type="text" >
    </div>
  </div>

  <div class="form-group row formularioPapel">
    <label class="col-lg-3 col-form-label form-control-label">Imagen</label>
    <div class="col-lg-9">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="imagenPapel" aria-describedby="customFile">
        <label class="custom-file-label" for="customFile">Elige la Foto del Papel </label>
      </div>
    </div>
  </div>

  <div class="form-group row formularioPapel">
    <label class="col-lg-3 col-form-label form-control-label">Categoria</label>
    <div class="col-lg-9">
      <select class="form-control" id="categoriaSeleccionada">
        <option class="hidden"  selected disabled>Selecciona la Categoria</option>
          <?php
            $conexion = mysqli_connect("localhost","root","","Postales");
            $conexion->set_charset("utf8");
            $queryPapel = "select * from categorias";
            $resultado = mysqli_query($conexion,$query);
            while($row = mysqli_fetch_object($resultado)){
                echo "<option value='$row->idCategoria'> $row->nombreCategoria </option>";
            }

           ?>
       </select>
    </div>
  </div>



  <div class="col-sm-12">
    <h5 class="bg-danger" id="alerthPapel" style="color: white;"><center id="alertPapel"></center></h5>
  </div>
  <div class="form-group row formularioPapel">
    <div class="col-lg-12 text-center">
      <!-- <input type="reset" class="btn btn-secondary" value="Cancel"> -->
      <input id="registrarPapel" onclick="registroPapel()" type="button" class="btn btn-warning" value="Guardar cambios">
    </div>
  </div>
</form>
<script>
  $(".formularioPapel").keyup(function(event) {
       if (event.keyCode === 13) {
           $("#registrarPapel").click();
       }
   });
</script>
