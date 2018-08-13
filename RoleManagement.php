<?php include 'subcomponents/header.php'; ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">

</script>
<div style="min-height: 95%" class="container mt-4">

  <!-- <div class="row p-2 bg-white shadow-sm rounded">
    <h2 class="font-weight-light">Gestion de roles</h2>
  </div> -->

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
          <!-- <tr class="selectableRow" onclick="selectUser(event, 'Johangelito')">
            <td>Johangelito</td>
            <td>Usuario</td>
          </tr>
          <tr class="selectableRow" onclick="selectUser(event, 'Macoisito')">
            <td>Macoisito</td>
            <td>Especialista</td>
          </tr> -->
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
            </select>
          </div>
        </div>
        <div id="optionsContainer" class="hidden">
          <div class="form-group">
            <label for="inputState">Area especializacion</label>
            <select id="specializacionField" class="form-control">
              <option selected disabled>Seleccionar area especializacion</option>
              <option>Especializacion 1</option>
              <option>Especializacion 2</option>
              <option>Especializacion 3</option>
            </select>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity">CMD</label>
              <input type="text" class="form-control" id="CMD">
            </div>

            <div class="form-group col-md-4">
              <label for="inputState">State</label>
              <select id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="inputZip">Salario por consulta</label>
              <input type="number" class="form-control" id="salary">
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="specialistActive">
              <label class="form-check-label" for="gridCheck">
                Especialista Activo
              </label>
            </div>
          </div>
        </div>

        <button type="submit" onclick="updateSpecialistInfo(event)" class="btn btn-primary">Editar rol</button>
      </form>
    </div>
  </div>


</div>
<script type="text/javascript">
var user_id;
var row_table;
$(document).ready( function () {
  getAllUsers();
} );

function selectUser(event, name, id){
  user_id = id;
  row_table = event.target.parentElement.children[1];
  $.ajax({
    type:'GET',
    url : "http://localhost/reservas/controladores/getSpecialistInfo?id="+id,
    success: function(data, status){
      if(data == 'false'){
        $('#optionsContainer').addClass('hidden');
        $('#rol').val('Usuario');
        $('#CMD').val('');
        $('#salary').val('');
        $('#specializacionField').val('');
        $('#specialistActive')['0'].checked = false;

      }else{
        var specialist = {}
         specialist = JSON.parse(data);
         $('#optionsContainer').removeClass('hidden');
         $('#CMD').val(specialist['cmd']);
         $('#rol').val('Especialista');
         $('#salary').val(specialist['salary']);
         $('#specializacionField').val(specialist['specialistField']);
         if(specialist['active'] == 1){
           $('#specialistActive')['0'].checked = true;
         }else{
           $('#specialistActive')['0'].checked = false;
         }
      }

      $('#userName').val(name);
      $('.selected').removeClass('selected');
      event.target.parentElement.classList.add('selected');
    }
  });
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

function getAllUsers(){

  $.ajax({
    type: "GET",
    url : "http://localhost/reservas/controladores/getAllUsers.php",
    datatype:'json',

    success :function(data, status){
      data = JSON.parse(data);
      var table = document.getElementById("userTablesBody");
      var cell1;
      var cell2;
      var row;

      for(var i = 0; i <data.length; i++ ){
        row = table.insertRow(i);
        var name = data[i].nombre;
        row.className='selectableRow';
        cell1 = row.insertCell(0);
        cell2 = row.insertCell(1);
        cell3 = row.insertCell(2);
        cell1.innerHTML = data[i].nombre;
        cell2.innerHTML = data[i].rol;
        cell3.innerHTML = data[i].user_id;
        row = null;
      }

      $("#userTablesBody").on('click','tr',function(e) {
          // console.log($(this)['0'].children[2].innerHTML);
          selectUser(e,$(this)['0'].children[0].innerHTML, $(this)['0'].children[2].innerHTML);
      });
      $('#userTables').DataTable();
    }

  });
}

function updateSpecialistInfo(evt){

  evt.preventDefault();

  var cmd = $('#CMD').val();
  var rol = $('#rol').val();
  var salary = $('#salary').val();
  var specializacionField  = $('#specializacionField').val();
  if($('#specialistActive')['0'].checked){
      var active = 1;
    }else{
      var active = 0;
    }

  var request={
    user_id: user_id,
    cmd:cmd,
    rol:rol,
    salary:salary,
    specializacionField:specializacionField,
    active:active
  }

  $.ajax({
    type: "POST",
    url : "http://localhost/reservas/controladores/updateSpecialistInfo.php",
    data: request,
    success :function(data, status){
      toastr.success(data);
      row_table.innerHTML = rol;
    }
  });

}
</script>
<?php include 'subcomponents/footer.php'; ?>
