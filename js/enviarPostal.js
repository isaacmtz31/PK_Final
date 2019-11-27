$(document).ready(function() {
   $('input#input_text, textarea#textarea2').characterCounter();
   $('.materialboxed').materialbox();

   $('#enviarPostal').validetta({
     bubblePosition: 'bottom', // Bubble position // right / bottom
     bubbleGapLeft: 15, // Right gap of bubble (px unit)
     bubbleGapTop: 0, // Top gap of bubble (px unit)
     onValid : function( event ) {
       event.preventDefault(); // Will prevent the submission of the form
       swal(
         {
             title: "¿Estas seguro de enviar esta postal?",
             text: "La postal será enviada por corre electrónico y no habrá manera de eliminarla.",
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
                   url:"./../pages/enviar_postal_AX.php",
                   data: new FormData(document.getElementById("enviarPostal")),
                   cache:false,
                   contentType: false,
                   processData: false,
                   success:function(respAX)
                   {
                       console.log(respAX);
                       var AX = JSON.parse(respAX);
                       if(AX.val == 1)
                       {
                         swal({
                             title: "¡Éxito!",
                             text: AX.msj,
                             showCancelButton: false,
                             confirmButtonColor: "#4BB543",
                             confirmButtonText: "¡Adelante!",
                             closeOnConfirm: true,
                             imageUrl: "./../imgs/postKarteb.png"
                           },
                             function(){
                               window.location.replace("./../pages/Explorar.php");
                             });
                       }else {
                          swal("¡Oh-no!", AX.msj ,"error");
                       }
                   }
               });               
             }
             else
             {
               swal("La postal no será enviada.", "", "error");
             }

         });
     },
     onError : function( event ){
       swal("Hay errores en el formulario", "", "error");
     }
   });
 });
