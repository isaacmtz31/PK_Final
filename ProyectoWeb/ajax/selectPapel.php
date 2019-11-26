<?php
  if (!empty($_POST['idPapel'])) {
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");
    $query = 'Select papel.idPapel,nombrePapel,img,idCategoria from papel,papelcategoria where papel.idPapel = '.$_POST['idPapel'].' and papel.idPapel = papelcategoria.idPapel and idCategoria = '.$_POST['idCategoria'].' limit 1';
    $resultado = mysqli_query($conexion,$query);
    if($data = mysqli_fetch_assoc($resultado)){
      $arreglo['data'][]=$data;
      echo json_encode($arreglo);
    }
    else{
      echo "no existe ese Papel";
    }
  }
  else {
    echo $_POST['idPapel'] ;
  }


 ?>
