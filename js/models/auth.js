var authModel = {

  login: function(request){
    $.ajax({
      statusCode: {
        500: function() {
          toastr.error('Credenciales del usuario no coinciden');
        }
      },
      type: "POST",
      url : "http://localhost/reservas/controladores/Auth/auth.php",
      data: request,
      success :function(data, status){
        console.log(data);
        if(data == 'true'){
          window.location.href = "http://localhost/reservas/index.php";
        }else{
          toastr.error('Error de credenciales');
        }

      }
    });
  },

  register: function(request){
    $.ajax({
      type: "POST",
      url : "http://localhost/reservas/controladores/Auth/register.php",
      data: request,
      success :function(data, status){
        console.log(data);
        if(data == '1'){
          window.location.href = "http://localhost/reservas/login.php";
        }else{
        }

      }
    });
  }
}
