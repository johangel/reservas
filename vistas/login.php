<?php
session_start();
if (isset($_SESSION['username'])){
header( "Location: http://localhost/reservas/vistas");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" href="../assets/cita.png">
<?php include '../subcomponents/dependencies.php';
include '../subcomponents/loader.php';
?>
<title>Sitema Reservas</title>
</head>
<body>

<div style="height: 100vh;" class="row justify-content-md-center align-items-center">
  <div class="FormContainer col-md-3 p-3 bg-light text-center shadow rounded">
    <div class="form-signin" id="form">
      <img class="mb-3" src="../assets/cita.png" alt="" width="700" height="200">
      <h1 class="h3 mb-3 font-weight-normal">Ingresa con tus crendeciales</h1>

      <input type="email" id="inputEmail" class="form-control mb-1" placeholder="Correo electronico" required autofocus>

      <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>

      <button class="btn btn-md btn-primary btn-block mt-3" onclick="login()" type="submit">Ingresar</button>
      <a href="http://localhost/reservas/vistas/registro.php" class="btn btn-sm btn-secondary btn-block mt-1 white" type="submit">Registrate</a>

      <p class="mt-5 mb-3 text-muted">&copy;Todos los derechos reservados 2018-2019</p>

    </div>
  </div>
</div>

<script type="text/javascript" src="../js/controlers/auth.js"></script>

<script type="text/javascript">



  function login(){
  
  var email = $('#inputEmail').val();
  var password = $('#inputPassword').val();

    if(email == '' || password == ''){
        toastr.error('llena todos los campos antes de iniciar sesion');
        return false;
     }

    var request={
      email: $('#inputEmail').val(),
      password:$('#inputPassword').val()
    }

    authModel.login(request);
  }
</script>
</body>
</html>
