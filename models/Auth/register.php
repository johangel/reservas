<?php
include '../../subcomponents/connection.php';
//recibe el post
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];

//define query para crear usuario
$sql = "SELECT * FROM usuarios WHERE correo = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if(isset($row)){
  echo 'correoTomado';
  return;
}

  // code...


$sql = "INSERT INTO Usuarios (correo, nombre, clave, validated) VALUES ('$email', '$name', '$password', '0')";
$result = mysqli_query($conn, $sql);




//obtener ultima id
$result = mysqli_query($conn, "SELECT max(id) FROM Usuarios");
$row=mysqli_fetch_array($result);
$lastid = $row[0];

//crea user_info a partir del usuario creado
$sql_create_userInfo = "INSERT INTO user_info (user_id, rol) VALUES ('$lastid', 'usuario')";
$result2 = mysqli_query($conn, $sql_create_userInfo);
$validation_key = 'validation'.date('d_m_Y_H_i_s');
$sql_create_validate_key = "INSERT INTO validation_keys (user_id, validation_key, user_email) VALUES ('$lastid', '$validation_key', '$email')";
$result3 = mysqli_query($conn, $sql_create_validate_key);

$linkToValidateAccout = 'http://localhost/reservas/vistas/validationAccount.php?validation_key='.$validation_key;
include '../../subcomponents/emailVerificationMessage.php';
echo '1';

mysqli_close($conn);

?>
