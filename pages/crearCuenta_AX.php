<?php
    include("./../BD/configBD.php");
    include("./../BD/getPosts.php");

    $respAX = array();
    $nombreUsuario = $_POST["nombreUsuario"];
    $apellidoUsuario = $_POST["apellidoUsuario"];
    $genero = $_POST["genero"];
    $email = $_POST["email"];
    $contra = $_POST["contra"];
    $edad = $_POST["edad"];
    $sqlRegistro = "CALL agregarUsuario('$nombreUsuario','$apellidoUsuario','$genero','$contra','$email',$edad, '$fotoPerfil')";
    $resRegistro = mysqli_query($conexion,$sqlRegistro);
    $filasAfectadasRegistro = mysqli_affected_rows($conexion);
        if($filasAfectadasRegistro == 1)
        {
          $infUsuario = mysqli_fetch_row($resRegistro);
          if($infUsuario[0] == "Usuario agregado"){
            $respAX["val"] = 1;
            $respAX["msj"] = "<h5 class='center-align'>Se registraron correctamente sus datos. Gracias :)</h5>";
          }
          else{
            $respAX["val"] = 0;
            $respAX["msj"] = "<h5 class='center-align'>Error" . $infUsuario[0] . "</h5>";
          }
        }else{
            $respAX["val"] = 0;
            $respAX["msj"] = "<h5 class='center-align'>Se present&oacute; un error. Favor de intentarlo nuevamente.</h5>";
        }

    echo json_encode($respAX);

?>
