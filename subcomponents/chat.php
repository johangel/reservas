<link rel="stylesheet" href="../reservas/styles/chat.css">

<div class="chatWindow">

  <div  id="chat" class="chat">
    <div onclick="hideChat()" class="chat_header p-2">
      <?php echo $_SESSION['username']; ?>
    </div>
    <div id="chatList" class="chatList hidden height0">
      <ul id="userList">
      </ul>
    </div>
  </div>

</div>

<div id="message" class="message hidden">
  <div id="transmiterName" onclick="hideChatMessages()" class="transmiterName p-2 chat_header">
  </div>

    <ul class="chatMessages" id="chatMessages" class="p-2">
    </ul>
    <input type="text" class="messageField" onkeyup="submitMessage(event)" placeholder="escribe un mensaje..">
</div>

<script type="text/javascript">

var receptor_id;

$(document).ready( function () {
  getUsersSpecialist();
});

  function getUsersSpecialist(){
    request = {
      specialist_id: <?php echo $_SESSION['userId'] ?>
    };

    $.ajax({
      type:'GET',
      url:"http://localhost/reservas/controladores/Specialists/getSpecialistFromClient.php",
      data: request,
      success: function(data, status){
        data =JSON.parse(data);
        console.log(data);
        for(var i = 0; i<data.length; i++){

          $('#userList').append('<li class="p-1 pl-2 chatUser" onclick="openChat('+data[i].id +', \''+data[i].nombre+'\')">'+data[i].nombre+'</li>');
        }
      }
    })
  }

  function hideChat(){
    $('#chatList').toggleClass('hidden');
    $('#chatList').toggleClass('height0');

    if($('#chatList').hasClass('hidden')){
      $('#chat').css('min-height', '0px');
    }else{
      $('#chat').css('min-height', '300px');
    }
  }

  function openChat(id, name){

    $('#message').removeClass('hidden');
    receptor_id = id;
    console.log(name);
    $('#transmiterName').html(name);
    request={
      guessUser: id
    };
    $.ajax({
      type:'GET',
      data: request,
      url:"http://localhost/reservas/controladores/Chat/getMessages.php",
      success: function(data, status){
        $('.message_container').remove();
        data = JSON.parse(data)
        data.sort(function(a,b){
            return a['id'] - b['id'];
        });
        for(var i= 0; i<data.length; i++){
          if(data[i].receptor_id == <?php echo $_SESSION['userId'] ?>){
            $('#chatMessages').append('<li class="mb-2 guessMessage message_container"><div class="p-1 message_text">'+ data[i].message_body +'<small class="small" style="font-size: 10px; display: block;">'+moment(data[i].time).fromNow()+'</small></div></li>');
          }else{
            $('#chatMessages').append('<li class="mb-2 selfMessage message_container"><div class="p-1 message_text">'+ data[i].message_body +'<small class="small" style="font-size: 10px; display: block;"> '+moment(data[i].time).fromNow()+'</small></div></li>');
          }
        }
      }
    })
  }

  function hideChatMessages(){
    $('#message').addClass('hidden');
  }

  function submitMessage(event){

    if(event.target.value == ''){
      return;
    }

    var keycode = (event === null) ? window.event.keyCode : event.which;
    if(keycode === 13) {
      var request ={
        message: event.target.value,
        receptor_id: receptor_id,
        transmiter_id: <?php echo $_SESSION['userId'] ?>,
        time: moment().format()
      };

      $.ajax({
        type:'POST',
        data:request,
        url:"http://localhost/reservas/controladores/Chat/sendMessage.php",
        success:function(data, status){
          console.log(data);
          event.target.value = "";
          $('#chatMessages').append('<li class=" mb-2 selfMessage"> <div class="p-1 message_text"> '+ request.message +' </div></li>');
        }
      })

      console.log(request);
    }
  }
</script>
