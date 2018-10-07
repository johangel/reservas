<?php
include '../../subcomponents/connection.php';

session_start();

$guessId = $_GET['guessUser'];
$selfId = $_SESSION['userId'];

$sql ="SELECT * from messages WHERE receptor_id = $guessId AND transmiter_id = $selfId";
$result = mysqli_query($conn, $sql);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}

$sql ="SELECT * from messages WHERE receptor_id = $selfId AND transmiter_id = $guessId";
$result = mysqli_query($conn, $sql);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}

if(!($returnArray == null)){
  $sqlResetNotification = "UPDATE message_notification SET amount = '0' WHERE id_receptor = '$selfId' AND id_transmiter = '$guessId'";
  $resultResetNotification = mysqli_query($conn, $sqlResetNotification);

}
$option = json_encode($returnArray);
echo $option;
mysqli_close($conn);

?>
