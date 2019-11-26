<?php
if(!empty($_POST['nombreCategoria'])){
  $conexion = mysqli_connect("localhost","root","","Postales");
  $conexion->set_charset("utf8");
  if(!empty($_POST['idCategoria']) and $_POST['idCategoria']!='0' and $_POST['idCategoria']!=0){
    $queryUpdate = 'update categorias set nombreCategoria = "'.$_POST['nombreCategoria'].'" where idCategoria = '.$_POST["idCategoria"];
    $resultadoUpdate = mysqli_query($conexion,$queryUpdate);
    if(isset($_FILES["file"]["name"])){
      $queryImagen = 'select * from categorias where idCategoria = '.$_POST["idCategoria"];
      $resultadoImagen = mysqli_query($conexion,$queryImagen);
      $obtenidoImagen = mysqli_fetch_assoc($resultadoImagen);
      $idCategoria = $_POST['idCategoria'];

      if($obtenidoImagen){
        $destino = "../imgs/categorias/categoria".($idCategoria).".png";
        if(!file_exists($destino)){
          move_uploaded_file($_FILES["file"]["tmp_name"], $destino);
        }
        else if(!unlink($destino)){
          echo 'No se actualizo la imagen';
        }
        else{
         copy($_FILES["file"]["tmp_name"], $destino);
       }
      }
    }
    echo 2;
  }
  else{
    $queryVerify = mysqli_query($conexion,"select * from categorias where nombreCategoria='".$_POST['nombreCategoria']."'");
    if(mysqli_num_rows($queryVerify) > 0){
      echo "nombre Repetido";
    }else {
      if(isset($_FILES["file"]["name"])){
      $queryId = mysqli_query($conexion,"select max(idCategoria) from categorias");
      $max = mysqli_fetch_array($queryId);
      $idCategoria = $max[0]+1;
      $destino = "../imgs/categorias/categoria".($idCategoria).".png";

      $queryInsert = 'insert into categorias (nombreCategoria,imagen) values ("'.$_POST['nombreCategoria'].'","'.$destino.'")';
      $resultado = mysqli_query($conexion,$queryInsert);
      move_uploaded_file($_FILES["file"]["tmp_name"], $destino);
      echo 1;
      }else {
      echo "falta la imagen";
      }
    }
  }
}else {
echo "khe";
}
?>
