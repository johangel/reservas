<?php
include '../connection.php';
session_start();
$start = $_POST['start'];
$end = $_POST['end'];
$id = $_POST['id'];

$sql = "UPDATE reservations SET start ='$start', end ='$end' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
echo 'Se cambio la hora de reservacion con exito';
?>
