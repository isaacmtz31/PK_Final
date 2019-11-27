<?php
include("./../BD/getPosts.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "./PHPMailer/PHPMailer.php";
require "./PHPMailer/SMTP.php";
require "./PHPMailer/Exception.php";


  $respAX = array();
  // New Connection
$db = new mysqli('localhost','root','','Postales');

// Check for errors
if(mysqli_connect_errno()){
echo mysqli_connect_error();
}

// 1st Query
$result = $db->query("call selectEmail('$email')");
if($result){
     // Cycle through results
    while ($row = $result->fetch_object()){
        $otro = $row;
    }
    // Free result set
    $result->close();
    $db->next_result();
}


if($otro->email == $email){
  $num_caracteres = "5"; // asignamos el número de caracteres que va a tener la nueva contraseña
  $nueva_clave = substr(md5(rand()),0,$num_caracteres);
  $usuario_clave = $nueva_clave; // la nueva contraseña que se enviará por correo al usuario

  // 2nd Query
  $result = $db->query("call cambiarPSW('$otro->email','$usuario_clave','$usuario_clave')");
  if($result){
       // Cycle through results
      while ($row = $result->fetch_object()){
          $user_pswn = $row;
      }
       // Free result set
       $result->close();
       $db->next_result();
  }
  else echo($db->error);

  if($user_pswn->aviso == "Datos modificados"){

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
        $mail->addAddress($otro->email);
        $mail->CharSet = 'UTF-8';
        $mail->Subject="Recuperación de contraseña";
        $mail->msgHTML("Tu contraseña es: " .$usuario_clave . "<br> Iniciar Sesión en el siguiente link: ".$link);
        if(!$mail->send()){
          $respAX["val"] = 0;
          $respAX["msj"] = "Error al enviar. Favor de intentarlo nuevamente.";
        }
          else {
            $respAX["val"] = 1;
            $respAX["msj"] = "Su contrasena ha sido enviada. Favor de revisar su email";
          }
        }

  else{
    $respAX["val"] = 0;
    $respAX["msj"] = "Imposible cambiar la contraseña de la base de datos";}

// Close connection
$db->close();
}

else {
  $respAX["val"] = 0;
  $respAX["msj"] = "Ese usuario no existe en la base de datos. Favor de corroborar su email.";
}

echo json_encode($respAX);
?>
