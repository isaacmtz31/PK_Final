$(document).ready(function() {

    $("#ver i").click(function() {
        var val = $(this).data('value');
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {"test" : val},
            url: "./../pages/cambiarEstatusPK_AX.php",
            success: function(data) {
              console.log(data);
            }
          });
    });

    $("#pdfD a").click(function() {
      var val = $(this).data('value');
      swal("OK",val,"success");
      // $.ajax({
      //     type: "POST",
      //     dataType: "",
      //     data: {"prueba" : val},
      //     url: "./../pages/pdfImagenes.php",
      //   })
      //     .complete(function( data ) {

              console.log( "Sample of data:");
              location.assign("http://localhost/postKarte_v4/pages/pruebaPDF.php?var="+val);
          // });
    });
});
