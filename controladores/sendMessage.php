<?php
include '../connection.php';
session_Start();
$message = $_POST['message'];
$time = $_POST['time'];
$receptor_id = $_POST['receptor_id'];
$transmiter_id = $_POST['transmiter_id'];

$sql = "INSERT INTO messages (transmiter_id, receptor_id, message_body, time) values ('$transmiter_id', '$receptor_id', '$message', '$time')";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
?>
