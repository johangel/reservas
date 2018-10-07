<?php
session_start();
include '../../subcomponents/connection.php';


$id = $_POST['user_id'];
$active = $_POST['active'];
$specialistField = $_POST['specializacionField'];
$cmd = $_POST['cmd'];
$salary = $_POST['salary'];
$rol = $_POST['rol'];
$daysArray = $_POST['daysArray'];
$from = $_POST['from'];
$to = $_POST['to'];


$sql = "SELECT id from specialist_info WHERE user_id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//si existe el id en specialist_info y se cambia a usuario, se elimina su specialist_info
//y e update su rol, si no existe se crear la specialist info

if(!($row == NULL)){

  if($rol == 'Usuario' || $rol == 'Administrador'){
      $sqlUpdate = "UPDATE user_info SET rol ='$rol' WHERE user_id='$id'";
      $resultSqlUpdate = mysqli_query($conn, $sqlUpdate);

      $sqlDelete = "DELETE FROM specialist_info WHERE user_id = '$id'";
      $resultDelete = mysqli_query($conn, $sqlDelete);

    }else if($rol == 'Especialista'){

      $sqlCheckHours = "SELECT * FROM specialist_info where user_id='$id'";
      $resultCheckHours = mysqli_query($conn, $sqlCheckHours);

      $rowCheckHours = mysqli_fetch_array($resultCheckHours);

      //verificando si al editar el especialista se esta alterando su horario de algun modo

      if(($rowCheckHours['days'] != $daysArray) || ($rowCheckHours['hoursFrom'] != $from) || ($rowCheckHours['hoursTo'] != $to)){

        //de ser el caso se deben crear las notificaciones a sus clientes

        $sqlReservations = "SELECT id_client FROM reservations where id_specialist='$id'";
        $resultReservations = mysqli_query($conn, $sqlReservations);

        while ($rowReservations = mysqli_fetch_array($resultReservations)) {
          $ClientesArray[] = $rowReservations[0];
        }

        if(isset($ClientesArray)){
          $ClientesArray = array_keys(array_count_values($ClientesArray));

          // se arma el mensaje de notificacion para los clientes

          $sqlDoctorName = "SELECT nombre FROM usuarios WHERE id='$id'";
          $resultDoctorName = mysqli_query($conn, $sqlDoctorName);
          $doctorName = mysqli_fetch_array($resultDoctorName);

          $messageText = "El especialista ".$doctorName['nombre']. " cambio sus horas de ejercicio, verificar si las reservas con dicho profesional permanecen en horas validas";

          //con este arreglo se enviaran las notifiaciones a los usuarios que el especialista cambio sus horas

          for($i = 0; $i < count($ClientesArray); $i++){
            $sqlSendNotifications = "INSERT INTO info_notifications (user_id, message) VALUES ('$ClientesArray[$i]', '$messageText')";
            $resultSendNotification = mysqli_query($conn, $sqlSendNotifications);
          }
        }


      }


      $sqlUpdate = "UPDATE specialist_info SET active='$active', specialistField='$specialistField', cmd='$cmd', salary='$salary', days='$daysArray', hoursFrom='$from', hoursTo='$to' WHERE user_id='$id'";
      $resultSqlUpdate = mysqli_query($conn, $sqlUpdate);

    }

    mysqli_close($conn);
    echo 'se actualizo el usuario con exito';
  }else{

  $sqlUpdate = "UPDATE user_info SET rol ='$rol' WHERE user_id='$id'";
  $resultSqlUpdate = mysqli_query($conn, $sqlUpdate);

  $sqlCreate = "INSERT INTO specialist_info (user_id, active, cmd, salary, specialistField, days, hoursFrom, hoursTo)
  VALUES('$id', '$active', '$cmd', '$salary', '$specialistField', '$daysArray', '$from', '$to')";


  // echo $sqlCreate;

  $resultSqlCreate = mysqli_query($conn, $sqlCreate);
  mysqli_close($conn);
  echo 'se creo el rol especialista con exito';
}

?>
