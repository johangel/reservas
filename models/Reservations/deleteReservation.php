<?php
include '../../subcomponents/connection.php';


session_start();
$id = $_POST['id_reservation'];

$sqlInfoReservation = "SELECT * FROM reservations WHERE id = '$id'";
$sqlResultReservation = mysqli_query($conn, $sqlInfoReservation);

$row = mysqli_fetch_array($sqlResultReservation);

$id_specialist = $row['id_specialist'];
$message_specialist = 'la cita "'.$row['title'] .'", con el cliente '.$row['client'].' fue cancelada';
$sqlCreateNotificationSpecialist = "INSERT INTO info_notifications (user_id, message) values ('$id_specialist', '$message_specialist')";
$result = mysqli_query($conn, $sqlCreateNotificationSpecialist);

$id_client = $row['id_client'];
$message_client = 'la cita "'.$row['title'] .'", con el especialista '.$row['specialist'].' fue cancelada';
$messageNotificationClient = "INSERT INTO info_notifications (user_id, message) values ('$id_client', '$message_client')";
$result = mysqli_query($conn, $messageNotificationClient);

$sql = "DELETE FROM reservations WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);



?>
