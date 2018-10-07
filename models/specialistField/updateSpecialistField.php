<?php
include '../../subcomponents/connection.php';
session_start();
$id = $_POST['id'];
$newName = $_POST['name'];

$sql = "UPDATE specialist_Field SET Name = '$newName' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);

?>
