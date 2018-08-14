<?php
include '../connection.php';

session_start();
$id = $_POST['id_reservation'];

$sql = "DELETE FROM reservations WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

?>
