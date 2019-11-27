var papelId = 0,categoriaId=0,categoriaIdold=0;;
function registroPapel(){
  var nombrePapel,img,categoriaSeleccionada;
  nombrePapel = $("#nombrePapel").val();
  img=document.getElementById('imagenPapel').files[0];
  categoriaSeleccionada = $("#categoriaSeleccionada").val();
  var form_data = new FormData();
  if(document.getElementById("imagenPapel").files.length == 0){
       form_data.append("file", 0);
       // alert('vacio');
   }else{
     form_data.append("file", document.getElementById('imagenPapel').files[0]);
   }
   form_data.append("nombrePapel",nombrePapel);
   form_data.append("idPapel",papelId);
   form_data.append("idCategoriaOld",categoriaIdold);
   form_data.append("categoriaSeleccionada",categoriaSeleccionada);
   $.ajax({
     url:"../ajax/registroPapel.php",
     method:"POST",
     data: form_data,
     contentType: false,
     cache: false,
     processData: false,
     success:function(data){
       if(data == 1){
         $('#papelList').load('Tablas/tablaPapel.php');
         limpiarPapel();
         papelId=0;
       }else if(data == 2){
         alert("se ha actualizado la categoria");
         $('#papelList').load('Tablas/tablaPapel.php');
         limpiarPapel();
         papelId=0;
       }else{
         alert(data);
       }
     }
   });
}
function editarPapel(idPapel,idCategoria){
  var data = new FormData();
  data.append("idPapel",idPapel);
  data.append("idCategoria",idCategoria);
  $.ajax({
    url: '../ajax/selectPapel.php',
    type: 'POST',
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(response){
      if(response.charAt(0)== '{'){
        var jason = JSON.parse(response);
        $('#nombrePapel').val(jason['data'][0].nombrePapel);
        $("#categoriaSeleccionada").val(jason['data'][0].idCategoria);
        //$('#imagenPapel').attr("src",jason['data'][0].img);
        papelId=jason['data'][0].idPapel;
        categoriaIdold=jason['data'][0].idCategoria;
        categoriaId=jason['data'][0].idCategoria;
       }
       else{
         alert(response);
       }
    }
  });
}
function eliminarPapel(idPapel,idCategoria){
  var data = new FormData();
  data.append("idPapel",idPapel);
  data.append("idCategoria",idCategoria);
  $.ajax({
    url: '../ajax/eliminarPapel.php',
    type: 'POST',
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success : function(response){
      if (response == 1) {
        alert("El Papel fue eliminado");
        $('#adminList').load('Tablas/tablaPapel.php');
      }
      else{
        alert(response);
      }
    }
  });
}
function limpiarPapel(){
  $("#categoriaSeleccionada").val('');
  $("#nombrePapel").val('');
}
