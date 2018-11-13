<?php
include '../../subcomponents/connection.php';

  class auth{

    public function login($email, $password){
      $sql = "SELECT * FROM usuarios u INNER JOIN user_info i on i.user_id = u.id  WHERE u.correo = '$email' AND clave = '$password'";

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);

      if(!($row == null)){
        if($row['validated'] == '0'){
          return false;
        }
        return true;

      }else{
        return false;
      }
      mysqli_close($conn);
    }

  }

?>
