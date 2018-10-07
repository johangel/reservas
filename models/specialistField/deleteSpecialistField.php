<?php
include '../../subcomponents/connection.php';

session_start();
$id = $_POST['idField'];

$sql = "DELETE FROM specialist_field WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

?>
