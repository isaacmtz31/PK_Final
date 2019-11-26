<?php
    session_start();
    include("./configBD.php");
    include("./getPosts.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require "./PHPMailer/PHPMailer.php";
    require "./PHPMailer/SMTP.php";
    require "./PHPMailer/Exception.php";

    $respAX = array();
    $sqlLoginV3m = "call selectEmail('$email')";
    $resLoginV3m = mysqli_query($conexion, $sqlLoginV3m);
    $infAlumno = mysqli_fetch_row($resLoginV3m);

    if($infAlumno[0] != "Ese usuario no existe")
    {
        $num_caracteres = "5"; // asignamos el número de caracteres que va a tener la nueva contraseña
        $nueva_clave = substr(md5(rand()),0,$num_caracteres);
        $usuario_clave = $nueva_clave; // la nueva contraseña que se enviará por correo al usuario
        $usuario_clave2 = $usuario_clave; // encriptamos la nueva contraseña para guardarla en la BD
        $contran = "call cambiarPSW('$email','$usuario_clave','$usuario_clave')";
        $resLoginV3m = mysqli_query($conexion, $contran);
        $link="<a href = http://localhost/PostKarte_v3/pages/logIn.php> Click aqu&iacute;.</a>"; 
        $mail= new PHPMailer;
        $mail->isSMTP();
        $mail->Host="smtp.gmail.com";
        $mail->Port=587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth=true;
        $mail->Username="erickarvizu11@gmail.com";
        $mail->Password="erickMonte$2";
        $mail->setFrom("erickarvizu11@gmail.com","POSTKARTE");
        $mail->addAddress($infAlumno[5]);
        $mail->CharSet = 'UTF-8';
        $mail->Subject="Recuperación de contraseña";
        $mail->msgHTML("Contrasena: " .$usuario_clave . "<br>Iniciar Sesión: ".$link);
        
    
    if(!$mail->send()){
      $respAX["val"] = 0;
      $respAX["msj"] = "<h5 class='center-align'>Error al enviar. Favor de intentarlo nuevamente</h5>";
    }
      else {
        $respAX["val"] = 1;
        $respAX["msj"] = "<h5 class='center-align'> Su contrase&ntilde;a ha sido enviada</h5>";
      }
    }
    else{
      $respAX["val"] = 0;
      $respAX["msj"] = "<h5 class='center-align'>Ese usuario no existe en la base de datos. Favor de corroborar su email.</h5>";
    }
    
  echo json_encode($respAX);
  ?>

