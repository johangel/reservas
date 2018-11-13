<?php
include '../../subcomponents/connection.php';


session_start();

$field = $_GET['field'];
$returnArray = [];
$sql = "SELECT * FROM reservations r INNER JOIN specialist_info s WHERE r.id_specialist = s.user_id AND s.specialistField = '$field'";
$result = mysqli_query($conn, $sql);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);


?>
