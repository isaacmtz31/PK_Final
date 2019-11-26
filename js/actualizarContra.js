var respuestaGlobal = "";
$(document).ready(function() {
    $('#updateContra').validetta({

      onValid : function( event ) {
        event.preventDefault(); // Will prevent the submission of the form
        swal(
          {
              title: "¿Estas seguro de modificar tu contraseña?",
              text: "Puedes modificar tus datos tantas veces quieras",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#4BB543",
              confirmButtonText: "¡Claro!",
              cancelButtonText: "No, jamás",
              closeOnConfirm: false,
              closeOnCancel: false },
              function(isConfirm){
              if (isConfirm)
              {
                $.ajax({
                    method:"POST",
                    url:"./../pages/actualizarContra_AX.php",
                    data: new FormData(document.getElementById("updateContra")),
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(respAX)
                    {
                        console.log(respAX);
                        var AX = JSON.parse(respAX);
                        respuestaGlobal = AX.msj;
                        console.log(respuestaGlobal);
                        if(AX.val == 1)
                          swal("¡Hecho!", respuestaGlobal ,"success");
                        else
                          swal("Error ):", respuestaGlobal ,"error");
                    }
                });
                //window.location = "./profile.php";
              }
              else
              {
                swal("Tus datos no serán modificados!", "", "error");
              }

          });
      },
      onError : function( event ){
        swal("Hay errores en el formulario.");
      }
    });
});
