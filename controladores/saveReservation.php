<?php
include('../connection.php');
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
mysqli_close($conn);


?>
