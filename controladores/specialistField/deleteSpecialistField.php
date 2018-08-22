<?php
include '../../connection.php';
session_start();
$id = $_POST['idField'];

$sql = "DELETE FROM specialist_field WHERE = '$id'";
echo $sql;
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

?>
