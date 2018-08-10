<?php
include '../connection.php';

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];

$sql = "INSERT INTO Usuarios (correo, nombre, clave) VALUES ('$email', '$name', '$password')";
$result = mysqli_query($conn, $sql);
echo $result;
// if(!($row == null)){
//   echo 'true';
// }else{
//   echo 'false';
// }
?>
