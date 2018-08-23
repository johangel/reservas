var Reports = {

  getReservationsWithSpecialists: function(){
    var returnReservations = [];
    $.ajax({
      type: 'GET',
      async: false,
      url: 'http://localhost/reservas/controladores/reportsGenerator.php',
      success: function(data, status){
        returnReservations = JSON.parse(data);
      }
    });
    return returnReservations;
  },
  
}
