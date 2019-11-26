<?php
  if (!empty($_POST["idAdmin"])) {
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");
    $query = 'Select * from admini where idAdmin = "'.$_POST['idAdmin'].'" limit 1';
    $resultado = mysqli_query($conexion,$query);
    if($data = mysqli_fetch_assoc($resultado)){
      $arreglo['data'][]=$data;
      echo json_encode($arreglo);
    }
    else{
      echo "no hay Administrador";
    }
  }
  else {
    echo 'Introduce datos validos' ;
  }


 ?>
