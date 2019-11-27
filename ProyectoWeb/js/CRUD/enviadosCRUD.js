function eliminarEnviados(idEnviados){
  var data = "idEnviados="+ idEnviados;
  $.ajax({
    url: '../ajax/eliminarEnviados.php',
    type: 'POST',
    data: data,
    success : function(response){
      if (response == 1) {
        alert("El elemento fue eliminado");
        $('#enviadosList').load('Tablas/tablaEnviados.php');
      }
      else{
        alert(response);

      }
    }
  });
}
