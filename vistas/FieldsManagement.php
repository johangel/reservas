<?php include '../subcomponents/header.php'; ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div style="min-height: 95%" class="container p-4">
  <div class="row p-3 bg-white shadow-sm rounded">
    <h2 class="font-weight-light mb-0">Gerenciar Especialidades</h2>
    <button type="button" class=" ml-3 btn btn-sm btn-primary" onclick="openModalCreate()" name="button">Crear especializacion</button>
  </div>

  <div class="row p-3 bg-white shadow-sm rounded mt-3">
    <div class="col-md-12">
      <table id="EspecialityTable" class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th class="text-center">id</th>
            <th class="text-center">Nombre especializacion</th>
            <th class="text-center">Accion</th>
          </tr>
        </thead>
        <tbody id="specialityTablesBody">

        </tbody>
      </table>
    </div>
  </div>

</div>

<div class="modal" id="confirmDeleteField" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mensaje de confirmacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Estas seguro que deseas eliminar esta especializacion?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="deleteSpeciality()">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="CreateModalField" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Creacion de nueva especializacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Nombre de especializacion</label>
          <input type="text" class="form-control" id="specializacionField" onkeydown="disableNumbers(event)">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
        <button type="button" class="btn btn-primary" onclick="createSpecializacion()">Crear especializacion</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmUpdateField" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edicion de especializacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Nuevo nombre de especializacion</label>
          <input type="text" class="form-control" onkeydown="disableNumbers(event)" id="specializacionUpdateField">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
        <button type="button" class="btn btn-primary" onclick="UpdateSpecializacion()">Editar Especializacion</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="../js/controlers/specialistFields.js"></script>

<script type="text/javascript">

  var listaEspecialidades = [];
  var specialityToBeDeleted;
  var specialityToBeEdited;

  $(document).ready( function () {
    listaEspecialidades = FieldsModel.setFields();
    console.log(listaEspecialidades);
    for(var i = 0; i<listaEspecialidades.length; i++){
      $('#EspecialityTable').append('<tr> <td class="text-center">'+listaEspecialidades[i].id+'</td> <td class="text-center">'+listaEspecialidades[i].Name+'</td> <td class="text-center"> <button type="button" class="btn btn-sm btn-danger" onclick="ConfirmDelete('+listaEspecialidades[i].id+')" name="button">Eliminar</button>  <button type="button" class="btn btn-sm btn-info" onclick="ConfirmUpdate('+listaEspecialidades[i].id+')" name="button">Editar</button> </td></tr>')
    }
    setTimeout(function(){
      $('#EspecialityTable').DataTable({
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
    }, 1);
  });

  function deleteSpeciality(){
    FieldsModel.deleteField(specialityToBeDeleted);
  }

  function ConfirmDelete(id){
    $('#confirmDeleteField').modal('show');
    specialityToBeDeleted = id;
  }

  function openModalCreate(){
    $('#CreateModalField').modal('show');
  }

  function createSpecializacion(){
    if(!($('#specializacionField').val() == '')){
      FieldsModel.addNewField($('#specializacionField').val());
    }
  }

  function ConfirmUpdate(id){
    $('#confirmUpdateField').modal('show');
    specialityToBeEdited = id;
  }

  function UpdateSpecializacion(){
    if(!($('#specializacionUpdateField').val() == '')){
      var request ={
        id:specialityToBeEdited,
        name: $('#specializacionUpdateField').val()
      }

      FieldsModel.updateField(request);
      // console.log(request);

    }

  }

</script>


<?php include '../subcomponents/footer.php'; ?>
