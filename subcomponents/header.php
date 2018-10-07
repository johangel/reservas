<?php
session_start();
if (!isset($_SESSION['username'])){
  header( "Location: http://localhost/reservas/vistas/login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" href="assets/logo.png">
<?php
if(!($_SERVER['REQUEST_URI'] == '/reservas/')){
  include '../subcomponents/dependencies.php';
}
?>
<title>Sitema Reservas</title>
</head>
<body>
  <nav style="style="max-height: 10vh;" " class="navbar navbar-expand-lg navbar-dark bg-primary p-0 px-2">
    <a class="navbar-brand" href="#">Sistema Reservas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <?php
          if($_SESSION['rol'] == 'Administrador'){
            echo '<li class="nav-item mr-auto">
                    <a class="nav-link" href="http://localhost/reservas/vistas/RoleManagement">Gestionar roles</a>
                  </li>
                  <li class="nav-item mr-auto">
                    <a class="nav-link" href="http://localhost/reservas/vistas/Reports">Reportes</a>
                  </li>
                  <li class="nav-item mr-auto">
                    <a class="nav-link" href="http://localhost/reservas/vistas/FieldsManagement">Especialidades</a>
                  </li>';
          }else{
            echo '
            <li class="nav-item">
            <a class="nav-link" href="http://localhost/reservas">Reservas <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="http://localhost/reservas/vistas/perfil">Personal</a>
            </li>
            ';
          }
         ?>
      </ul>
      <ul class="navbar-nav ml-auto">
        <?php include '../subcomponents/header_notifications.php'; ?>
        <li class="nav-item dropdown d-flex align-items-center">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <?php echo $_SESSION['username'];?> <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a onclick="logout()" class="dropdown-item">
              Desconectar
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <script type="text/javascript">
    function logout(){

      $.ajax({
        type: "GET",
        url : "http://localhost/reservas/models/Auth/logout.php",
        success :function(data ,status){
          window.location.href = "http://localhost/reservas/vistas/login.php";
        }
      });
    }
  </script>
