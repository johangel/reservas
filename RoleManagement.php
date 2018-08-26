<?php include 'subcomponents/header.php'; ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div style="min-height: 95%" class="container mt-4">

  <div class="row justify-content-between mt-3">
    <div class="col-md-12 p-3 bg-white shadow rounded">
      <h4 class="font-weight-light">Lista Usuarios</h4>
      <table id="userTables" class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>Nombre</th>
            <th>Rol</th>
            <th>id de usuario</th>
          </tr>
        </thead>
        <tbody id="userTablesBody">

        </tbody>
      </table>
    </div>

    <div class="col-md-12 p-3 bg-white shadow rounded mt-3">
      <h4 class="font-weight-light">Panel de roles</h4>
      <form>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Usuario</label>
            <input type="text" class="form-control" id="userName" readonly placeholder="Nombre">
          </div>

          <div class="form-group col-md-6">
            <label for="inputState">Rol</label>
            <select onchange="showRoleOptions(value)" id="rol" class="form-control">
              <option selected disabled>Seleccionar rol</option>
              <option value="Especialista">Especialista</option>
              <option value="Usuario">Usuario</option>
              <option value="Administrador">Administrador</option>

            </select>
          </div>
        </div>
        <div id="optionsContainer" class="hidden">
          <div class="form-group">
            <label for="inputState">Area especializacion</label>
            <select id="specializacionField" class="form-control">
              <option selected disabled>Seleccionar area especializacion</option>
            </select>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">CMD</label>
              <input type="text" class="form-control" id="CMD">
            </div>

            <div class="form-group col-md-6">
              <label for="inputZip">Salario por consulta</label>
              <input type="number" class="form-control" id="salary">
            </div>
          </div>

          <div class="form-row">

            <div class="form-group col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="specialistActive">
                <label class="form-check-label" for="gridCheck">
                  Especialista Activo
                </label>
              </div>
            </div>

            <div class="form-group col-md-8">
              <label for=""> Horario de especialista </label>
              <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" checked="" type="checkbox" id="day1" value="1">
                <label class="form-check-label" for="lunes">Lunes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" checked="" type="checkbox" id="day2" value="2">
                <label class="form-check-label" for="martes">Martes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" checked="" type="checkbox" id="day3" value="3">
                <label class="form-check-label" for="miercoles">Miercoles</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" checked="" type="checkbox" id="day4" value="4">
                <label class="form-check-label" for="jueves">Jueves</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" checked="" type="checkbox" id="day5" value="5">
                <label class="form-check-label" for="viernes">Viernes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" checked="" type="checkbox" id="day6" value="6">
                <label class="form-check-label" for="sabado">Sabado</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="day0" value="0">
                <label class="form-check-label" for="domingo">domigo</label>
              </div>

              <div class="form-group mt-3">
                <div class="row">
                  <div class="col-md-6">
                    <label for="inputState">desde</label>
                    <select id="hoursFrom" class="form-control">
                      <option selected>8:00</option>
                      <option>9:00</option>
                      <option>10:00</option>
                      <option>11:00</option>
                      <option>12:00</option>
                      <option>13:00</option>
                      <option>14:00</option>
                      <option>15:00</option>
                      <option>16:00</option>
                      <option>17:00</option>
                      <option>18:00</option>
                      <option>19:00</option>
                      <option>20:00</option>
                      <option>21:00</option>
                      <option>22:00</option>
                    </select>
                  </div>

                  <div class="col-md-6">
                      <label for="inputState">hasta</label>
                      <select id="hoursTo" class="form-control">
                        <option>8:00</option>
                        <option>9:00</option>
                        <option>10:00</option>
                        <option>11:00</option>
                        <option>12:00</option>
                        <option>13:00</option>
                        <option>14:00</option>
                        <option>15:00</option>
                        <option>16:00</option>
                        <option selected>17:00</option>
                        <option>18:00</option>
                        <option>19:00</option>
                        <option>20:00</option>
                        <option>21:00</option>
                        <option>22:00</option>
                      </select>
                  </div>
                </div>
            </div>

            </div>


          </div>

      </form>
    </div>
    <button type="submit" onclick="updateSpecialistInfo(event)" class="btn btn-primary">Editar rol</button>
  </div>


</div>
<script type="text/javascript" src="js/models/Users.js"></script>
<script src="js/models/specialistFields.js"></script>
<script type="text/javascript" src="js/models/specialist"></script>
<script type="text/javascript">
  var allSpecialFields = [];
  var user_id;
  var row_table;
  $(document).ready( function () {
    allSpecialFields = FieldsModel.setFields();
    userModel.setUserInTable();
    setSpecialFields();
  } );

  function selectUser(event, name, id){
    $('input[type=checkbox]').prop('checked',false);
    user_id = id;
    row_table = event.target.parentElement.children[1];
    Specialists.selectSpecialist(event, name,user_id);
  }

  function showRoleOptions(value){
    if(value == 'Especialista'){
      $('.hidden').removeClass('hidden');
    }else{
      $('#optionsContainer').addClass('hidden');
      $('#CMD').val('');
      $('#salary').val('');
      $('#specializacionField').val('');
      $('#specialistActive')['0'].checked = false;
    }
  }

  function updateSpecialistInfo(evt){

    evt.preventDefault();

    var daysArray = [];
    var cmd = $('#CMD').val();
    var rol = $('#rol').val();
    var salary = $('#salary').val();
    var specializacionField  = $('#specializacionField').val();

    if($('#specialistActive')['0'].checked){
        var active = 1;
      }else{
        var active = 0;
    }

    for(var i = 0; i<7; i++){
      if($('#day' + i)['0'].checked){
        daysArray.push($('#day' + i).val());
      }
    }

    var request={
      user_id: user_id,
      cmd:cmd,
      rol:rol,
      salary:salary,
      specializacionField:specializacionField,
      active:active,
      daysArray:daysArray.toString(),
      from:$('#hoursFrom').val(),
      to:$('#hoursTo').val()
    }

    console.log(request);
    Specialists.updateSpecialistInfo(request, rol);

  }

  function setSpecialFields(){
    for (var i = 0; i<allSpecialFields.length; i++){
      $('#specializacionField').append(' <option value"'+allSpecialFields[i].Name+'">'+allSpecialFields[i].Name+'</option>')
    }
  }
</script>
<?php include 'subcomponents/footer.php'; ?>
