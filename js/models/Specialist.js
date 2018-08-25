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
  },

  selectSpecialist: function(event, name, id){
    $.ajax({
      type:'GET',
      url : "http://localhost/reservas/controladores/Specialists/getSpecialistInfo?id="+id,
      success: function(data, status){
        if(data == 'false'){
          $('#optionsContainer').addClass('hidden');
          $('#rol').val('Usuario');
          $('#CMD').val('');
          $('#salary').val('');
          $('#specializacionField').val('');
          $('#specialistActive')['0'].checked = false;

        }else{
          var specialist = {}
           specialist = JSON.parse(data);
           $('#optionsContainer').removeClass('hidden');
           $('#CMD').val(specialist['cmd']);
           $('#rol').val('Especialista');
           $('#salary').val(specialist['salary']);
           $('#specializacionField').val(specialist['specialistField']);
           if(specialist['active'] == 1){
             $('#specialistActive')['0'].checked = true;
           }else{
             $('#specialistActive')['0'].checked = false;
           }
        }

        $('#userName').val(name);
        $('.selected').removeClass('selected');
        event.target.parentElement.classList.add('selected');
      }
    });
  },

  updateSpecialistInfo: function(request){
    $.ajax({
      type: "POST",
      url : "http://localhost/reservas/controladores/Specialists/updateSpecialistInfo.php",
      data: request,
      success :function(data, status){
        toastr.success(data);
        row_table.innerHTML = rol;
      }
    });
  },

  setDoctorForReservation: function(doctor_user_id){
    $.ajax({
      type: 'GET',
      url : "http://localhost/reservas/controladores/Specialists/getSpecialistsReservations?id_specialist="+doctor_user_id,
      success: function(response, status){

        response = JSON.parse(response);
        if(response.reservas == null){
          specialist_reservations = [];
        }else{
          specialist_reservations = response.reservas;
        }

        $('#calendar').fullCalendar('option', {
          businessHours:{
            dow: JSON.parse("[" +response.specilist_info.days +"]"),
            start: response.specilist_info.hoursFrom,
            end: response.specilist_info.hoursTo
          }
        })

        for(var i = 0; i<specialist_reservations.length; i++){
          if(specialist_reservations[i].id_client == self_id){
            specialist_reservations[i]['editable'] = true;
          }else {
            specialist_reservations[i]['editable'] = false;
          }
        }
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('renderEvents', specialist_reservations, true);
      }

    })
  }

}
