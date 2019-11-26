<?php
  include("./../BD/configBD.php");
  $email = $_SESSION["email"];
  $sqlInfUser = "call datosUsuario('$email')";
  $resInfUser = mysqli_query($conexion, $sqlInfUser);
  $infUser = mysqli_fetch_row($resInfUser);
 ?>
