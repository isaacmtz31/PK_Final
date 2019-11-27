<?php
  if (!empty($_POST["idCategoria"])){
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");
    $query = 'Select * from categorias where idCategoria = "'.$_POST['idCategoria'].'" limit 1';
    $resultado = mysqli_query($conexion,$query);
    if($data = mysqli_fetch_assoc($resultado)){
      $arreglo['data'][]=$data;
      echo json_encode($arreglo);
    }
    else{
      echo "no hay Categoria";
    }
  }
  else {
    echo 'Introduce datos validos' ;
  }


 ?>
