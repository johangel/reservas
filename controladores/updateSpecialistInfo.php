<?php
session_start();
include '../connection.php';

$id = $_POST['user_id'];
$active = $_POST['active'];
$specialistField = $_POST['specializacionField'];
$cmd = $_POST['cmd'];
$salary = $_POST['salary'];
$rol = $_POST['rol'];


$sql = "SELECT id from specialist_info WHERE user_id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//si existe el id en specialist_info y se cambia a usuario, se elimina su specialist_info
//y e update su rol, si no existe se crear la specialist info

if(!($row == NULL)){

  if($rol == 'Usuario'){
      $sqlUpdate = "UPDATE user_info SET rol ='$rol' WHERE user_id='$id'";
      $resultSqlUpdate = mysqli_query($conn, $sqlUpdate);

      $sqlDelete = "DELETE FROM specialist_info WHERE user_id = '$id'";
      $resultDelete = mysqli_query($conn, $sqlDelete);

    }else if($rol == 'Especialista'){

      $sqlUpdate = "UPDATE specialist_info SET active='$active', specialistField='$specialistField', cmd='$cmd', salary='$salary' WHERE user_id='$id'";
      $resultSqlUpdate = mysqli_query($conn, $sqlUpdate);

    }

    mysqli_close($conn);
    echo 'se actualizo el usuario con exito';
  }else{

  $sqlUpdate = "UPDATE user_info SET rol ='$rol' WHERE user_id='$id'";
  $resultSqlUpdate = mysqli_query($conn, $sqlUpdate);

  $sqlCreate = "INSERT INTO specialist_info (user_id, active, cmd, salary, specialistField)
  VALUES('$id', '$active', '$cmd', '$salary', '$specialistField')";

  // echo $sqlCreate;

  $resultSqlCreate = mysqli_query($conn, $sqlCreate);
  mysqli_close($conn);
  echo 'se creo el rol especialista con exito';
}

?>