<?php
  if(!empty($_POST['idAdmin'])){
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");

    $query = "Delete from admini where idAdmin =".$_POST['idAdmin'];
    $resultado = mysqli_query($conexion,$query);
    if(mysqli_affected_rows($conexion) > 0){
      echo 1;
    }else{
      echo "no se pudo eliminar al Administrador";
    }
  }
  else{
    echo "hubo un error";
  }
 ?>
