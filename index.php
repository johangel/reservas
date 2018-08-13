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
          <input type="text" class="form-control" id="especilisaEdit" placeholder="Nombre del especialista">
        </div>
        <div class="form-group">
          <label for="">Hora de inico</label>
          <input type="text" class="form-control" id="horaInicio" placeholder="">
        </div>
        <div class="form-group">
          <label for="">Hora de finalizado</label>
          <input type="text" class="form-control" id="horaFinal" placeholder="">
        </div>
        <div class="form-group">
          <label for="">Costo de reserva</label>
          <input type="text" class="form-control" id="precioEdit" placeholder="Precio total de consulta">
        </div>
      </form>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-primary" disabled>Editar reserva</button>
        <button type="button" class="btn btn-danger" disabled>Eliminar reserva</button>
      </div>
    </div>

    <div class="col-md-8 p-3">
      <h4>Menu Creacion de reservas</h4>
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
            <option value="" selected disabled>Selecciona un especialista</option>
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
            <input type="text" class="form-control" id="especialista">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Precio consulta:</label>
            <input type="text" class="form-control" id="precio">
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
      id_cliente:'',
      id_specialist:'',
      title: $('#descripcion').val(),
      start: Globalstart,
      end: globalEnd,
      specialist: $('#especialista').val(),
      Cost: $('#precio').val()
    };


    console.log(eventData);
    $('#calendar').fullCalendar('renderEvent', eventData); // stick? = true
    toastr.success('Se creo la reserva con exito', 'Exito');
    $('#FormEvent').modal('hide');
  }

  function setSpeciality(value){
    for(var i = 0; i<allSpecialists.length; i++){
      if(allSpecialists[i].specialistField == value){
        doctorsSelect = document.getElementById('doctorsSelect');
        doctorsSelect.options[doctorsSelect.options.length] = new Option('Dr. ' + allSpecialists[i].nombre, allSpecialists[i].user_id);
      }
    }
  }

  function setDoctor(value){
    doctor_user_id = value;
    console.log(doctor_user_id);
    canCreate = true;
  }
</script>

<?php include 'subcomponents/footer.php'; ?>
