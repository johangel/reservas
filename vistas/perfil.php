<?php include '../subcomponents/header.php'; ?>

<div style="min-height:" class="container p-4">

  <div class="row  p-2 bg-white shadow-sm rounded">
    <h2 class="font-weight-normal"> <span class="font-weight-light">Bienvenido, </span> <?php echo $_SESSION['username']?></h2>
  </div>

  <div class="row mt-3 p-2 bg-white shadow rounded">
    <div class="col-md-6">
      <h3 class="font-weight-light">Informacion de usuario</h3>
      <hr>
      <form id="userInfoForm" class="">

       <div class="row mb-4 justify-content-center">
          <div class="col-md-5">
            <div class="img_container">
              <span class="message_centered">Cambiar foto de perfil</span>
              <img onclick="triggerInputFile()" style="border-radius: 100px;" id="profilePic" alt="..." class="img-thumbnail hoverProfilePhto">
            </div>
            <input class="hidden" onchange="setImageProfile(event)" id="inputProfilePhoto" type="file" name="" value="">
          </div>
        </div>

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
            <input type="number" class="form-control" id="age" placeholder="edad" onkeydown="onlyNumbers(event)" onkeyup="maxValue(80,event)" onchange="maxValue(80,event)">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Dni</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="dni" onkeydown="onlyNumbers(event)" maxlength="8" placeholder="Documento identidad">
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

<script src="../js/controlers/Users.js"></script>
<script src="../js/controlers/reservations.js"></script>
<script src="../js/controlers/messages.js"></script>
<script type="text/javascript">
  var typeUser = <?php echo "'".$_SESSION['rol']."';" ?>
  var user_id =  <?php echo "'".$_SESSION['userId']."';" ?>
  var img_profile = '';
  var img_profile_name = '';

  $(document).ready(function() {

    getInfofromUser();
    getNewReservations();
  })

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
    };
    userModel.updateUserInformation(request);

  }

  function getInfofromUser(){
    var userid = <?php echo $_SESSION['userId'].';'; ?>
    userModel.getInfofromUserId(userid);
  }

  function getNewReservations(){
    request = {
      type_user : typeUser,
      user_id : user_id
    }
    reservationModel.getNewReservationsNotifications(request);
  }

  function deleteNotification(notificationBoxId, notification_id){
    request ={
      id_notification: notification_id,
      user_id: user_id
    };
    reservationModel.deleteReservationNotification(request);
    notificationBoxId.remove();
  }

  function triggerInputFile(){
    $('#inputProfilePhoto').trigger('click');
  }

  function setImageProfile(event){
    var file = document.getElementById('inputProfilePhoto');
    img_profile_name = file.files[0].name;
    extension = img_profile_name.split('.').pop();
    console.log(extension);
    if(extension != 'jpg' && extension != 'png'){
      toastr.error('subir archivos formato png o jpg');
      return false
    };

    var e = event;
    var filereader = new FileReader();
    filereader.readAsDataURL(file.files[0]);
    filereader.onload = (e) => {
      $('#profilePic').attr("src", e.target.result);
      img_profile =  e.target.result;
      updatePhotoUser();
    }
  }

  function updatePhotoUser(){
    request ={
      img: img_profile,
      id_user: <?php echo "'".$_SESSION['userId']."',"; ?>
      img_name: img_profile_name
    }
    userModel.updatePhotoUser(request);
  }

</script>
<?php include '../subcomponents/footer.php'; ?>
