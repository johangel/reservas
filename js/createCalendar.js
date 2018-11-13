  var canCreate = false;
  var globalStart;
  var globalEnd;
  var ReservationsByCliente;
  var id_reservation;
  var url_conditional;
  var canEdit = true;
  var canClick = true;
  var businessHoursGlobal = {};


  $(document).ready(function() {
    if(rol == 'Especialista'){
      canEdit = false;
      canClick = false;
      url_conditional = "http://localhost/reservas/models/Reservations/getReservationsBySpecialist.php";
    }else{
      url_conditional = "http://localhost/reservas/models/Reservations/getReservationsByClient.php";
    }


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
            right: 'month,agendaWeek,agendaDay,listMonth'

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
              $('#calendar').fullCalendar('unselect');
              return;
            }
            if(!canCreate){
              toastr.error('escoger una especialista antes de realizar una reserva');
              $('#calendar').fullCalendar('unselect');
              console.log(start)
              return;
            }
            if(start.isBefore(moment().subtract(210, 'minutes'))) {
              console.log(start);
              console.log(moment());
              toastr.error('No pueden ser seleccionadas fechas pasadas');
              $('#calendar').fullCalendar('unselect');
              return false;
            }
            Globalstart = start;
            globalEnd = moment(start).add(30, 'minutes');
            $('#FormEvent').modal('show');
          },

          eventClick: function(calEvent, jsEvent, view) {
            $('#DescriptionEdit').prop("readonly",true);
            $('#DescriptionEdit').val('');
            $('#precioEdit').val('');
            $('#Pacienteid').val(calEvent.client);
            $('#especilisaEdit').val(calEvent.specialist);
            $('#horaInicio').val(moment(calEvent.start).format('LLLL'));
            $('#horaFinal').val(moment(calEvent.end).format('LLLL'));
            id_reservation = calEvent.id;
            $('.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#btn_group').addClass('hidden');
            console.log(self_id);
            $('#DescriptionEdit').val(calEvent.title);
            $('#updpateButtonReservation').removeClass('hidden')

            if(calEvent.id_client == self_id || rol == 'Especialista'){
              $('#btn_group').removeClass('hidden');
              $('#DescriptionEdit').prop("readonly",false);
              $('#precioEdit').val(calEvent.cost);
            }
            if(rol == 'Especialista'){
              $('#DescriptionEdit').prop("readonly",true);
              $('#updpateButtonReservation').addClass('hidden')
            }
          },

          eventDrop: function(event ,delta, revertFunc, jsEvent, ui, view ){

            if(!canCreate){
              toastr.error('escoger una especialista antes de editar las horas de reservaciones');
              revertFunc();
              return;
            }
            if(moment(event.start).isBefore(moment().subtract(210, 'minutes'))) {
              console.log(moment(event.start));
              toastr.error('No pueden ser seleccionadas horas pasadas');
              revertFunc();
              return;
            }
            request ={
              start: moment(event.start).format(),
              end: moment(event.end).format(),
              start_format: moment(event.start).format('LLLL'),
              id: event.id
            };

            reservationModel.updateReservationHours(request);

          },
          eventLimit: true, // allow "more" link when too many events
          events:ReservationsByCliente,
          businessHours: businessHoursGlobal,
          validRange: function(nowDate) {
            return {
              start: moment().subtract(12, 'hours'),
              end: nowDate.clone().add(6, 'months')
            };
          },
           selectConstraint :"businessHours",
           eventConstraint:"businessHours"
          });

      }
    })

});
