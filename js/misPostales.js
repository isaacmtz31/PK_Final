$(document).ready(function() {
    $("#ver").click(function() {
        var val = $(this).data('value');
        //swal("¡Oh-no!", val, "error");
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
});
