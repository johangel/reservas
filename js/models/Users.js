var userModel = {
  setUserInTable: function(){
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
  },
  

}
