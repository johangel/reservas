<?php
include '../../subcomponents/connection.php';

session_start();

$sqlPacients = "SELECT * FROM user_info i INNER JOIN usuarios u  ON i.user_id = u.id WHERE rol = 'usuario'";
$result = mysqli_query($conn, $sqlPacients);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$allPacients = json_encode($returnArray);
echo $allPacients;
mysqli_close($conn);

?>
