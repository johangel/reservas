<?php
include '../subcomponents/connection.php';
session_start();

// $typeOfReport = $_GET['type'];

$sql ="SELECT * FROM reservations r INNER JOIN specialist_info s ON r.id_specialist = s.user_id";
$result = mysqli_query($conn, $sql);
$returnArray = [];
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);
?>
