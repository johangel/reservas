<?php
require '../../phpMailer/PHPMailerAutoload.php';
require '../../phpMailer/credentials.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(EMAIL, 'PepeReservas');
$mail->addAddress($email, $name);     // Add a recipient
$mail->addReplyTo(EMAIL);

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Mensaje de validacion para su cuenta';
$mail->Body    = '<p>Gracias por registrarte en nuestra plataforma, por favor haz click en el siguiente link
                      para poder verificar tu cuenta exitosamente</p> <br>
                      ' . $linkToValidateAccout;
$mail->AltBody = '<p>Gracias por registrarte en nuestra plataforma, por favor haz click en el siguiente link
                      para poder verificar tu cuenta exitosamente</p> <br>
                      ' . $linkToValidateAccout;

if(!$mail->send()) {
    // echo 'Message could not be sent.';
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    // echo 'Message has been sent';
}
