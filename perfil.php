<?php include 'subcomponents/header.php'; ?>

<div style="min-height:" class="container p-4">

  <div class="row  p-2 bg-white shadow-sm rounded">
    <h2 class="font-weight-normal"> <span class="font-weight-light">Bienvenido, </span> <?php echo $_SESSION['username']?></h2>
  </div>

  <div class="row mt-3 p-2 bg-white shadow rounded">
    <div class="col-md-6">
      <h3 class="font-weight-light">Informacion de usuario</h3>
      <hr>
      <form id="userInfoForm" class="">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label">Correo</label>
          <div class="col-sm-8">
            <input type="email" class="form-control" id="email" readonly placeholder="correo">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-4 col-form-label">Rol</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="role" readonly placeholder="rol">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Edad</label>
          <div class="col-sm-8">
            <input type="number" class="form-control" id="age" placeholder="edad">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Dni</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="dni" placeholder="Documento identidad">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Fecha de nacimiento</label>
          <div class="col-sm-8">
            <input type="date" class="form-control" id="birthdate" placeholder="">
          </div>
        </div>

        <div class="form-group row">
           <label class="col-sm-4" for="BloodType">Tipo de sangre</label>
           <div class="col-sm-8">
             <select id="BloodType" class="form-control ">
               <option selected disabled>Seleccionar Tipo de Sangre</option>
               <option>A Positivo</option>
               <option>A Negativo</option>
               <option>B Positivo</option>
               <option>B Negativo</option>
               <option>AB Positivo</option>
               <option>AB Negativo</option>
               <option>O Positivo</option>
               <option>O Negativo</option>
             </select>
           </div>
         </div>

        <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-sm-4 pt-0">Genero</legend>
            <div class="col-sm-8">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="genderRadio" id="maleRadio" value="Hombre" checked>
                <label class="form-check-label" for="maleRadio">
                  Hombre
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="genderRadio" id="femaleRadio" value="Mujer">
                <label class="form-check-label" for="femaleRadio">
                  Mujer
                </label>
              </div>
            </div>
          </div>
        </fieldset>


        <div class="form-group row">
          <div class="col-sm-8">
            <button type="submit" onclick="editUserInfo(event)" class="btn btn-primary">Editar informacion</button>
          </div>
        </div>

      </form>
    </div>

    <div class="col-md-6">
      <h3 class="font-weight-light">Reservas del usuario</h3>
      <hr>
      <div class="row">
        <div id="notification_container" class="col-md-12">

        </div>
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">
  var typeUser = <?php echo "'".$_SESSION['rol']."';" ?>
  function editUserInfo(evt){
    evt.preventDefault();
    var email = $('#email').val();
    var age = $('#age').val();
    var dni = $('#dni').val();
    var birthdate = $('#birthdate').val();
    var BloodType = $('#BloodType').val();
    var genero = $('input[name=genderRadio]:checked', '#userInfoForm').val();

    var request ={
      email: email,
      age: age,
      dni: dni,
      birthdate: birthdate,
      BloodType: BloodType,
      genero: genero
    }

    $.ajax({
      type: "POST",
      url : "http://localhost/reservas/controladores/updateUserInfo.php",
      data: request,
      success :function(data, status){
        if(data == 1){
          toastr.success('Informacion actualizada con exito');
        }else{
          toastr.error('Ocurrio un problema');
        }
      }
    });

  }

  function getInfofromUser(){
    $.ajax({
      type: "GET",
      url : "http://localhost/reservas/controladores/getUserInfo.php?id=<?php echo $_SESSION['userId']; ?>",
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
      }
    });
  }

  function getNewReservations(){
    request = {
      type_user : typeUser,
      user_id : <?php echo "'".$_SESSION['userId']."'" ?>
    }
    $.ajax({
      type: 'POST',
      data: request,
      url: 'http://localhost/reservas/controladores/getNewReservations.php',
      success: function(data, status){
        var newNotifications = JSON.parse(data);
        console.log(newNotifications);
        for(var i = 0; i<newNotifications.length; i++){
          $('#notification_container').append('<div class="notifcation_box mb-2"> <h5>'+newNotifications[i].title+'</h5> <small>Especialista: '+newNotifications[i].specialist+'</small> <br> <small>Hora de reserva: '+moment(newNotifications[i].start).format('LLLL')+'</small> <br> <small>Costo de reserva: '+newNotifications[i].cost+'</small> <br> <button type="button" class="notification_button btn-dark btn btn-sm">Borrar notificacion</button> </div>');
        }
      }
    })
  }

  $(document).ready(function() {

    getInfofromUser();
    getNewReservations();
  })
</script>
<?php include 'subcomponents/footer.php'; ?>
