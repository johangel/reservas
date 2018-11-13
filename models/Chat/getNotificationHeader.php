<?php
session_start();
include('../../subcomponents/connection.php');

$userId = $_SESSION['userId'];
$sqlMessages = "SELECT * from info_notifications WHERE user_id = '$userId'";
$resultMesages = mysqli_query($conn, $sqlMessages);
$messagesArray = [];
while ($messages = mysqli_fetch_assoc($resultMesages)) {
  $messagesArray[] = $messages;
}
$response = json_encode($messagesArray);

echo $response;
mysqli_close($conn);



?>
