<?php
session_start();
include '../../connection.php';

$id = $_GET['specialist_id'];
$arraySpecialist;

if($_SESSION['rol'] == 'usuario'){
  $sql = "SELECT id_specialist FROM reservations WHERE id_client = $id";
}else if($_SESSION['rol'] == 'Especialista'){
  $sql = "SELECT id_client FROM reservations WHERE id_specialist = $id";
}
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
while ($fila = mysqli_fetch_row($result)) {
  $returnArray[] = $fila[0];
}
$returnArray = array_keys(array_count_values($returnArray));
for($i = 0; $i<sizeof($returnArray); $i++){
  $idToLook = $returnArray[$i];
  $sql = "SELECT nombre, id from usuarios WHERE id = '$idToLook'";
  $result = mysqli_query($conn, $sql);

  while ($fila = mysqli_fetch_assoc($result)) {
    $specialist[] = $fila;
  }

  $arraySpecialist = json_encode($specialist);
}

echo $arraySpecialist;
mysqli_close($conn);

?>
