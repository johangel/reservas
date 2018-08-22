<?php
include '../../connection.php';

session_start();
$sql ="SELECT * FROM specialist_Field";
$result = mysqli_query($conn, $sql);
$returnArray = [];
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);

?>
