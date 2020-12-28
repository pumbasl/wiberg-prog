<?php 
session_start(); 

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$email = $_SESSION['emailuser'];
$page = $_SESSION['email_page'];
$subject = $_SESSION['subject'];
$body = $_SESSION['body'];

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.adm.tools';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'webmaster@wiberg-prog.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'XHaUvv3b510A'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('webmaster@wiberg-prog.ru'); // от кого будет уходить письмо?
$mail->addAddress($email);     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $body;
$mail->AltBody = '';

if(!$mail->send()) {
    echo 'Error';
} else {
    header('location: '.$page);
}

echo "" .$subject." | ".$body." | ".$page;
?>