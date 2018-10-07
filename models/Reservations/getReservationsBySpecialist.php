<?php
include '../../subcomponents/connection.php';


session_start();

$specialist_id = $_SESSION['userId'];
$returnArray = [];
$sql = "SELECT * FROM reservations WHERE id_specialist = '$specialist_id'";
$result = mysqli_query($conn, $sql);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);

?>
