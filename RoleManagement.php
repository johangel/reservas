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
<script src="js/models/specialistFields.js"></script>
<script type="text/javascript">
  var allSpecialFields = [];
  var user_id;
  var row_table;
  $(document).ready( function () {
    allSpecialFields = FieldsModel.setFields();
    getAllUsers();
    setSpecialFields();
  } );

  function selectUser(event, name, id){
    user_id = id;
    row_table = event.target.parentElement.children[1];
    $.ajax({
      type:'GET',
      url : "http://localhost/reservas/controladores/Specialists/getSpecialistInfo?id="+id,
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
      url : "http://localhost/reservas/controladores/User/getAllUsers.php",
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
        $('#userTables').DataTable({
          "language": {
            "lengthMenu": "Mostrar _MENU_ por páginas",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "sSearch":         "Buscar:",
            "sZeroRecords":    "No se encontraron resultados",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
            },
          }
        });
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
      url : "http://localhost/reservas/controladores/Specialists/updateSpecialistInfo.php",
      data: request,
      success :function(data, status){
        toastr.success(data);
        row_table.innerHTML = rol;
      }
    });

  }

  function setSpecialFields(){
    for (var i = 0; i<allSpecialFields.length; i++){
      $('#specializacionField').append(' <option value"'+allSpecialFields[i].Name+'">'+allSpecialFields[i].Name+'</option>')
    }
  }
</script>
<?php include 'subcomponents/footer.php'; ?>
