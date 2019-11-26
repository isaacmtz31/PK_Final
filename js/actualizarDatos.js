var respuestaGlobal = "";
$(document).ready(function() {
    $(function() {
      $('#check').on("change", function() {

        var ena = document.getElementById("nombreCorreo").disabled;
        if(ena)
        {
          document.getElementById("nombreCorreo").disabled = false;
        }else {
          document.getElementById("nombreCorreo").disabled = true;
        }

      });
    });
    $('#UpdateD').validetta({

      onValid : function( event ) {
        event.preventDefault(); // Will prevent the submission of the form
        swal(
          {
              title: "¿Estas seguro de modificar tus datos?",
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
                var ena = document.getElementById("nombreCorreo").disabled;
                if(ena)
                {
                  document.getElementById("nombreCorreo").disabled = false;
                }
                $.ajax({
                    method:"POST",
                    url:"./../pages/actualizarDatos_AX.php",
                    data: new FormData(document.getElementById("UpdateD")),
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(respAX)
                    {
                        console.log(respAX);
                        var AX = JSON.parse(respAX);
                        respuestaGlobal = AX.msj;
                        console.log(respuestaGlobal);
                        swal("¡Hecho!", respuestaGlobal ,"success");
                        document.getElementById("nombreCorreo").disabled = true;
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
        swal("Hay errores en el formulario", "", "error");        
      }
    });
});
