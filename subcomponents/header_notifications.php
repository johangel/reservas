<?php
include('../subcomponents/connection.php');

$userId = $_SESSION['userId'];
$sqlMessages = "SELECT * from info_notifications WHERE user_id = '$userId'";
$resultMesages = mysqli_query($conn, $sqlMessages);
$messagesArray = [];
while ($messages = mysqli_fetch_assoc($resultMesages)) {
  $messagesArray[] = $messages;
}
mysqli_close($conn);


$host_url = 'http://'.$_SERVER['HTTP_HOST'].'/reservas';

?>

<li class="notification_header_container nav-item d-flex align-items-center p-2 position-relative">
  <div onclick="showNotificationsHeader()">
    <img src=" <?php echo $host_url.'/assets/icons/bell.png'; ?>" alt="">
    <span id="amountNotificationsHeader" style="color: white"><?php echo count($messagesArray); ?></span>
  </div>
    <ul id="notifications_header_container" class="message_notification_header_container shadow rounded hidden">
      <?php
      if(count($messagesArray) > 0){
        for($i = 0; $i<count($messagesArray); $i++){
          echo '<li class="message_notification" onclick="deleteNotificationHeader('.$messagesArray[$i]['id_notification'].',event)">'.$messagesArray[$i]["message"].'</li>';
        }
      }else{
         echo '<li class="message_notification">No tienes notificaciones sin leer en este momento</li>';
      }
      ?>
    </ul>
</li>


<style media="screen">

  .notification_header_container{
    transition: 0.125s all;
  }

  .notification_header_container:hover{
    background: #495081;
    cursor: pointer;
  }

  .notification_header_container .message_notification_header_container{
    position: absolute;
    top: 75%;
    z-index: 100;
    right: 170px;
    font-size: 12px;
    max-width: 250px;
    background: white;
    max-height: 250px;
    overflow-y: scroll;
    right: 50%;
    width: 250px;
  }

  .notification_header_container .message_notification_header_container .message_notification{
    padding: 10px;
    border-bottom: 1px solid #e6ecf0;
    transition: 0.125s all;
    cursor: pointer;
  }

  .notification_header_container .message_notification_header_container .message_notification:hover{
    color: white;
    background: #007bff;
  }

  .notification_header_container .message_notification_header_container .message_notification:last-child{
    border-bottom: none;
  }


</style>

<script type="text/javascript">
  function showNotificationsHeader(){
    $('#notifications_header_container').toggleClass('hidden');
  }

  function deleteNotificationHeader(id,event){
    var amountNOtifications = $('#amountNotificationsHeader').html();
    amountNOtifications--;
    $('#amountNotificationsHeader').html(amountNOtifications);
    var elem = event.target;
    elem.parentNode.removeChild(elem);

    if(amountNOtifications == 0){
      $("#notifications_header_container").append('<li class="message_notification">No tienes notificaciones sin leer en este momento</li>');
    }

    var request = {
      id_notification: id,
    };
    messagesModels.deleteNotificationHeader(request);
  }
</script>
