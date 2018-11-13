var reservationModel = {
  createReservation: function(eventData){
    $.ajax({
      type:'POST',
      url:"http://localhost/reservas/models/Reservations/saveReservation.php",
      data: eventData,
      success: function(data, status){

        if(data == 'badHour'){
          toastr.error('ya tienes esta hora en otra reserva');
          return;
        }

        $('#calendar').fullCalendar('renderEvent', eventData); // stick? = true
        location.reload();
      }
    })
  },

  deleteReservation: function(request){
    $.ajax({
      type: "POST",
      url : "http://localhost/reservas/models/Reservations/deleteReservation.php",
      data:  request,
      success: function(response, status){
        console.log(response)
        $('#calendar').fullCalendar('removeEvents',id_reservation);
        id_reservation = 0;
        $('#btn_group').addClass('hidden');
        $('#DescriptionEdit').val('');
        $('#especilisaEdit').val('');
        $('#horaInicio').val('');
        $('#horaFinal').val('');
        $('#precioEdit').val('');
        toastr.success('reserva eliminada con exito');
      }
    })
  },

  updateReservation: function(request){
    $.ajax({
      type: "POST",
      data : request,
      url : "http://localhost/reservas/models/Reservations/updateReservation.php",
      success: function(response, status){
        toastr.success('se edito la reserva con exito');

      }
    })
  },

  getNewReservationsNotifications: function(request){
    $.ajax({
      type: 'POST',
      data: request,
      url: 'http://localhost/reservas/models/Reservations/getNewReservations.php',
      success: function(data, status){
        var newNotifications = JSON.parse(data);
        console.log(newNotifications);
        for(var i = 0; i<newNotifications.length; i++){
          $('#notification_container').append('<div id="notification' + i +'" class="notifcation_box mb-2"> <h5>'+newNotifications[i].title+'</h5> <small>Especialista: '+newNotifications[i].specialist+'</small> <br> <small>Cliente: '+newNotifications[i].client+'</small> <br> <small>Hora de reserva: '+moment(newNotifications[i].start).format('LLLL')+'</small> <br> <small>Costo de reserva: '+newNotifications[i].cost+'</small> <br> <button type="button" onclick="deleteNotification(notification'+i+', ' + newNotifications[i].id_notification +')" class="notification_button btn-dark btn btn-sm">Borrar notificacion</button> </div>');
        }
      }
    })
  },

  deleteReservationNotification: function(request){
    $.ajax({
      type: 'POST',
      data: request,
      url: 'http://localhost/reservas/models/User/deleteNotification.php',
      success: function(data, status){
        console.log(data);
        toastr.success('notificacion eliminada');
      }
    })
  },

  updateReservationHours: function(request){
    $.ajax({
      type: 'POST',
      url: 'http://localhost/reservas/models/Reservations/updateReservationHours.php',
      data: request,
      success: function(data, status){
        toastr.success(data);
      }
    })
  },

  getReservationByClient: function(request){
    var returnReservations = [];
    $.ajax({
      type: 'GET',
      async: false,
      data: request,
      url: 'http://localhost/reservas/models/reservations/getReservationsByClientId.php',
      success: function(data, status){
        returnReservations = JSON.parse(data);
      }
    });
    return returnReservations;
  },

  getReservationsBySpecialist: function(request){
    var returnReservations = [];
    $.ajax({
      type: 'GET',
      async: false,
      data: request,
      url: 'http://localhost/reservas/models/reservations/getReservationsBySpecialistId.php',
      success: function(data, status){
        returnReservations = JSON.parse(data);
      }
    });
    return returnReservations;
  },

  getReservationsByField: function(request){
    var returnReservations = [];
    $.ajax({
      type: 'GET',
      async: false,
      data: request,
      url: 'http://localhost/reservas/models/reservations/getReservationsByFieldName.php',
      success: function(data, status){
        returnReservations = JSON.parse(data);
      }
    });
    return returnReservations;
  }
}
