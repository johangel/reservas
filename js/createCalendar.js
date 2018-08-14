  var canCreate = false;
  var globalStart;
  var globalEnd;
  var ReservationsByCliente;
  var id_reservation;

  $(document).ready(function() {
    $.ajax({
      type: 'GET',
      url : "http://localhost/reservas/controladores/getReservationsByClient.php",
      success: function(data, staus){
        ReservationsByCliente = JSON.parse(data);

        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,week,agendaDay,listMonth'
          },
          defaultDate: '2018-03-12',
          weekNumbers: true,
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          selectable: true,
          allDayDefault: false,
          selectHelper: true,
          defaultTimedEventDuration: '00:30:00',
          forceEventDuration: true,
          eventDurationEditable: false,
          selectOverlap: false,
          select: function(start) {
            if(!canCreate){
              toastr.error('escoger una especialista antes de realizar una reserva');
              return;
            }
            Globalstart = start;
            globalEnd = end;
            $('#FormEvent').modal('show');
            //   $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            // }
            // $('#calendar').fullCalendar('unselect');
          },
          eventClick: function(calEvent, jsEvent, view) {
            console.log(moment.locale());
            $('#DescriptionEdit').val(calEvent.title);
            $('#especilisaEdit').val(calEvent.specialist);
            $('#horaInicio').val(moment(calEvent.start).format('LLLL'));
            $('#horaFinal').val(moment(calEvent.end).format('LLLL'));
            $('#precioEdit').val(calEvent.Cost);
            console.log(calEvent);
            id_reservation = calEvent.id;
            $(this).css('border-color', 'green');
            $('#btn_group').removeClass('hidden');
          },
          eventLimit: true, // allow "more" link when too many events
          events:ReservationsByCliente,
          businessHours: {
            dow: [ 1, 2, 3, 4, 5, 6],
            start: '8:00',
            end: '17:00'
          },
          validRange: function(nowDate) {
            return {
              // start: yesterdayDate,
              end: nowDate.clone().add(1, 'months')
            };
          },
          selectConstraint :"businessHours"
          });

      }
    })

});
