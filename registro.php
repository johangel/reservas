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
        <input type="text" id="inputName" class="form-control mb-2" placeholder="Nombre y apellido" required autofocus>
        <input type="email" id="inputEmailRegister" class="form-control mb-2" placeholder="Correo electronico" required>
        <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Contraseña" required>
        <input type="password" id="repeatPassword" class="form-control mb-2" placeholder="Repetir Contraseña" required>

        <button class="btn btn-md btn-primary btn-block mt-1" onclick="register()" type="submit">Registrar</button>
        <a href="http://localhost/reservas/login" class="btn btn-sm btn-secondary btn-block mt-1">volver</a>


        <p class="mt-5 mb-3 text-muted">&copy;Todos los derechos reservados 2017-2018</p>
      </div>
    </div>
  </div>

<script type="text/javascript">
  function register(){
    var password = $('#inputPassword').val();
    var repeat_password = $('#repeatPassword').val();
    var email = $('#inputEmailRegister').val();
    var name = $('#inputName').val();

    if(password != repeat_password){
      toastr.error('Las contraseñas no coniciden');
      return;
    }

    var request = {
      name:name,
      email:email,
      repeat_password:repeat_password,
      password:password
    }

    $.ajax({
      type: "POST",
      url : "http://localhost/reservas/controladores/register.php",
      data: request,
      success :function(data, status){
        console.log(data);
        if(data == '1'){
          window.location.href = "http://localhost/reservas/index.php";
        }else{
        }

      }
    });

  }
</script>
<?php include 'subcomponents/footer.php'; ?>
