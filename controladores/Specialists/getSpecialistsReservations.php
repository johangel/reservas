<?php
include '../../connection.php';
session_start();
$id = $_GET['id_specialist'];
$returnArray = [];
$sql = "SELECT * FROM specialist_info WHERE user_id = $id";

$result = mysqli_query($conn,$sql);

while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray['specilist_info'] = $fila;
}

$sql = "SELECT * FROM reservations WHERE id_specialist = $id";
$result = mysqli_query($conn,$sql);

while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray['reservas'][] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);

?>
