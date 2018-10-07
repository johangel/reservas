<?php
session_start();
include '../../subcomponents/connection.php';


$sql = "SELECT * FROM user_info i INNER JOIN usuarios u ON i.user_id = u.id";
$result = mysqli_query($conn, $sql);

while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;

}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);

?>
