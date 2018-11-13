<?php
include '../../subcomponents/connection.php';


session_start();
$start = $_POST['start'];
$end = $_POST['end'];
$id = $_POST['id'];

$sqlInfoReservation = "SELECT * FROM reservations WHERE id = '$id'";
$sqlResultReservation = mysqli_query($conn, $sqlInfoReservation);

$row = mysqli_fetch_array($sqlResultReservation);

$id_specialist = $row['id_specialist'];
$message_specialist = 'la cita "'.$row['title'] .'", con el cliente '.$row['client'].' fue cambiada al horario '. $_POST['start_format'];
$sqlCreateNotificationSpecialist = "INSERT INTO info_notifications (user_id, message) values ('$id_specialist', '$message_specialist')";
$result = mysqli_query($conn, $sqlCreateNotificationSpecialist);

$id_client = $row['id_client'];
$message_client = 'la cita "'.$row['title'] .'", con el especialista '.$row['specialist'].' fue cambiada al horario '. $_POST['start_format'];
$messageNotificationClient = "INSERT INTO info_notifications (user_id, message) values ('$id_client', '$message_client')";
$result = mysqli_query($conn, $messageNotificationClient);

$sql = "UPDATE reservations SET start ='$start', end ='$end' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
echo 'Se cambio la hora de reservacion con exito';
?>
