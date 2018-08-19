<?php
session_start();
include '../connection.php';

$img = $_POST['img'];
$id_user = $_POST['id_user'];
$img_name = date('d_m_Y_H_i_s').$_POST['img_name'];

function uploadImgBase64 ($base64, $img_name){
  // decodificamos el base64
  $datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
  // definimos la ruta donde se guardara en el server
  $path= $_SERVER['DOCUMENT_ROOT'].'/reservas/assets/user_images/'.$img_name;
  // guardamos la imagen en el server
  if(!file_put_contents($path, $datosBase64)){
    // retorno si falla
    return false;
  }else{
    // retorno si todo fue bien
    return true;
  }
}

uploadImgBase64($img, $img_name);

function deletePreviousImage($id_user, $conn){
  $sql = "SELECT profile_img FROM user_info WHERE user_id='$id_user'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  if(!($row == null)){
    $previousPhoto = $row['profile_img'];
    $path = $_SERVER['DOCUMENT_ROOT'].'/reservas/assets/user_images/'.$previousPhoto;
    unlink($path);
  }
}

deletePreviousImage($id_user, $conn);

$sql = "UPDATE user_info SET profile_img='$img_name' WHERE user_id='$id_user'";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);


?>
