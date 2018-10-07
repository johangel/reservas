var userModel = {
  setUserInTable: function(){
    $.ajax({
      type: "GET",
      url : "http://localhost/reservas/models/User/getAllUsers.php",
      datatype:'json',

      success :function(data, status){
        data = JSON.parse(data);
        var table = document.getElementById("userTablesBody");
        var cell1;
        var cell2;
        var row;

        for(var i = 0; i <data.length; i++ ){
          row = table.insertRow(i);
          //var name = data[i].nombre;
          row.className='selectableRow';
          cell1 = row.insertCell(0);
          cell2 = row.insertCell(1);
          cell3 = row.insertCell(2);
          cell4 = row.insertCell(3);


          cell1.innerHTML = data[i].nombre;
          cell2.innerHTML = data[i].rol;
          cell3.innerHTML = data[i].user_id;
          cell4.innerHTML = data[i].correo;

          row = null;
        }

        $("#userTablesBody").on('click','tr',function(e) {
            //console.log($(this)['0'].children[2].innerHTML);
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

  updateUserInformation: function(request){
    $.ajax({
      type: "POST",
      url : "http://localhost/reservas/models/User/updateUserInfo.php",
      data: request,
      success :function(data, status){
        if(data == 1){
          toastr.success('Informacion actualizada con exito');
        }else{
          toastr.error('Ocurrio un problema');
        }
      }
    });
  },

  getInfofromUserId: function(id){
    $.ajax({
      type: "GET",
      url : "http://localhost/reservas/models/User/getUserInfo.php?id="+id,
      success :function(data, status){
        data = JSON.parse(data);
        console.log(data);
        $('#email').val(data['correo']);
        $('#role').val(data['rol']);
        $('#age').val(data['edad']);
        $('#dni').val(data['Dni']);
        $('#birthdate').val(data['fecha_nacimiento']);
        $('#BloodType').val(data['tipo_sangre']);
        if(data['genero'] == 'Hombre'){
          $('input:radio[name="genderRadio"]').filter('[value="Hombre"]').attr('checked', true);
        }else{
          $('input:radio[name="genderRadio"]').filter('[value="Mujer"]').attr('checked', true);
        }

        if(!data['profile_img'] == ''){
          console.log('tiene fotico');
          $('#profilePic').attr('src','../assets/user_images/'+data['profile_img']);
        }else{
          $('#profilePic').attr('src','../assets/user_images/default.jpg');

        }
      }
    });
  },

  updatePhotoUser: function(request){
    $.ajax({
      type:'POST',
      data: request,
      url:'http://localhost/reservas/models/User/updateProfilePhoto.php',
      success:function(data, status){
        toastr.success('La imagen fue cambiada con exito');
      }
    })
  }


}
