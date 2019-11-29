<?php

session_start();
include("./../BD/configBD.php");
include("./../BD/getPosts.php");
$emailS = $_SESSION["email"];
$respAX = array();

$test = $_POST['test'];
$sqlLogin = "call cambiarEstadoPK('$test')";
$resLogin = mysqli_query($conexion, $sqlLogin);
$numFilasLogin = mysqli_num_rows($resLogin);

if($numFilasLogin == 1)
{
  $infUsuario = mysqli_fetch_row($resLogin);
  if($infUsuario[0] == 'Ese nombre de la postal no existe'){
    $respAX["val"] = 0;
    $respAX["msj"] = "Hubo un error con el nombre de la postal. $infUsuario[0]";
  }else{
    if($infUsuario[0] != 'Ya la vio')
    {
      $respAX["val"] = 1;
      $respAX["msj"] = "$infUsuario[0]";
    }else{
      $respAX["val"] = 2;
      $respAX["msj"] = "$infUsuario[0]";
    }
  }
}else{
    $respAX["val"] = 0;
    $respAX["msj"] = "<h5 class='center-align'>Error. Favor de intentarlo nuevamente</h5>";
}
echo ($respAX);



 ?>
