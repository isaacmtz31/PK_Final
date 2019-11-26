<?php
  if(!empty($_POST['nombre']) and !empty($_POST['apellido']) and !empty($_POST['contra'])
  and !empty($_POST['email']) and !empty($_POST['genero']) and !empty($_POST['edad']) ){
    $conexion = mysqli_connect("localhost","root","","Postales");
    $conexion->set_charset("utf8");
    if(!empty($_POST['idUsuario']) and $_POST['idUsuario']!='0' and $_POST['idUsuario']!=0){
      // echo "sos";

      $queryUpdate = 'update usuario set nombreUsuario = "'.$_POST['nombre'].'",apellidoUsuario = "'.$_POST['apellido'].'",contra = "'.$_POST['contra'].'",email = "'.$_POST['email'].'",genero = "'.$_POST['genero'].'",edad = '.$_POST['edad'].' where idUsuario = '.$_POST["idUsuario"];
      $resultadoUpdate = mysqli_query($conexion,$queryUpdate);
      if(isset($_FILES["file"]["name"])){
        $queryImagen = 'select * from usuario where idUsuario = '.$_POST["idUsuario"];
        $resultadoImagen = mysqli_query($conexion,$queryImagen);
        $obtenidoImagen = mysqli_fetch_assoc($resultadoImagen);
        $idUsuario = $_POST['idUsuario'];

        if($obtenidoImagen){
          $destino = "../imgs/users/user".($idUsuario).".png";
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
      $queryVerify = mysqli_query($conexion,"select * from usuario where email='".$_POST['email']."'");

      if(mysqli_num_rows($queryVerify) > 0){
        echo "email Repetido";
      }
      else{
        if(isset($_FILES["file"]["name"])){
        $queryId = mysqli_query($conexion,"select max(idUsuario) from usuario");
        $max = mysqli_fetch_array($queryId);
        $idUsuario = $max[0]+1;
        $destino = "../imgs/users/user".($idUsuario).".png";

        $queryInsert = 'insert into usuario (nombreUsuario,apellidoUsuario,genero,contra,email,edad,fotoPerfil) values ("'.$_POST['nombre'].'","'.$_POST['apellido'].'","'.$_POST['genero'].'","'.$_POST['contra'].'","'.$_POST['email'].'","'.$_POST['edad'].'","'.$destino.'")';
        $resultado = mysqli_query($conexion,$queryInsert);
        move_uploaded_file($_FILES["file"]["tmp_name"], $destino);
        echo 1;
        }else {
        echo "falta la imagen";
        }
      }
    }
  }
  else {
  echo "khe";
  }

 ?>
