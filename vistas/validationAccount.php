<?php
include '../subcomponents/connection.php';
$validation_key = $_GET['validation_key'];

$sql = "SELECT * FROM validation_keys WHERE validation_key = '$validation_key'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$mensaje;


if(!($row == null)){
  $email = $row['user_email'];

  $sqlUpdateValidationAccount ="UPDATE usuarios SET validated = '1' WHERE correo = '$email'";
  $result = mysqli_query($conn, $sqlUpdateValidationAccount);

  $sqlDeleteValidation ="DELETE FROM validation_keys WHERE validation_key = '$validation_key'";
  $result = mysqli_query($conn, $sqlDeleteValidation);

  $mensaje = '¡Felicitaciones! la cuenta enlazada al correo '. $row['user_email'].' fue validada exitosamente';
}else{
  $mensaje = 'No pudimos validar ninguna cuenta con el codigo utilizado';
}
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" href="assets/logo.png">
<?php include '../subcomponents/dependencies.php'; ?>
<title>Sitema Reservas</title>
</head>
<div style="height: 100vh;" class="row justify-content-md-center align-items-center">
  <div class="FormContainer col-md-4 text-center">
    <h3 class="p-3 bg-light shadow rounded">
      <?php echo  $mensaje?>
    </h3>
    <a href="http://localhost/reservas" name="button" class="btn btn-primary mt-4">Iniciar sesion</a>
  </div>
</div>
