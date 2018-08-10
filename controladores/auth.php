<?php
session_start();
include '../connection.php';
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT nombre FROM Usuarios WHERE correo = '$email' AND clave = '$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if(!($row == null)){
  echo 'true';
  $_SESSION['username'] = $row['nombre'];
}else{
  echo 'false';
}
?>
