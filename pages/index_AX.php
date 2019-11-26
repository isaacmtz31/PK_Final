<?php
    session_start();
    include("./../BD/configBD.php");
    include("./../BD/getPosts.php");

    $respAX = array();
    //$contra = md5($contra);
    //$sqlLogin = "call logIn('$email','$contra')";
    $sqlLogin = "call logIn('$email','$contra')";
    $resLogin = mysqli_query($conexion, $sqlLogin);
    $numFilasLogin = mysqli_num_rows($resLogin);

    if($numFilasLogin == 1)
    {
      $infUsuario = mysqli_fetch_row($resLogin);
      if($infUsuario[0] == "USUARIO NO ENCONTRADO"){
        $respAX["val"] = 0;
        $respAX["msj"] = "Usuario no encontrado, favor de corroborar tus datos.";
      }else{
        $respAX["val"] = 1;
        $respAX["msj"] = "Hola $infUsuario[1]. Bienvenido a PostKarte";
        $_SESSION["email"] = $infUsuario[5];
        }
    }else{
        $respAX["val"] = 1;
        $respAX["msj"] = "Error. Favor de intentarlo nuevamente";
    }
    echo json_encode($respAX);
?>
