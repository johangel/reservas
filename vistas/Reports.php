<?php include '../subcomponents/header.php'; ?>

<div style="min-height: 95%" class="container p-4">
  <div class="row p-2 bg-white shadow-sm rounded">
    <h2 class="font-weight-light">Reportes de reservas</h2>
  </div>
  <div class="row mt-3 bg-white shadow-sm rounded p-4">
    <div class="col-md-12 ">
      <div class="row align-items-center">
        <div class="col-md-3">
          <label for="">Filtrado:</label>
          <select onchange="filter(value)" class="form-control" id="filterValue">
            <option>Filtrar por especializacion</option>
            <option>Filtrar por especialista</option>
            <option value="Filtrar por año">Filtrar por fechas</option>
          </select>
        </div>

        <div class="col-md-3 mainMenu">
          <label for="">Desde:</label>
          <input id="fromDate" type="date" name="" class="form-control" value="">
        </div>

        <div class="col-md-3 mainMenu">
          <label for="">Hasta:</label>
          <input id="toDate" type="date" name="" class="form-control" value="">
        </div>

        <div class="col-md-3 mainMenu">
          <button type="button" name="button" class="btn btn-sm btn-info mt-4" onclick="filterByDate()">filtrar</button>
        </div>

      </div>
    </div>

    <div class="col-md-12 p-2 pt-2">
        <canvas id="myChart"></canvas>
        <button type="button" class="btn btn-sm btn-info m-auto" onclick="downloadPDF('myChart', 'Grafica')">Descargar PDF</button>

    </div>


    <div class="modal fade bd-example-modal-lg" id="yearStatisticsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Estadisticas del año <span id="yearSelectedLable">año</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">


            <div class="row">
              <div class="form-group  col-md-12">
                <label for="">Tipo de filtrado</label>
                <select onchange="SetFilterValue(value)" class="form-control" id="MainFilter">
                  <option selected disabled>Seleccionar un tipo de filtrado</option>
                  <option>Filtrar por Especializacion</option>
                  <option>Filtrar por Paciente</option>
                  <option>Filtrar por Especialista</option>
                </select>
              </div>

              <div class="form-group  col-md-12">
                <label for="">Subfiltro</label>
                <select class="form-control" id="subFilterSelect">
                </select>
              </div>

              <div class="col-md-12 p-2">
                <canvas id="dayChart"></canvas>
                <button type="button" class="btn btn-sm btn-info m-auto" onclick="downloadPDF('dayChart', 'Grafica del dia')">Descargar PDF</button>
              </div>

              <div class="col-md-12 p-2">
                <canvas id="monthChart"></canvas>
                <button type="button" class="btn btn-sm btn-info m-auto" onclick="downloadPDF('monthChart', 'Grafica del mes')">Descargar PDF</button>

              </div>

              <div class="col-md-12 p-2">
                <canvas id="hoursChart"></canvas>
                <button type="button" class="btn btn-sm btn-info m-auto" onclick="downloadPDF('hoursChart', 'Grafica de horas')">Descargar PDF</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>


</div>

<script src="../js/chart.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/controlers/specialistFields.js"></script>
<script type="text/javascript" src="../js/controlers/Reports.js"></script>
<script type="text/javascript" src="../js/controlers/Specialist.js"></script>
<script type="text/javascript" src="../js/controlers/Users.js"></script>
<script type="text/javascript" src="../js/controlers/reservations.js"></script>
<script type="text/javascript">
  var specialistField = [];
  var dataReport = [];
  var nombreEtiqueta = [];
  var contador = 0;
  var data;
  var chart;
  var SepcialistsNames;
  var yearSelected;

  $(document).ready( function () {
    specialistField = FieldsModel.setFields();
    SepcialistsNames = Specialists.getAllSpecialists();
    data = Reports.getReservationsWithSpecialists();
    chartByField();
  });

  function chartBySpecialist(){
    $('.mainMenu').removeClass('d-none');

    // asignando nombre de especialidades a array
    for(var i= 0; i<SepcialistsNames.length;i++){
      nombreEtiqueta.push(SepcialistsNames[i].nombre);
    }

    for(var i =0; i<nombreEtiqueta.length; i++){
      contador = 0;
      for(var j = 0; j<data.length; j++){
        if(data[j].specialist == nombreEtiqueta[i]){
          contador = contador + 1;
          console.log(nombreEtiqueta[i])
        }
        dataReport[i] = contador;
      }
    }

    var ctx = document.getElementById('myChart').getContext('2d');

    chart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'bar',

      // The data for our dataset
      data: {
        labels: nombreEtiqueta,
        datasets: [{
          label: "Cantidad de reservaciones por especialista",
          backgroundColor: 'rgba(81,173,243,0.2)',
          borderColor: 'rgba(81,173,243)',
          borderWidth: 1,
          data: dataReport,
        }],
        options: {
          scales: {
            yAxes: [{
              ticks: {
                min: 0,
              }
            }]
          },
          legend: {
            display: true,
          }
        }
      },

      // Configuration options go here
      options: {}
    });

    $('#myChart').unbind( "click" );

  }

  function chartByField(){
    $('.mainMenu').removeClass('d-none');

    console.log(data)
    // asignando nombre de especialidades a array
    for(var i= 0; i<specialistField.length;i++){
      nombreEtiqueta.push(specialistField[i].Name);
    }

    //sacando data para cada cabecera
    for(var i =0; i<nombreEtiqueta.length; i++){
      contador = 0;
      for(var j = 0; j<data.length; j++){
        if(data[j].specialistField == nombreEtiqueta[i]){
          contador = contador + 1;
          console.log(nombreEtiqueta[i])
        }
        dataReport[i] = contador;
      }
    }

    var ctx = document.getElementById('myChart').getContext('2d');

    chart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'bar',

      // The data for our dataset
      data: {
        labels: nombreEtiqueta,
        datasets: [{
          label: "Cantidad de reservaciones por especializacion",
          backgroundColor: 'rgba(81,173,243,0.2)',
          borderColor: 'rgba(81,173,243)',
          borderWidth: 1,
          data: dataReport,
        }],
        options: {
          scales: {
            yAxes: [{
              ticks: {
                min: 0,
              }
            }]
          },
          legend: {
            display: true,
          }
        }
      },

      // Configuration options go here
      options: {}
    });

    $('#myChart').unbind( "click" );

  }

  function chartByDate(reservationsArray){
    dataReport = [];
    allHeads = [];
    $('.mainMenu').addClass('d-none');
    nombreEtiqueta = ['2017', '2018', '2019', '2020'];

    for(year in nombreEtiqueta){
      contador = 0;
      for(reservation in reservationsArray){
        if(nombreEtiqueta[year] == moment(reservationsArray[reservation]['start']).year()){
          contador++;
        }
        dataReport[year] = contador;
      }
    }

    var ctx = document.getElementById('myChart').getContext('2d');

    chart = new Chart(ctx, {
      type: 'line',

      // The data for our dataset
      data: {
        labels: nombreEtiqueta,
        datasets: [{
          label: "Cantidad de reservaciones por año",
          backgroundColor: 'rgba(81,173,243,0.2)',
          borderColor: 'rgba(81,173,243)',
          borderWidth: 1,
          data: dataReport,
        }],
        options: {
          scales: {
            yAxes: [{
              ticks: {
                min: 0,
              }
            }]
          },
          legend: {
            display: true,
          }
        }
      },

      // Configuration options go here
      options: {}
    });

    $('#myChart').click(function(evt){

      index = chart.getElementAtEvent(evt)[0]['_index'];

      if(index != null){

        request = {
          'year': nombreEtiqueta[index]
        }

        yearSelected = nombreEtiqueta[index];

        reservationsByYears = Reports.getReservationsByYear(request);
        $('#yearSelectedLable').html(yearSelected);
        ChartByDay(reservationsByYears);
        chartByMonth(reservationsByYears);
        chartByHours(reservationsByYears);
        $("#MainFilter").val("Seleccionar un tipo de filtrado").change();
        $('#subFilterSelect').unbind( "change" );
        $('#subFilterSelect').html('');
        setTimeout(() => {
          $('#yearStatisticsModal').modal('show');
        }, 500);
      }

    })

  }

  function ChartByDay(reservationsArray){

    nombreEtiquetaDias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];
    dataDays = [];

    for(day in nombreEtiquetaDias){
      contador = 0;
      for(reservation in reservationsArray){
        if(nombreEtiquetaDias[day] == moment(reservationsArray[reservation]['start']).format('dddd')){
          contador++;
        }
        dataDays[day] = contador;
      }
    }

    var ctx = document.getElementById('dayChart').getContext('2d');

    chartday = new Chart(ctx, {
      // The type of chart we want to create
      type: 'line',

      // The data for our dataset
      data: {
        labels: nombreEtiquetaDias,
        datasets: [{
          label: "Cantidad de reservaciones por dia",
          backgroundColor: 'rgba(221,53,2,0.2)',
          borderColor: 'rgba(221,53,2)',
          borderWidth: 1,
          data: dataDays,
        }],
        options: {
          scales: {
            yAxes: [{
              ticks: {
                min: 0,
              }
            }]
          },
          legend: {
            display: true,
          }
        }
      },

      // Configuration options go here
      options: {}
    });

  }

  function chartByMonth(reservationsArray){
    nombreEtiquetaMes = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    datamonth = []
    for(mes in nombreEtiquetaMes){
      contador = 0;
      for(reservation in reservationsArray){
        if(nombreEtiquetaMes[mes] == moment(reservationsArray[reservation]['start']).format('MMMM')){
          contador++;
        }
        datamonth[mes] = contador;
      }
    }

    var ctx = document.getElementById('monthChart').getContext('2d');

    chartmonth = new Chart(ctx, {
      // The type of chart we want to create
      type: 'line',

      // The data for our dataset
      data: {
        labels: nombreEtiquetaMes,
        datasets: [{
          label: "Cantidad de reservaciones por mes",
          backgroundColor: 'rgba(21,223,2,0.2)',
          borderColor: 'rgba(21,223,2)',
          borderWidth: 1,
          data: datamonth,
        }],
        options: {
          scales: {
            yAxes: [{
              ticks: {
                min: 0,
              }
            }]
          },
          legend: {
            display: true,
          }
        }
      },

      // Configuration options go here
      options: {}
    });

  }

  function chartByHours(reservationsArray){

    nombreEtiquetaHora = ['8 - 10 ', '10 - 12', '12 - 14', '14 - 16', '16 - 18', '18 - 20', '20 - 22'];
    dataHours = [0,0,0,0,0,0,0];
    contador = 0;

    for(reservation in reservationsArray){
      hour = parseInt(moment(reservationsArray[reservation]['start']).format('H'));

      if(hour >= 8 && hour < 10){
        dataHours[0]++;
        }else if(hour >= 10 && hour < 12){
          dataHours[1]++;
        }else if(hour >= 12 && hour < 14){
          dataHours[2]++;
        }else if(hour >= 14 && hour < 16){
          dataHours[3]++;
        }else if(hour >= 16 && hour < 18){
          dataHours[4]++;
        }else if(hour >= 18 && hour < 20){
          dataHours[5]++;
        }else if(hour >= 20 && hour <= 12){
          dataHours[6]++;
        }

    }

    var ctx = document.getElementById('hoursChart').getContext('2d');

    charthours = new Chart(ctx, {
      // The type of chart we want to create
      type: 'line',

      // The data for our dataset
      data: {
        labels: nombreEtiquetaHora,
        datasets: [{
          label: "Cantidad de reservaciones por hora",
          backgroundColor: 'rgba(21,223,220,0.2)',
          borderColor: 'rgba(21,223,220)',
          borderWidth: 1,
          data: dataHours,
        }],
        options: {
          scales: {
            yAxes: [{
              ticks: {
                min: 0,
              }
            }]
          },
          legend: {
            display: true,
          }
        }
      },

      // Configuration options go here
      options: {}
    });

  }

  function filter(value){
    chart.destroy();
    nombreEtiqueta = [];
    contador = 0;
    if(value == 'Filtrar por especializacion'){
      chartByField();
    }else if(value == 'Filtrar por especialista'){
      chartBySpecialist();
    }else if(value == 'Filtrar por año'){
      reports = Reports.getAllReservations();
      chartByDate(reports);
    }
  }

  function SetFilterValue(value){
    $('#fromDate').val();
    $('#toDate').val('');
    if(value == "Filtrar por Especialista"){

      allSpecialists = Specialists.getAllSpecialists();
      htmlSpecialist = '<option selected disabled>Selecciona un especialista</option>';
      for(var i = 0; i<allSpecialists.length;i++){
        htmlSpecialist += '<option value=' + allSpecialists[i]['user_id'] +' >'+allSpecialists[i]['nombre']+'</option>'
      }
      $('#subFilterSelect').unbind( "change" );
      $('#subFilterSelect').on('change', (event) =>{
        filterReservationsBySpecialist(event.target.value);
      });
      $('#subFilterSelect').html('');
      $('#subFilterSelect').html(htmlSpecialist);

    }else if(value == "Filtrar por Paciente"){

      allPacients = userModel.getAllPacients();
      htmlPacients = '<option selected disabled>Selecciona un paciente</option>';
      for(var i = 0; i<allPacients.length;i++){
        htmlPacients += '<option value=' + allPacients[i]['user_id'] +' >'+allPacients[i]['nombre']+'</option>'
      }
      $('#subFilterSelect').unbind( "change" );
      $('#subFilterSelect').html('');
      $('#subFilterSelect').on('change', (event) =>{
        filterReservationsByPacients(event.target.value);
      });
      $('#subFilterSelect').html(htmlPacients);

    }

    else if(value == "Filtrar por Especializacion"){
      console.log(specialistField)
      htmlspecialistFields = '<option selected disabled>Selecciona una especializacion</option>';
      for(var i = 0; i<specialistField.length;i++){
        htmlspecialistFields += '<option value=' + specialistField[i]['Name'] +' >'+specialistField[i]['Name']+'</option>'
      }
      $('#subFilterSelect').unbind( "change" );
      $('#subFilterSelect').on('change', (event) =>{
        filterReservationsBySpecialistField(event.target.value);
      });
      $('#subFilterSelect').html('');
      $('#subFilterSelect').html(htmlspecialistFields);

    }
  }

  function filterReservationsByPacients(value){
    request = {
      id_pacient: value
    };
    reservationsByClientArray = reservationModel.getReservationByClient(request);
    reservationsByClientArray = filterRerservationsByYear(reservationsByClientArray, yearSelected);
    ChartByDay(reservationsByClientArray);
    chartByMonth(reservationsByClientArray);
    chartByHours(reservationsByClientArray);
  }

  function filterReservationsBySpecialist(value){
    request = {
      id_specialist: value
    };
    getReservationsBySpecialist = reservationModel.getReservationsBySpecialist(request);
    getReservationsBySpecialist = filterRerservationsByYear(getReservationsBySpecialist, yearSelected);
    ChartByDay(getReservationsBySpecialist);
    chartByMonth(getReservationsBySpecialist);
    chartByHours(getReservationsBySpecialist);
  }

  function filterReservationsBySpecialistField(value){
    request = {
      field: value
    };
    ReservationByField = reservationModel.getReservationsByField(request);
    ReservationByField = filterRerservationsByYear(ReservationByField, yearSelected);
    ChartByDay(ReservationByField);
    chartByMonth(ReservationByField);
    chartByHours(ReservationByField);
  }

  function filterRerservationsByYear(reservations, year){
    finalArray = []
    for(var i = 0; i<reservations.length; i++){
      if(moment(reservations[i]['start']).format('YYYY') == year){
        console.log(reservations[i]);
        finalArray.push(reservations[i]);
      }
    }
    return finalArray;
  }

  function downloadPDF(idElement, text) {
    var canvas = document.querySelector('#' + idElement);
  	//creates image
  	var canvasImg = canvas.toDataURL("image/jpeg", 1.0);

  	//creates PDF from img
  	var doc = new jsPDF('landscape');
  	doc.setFontSize(20);
  	doc.text(15, 15, text);
  	doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150 );
  	doc.save(text+'.pdf');
  }

  function filterByDate(){
    chart.destroy();

    var fromDate = $('#fromDate').val();
    var toDate = $('#toDate').val();
    dataFiltrated = []
    nombreEtiqueta = []
    var typeOfChart = $('#filterValue').val();

    for(var i = 0; i<data.length; i++){
      if(moment(data[i].start).isBetween(moment(fromDate), moment(toDate))){
        dataFiltrated.push(data[i]);
      }
    }

    console.log(dataFiltrated);
    dataReport = [];
    if(typeOfChart == 'Filtrar por especializacion'){

      for(var i= 0; i<specialistField.length;i++){
        nombreEtiqueta.push(specialistField[i].Name);
      }

      //sacando data para cada cabecera
      for(var i =0; i<nombreEtiqueta.length; i++){
        contador = 0;
        for(var j = 0; j<dataFiltrated.length; j++){
          if(dataFiltrated[j].specialistField == nombreEtiqueta[i]){
            contador = contador + 1;
            console.log(nombreEtiqueta[i])
          }
          dataReport[i] = contador;
        }
      }

      var ctx = document.getElementById('myChart').getContext('2d');

      chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
          labels: nombreEtiqueta,
          datasets: [{
            label: "Cantidad de reservaciones por especializacion",
            backgroundColor: 'rgba(81,173,243,0.2)',
            borderColor: 'rgba(81,173,243)',
            borderWidth: 1,
            data: dataReport,
          }],
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  min: 0,
                }
              }]
            },
            legend: {
              display: true,
            }
          }
        },

        // Configuration options go here
        options: {}
      });

      $('#myChart').unbind( "click" );

    }else{

      for(var i= 0; i<SepcialistsNames.length;i++){
        nombreEtiqueta.push(SepcialistsNames[i].nombre);
      }

      for(var i =0; i<nombreEtiqueta.length; i++){
        contador = 0;
        for(var j = 0; j<dataFiltrated.length; j++){
          if(dataFiltrated[j].specialist == nombreEtiqueta[i]){
            contador = contador + 1;
            console.log(nombreEtiqueta[i])
          }
          dataReport[i] = contador;
        }
      }

      var ctx = document.getElementById('myChart').getContext('2d');

      chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
          labels: nombreEtiqueta,
          datasets: [{
            label: "Cantidad de reservaciones por especialista",
            backgroundColor: 'rgba(81,173,243,0.2)',
            borderColor: 'rgba(81,173,243)',
            borderWidth: 1,
            data: dataReport,
          }],
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  min: 0,
                }
              }]
            },
            legend: {
              display: true,
            }
          }
        },

        // Configuration options go here
        options: {}
      });

      $('#myChart').unbind( "click" );

    }

  }
</script>

<?php include '../subcomponents/footer.php'; ?>
