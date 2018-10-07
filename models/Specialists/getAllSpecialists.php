<?php
include '../../subcomponents/connection.php';

session_start();

$sql = "SELECT * FROM specialist_info i INNER JOIN usuarios u ON i.user_id = u.id";
$result = mysqli_query($conn, $sql);
$returnArray = [];
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);
?>
