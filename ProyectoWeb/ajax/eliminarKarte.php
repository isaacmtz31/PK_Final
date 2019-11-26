<?php
  if(!empty($_POST['idKarte'])){
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");

    $query = "Delete from karte where idKarte =".$_POST['idKarte'];
    $resultado = mysqli_query($conexion,$query);
    if(mysqli_affected_rows($conexion) > 0){
      echo 1;
    }else{
      echo "no se pudo eliminar la karte";
    }
  }
  else{
    echo "hubo un error";
  }
 ?>
