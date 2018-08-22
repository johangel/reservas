  var canCreate = false;
  var globalStart;
  var globalEnd;
  var ReservationsByCliente;
  var id_reservation;
  var url_conditional;
  var canEdit = true;
  var canClick = true;


  $(document).ready(function() {
    if(rol == 'Especialista'){
      canEdit = false;
      canClick = false;
      url_conditional = "http://localhost/reservas/controladores/Reservations/getReservationsBySpecialist.php";
    }else{
      url_conditional = "http://localhost/reservas/controladores/Reservations/getReservationsByClient.php";
    }

    console.log(rol);

    $.ajax({
      type: 'GET',
      url: url_conditional,
      success: function(data, staus){
        console.log(JSON.parse(data));
        ReservationsByCliente = JSON.parse(data);
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,week,agendaDay,listMonth'
          },
          defaultDate: moment(),
          weekNumbers: true,
          navLinks: true, // can click day/week names to navigate views
          editable: canEdit,
          selectable: canClick,
          allDayDefault: false,
          selectHelper: true,
          eventOverlap: false,
          defaultTimedEventDuration: '00:30:00',
          forceEventDuration: false,
          eventDurationEditable: false,
          selectOverlap: false,
          select: function(start, end, jsEvent) {
            var duration = moment.duration(end.diff(start));
            var hours = duration.asHours();
            console.log(hours);
            if(hours > 0.5){
              toastr.error('no se pueden crear consultas superiores a media hora');
              return;
            }
            if(!canCreate){
              toastr.error('escoger una especialista antes de realizar una reserva');
              console.log(start)
              return;
            }
            Globalstart = start;
            globalEnd = moment(start).add(30, 'minutes');
            $('#FormEvent').modal('show');
          },
          eventClick: function(calEvent, jsEvent, view) {
            console.log(jsEvent)
            console.log(moment.locale());
            $('#DescriptionEdit').val('');
            $('#precioEdit').val('');
            $('#especilisaEdit').val(calEvent.specialist);
            $('#horaInicio').val(moment(calEvent.start).format('LLLL'));
            $('#horaFinal').val(moment(calEvent.end).format('LLLL'));
            console.log(calEvent);
            id_reservation = calEvent.id;
            $('.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#btn_group').addClass('hidden');
            console.log(self_id);
            if(calEvent.id_client == self_id || rol == 'Especialista'){
              $('#DescriptionEdit').val(calEvent.title);
              $('#btn_group').removeClass('hidden');
              $('#precioEdit').val(calEvent.cost);
            }
          },
          eventDrop: function( event, jsEvent, ui, view ){
            request ={
              start: moment(event.start).format(),
              end: moment(event.end).format(),
              id: event.id
            };
            $.ajax({
              type: 'POST',
              url: 'http://localhost/reservas/controladores/updateReservationHours.php',
              data: request,
              success: function(data, status){
                toastr.success(data);
              }
            })
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
