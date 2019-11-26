<?php
  if(!empty($_POST['idCategoria'])){
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");

    $query = "Delete from categorias where idCategoria =".$_POST['idCategoria'];
    $resultado = mysqli_query($conexion,$query);
    if(mysqli_affected_rows($conexion) > 0){
      echo 1;
    }else{
      echo "no se pudo eliminar la categoria";
    }
  }
  else{
    echo "hubo un error";
  }
 ?>
