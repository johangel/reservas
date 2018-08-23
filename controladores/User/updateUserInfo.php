<?php
include '../../connection.php';
session_start();
$email = $_POST['email'];
$age = $_POST['age'];
$dni = $_POST['dni'];
$birthdate = $_POST['birthdate'];
$BloodType = $_POST['BloodType'];
$genero = $_POST['genero'];
$sessionId = $_SESSION['userId'];


$sql = "UPDATE user_info SET genero='$genero', edad='$age', fecha_nacimiento='$birthdate', tipo_sangre='$BloodType', Dni='$dni' WHERE user_id='$sessionId'";
$result = mysqli_query($conn, $sql);

if ($email != ''){

}

if($result){
  echo 1;
}else{
  echo 0;
}

mysqli_close($conn);


?>
