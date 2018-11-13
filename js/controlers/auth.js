var authModel = {

  login: function(request){


    $.ajax({
      statusCode: {
        500: function() {
          toastr.error('Credenciales del usuario no coinciden');
        }
      },
      type: "POST",
      url : "http://localhost/reservas/models/Auth/auth.php",
      data: request,
      success :function(data, status){
        if(data == 'true'){
          window.location.href = "http://localhost/reservas/index.php";
        }else if(data == 'noVal'){
         toastr.error('su cuenta no ha sido verificada desde su correo electronico');
        }else{
          toastr.error('Error de credenciales');
        }
      }
    });
  },

  register: function(request){
   $('#loader').removeClass('hidden');
    $.ajax({
      type: "POST",
      url : "http://localhost/reservas/models/Auth/register.php",
      data: request,
      success :function(data, status){
        if(data == 'correoTomado'){
          toastr.error('Este correo ya ha sido tomado por otro usuario');
          $('#loader').addClass('hidden');
          return;
        }

        $('#loader').addClass('hidden');
        toastr.success('se ha enviado un link de verificacion a su correo electronico');
        setTimeout(function(){
          window.location.href = "http://localhost/reservas/vistas/login.php";
        }, 2000);
      }
    });
  }
}
