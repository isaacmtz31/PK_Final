<?php
  if(!empty($_POST['idPapel'])){
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");
    $queryAux = "delete from papelcategoria where idPapel = ".$_POST['idPapel']." and idCategoria = ".$_POST['idCategoria'];
    $resultado = mysqli_query($conexion,$queryAux);
    $query = "Delete from papel where idPapel =".$_POST['idPapel'];
    $resultado = mysqli_query($conexion,$query);
    if(mysqli_affected_rows($conexion) > 0){
      echo 1;
    }else{
      echo "no se pudo eliminar el papel";
    }
  }
  else{
    echo "hubo un error";
  }
 ?>
