<?php
  if(!empty($_POST['idUsuario'])){
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");

    $query = "Delete from usuario where idUsuario =".$_POST['idUsuario'];
    $resultado = mysqli_query($conexion,$query);
    if(mysqli_affected_rows($conexion) > 0){
      echo 1;
    }else{
      echo "no se pudo eliminar al usuario";
    }
  }
  else{
    echo "hubo un error";
  }
 ?>
