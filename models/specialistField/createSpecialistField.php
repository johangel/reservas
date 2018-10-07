<?php
session_start();
include '../../subcomponents/connection.php';


$fieldName = $_POST['nameField'];

$sql = "INSERT INTO specialist_Field (name) VALUES ('$fieldName')";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);


?>
