<?php
include '../../connection.php';
session_start();

$id_notification = $_POST['id_notification'];
$user_id = $_POST['user_id'];

$sql = "DELETE FROM notifications WHERE id_notification = '$id_notification' AND user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

  // $sqlDelete = "DELETE FROM specialist_info WHERE user_id = '$id'";
?>
