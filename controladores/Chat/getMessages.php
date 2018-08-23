<?php
include '../../connection.php';
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
$option = json_encode($returnArray);
echo $option;
mysqli_close($conn);

?>
