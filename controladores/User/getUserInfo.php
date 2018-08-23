<?php

session_start();
include '../../connection.php';

$user_id = $_GET['id'];

$sql = "SELECT * FROM user_info i INNER JOIN usuarios u ON i.user_id = u.id WHERE i.user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo json_encode($row);
mysqli_close($conn);
?>
