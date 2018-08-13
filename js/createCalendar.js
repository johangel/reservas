  var canCreate = false;
  var globalStart;
  var globalEnd;
  $(document).ready(function() {
  $('#calendar').fullCalendar({
    // themeSystem: 'bootstrap4',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listMonth'
    },
    defaultDate: '2018-03-12',
    weekNumbers: true,
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    selectable: true,
    selectHelper: true,
    select: function(start, end) {
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
      // console.log(calEvent.start._d.getDate);
      // console.log(calEvent.end);
      console.log(moment.locale());
      $('#DescriptionEdit').val(calEvent.title);
      $('#especilisaEdit').val(calEvent.specialist);
      $('#horaInicio').val(calEvent.start);
      $('#horaFinal').val(calEvent.end);
      $('#precioEdit').val(calEvent.Cost);
      $(this).css('border-color', 'green');
    },
    eventLimit: true, // allow "more" link when too many events
    events: [
      // {
      //   title: 'Long Event',
      //   start: '2018-03-07',
      //   end: '2018-03-10'
      // },
      // {
      //   id: 999,
      //   title: 'Repeating Event',
      //   start: '2018-03-09T16:00:00'
      // },
      // {
      //   id: 3,
      //   title: 'Repeating Event',
      //   start: '2018-03-16T16:00:00'
      // },
      // {
      //   title: 'Conference',
      //   start: '2018-03-11',
      //   end: '2018-03-13'
      // },
      // {
      //   title: 'Meeting',
      //   start: '2018-03-12T10:30:00',
      //   end: '2018-03-12T12:30:00'
      // },
      // {
      //   title: 'Lunch',
      //   start: '2018-03-12T12:00:00'
      // },
      // {
      //   title: 'Meeting',
      //   start: '2018-03-12T14:30:00'
      // },
      // {
      //   title: 'Happy Hour',
      //   start: '2018-03-12T17:30:00'
      // },
      // {
      //   id: '1',
      //   title: 'Dinner',
      //   start: '2018-03-12T20:00:00'
      // },
      // {
      //   title: 'Birthday Party',
      //   start: '2018-03-13T07:00:00'
      // },
      // {
      //   title: 'Click for Google',
      //   url: 'http://google.com/',
      //   start: '2018-03-28'
      // }
      ]
    });
});
