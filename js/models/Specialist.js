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
          $('#hoursTo').val('');
          $('#hoursFrom').val('');
        }else{
           var specialist = {};
           specialist = JSON.parse(data);
           specialist.days = JSON.parse("[" +specialist.days+"]");
           console.log(specialist);
           $('#optionsContainer').removeClass('hidden');
           $('#CMD').val(specialist['cmd']);
           $('#rol').val('Especialista');
           $('#salary').val(specialist['salary']);
           $('#specializacionField').val(specialist['specialistField']);
           $('#hoursTo').val(specialist.hoursTo);
           $('#hoursFrom').val(specialist.hoursFrom);

           if(specialist['active'] == 1){
             $('#specialistActive')['0'].checked = true;
           }else{
             $('#specialistActive')['0'].checked = false;
           }
           for(var i = 0; i<specialist.days.length; i++){
             $('#day'+specialist.days[i])['0'].checked = true;
           }
        }

        $('#userName').val(name);
        $('.selected').removeClass('selected');
        event.target.parentElement.classList.add('selected');
      }
    });
  },

  updateSpecialistInfo: function(request, rol){
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
          },
          selectConstraint :"businessHours",
          eventConstraint:"businessHours"

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
