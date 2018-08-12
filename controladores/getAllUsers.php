<?php
session_start();
include '../connection.php';

$sql = "SELECT * FROM user_info i INNER JOIN usuarios u ON i.user_id = u.id";
$result = mysqli_query($conn, $sql);

while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
  // echo json_encode($fila);
  // echo ',';
}
$options = json_encode($returnArray);
echo $options;
// $row = mysqli_fetch_array($result);
// echo json_encode($row);

// $sql = "SELECT nombre,  from Usuarios WHERE user_id = '$id'";

?>
