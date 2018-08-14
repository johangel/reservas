<?php include 'subcomponents/header.php'; ?>


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
      <div class=" p-2 row justify-content-between">
        <h4>Menu Creacion de reservas</h4>
        <button class="btn btn-sm btn-primary" onclick="clientsReservations()">ver mis reservaciones</button>
      </div>
      <hr>
      <div class="row mb-4">
        <div class="form-group col-md-12">
          <label for="">Area especialista</label>
          <select class="form-control" id="">
            <option selected disabled>Escoger una especializacion</option>
            <option onclick="setSpeciality('Especializacion 1')">Especializacion 1</option>
            <option onclick="setSpeciality('Especializacion 2')">Especializacion 2</option>
            <option onclick="setSpeciality('Especializacion 3')">Especializacion 3</option>

          </select>
        </div>

        <div class="form-group  col-md-12">
          <label for="">Doctores filtrados</label>
          <select onchange="setDoctor(value)" class="form-control" id="doctorsSelect">
            <option value="" selected>Selecciona un especialista</option>
          </select>
        </div>

      </div>
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
        console.log(allSpecialists);
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

    // console.log(moment(eventData.start._d).format('LLLL'));

    console.log(eventData);

    $.ajax({
      type:'POST',
      url:"http://localhost/reservas/controladores/saveReservation.php",
      data: eventData,
      success: function(data, status){
      }
    })
    $('#calendar').fullCalendar('renderEvent', eventData); // stick? = true
    toastr.success('Se creo la reserva con exito');
    $('#FormEvent').modal('hide');
  }

  function setSpeciality(value){
    $('#doctorsSelect').find('option').remove().end().append('<option selected>Escoger una especializacion</option>').val('whatever');
    for(var i = 0; i<allSpecialists.length; i++){
      if(allSpecialists[i].specialistField == value){
        doctorsSelect = document.getElementById('doctorsSelect');
        doctorsSelect.options[doctorsSelect.options.length] = new Option('Dr. ' + allSpecialists[i].nombre, allSpecialists[i].user_id);
      }
    }
  }

  function setDoctor(value){
    doctor_user_id = value;
    $.ajax({
      type: 'GET',
      url : "http://localhost/reservas/controladores/getSpecialistsReservations?id_specialist="+doctor_user_id,
      success: function(response, status){
        specialist_reservations = JSON.parse(response);
        console.log(specialist_reservations);
        for(var i = 0; i<specialist_reservations.length; i++){
          specialist_reservations[i].title = '';
          specialist_reservations[i].cost = '';
        }
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('renderEvents', specialist_reservations);

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
      url : "http://localhost/reservas/controladores/deleteReservation.php",
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
      url : "http://localhost/reservas/controladores/updateReservation.php",
      success: function(response, status){
        toastr.success('se edito la reserva con exito');
      }
    })
  }

  function clientsReservations(){
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar('renderEvents', ReservationsByCliente);
  }
</script>

<?php include 'subcomponents/footer.php'; ?>
