<?php
    session_start();
    include("./../BD/configBD.php");
    include("./../BD/getPosts.php");
    $emailS = $_SESSION["email"];
    $respAX = array();
    //$contra = md5($contra);
    //$sqlLoginV3m = "call logIn('$email','$contra')";
    //call actualizarDatos('Isaac','Martinez Sanchez','Masculino', 'isi_mrt@hotmail.com','', 21, 'isaac.jpg');

    $sqlLogin = "call actualizarDatos('$nombreU','$apellidosU','$genero','$emailS','$nombreCorreo','$edad','$nombreFotoPerfil')";
    $resLogin = mysqli_query($conexion, $sqlLogin);
    $numFilasLogin = mysqli_num_rows($resLogin);

    if($numFilasLogin == 1)
    {
      $infUsuario = mysqli_fetch_row($resLogin);
      if($infUsuario[0] != '¡Datos del usuario modificados correctamente!'){
        $respAX["val"] = 0;
        $respAX["msj"] = "Hubo un error. $infUsuario[0]";
      }else{
        $respAX["val"] = 1;
        $respAX["msj"] = "$infUsuario[0]";

        $dirFoto = "./../imgs/users/";
        $archFoto = $dirFoto . basename($_FILES["fotoPerfil"]["name"]);
        $extFoto = pathinfo($archFoto,PATHINFO_EXTENSION);
        //$destFoto = $dirFoto.$_POST["nombreCorreo"].".".$extFoto;
        if(move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $archFoto)){
            $respAX["msj"] .= "La foto se guardó; correctamente";
        }else{
            $respAX["msj"] .= "No se pudo guardar la foto";
        }
      }
    }else{
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>Error. Favor de intentarlo nuevamente</h5>";
    }
    echo json_encode($respAX);

?>
