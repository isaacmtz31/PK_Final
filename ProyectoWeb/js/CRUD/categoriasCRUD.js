 var idCategoria = 0;
function eliminarCategoria(idCategorias){
  var data = "idCategoria="+ idCategorias;
  $.ajax({
    url: '../ajax/eliminarCategorias.php',
    type: 'POST',
    data: data,
    success : function(response){
      if (response == 1) {
        alert("La categoria fue eliminada");
        $('#categoriasList').load('Tablas/tablaCategorias.php');
        $('#papelList').load('Tablas/tablaPapel.php');

      }
      else{
        alert(response);
      }
    }
  });
}

function editarCategoria(idCategorias){
  var data = "idCategoria="+ idCategorias;
  $.ajax({
    url: '../ajax/selectCategorias.php',
    type: 'POST',
    data: data,
    success: function(response){
      if(response.charAt(0)== '{'){
        var jason = JSON.parse(response);
        $('#nombreCategorias').val(jason['data'][0].nombreCategoria);
        idCategoria=jason['data'][0].idCategoria;
        $('#imagenCategoria').val(jason['data'][0].imagen);
       }
       else{
         alert(response);
       }
    }
  });
}

function registrarCategorias(){
  var nombre,fotoCategorias;
  nombre = $("#nombreCategorias").val();
  fotoCategorias=document.getElementById('imagenCategorias').files[0];
  var form_data = new FormData();
  if(document.getElementById("imagenCategorias").files.length == 0){
       form_data.append("file", 0);
       // alert('vacio');
   }else{
     form_data.append("file", document.getElementById('imagenCategorias').files[0]);
   }
  form_data.append('nombreCategoria',nombre);
  form_data.append('idCategoria',idCategoria);
  $.ajax({
    url:"../ajax/registroCategorias.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success:function(data){
      if(data == 1){
        $("#categoriasList").load("Tablas/tablaCategorias.php");
        $('#papelList').load('Tablas/tablaPapel.php');
        $('#categorias-tab').tab('show');
        limpiarCategorias();
        idCategoria=0;
      }else if(data == 2){
        alert("se ha actualizado la categoria");
        $("#categoriasList").load("Tablas/tablaCategorias.php");
        $('#papelList').load('Tablas/tablaPapel.php');
        $('#categorias-tab').tab('show');
        limpiarCategorias();
        idCategoria=0;
      }else{
        alert(data);
      }
    }
  });
}
function limpiarCategorias(){
  $("#nombreCategorias").val('');

}
