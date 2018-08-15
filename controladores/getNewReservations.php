<?php
include '../connection.php';
session_start();

$type_user = $_POST['type_user'];
$user_id = $_POST['user_id'];

$sql ="SELECT * FROM notifications n INNER JOIN reservations r on n.reservation_id = r.id WHERE n.type_user = '$type_user' and n.user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
while ($fila = mysqli_fetch_assoc($result)) {
  $returnArray[] = $fila;
}
$options = json_encode($returnArray);
echo $options;
mysqli_close($conn);
?>
