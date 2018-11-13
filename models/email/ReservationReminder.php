<?php
require '../../subcomponents/connection.php';
require '../../dependencies/phpMailer/PHPMailerAutoload.php';
require '../../dependencies/phpMailer/credentials.php';

function sendMessage($email, $hour, $nombreReserva, $userName, $specialistName){
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
  $mail->addAddress($email, $userName);     // Add a recipient
  $mail->addReplyTo(EMAIL);

  // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = 'Recordatorio de reservacion';
  $mail->Body    = '¡Hola, '. $userName . ' recuerda que hoy tienes una reservacion "'.$nombreReserva. '" a las ' . $hour . ' con el especialista ' .
  $specialistName . ' No olvides asistir!';
  $mail->AltBody = '¡Hola, '. $userName . ' recuerda que hoy tienes una reservacion "'.$nombreReserva. '" a las ' . $hour . ' con el especialista ' .
  $specialistName . ' No olvides asistir!';

  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    echo 'Message has been sent';
  }

}

$sqlTodayReservations = "SELECT * FROM reservations";
$result = mysqli_query($conn, $sqlTodayReservations);
$todayDate = date('m.d.y');
$reservationsArray = [];

while ($fila = mysqli_fetch_assoc($result)) {
  $reservationDate = date('m.d.y', strtotime($fila["start"]));

  if($reservationDate == $todayDate){
    $id_client = $fila['id_client'];
    $reservationName = $fila['title'];
    $client_name = $fila['client'];
    $specialit = $fila['specialist'];



    $getEmail = "SELECT correo from usuarios where id = '$id_client'";
    $resultEmail = mysqli_query($conn, $getEmail);

    $emailVar = mysqli_fetch_assoc($resultEmail);
    $reservationHour  = date("g:i a", strtotime($fila["start"]));


    sendMessage($emailVar['correo'], $reservationHour, $reservationName, $client_name, $specialit);
  }

}

mysqli_close($conn);
