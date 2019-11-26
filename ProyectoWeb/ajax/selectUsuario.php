<?php
  if (!empty($_POST["idUsuario"])) {
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");
    $query = 'Select * from usuario where idUsuario = "'.$_POST['idUsuario'].'" limit 1';
    $resultado = mysqli_query($conexion,$query);
    if($data = mysqli_fetch_assoc($resultado)){
      $arreglo['data'][]=$data;
      echo json_encode($arreglo);
    }
    else{
      echo "no hay Usuario";
    }
  }
  else {
    echo 'Introduce datos validos' ;
  }


 ?>
