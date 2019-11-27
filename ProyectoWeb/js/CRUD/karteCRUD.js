function eliminarKarte(idKarte){
  var data = "idKarte="+ idKarte;
  $.ajax({
    url: '../ajax/eliminarKarte.php',
    type: 'POST',
    data: data,
    success : function(response){
      if (response == 1) {
        alert("la karte fue eliminada");
        $('#karteList').load('Tablas/tablaKarte.php');
        $('#enviadosList').load('Tablas/tablaEnviados.php');
      }
      else{
        alert(response);

      }
    }
  });
}
