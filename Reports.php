<?php include 'subcomponents/header.php'; ?>

<div style="min-height: 95%" class="container p-4">
  <div class="row p-2 bg-white shadow-sm rounded">
    <h2 class="font-weight-light">Reportes de reservas</h2>
  </div>
  <div class="row mt-3 bg-white shadow-sm rounded p-4">
    <div class="col-md-12 ">
      <div class="row align-items-center">
        <div class="col-md-3">
          <select onchange="filter(value)" class="form-control" id="">
            <option selected disabled>Selecciona algo</option>
            <option>Filtrar por especializacion</option>
            <option>Filtrar por especialista</option>
          </select>
        </div>

      </div>
    </div>

    <div class="col-md-12 p-4 pt-2">
      <canvas id="myChart"></canvas>
    </div>

  </div>
</div>

<script src="js/chart.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/models/specialistFields.js"></script>
<script type="text/javascript" src="js/models/Reports.js"></script>
<script type="text/javascript" src="js/models/Specialist.js">

</script>
<script type="text/javascript">
  var specialistField = [];
  var dataReport = [];
  var nombreEtiqueta = [];
  var contador = 0;
  var data;
  var chart;
  var SepcialistsNames;

  $(document).ready( function () {
    specialistField = FieldsModel.setFields();
    SepcialistsNames = Specialists.getAllSpecialists();
    data = Reports.getReservationsWithSpecialists();
    chartByField();
  });

  function chartBySpecialist(){
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

  }

  function chartByField(){
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
  }

  function filter(value){
    chart.destroy();
    nombreEtiqueta = [];
    contador = 0;
    console.log(value);
    if(value == 'Filtrar por especializacion'){
      chartByField();
    }else if(value == 'Filtrar por especialista'){
      chartBySpecialist();
    }
  }
</script>

<?php include 'subcomponents/footer.php'; ?>
