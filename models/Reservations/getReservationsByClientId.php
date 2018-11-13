<?php
include '../../subcomponents/connection.php';


session_start();

$client_id = $_GET['id_pacient'];
$returnArray = [];
$sql = "SELECT * FROM reservations WHERE id_client = '$client_id'";
$result = mysqli_query($conn, $sql);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);


?>
