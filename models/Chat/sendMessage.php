<?php
include '../../subcomponents/connection.php';

session_Start();

$message = $_POST['message'];
$time = $_POST['time'];
$receptor_id = $_POST['receptor_id'];
$transmiter_id = $_POST['transmiter_id'];

$sql = "INSERT INTO messages (transmiter_id, receptor_id, message_body, time) values ('$transmiter_id', '$receptor_id', '$message', '$time')";
$result = mysqli_query($conn, $sql);

$sqlCheckNotification ="SELECT * FROM message_notification WHERE id_transmiter = '$transmiter_id' AND id_receptor = '$receptor_id'";
$resultChecking = mysqli_query($conn, $sqlCheckNotification);
$row = mysqli_fetch_array($resultChecking);

if(!($row == null)){
  $newNotificationAmount = $row['amount'] + 1;
  $sqlUpdateNotification = "UPDATE message_notification SET amount = '$newNotificationAmount' WHERE id_transmiter = '$transmiter_id' AND id_receptor = '$receptor_id'";
  $resultUpdateNotification = mysqli_query($conn, $sqlUpdateNotification);

}else{
  $sqlCreateNotification = "INSERT INTO message_notification (id_transmiter, id_receptor, amount) VALUES ('$transmiter_id', '$receptor_id', '1')";
  $resultCreateNotification = mysqli_query($conn, $sqlCreateNotification);
}
mysqli_close($conn);
?>
