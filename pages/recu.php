<?php
    session_start();
    include("./../BD/configBD.php");
    include("./../BD/getPosts.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "./PHPMailer/PHPMailer.php";
    require "./PHPMailer/SMTP.php";
    require "./PHPMailer/Exception.php";

    $respAX = array();
    $sqlLogin = "call selectEmail('$email')";
    $resLogin = mysqli_query($conexion, $sqlLogin);
    $infAlumno = mysqli_fetch_row($resLogin);

    if($infAlumno[0] != "Ese usuario no existe")
    {
        $num_caracteres = "5"; // asignamos el número de caracteres que va a tener la nueva contraseña
        $nueva_clave = substr(md5(rand()),0,$num_caracteres);
        $usuario_clave = $nueva_clave; // la nueva contraseña que se enviará por correo al usuario
        $usuario_clave2 = $usuario_clave; // encriptamos la nueva contraseña para guardarla en la BD
        $contranueva = "call cambiarPSW('$infAlumno[0]','$usuario_clave','$usuario_clave')";
        $respsw = mysqli_query($conexion, $contranueva);
        $link="<a href = http://localhost/postKarte_v4/pages/logIn.php> Click aqu&iacute;.</a>";
        $mail= new PHPMailer;
        $mail->isSMTP();
        $mail->Host="smtp.gmail.com";
        $mail->Port=587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth=true;
        $mail->Username="isaac31120@gmail.com";
        $mail->Password="martinez3112";
        $mail->setFrom("isaac31120@gmail.com","POSTKARTE");
        $mail->addAddress($infAlumno[0]);
        $mail->CharSet = 'UTF-8';
        $mail->Subject="Recuperación de contraseña";
        $mail->msgHTML("Contrasena: " .$usuario_clave . "<br>Iniciar Sesión: ".$link);


    if(!$mail->send()){
      $respAX["val"] = 0;
      $respAX["msj"] = "Error al enviar. Favor de intentarlo nuevamente.";
    }
      else {
        $respAX["val"] = 1;
        $respAX["msj"] = "Su contraseña ha sido enviada.";
      }
    }
    else{
      $respAX["val"] = 0;
      $respAX["msj"] = "Ese usuario no existe en la base de datos. Favor de corroborar su email.";
    }

  echo json_encode($respsw);
  ?>
