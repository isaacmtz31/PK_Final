<?php
    session_start();
    include("./../BD/getPosts.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "./PHPMailer/PHPMailer.php";
    require "./PHPMailer/SMTP.php";
    require "./PHPMailer/Exception.php";

    $db = new mysqli('localhost','root','','Postales');

    // Check for errors
    if(mysqli_connect_errno()){
    echo mysqli_connect_error();
    }
    $remitente = $_SESSION["email"];

    $respAX = array();
    // 1st Query
    $result = $db->query("call agregarPostalEnviada('$nombrePK','$descrip','P','$hide','$remitente','$emailD')");
    if($result){
         // Cycle through results
        while ($row = $result->fetch_object()){
            $otro = $row;
        }
        // Free result set
        $result->close();
        $db->next_result();
    }else echo($db->error);

    if($otro->aviso == 'OK')
    {
      // 2nd Query
      $result = $db->query("call datosUsuario('$remitente')");
      if($result){
           // Cycle through results
          while ($row = $result->fetch_object()){
              $user_data = $row;
          }
           // Free result set

           $result->close();
           $db->next_result();
      }
      else echo($db->error);

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
      $mail->addAddress($emailD);
      $mail->CharSet = 'UTF-8';
      $mail->Subject="¡TIENES UNA NUEVA POSTAL!";
      $mail->msgHTML("<h1><center><img width='50px' height = '50px' src='https://www.enriquedans.com/wp-content/uploads/2014/02/Telegram-logo.jpg'>Tienes una nueva postal en POSTKARTE.com</center></h1>" . "<br>" . "<h2><center> El usuario: " . $user_data->Nombre . " " . $user_data->Apellidos . " te ha mandado una postal.</center></h2>". "<br><h2><center>¡Inicia sesión para verla!</center></h2><br><center><h1>" . $link . "</center></h1>");
      if(!$mail->send()){
        $respAX["val"] = 0;
        $respAX["msj"] = "Error al enviar. Favor de intentarlo nuevamente.";
      }
        else {
          $respAX["val"] = 1;
          $respAX["msj"] = "El mensaje fue enviado con éxito.";
        }
    }
    else{
      $respAX["val"] = 0;
      $respAX["msj"] = "Hubo un problema: " . $otro->aviso ;
    }
$db->close();
  echo json_encode($respAX);
  ?>
