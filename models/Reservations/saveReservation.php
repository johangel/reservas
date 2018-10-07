<?php
include '../../subcomponents/connection.php';


session_start();

$id_client = $_POST['id_cliente'];
$id_specialist = $_POST['id_specialist'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$specialist = $_POST['specialist'];
$cost = $_POST['Cost'];
$client = $_POST['client'];

$sql = "INSERT INTO reservations (id_specialist, id_client, title, start, end, specialist, cost, client) VALUES ('$id_specialist', '$id_client', '$title', '$start', '$end', '$specialist', '$cost', '$client')";
$result = mysqli_query($conn, $sql);

$resultId = mysqli_query($conn, "SELECT max(id) FROM reservations");
$row=mysqli_fetch_array($resultId);
$lastReservationid = $row[0];

$sqlNotificationClient = "INSERT INTO notifications (reservation_id, type_user, user_id) VALUES ('$lastReservationid', 'Usuario', '$id_client')";
$resultNotificationCliente = mysqli_query($conn, $sqlNotificationClient);

$sqlNotificationSpecialist = "INSERT INTO notifications (reservation_id, type_user, user_id) VALUES ('$lastReservationid', 'Especialista', '$id_specialist')";
$resultNotificationEspecialista = mysqli_query($conn, $sqlNotificationSpecialist);

mysqli_close($conn);


?>
