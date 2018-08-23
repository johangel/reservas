var Specialists = {
  getAllSpecialists: function(){
    $.ajax({
      type: 'GET',
      async: false,
      url : "http://localhost/reservas/controladores/Specialists/getAllSpecialists.php",
      success: function(data, status){
        data =JSON.parse(data);
        allSpecialists = data;
      }
    })
    return allSpecialists;
  }
}
