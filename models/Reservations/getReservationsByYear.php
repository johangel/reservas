<?php
include '../../subcomponents/connection.php';

session_start();

$year = $_GET['year'];
$returnArray = [];
$sqlReservations = "SELECT * from reservations";
$result = mysqli_query($conn, $sqlReservations);
while ($fila = mysqli_fetch_assoc($result)) {
  $reservationDate = date('Y', strtotime($fila["start"]));
  if($year == $reservationDate){
    $returnArray[] = $fila;
  }
}
$options = json_encode($returnArray);
echo $options;

mysqli_close($conn);


?>
