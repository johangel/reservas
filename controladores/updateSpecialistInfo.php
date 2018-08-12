<?php
session_start();
include '../connection.php';

$id = $_POST['user_id'];
$acive = $_POST['acive'];
$specialistField = $_POST['specialistField'];
$cmd = $_POST['cmd'];
$salary = $_POST['salary'];


$sql = "SELECT id from specialist_info WHERE user_id = '$id'";
echo $sql;
$result = mysqli_query($conn, $sql);

if($result){
  $sqlUpdate = "UPDATE specialist_info SET active='$active', specialistField='$specialistField', cmd='$cmd', salary='$salary' WHERE user_id='$id'";
}else{
  // $sqlCreate = "INSERT INTO specialist_info"
}

?>
