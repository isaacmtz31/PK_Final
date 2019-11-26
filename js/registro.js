$(document).ready(function(){
        $("#formRegistro").validetta({
            bubblePosition: 'bottom',
            bubbleGapTop: 10,
            bubbleGapLeft: -5,
            onValid:function(e){
                e.preventDefault();
                var tipoAlerts = new Array("red","blue");
                var iconos = new Array("fas fa-exclamation","fas fa-check fa-2x");
                $.ajax({
                    method:"POST",
                    url:"./../pages/crearCuenta_AX.php",
                    data:new FormData($("#formRegistro")[0]),
                    contentType: false,
                    processData:false,
                    cache:false,
                    success:function(respAX){
                      console.log(respAX);
                        var AX = JSON.parse(respAX);
                        $.alert({
                            content:AX.msj,
                            icon:iconos[AX.val],
                            type:tipoAlerts[AX.val],
                            onDestroy:function(){
                                if(AX.val == 1){
                                    window.location.replace("./../pages/login.php");
                                }
                            }
                        });
                    }
                });
            }
        });
    });
