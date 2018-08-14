<?php
include '../connection.php';
session_start();
$id = $_GET['id_specialist'];

$sql = "SELECT * FROM reservations WHERE id_specialist = $id";
$result = mysqli_query($conn,$sql);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);

?>
