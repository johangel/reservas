var Reports = {

  getReservationsWithSpecialists: function(){
    var returnReservations = [];
    $.ajax({
      type: 'GET',
      async: false,
      url: 'http://localhost/reservas/models/reportsGenerator.php',
      success: function(data, status){
        returnReservations = JSON.parse(data);
      }
    });
    return returnReservations;
  },

  getAllReservations: function(){
    var returnReservations = [];
    $.ajax({
      type: 'GET',
      async: false,
      url: 'http://localhost/reservas/models/reservations/getAllReservations.php',
      success: function(data, status){
        returnReservations = JSON.parse(data);
      }
    });
    return returnReservations;
  },

  getReservationsByYear: function(request){
    var returnReservations = [];
    $.ajax({
      type: 'GET',
      async: false,
      data: request,
      url: 'http://localhost/reservas/models/reservations/getReservationsByYear.php',
      success: function(data, status){
        returnReservations = JSON.parse(data);
        console.log(returnReservations);
      }
    });
    return returnReservations;
  }



}
