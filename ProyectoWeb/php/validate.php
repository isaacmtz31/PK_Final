<?php
  session_start();
  $_SESSION['Correo']='luis.garcia_1998@hotmail.com';
  $_SESSION['Administrador']='Arturo Garcia';
  header("Location:http://localhost:8080/ProyectoWeb/public/administrator.php");
 ?>
