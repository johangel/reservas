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

}
