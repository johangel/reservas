<?php
session_start();
include '../../subcomponents/connection.php';


$id = $_GET['specialist_id'];
$arraySpecialist;

if($_SESSION['rol'] == 'usuario'){
  $sql = "SELECT id_specialist FROM reservations WHERE id_client = $id";
}else if($_SESSION['rol'] == 'Especialista'){
  $sql = "SELECT id_client FROM reservations WHERE id_specialist = $id";
}

$result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_array($result);

while ($fila = mysqli_fetch_array($result)) {
  $returnArray[] = $fila[0];
}

$returnArray = array_keys(array_count_values($returnArray));

for($i = 0; $i<sizeof($returnArray); $i++){
  $idToLook = $returnArray[$i];
  $sql = "SELECT nombre, id FROM usuarios WHERE id = '$idToLook'";
  $result = mysqli_query($conn, $sql);

  while ($fila = mysqli_fetch_assoc($result)) {
    $transmiter_id = $fila['id'];
    $sqlMessageNotifications = "SELECT amount FROM message_notification WHERE id_transmiter = '$transmiter_id' AND id_receptor = '$id'";
    $resultNotificationMessage = mysqli_query($conn, $sqlMessageNotifications);
    $row = mysqli_fetch_array($resultNotificationMessage);
    if(!($row == null)){
      $fila['amount'] = $row['amount'];
      $specialist[] = $fila;
    }else{
      $fila['amount'] = '0';
      $specialist[] = $fila;
    }
  }



  $arraySpecialist = json_encode($specialist);
}

echo $arraySpecialist;
mysqli_close($conn);

?>
