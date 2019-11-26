<?php
if(!empty($_POST['contra']) and !empty($_POST['email'])){
  $conexion = mysqli_connect("localhost","root","","Postales");
  $conexion->set_charset("utf8");
  if(!empty($_POST['idAdmin']) and $_POST['idAdmin']!='0' and $_POST['idAdmin']!=0){

    $queryUpdate = 'update admini set contra = "'.$_POST['contra'].'",email = "'.$_POST['email'].'" where idAdmin = '.$_POST["idAdmin"];
    $resultadoUpdate = mysqli_query($conexion,$queryUpdate);
    echo 2;
  }
  else{
    $queryVerify = mysqli_query($conexion,"select * from admini where email='".$_POST['email']."'");

    if(mysqli_num_rows($queryVerify) > 0){
      echo "email repetido";
    }
    else{
      $queryInsert = 'insert into admini (email,contra) values ("'.$_POST["email"].'","'.$_POST['contra'].'")';
      $resultado = mysqli_query($conexion,$queryInsert);
      echo 1;
    }
  }

}
else{
  echo "gg";
}

 ?>
