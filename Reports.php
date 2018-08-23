<?php include 'subcomponents/header.php'; ?>

<div style="min-height: 95%" class="container p-4">
  <div class="row p-2 bg-white shadow-sm rounded">
    <h2 class="font-weight-light">Reportes de reservas</h2>
  </div>
  <div class="row mt-3 bg-white shadow-sm rounded p-4">
    <div class="col-md-12 ">
      <div class="row align-items-center">
        <div class="col-md-3">
          <select class="form-control" id="">
            <option selected disabled>Selecciona algo</option>
            <option value"Neurologia">Filtrar por especialazacion</option>
            <option value"Traumatologia">Filtrar por especialista</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-sm btn-primary" name="button">Ordernar informacion</button>
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

<script type="text/javascript">
  var specialistField = [];

  $(document).ready( function () {
    specialistField = FieldsModel.setFields();
    LoadChart();
  });

  function LoadChart(){
    request ={
      type: 'something'
    };
    $.ajax({
      type: 'GET',
      data: request,
      url: 'http://localhost/reservas/controladores/reportsGenerator.php',
      success: function(data, status){
        var data = JSON.parse(data);
        var dataReport = [];
        var nombreEtiqueta = [];
        var dataSet = [];
        var contador = 0;

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

        // console.log(dataReport);
        //
        // console.log(nombreEtiqueta);

        var ctx = document.getElementById('myChart').getContext('2d');

        var chart = new Chart(ctx, {
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
    })
  }
</script>

<?php include 'subcomponents/footer.php'; ?>
