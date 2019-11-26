<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$ruta = $_POST['imagen'];//leemos la ruta de la postal creada la cual esta ya en base 64
$correo_des = $_POST['correo'];//leemos el correo concatenado del destinatario en POST tambien
$resource = base64_decode(str_replace(" ", "+", substr($ruta, strpos($ruta, ","))));//transformamos la imagen para ser enviada


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // nos imprime los mensajes mientras ocurre la conexion por TCP hasta el envio 
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPOptions = array( //Checar si es necesario, en otros dominios puede servir sin estas lines de codigo: SMTPOptions
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('lobosupremo1998@gmail.com', 'Danielo');//quien se lo va a enviar
    $mail->addAddress($correo_des);//a quien se lo va a enviar

    // Attachments(Enviamos la postal que se creo)
    $mail->addStringAttachment($resource, "Postal.png", "base64", "image/png");

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->CharSet = 'UTF-8';  //Para haceptar acentos y demas.
    $mail->Subject = '¡Has recibido una postal! POSTKARTE';
    $mail->Body    = '<h1>Mira la postal que te enviarón</h1>
    					<h2>¡Entra ya para crear tu propia postal!: http://localhost/Proyecto_web/postal.php</h2>
    					<br>
    					<h4>© 2019-2020 ESCOM / IPN. RESERVADOS TODOS LOS DERECHOS, POSTKARTE WEB   Sitio Seguro</h4>';
 //   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<script> function activates() {
    var carga = document.getElementById("cargador");
    var envia = document.getElementById("elsub");
    var msj = document.getElementById("con");
    envia.disabled = false;
    envia.style.background = "#63BF6A";
    carga.style.display = "none";
    msj.style.display = "block";
    msj.style.color = "#63BF6A";
    msj.innerHTML="¡Enviado con éxito!"
	}
    function ocul() {
    var msj = document.getElementById("con");
    msj.style.display = "none";
    }
	activates();
    setTimeout(function(){ocul()},3000);
    </script>';
} catch (Exception $e) {
      echo '<script> function activates() {
    var carga = document.getElementById("cargador");
    var envia = document.getElementById("elsub");
    var msj = document.getElementById("con");
    envia.disabled = false;
    envia.style.background = "#63BF6A";
    carga.style.display = "none";
    msj.style.display = "block";
    msj.style.color = "#B22914";
    msj.innerHTML="Error al enviar :("
    }
    function ocul() {
    var msj = document.getElementById("con");
    msj.style.display = "none";
    }
    activates();
    setTimeout(function(){ocul()},3000);
    </script>';
}
?>