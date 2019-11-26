<?php
/**/
    session_start();
    include("./../BD/configBD.php");
    include("./../BD/getPosts.php");
    $emailS = $_SESSION["email"];
    $respAX = array();
    //$contra = md5($contra);
    //$sqlLoginV3m = "call logIn('$email','$contra')";
    //call actualizarDatos('Isaac','Martinez Sanchez','Masculino', 'isi_mrt@hotmail.com','', 21, 'isaac.jpg');

    $sqlLogin = "call cambiarPSW('$emailP','$psw','$pswV')";
    $resLogin = mysqli_query($conexion, $sqlLogin);
    $numFilasLogin = mysqli_num_rows($resLogin);

    if($numFilasLogin == 1)
    {
      $infUsuario = mysqli_fetch_row($resLogin);
      if($infUsuario[0] != 'Datos modificados'){
        $respAX["val"] = 0;
        $respAX["msj"] = "Hubo un error. $infUsuario[0]";
      }else{
        $respAX["val"] = 1;
        $respAX["msj"] = "$infUsuario[0]";        
      }
    }else{
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>Error. Favor de intentarlo nuevamente</h5>";
    }
    echo json_encode($respAX);

?>
