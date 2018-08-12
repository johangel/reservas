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
          </tr>
        </thead>
        <tbody>
          <tr class="selectableRow" onclick="selectUser(event, 'Johangelito')">
            <td>Johangelito</td>
            <td>Usuario</td>
          </tr>
          <tr class="selectableRow" onclick="selectUser(event, 'Macoisito')">
            <td>Macoisito</td>
            <td>Especialista</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 p-3 bg-white shadow rounded mt-3">
      <h4 class="font-weight-light">Panel de roles</h4>
      <form>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Usuario</label>
            <input type="text" class="form-control" id="userName" placeholder="Nombre">
          </div>

          <div class="form-group col-md-6">
            <label for="inputState">Rol</label>
            <select onchange="showRoleOptions(value)" id="inputState" class="form-control">
              <option selected disabled>Seleccionar rol</option>
              <option value="Especialista">Especialista</option>
              <option value="Usuario">Usuario</option>
            </select>
          </div>
          <!-- <div class="form-group col-md-6">
            <label for="inputPassword4">Rol</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Password">
          </div> -->
        </div>
        <div id="optionsContainer" class="hidden">
          <div class="form-group">
            <label for="inputState">Area especializacion</label>
            <select id="inputState" class="form-control">
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
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                Especialista Activo
              </label>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Editar rol</button>
      </form>
    </div>
  </div>


</div>
<script type="text/javascript">
$(document).ready( function () {
  $('#userTables').DataTable();
} );

function selectUser(evt, name){
  $('#userName').val(name);
  console.log(evt);
  $('.selected').removeClass('selected');
  evt.target.parentElement.classList.add('selected');
}

function showRoleOptions(value){
  if(value == 'Especialista'){
    $('.hidden').removeClass('hidden');
  }else{
    $('#optionsContainer').addClass('hidden');
  }
}
</script>
<?php include 'subcomponents/footer.php'; ?>
