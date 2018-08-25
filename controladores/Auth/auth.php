<?php
session_start();
include '../../connection.php';


$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios u INNER JOIN user_info i on i.user_id = u.id  WHERE u.correo = '$email' AND clave = '$password'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if(!($row == null)){
  echo 'true';
  $_SESSION['username'] = $row['nombre'];
  $_SESSION['userId'] = $row['user_id'];
  $_SESSION['rol'] = $row['rol'];

}else{
  echo 'false';
}
mysqli_close($conn);

?>
