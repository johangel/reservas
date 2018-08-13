<?php
include '../connection.php';
session_start();
$id = $_GET['id'];

$sql = "SELECT * FROM specialist_info WHERE user_id = '$id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row == null){
 echo 'false';
}else{
  echo json_encode($row);
}
?>
