<?php
include '../../subcomponents/connection.php';


session_start();

$sqlReservations = "SELECT * from reservations";
$result = mysqli_query($conn, $sqlReservations);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$allReservations = json_encode($returnArray);
echo $allReservations;
mysqli_close($conn);

?>
