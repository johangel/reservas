<?php
include '../../subcomponents/connection.php';

session_start();
$id = $_POST['id_notification'];

$sql = "DELETE FROM info_notifications WHERE id_notification = '$id'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

?>
