<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/PHPMailer/src/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/PHPMailer/src/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {

  $mail = new PHPMailer($debug);
    if ($debug) {
      $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
    }

  $mail->isSMTP();
  $mail->SMTPAuth = true;

  $mail->Host = "smtp.remotehost.es";
  $mail->Port = 587;
  $mail->Username = "no-reply@remotehost.es";
  $mail->Password = "Justfortesting26#";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->setFrom('no-reply@remotehost.es', 'RemoteHost');

  $mail->addAddress('jkelly20940@iesjoanramis.org', 'josh');
  $mail->addAttachment($_SERVER['DOCUMENT_ROOT']."/student014/shop/assets/images/logo.png", "logo.png");
  $mail->CharSet = 'UTF-8';
  $mail->Encoding = 'base64';
  $mail->isHTML(true);
  $mail->Subject = 'Trial sending email';
  $mail->Body = '<h1>Soy spam</h1><img src="https://remotehost.es/student014/shop/assets/images/logo.png" alt="image"/>';
  // $mail->AltBody = 'Texto como elemento de texto simple';
  $mail->send();

} catch (Exception $e) {
  echo "Mailer Error: ".$e->getMessage();
}

?>