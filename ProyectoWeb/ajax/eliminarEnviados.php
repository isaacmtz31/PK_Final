<?php
  if(!empty($_POST['idEnviados'])){
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");

    $query = "Delete from relUsuarioKarte where idEnviados =".$_POST['idEnviados'];
    $resultado = mysqli_query($conexion,$query);
    if(mysqli_affected_rows($conexion) > 0){
      echo 1;
    }else{
      echo "no se pudo eliminar el elemento";
    }
  }
  else{
    echo "hubo un error";
  }
 ?>
