<?php
include '../../subcomponents/connection.php';


session_start();
$title = $_POST['title'];
$id_reservation = $_POST['id_reservation'];
$sql = "UPDATE reservations SET title='$title' WHERE id='$id_reservation'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

?>
