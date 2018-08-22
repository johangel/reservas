<?php include 'subcomponents/header.php';
if($_SESSION['rol'] == 'Administrador'){
  header( "Location: http://localhost/reservas/RoleManagement");
}
?>

<div style="min-height: 95%" class="container p-4">
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
          <input type="text" class="form-control" id="DescriptionEdit" placeholder="Titulo">
        </div>
        <div class="form-group">
          <label for="">Especialista</label>
          <input type="text" class="form-control" id="especilisaEdit" placeholder="Nombre del especialista" readonly>
        </div>
        <div class="form-group">
          <label for="">Hora de inico</label>
          <input type="text" class="form-control" id="horaInicio" placeholder="" readonly>
        </div>
        <div class="form-group">
          <label for="">Hora de finalizado</label>
          <input type="text" class="form-control" id="horaFinal" placeholder="" readonly>
        </div>
        <div class="form-group">
          <label for="">Costo de reserva</label>
          <input type="text" class="form-control" id="precioEdit" placeholder="Precio total de consulta" readonly>
        </div>
      </form>
      <div id="btn_group" class="btn-group hidden" role="group">
        <button type="button" class="btn btn-primary" onclick="updateReservation()">Editar reserva</button>
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
             <select onchange="setSpeciality(value)" class="form-control" id="">
               <option selected disabled>Escoger una especializacion</option>
               <option value"Neurologia">Neurologia</option>
               <option value"Traumatologia">Traumatologia</option>
               <option value"Emergencia">Emergencias</option>
               <option value"Odontologia">Odontologia</option>


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
</div>

<script src="js/createCalendar.js"></script>

<script type="text/javascript">

  var allSpecialists = []
  var doctor_user_id;
  var specialist_reservations = [];
  var self_id = <?php echo $_SESSION['userId']; ?>;
  var rol = <?php echo "'".$_SESSION['rol']."'"; ?>;

  $(document).ready( function () {
    getAllSpecialists();
  });

  function getAllSpecialists(){
    $.ajax({
      type: 'GET',
      url : "http://localhost/reservas/controladores/getAllSpecialists.php",
      success: function(data, status){
        data =JSON.parse(data);
        allSpecialists = data;
      }
    })
  }

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

    console.log(eventData);

    $.ajax({
      type:'POST',
      url:"http://localhost/reservas/controladores/Reservations/saveReservation.php",
      data: eventData,
      success: function(data, status){
        $('#calendar').fullCalendar('renderEvent', eventData); // stick? = true
        toastr.success('Se creo la reserva con exito');
        $('#FormEvent').modal('hide');
        location.reload();
      }
    })
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
    $.ajax({
      type: 'GET',
      url : "http://localhost/reservas/controladores/Reservations/getSpecialistsReservations?id_specialist="+doctor_user_id,
      success: function(response, status){
        console.log(response);
        if(response == null){
          specialist_reservations = [];
        }else{
          specialist_reservations = JSON.parse(response);
        }
        for(var i = 0; i<specialist_reservations.length; i++){
          if(specialist_reservations[i].id_client == self_id){
            specialist_reservations[i]['editable'] = true;
          }else {
            specialist_reservations[i]['editable'] = false;
          }
        }
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('renderEvents', specialist_reservations, true);
      }
    })

    console.log(doctor_user_id);
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

    $.ajax({
      type: "POST",
      url : "http://localhost/reservas/controladores/Reservations/deleteReservation.php",
      data:  request,
      success: function(response, status){
        console.log(response)
        $('#calendar').fullCalendar('removeEvents',id_reservation);
        id_reservation = 0;
        $('#btn_group').addClass('');
        $('#DescriptionEdit').val('');
        $('#especilisaEdit').val('');
        $('#horaInicio').val('');
        $('#horaFinal').val('');
        $('#precioEdit').val('');
        toastr.success('reserva eliminada con exito');
      }
    })
  }

  function updateReservation(){
    request={
      title: $('#DescriptionEdit').val(),
      id_reservation: id_reservation
    };

    $.ajax({
      type: "POST",
      data : request,
      url : "http://localhost/reservas/controladores/Reservations/updateReservation.php",
      success: function(response, status){
        toastr.success('se edito la reserva con exito');
      }
    })
  }

  function clientsReservations(){
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar('renderEvents', ReservationsByCliente, true);
  }
</script>

<?php include 'subcomponents/footer.php'; ?>
