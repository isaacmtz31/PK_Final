 $(document).ready(function(){
    $("#formLogin").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(evnt){
            evnt.preventDefault();
            var tipoAlerts = new Array("red","blue");
            var iconos = new Array("fas fa-exclamation","fas fa-check fa-2x");
            $.ajax({
                method:"POST",
                url:"./../pages/index_AX.php",
                data:$("#formLogin").serialize(),
                cache:false,
                success:function(respAX){
                    console.log(respAX);
                    var AX = JSON.parse(respAX);
                    if(AX.val == 1){
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
                            window.location.replace("./../pages/profile.php");
                          });
                    }
                    else {
                      swal("¡Oh-no!", AX.msj, "error");
                    }
                }
            });
        }
    });
});
