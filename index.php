<?php
session_start();
if($_SESSION['rol'] == 'Administrador'){
  header( "Location: http://localhost/reservas/vistas/RoleManagement");
}
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
  <script src='./dependencies/fullCalendar-3.9.0/lib/moment.min.js'></script>
  <script src="./dependencies/fullcalendar-3.9.0/lib/jquery.min.js"></script>
  <link rel="stylesheet" href="./dependencies/fullcalendar-3.9.0/fullcalendar.min.css">
  <link rel="stylesheet" href="./dependencies/fullcalendar-3.9.0/fullcalendar.print.min.css" media="print">
  <script src="./dependencies/fullCalendar-3.9.0/fullCalendar.min.js"></script>
  <script src="./dependencies/fullCalendar-3.9.0/locale/es.js"></script>
  <script src="./js/commonfunctions.js"></script>
  <!-- <script src='fullCalendar-3.9.0/demos/js/theme-chooser.js'></script> -->
  <script src='./dependencies/fullCalendar-3.9.0/lib/toastr.min.js'></script>
  <link rel="stylesheet" href='./dependencies/fullCalendar-3.9.0/lib/toastr.min.css'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="./styles/global.css">
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

      <?php
        include('subcomponents/connection.php');

        $userId = $_SESSION['userId'];
        $sqlMessages = "SELECT * from info_notifications WHERE user_id = '$userId'";
        $resultMesages = mysqli_query($conn, $sqlMessages);
        $messagesArray = [];
        while ($messages = mysqli_fetch_assoc($resultMesages)) {
          $messagesArray[] = $messages;
        }
        mysqli_close($conn);


        $host_url = 'http://'.$_SERVER['HTTP_HOST'].'/reservas';

      ?>

      <li class="notification_header_container nav-item d-flex align-items-center p-2 position-relative">
        <div onclick="showNotificationsHeader()">
          <img src=" <?php echo $host_url.'/assets/icons/bell.png'; ?>" alt="">
          <span id="amountNotificationsHeader" style="color: white"><?php echo count($messagesArray); ?></span>
        </div>
          <ul id="notifications_header_container" class="message_notification_header_container shadow rounded hidden">
            <?php
            if(count($messagesArray) > 0){
              for($i = 0; $i<count($messagesArray); $i++){
                echo '<li class="message_notification" onclick="deleteNotificationHeader('.$messagesArray[$i]['id_notification'].',event)">'.$messagesArray[$i]["message"].'</li>';
              }
            }else{
               echo '<li class="message_notification">No tienes notificaciones sin leer en este momento</li>';
            }
            ?>
          </ul>
      </li>


      <style media="screen">

        .notification_header_container{
          transition: 0.125s all;
        }

        .notification_header_container:hover{
          background: #495081;
          cursor: pointer;
        }

        .notification_header_container .message_notification_header_container{
          position: absolute;
          top: 75%;
          z-index: 100;
          right: 170px;
          font-size: 12px;
          max-width: 250px;
          background: white;
          max-height: 250px;
          overflow-y: scroll;
          right: 50%;
          width: 250px;
        }

        .notification_header_container .message_notification_header_container .message_notification{
          padding: 10px;
          border-bottom: 1px solid #e6ecf0;
          transition: 0.125s all;
          cursor: pointer;
        }

        .notification_header_container .message_notification_header_container .message_notification:hover{
          color: white;
          background: #007bff;
        }

        .notification_header_container .message_notification_header_container .message_notification:last-child{
          border-bottom: none;
        }


      </style>
      <script src="js/controlers/messages.js"></script>

      <script type="text/javascript">

        $(document).ready( function () {
          setNewMessagesInHeader();
          setInterval(function(){
             setNewMessagesInHeader();
          }, 5000);
        });

        function setNewMessagesInHeader(){
          messagesHtml = '';
          messagesArray = messagesModels.getNotificationHeader();
          if(messagesArray.length > 0){
            for(var i = 0; i<messagesArray.length; i++){
              messagesHtml += '<li class="message_notification" onclick="deleteNotificationHeader('+messagesArray[i]['id_notification']+',event)">'+messagesArray[i]["message"]+'</li>'
            }
          }else{
            messagesHtml = '<li class="message_notification">No tienes notificaciones sin leer en este momento</li>';
          }
          // $('#notifications_header_container').html('');
          $('#notifications_header_container').html(messagesHtml);
          $('#amountNotificationsHeader').html(messagesArray.length);
          // console.log(messagesArray);
        }

        function showNotificationsHeader(){
          $('#notifications_header_container').toggleClass('hidden');
        }

        function deleteNotificationHeader(id,event){
          var amountNOtifications = $('#amountNotificationsHeader').html();
          amountNOtifications--;
          $('#amountNotificationsHeader').html(amountNOtifications);
          var elem = event.target;
          elem.parentNode.removeChild(elem);

          if(amountNOtifications == 0){
            $("#notifications_header_container").append('<li class="message_notification">No tienes notificaciones sin leer en este momento</li>');
          }

          var request = {
            id_notification: id,
          };
          messagesModels.deleteNotificationHeader(request);
        }
      </script>

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


<div style="min-height: 95%" class="container py-4">

  <div class="row p-2 bg-white shadow-sm rounded">
    <h2 class="font-weight-light">Tabla de reservas</h2>
  </div>
  <div class="row justify-content-between mt-3 bg-white shadow rounded">
    <div class="col-md-4 p-3 ">
      <h4>Especificaciones de reservas</h4>
      <hr>
      <form class="">
        <div class="form-group">
          <label for="">Descripcion de reserva</label>
          <input type="text" class="form-control" id="DescriptionEdit" placeholder="Descripcion Reserva" readonly onkeydown="disableNumbers(event)">
        </div>

         <?php  if($_SESSION['rol'] == 'usuario'){
      echo '  <div class="form-group">
          <label for="">Especialista</label>
          <input type="text" class="form-control" id="especilisaEdit" placeholder="Nombre del especialista" readonly>
        </div>';

      }?>

        <?php  if($_SESSION['rol'] == 'Especialista'){
      echo '  <div class="form-group">
          <label for="">Paciente</label>
          <input type="text" class="form-control" id="Pacienteid" placeholder="Nombre del paciente" readonly>
        </div>';
       }?>

        <div class="form-group">
          <label for="">Hora de inico</label>
          <input type="text" class="form-control" id="horaInicio" placeholder="Hora inicio" readonly>
        </div>
        <div class="form-group">
          <label for="">Hora de finalizado</label>
          <input type="text" class="form-control" id="horaFinal" placeholder="Hora Final" readonly>
        </div>
        <div class="form-group">
          <label for="">Costo de reserva</label>
          <input type="text" class="form-control" id="precioEdit" placeholder="Precio total de consulta" readonly>
        </div>
      </form>
      <div id="btn_group" class="btn-group hidden" role="group">
        <button type="button" class="btn btn-primary" id="updpateButtonReservation" onclick="updateReservation()">Editar reserva</button>
        <button type="button" onclick="deleteReservation()" class="btn btn-danger">Eliminar reserva</button>
      </div>
    </div>

    <div class="col-md-8 p-3">
      <div class="pr-3 row justify-content-between">
        <h4>Tabla de reservas</h4>
           <?php  if($_SESSION['rol'] == 'usuario'){
             echo '<button class="btn btn-sm btn-primary" onclick="clientsReservations()">ver mis reservaciones</button>';
           }?>

      </div>

       <?php  if($_SESSION['rol'] == 'usuario'){
         echo '
         <div class="row mb-4">
           <div class="form-group col-md-12">
             <label for="">Area especialista</label>
             <select id="specialFieldSelecet" onchange="setSpeciality(value)" class="form-control" id="">
               <option selected disabled>Escoger una especializacion</option>

             </select>
           </div>

           <div class="form-group  col-md-12">
             <label for="">Doctores filtrados</label>
             <select onchange="setDoctor(value)" class="form-control" id="doctorsSelect">
               <option value="" selected>Selecciona un especialista</option>
             </select>
           </div>



         </div>';
       }?>

      <div id="calendar"></div>
    </div>

  </div>
</div>

<div class="modal fade" id="FormEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulario reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Descripcion de la reserva:</label>
            <input type="text" class="form-control" id="descripcion">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Especialista:</label>
            <input type="text" class="form-control" id="especialista" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Precio consulta:</label>
            <input type="text" class="form-control" id="precio" readonly>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="crearReserva()" class="btn btn-primary">Crear Reserva</button>
      </div>
    </div>
  </div>

</div><link rel="stylesheet" href="styles/chat.css">

<div class="chatWindow">

  <div  id="chat" class="chat">
    <div onclick="hideChat()" class="chat_header p-2">
      <?php echo $_SESSION['username']; ?>
    </div>
    <div id="chatList" class="chatList hidden height0">
      <ul id="userList">
      </ul>
    </div>
  </div>

</div>

<div id="message" class="message hidden">
  <div id="transmiterName" onclick="hideChatMessages()" class="transmiterName p-2 chat_header">
  </div>

    <ul class="chatMessages" id="chatMessages" class="p-2">
    </ul>
    <input type="text" class="messageField" onkeyup="submitMessage(event)" placeholder="escribe un mensaje..">
</div>

<script src="js/controlers/messages.js"></script>

<script type="text/javascript">

  var receptor_id;

  $(document).ready( function () {
    getUsersSpecialist();
    setInterval(function(){
       getUsersSpecialist();
    }, 5000);
  });

  function getUsersSpecialist(){
    request = {
      specialist_id: <?php echo $_SESSION['userId'] ?>
    };
    messagesModels.getSpecialistFromClient(request);
  }

  function hideChat(){
    $('#chatList').toggleClass('hidden');
    $('#chatList').toggleClass('height0');

    if($('#chatList').hasClass('hidden')){
      $('#chat').css('min-height', '0px');
    }else{
      $('#chat').css('min-height', '300px');
    }
  }

  function openChat(id, name, amount){
    console.log(amount);
    if(amount > 0){
      $('#notification' + id).addClass('hidden');
    }
    $('#message').removeClass('hidden');
    receptor_id = id;
    $('.message_container').remove();
    $('#transmiterName').html(name);
    request={
      guessUser: id,
      selfId: <?php echo $_SESSION['userId'] ?>
    };
    messagesModels.openChat(request);
  }

  function hideChatMessages(){
    $('#message').addClass('hidden');
  }

  function submitMessage(event){


    var keycode = (event === null) ? window.event.keyCode : event.which;
    if(keycode === 13) {
      var request ={
        message: event.target.value,
        receptor_id: receptor_id,
        transmiter_id: <?php echo $_SESSION['userId'] ?>,
        time: moment().format()
      };

    if($.trim(event.target.value).length == 0) {
      // string only contained whitespace (ie. spaces, tabs or line breaks)
      return false;
    }

    messagesModels.submitMessage(request, event);

    console.log(request);
    }
  }
</script>

<script src="js/createCalendar.js"></script>
<script src="js/controlers/specialistFields.js"></script>
<script src="js/controlers/Specialist.js"></script>
<script src="js/controlers/reservations.js"></script>
<script type="text/javascript">
  var allSpecialFields = [];
  var allSpecialists = [];
  var doctor_user_id;
  var specialist_reservations = [];
  var self_id = <?php echo $_SESSION['userId']; ?>;
  var rol = <?php echo "'".$_SESSION['rol']."'"; ?>;

  $(document).ready( function () {
    allSpecialFields = FieldsModel.setFields();
    console.log(allSpecialFields);
    allSpecialists = Specialists.getAllSpecialists();
    console.log(allSpecialists);

    setSpecialFields();
  });

  function crearReserva(){
    var eventData;

    eventData = {
      id_cliente: <?php echo $_SESSION['userId'] ?>,
      client: '<?php echo $_SESSION['username'] ?>',
      id_specialist:doctor_user_id,
      title: $('#descripcion').val(),
      start: moment(Globalstart).format(),
      end: moment(globalEnd).format(),
      specialist: $('#especialista').val(),
      Cost: $('#precio').val()
    };

    reservationModel.createReservation(eventData);
  }

  function setSpeciality(value){
    $('#doctorsSelect').find('option').remove().end().append('<option selected>Escoger una especializacion</option>').val('whatever');
    for(var i = 0; i<allSpecialists.length; i++){
      if(allSpecialists[i].specialistField == value && allSpecialists[i].active == 1){
        doctorsSelect = document.getElementById('doctorsSelect');
        doctorsSelect.options[doctorsSelect.options.length] = new Option('Dr. ' + allSpecialists[i].nombre, allSpecialists[i].user_id);
      }
    }
  }

  function setDoctor(value){
    doctor_user_id = value;
    Specialists.setDoctorForReservation(doctor_user_id)

    for(var i = 0; i<allSpecialists.length; i++){
      if(allSpecialists[i].user_id == doctor_user_id){
        $('#especialista').val(allSpecialists[i].nombre);
        $('#precio').val(allSpecialists[i].salary + '$');
      }
    }
    canCreate = true;
  }

  function deleteReservation(){
    request={
      id_reservation: id_reservation
    };

    reservationModel.deleteReservation(request);
  }

  function updateReservation(){
    request={
      title: $('#DescriptionEdit').val(),
      id_reservation: id_reservation
    };
    reservationModel.updateReservation(request);
  }

  function clientsReservations(){
    $('#calendar').fullCalendar('removeEvents');

    $('#calendar').fullCalendar('renderEvents', ReservationsByCliente, true);

    location.reload();
  }

  function setSpecialFields(){
    for (var i = 0; i<allSpecialFields.length; i++){
      $('#specialFieldSelecet').append('<option value"'+allSpecialFields[i].Name+'">'+allSpecialFields[i].Name+'</option>')
    }
  }

  function changeBussinesHours(){
    console.log('epa');
      $('#calendar').fullCalendar('option', {
        businessHours: businessHoursGlobal
      })
  }

</script>
