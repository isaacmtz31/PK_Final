<?php
if(!empty($_POST['nombrePapel']) and !empty($_POST['categoriaSeleccionada'])){
  $conexion = mysqli_connect("localhost","root","","Postales");
  $conexion->set_charset("utf8");
  if(!empty($_POST['idPapel']) and $_POST['idPapel']!='0' and $_POST['idPapel']!=0){
    $querySelect = 'select idPC from papelcategoria where idCategoria = '.$_POST['idCategoriaOld'].' and idPapel = '.$_POST['idPapel'].' limit 1';
    $resultadoSelect = mysqli_query($conexion,$querySelect);
    $row = mysqli_fetch_array($resultadoSelect);
    $idPC=$row['idPC'];
    $queryUpdate = 'update papel set nombrePapel = "'.$_POST['nombrePapel'].'" where idPapel = '.$_POST['idPapel'].'';
    $resultadoUpdate = mysqli_query($conexion,$queryUpdate);
    $queryPC= 'update papelcategoria set idCategoria = '.$_POST['categoriaSeleccionada'].' where idPC ='.$idPC.'';
    $resultadoPC = mysqli_query($conexion,$queryPC);

    if(isset($_FILES["file"]["name"])){
      $queryImagen = 'select * from categorias where idCategoria = '.$_POST["categoriaSeleccionada"];
      $resultadoImagen = mysqli_query($conexion,$queryImagen);
      $obtenidoImagen = mysqli_fetch_assoc($resultadoImagen);
      $idCategoria = $_POST['categoriaSeleccionada'];
      if($obtenidoImagen){
        $destino = "../imgs/papeles/papel".($idPapel).".png";
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

  }else {
    $queryVerify = mysqli_query($conexion,"select * from papel where nombrePapel='".$_POST['nombrePapel']."'");
    if(mysqli_num_rows($queryVerify) > 0){
      echo "nombre Repetido";
    }else{
      if(isset($_FILES["file"]["name"])){
        $queryId = mysqli_query($conexion,"select max(idPapel) from papel");
        $max = mysqli_fetch_array($queryId);
        $idPapel = $max[0]+1;
        $destino = "../imgs/papeles/papel".($idPapel).".png";
        $queryInsert = 'insert into papel (nombrePapel,img) values ("'.$_POST['nombrePapel'].'","'.$destino.'")';
        $resultado = mysqli_query($conexion,$queryInsert);
        if (mysqli_affected_rows($conexion)) {
          $queryIntermedia = 'insert into papelcategoria(idPapel,idCategoria) values ('.$idPapel.','.$_POST['categoriaSeleccionada'].')';

          $resultado = mysqli_query($conexion,$queryIntermedia);
          echo 1;
        }else{
          echo khe2;
        }
        move_uploaded_file($_FILES["file"]["tmp_name"], $destino);
        }else {
        echo "falta la imagen";
        }
      }
    }
  }else{
    echo "khe";
  }



?>
