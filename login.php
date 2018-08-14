<?php
session_start();
if (isset($_SESSION['username'])){
header( "Location: http://localhost/reservas");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" href="assets/logo.png">
<?php include 'subcomponents/dependencies.php'; ?>
<title>Sitema Reservas</title>
</head>
<body>

<div style="height: 100vh;" class="row justify-content-md-center align-items-center">
  <div class="FormContainer col-md-3 p-3 bg-light text-center shadow rounded">
    <div class="form-signin">
      <img class="mb-3" src="assets/logo.png" alt="" width="200" height="200">
      <h1 class="h3 mb-3 font-weight-normal">Ingresa con tus crendeciales</h1>
      <input type="email" id="inputEmail" class="form-control mb-1" placeholder="Correo electronico" required autofocus>
      <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>

      <button class="btn btn-md btn-primary btn-block mt-3" onclick="login()" type="submit">Ingresar</button>
      <a href="http://localhost/reservas/registro.php" class="btn btn-sm btn-secondary btn-block mt-1 white" type="submit">Registrate</a>

      <p class="mt-5 mb-3 text-muted">&copy;Todos los derechos reservados 2017-2018</p>

    </div>
  </div>
</div>
<script type="text/javascript">
  function login(){
    console.log('aja')

    var request={
      email:$('#inputEmail').val(),
      password:$('#inputPassword').val()
    }

    $.ajax({
      statusCode: {
        500: function() {
          toastr.error('Credenciales del usuario no coinciden');
        }
      },
      type: "POST",
      url : "http://localhost/reservas/controladores/auth.php",
      data: request,
      success :function(data, status){
        console.log(data);
        if(data == 'true'){
          window.location.href = "http://localhost/reservas/index.php";
        }else{
          toastr.error('Error de credenciales');
        }

      }
    });
  }
</script>
<?php include 'subcomponents/footer.php'; ?>
