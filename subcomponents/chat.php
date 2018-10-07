<link rel="stylesheet" href="../styles/chat.css">

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

<script src="../../js/controlers/messages.js"></script>
<script type="text/javascript">

  var receptor_id;

  $(document).ready( function () {
    getUsersSpecialist();
  });

  function getUsersSpecialist(){
    request = {
      specialist_id: <?php echo $_SESSION['userId'] ?>
    };
    messagesModels.getSpecialistFromClient(request);
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

  function openChat(id, name, amount){
    console.log(amount);
    if(amount > 0){
      $('#notification' + id).addClass('hidden');
    }
    $('#message').removeClass('hidden');
    receptor_id = id;
    $('.message_container').remove();
    $('#transmiterName').html(name);
    request={
      guessUser: id,
      selfId: <?php echo $_SESSION['userId'] ?>
    };
    messagesModels.openChat(request);
  }

  function hideChatMessages(){
    $('#message').addClass('hidden');
  }

  function submitMessage(event){

    var keycode = (event === null) ? window.event.keyCode : event.which;

    if(keycode === 13) {
      var request ={
        message: event.target.value,
        receptor_id: receptor_id,
        transmiter_id: <?php echo $_SESSION['userId'] ?>,
        time: moment().format()
      };

      if(event.target.value.trim().length > 0) {
        // string only contained whitespace (ie. spaces, tabs or line breaks)
        console.log('vacio');
        console.log(event.target.value);
        return false;
      }
    // messagesModels.submitMessage(request, event);

    // console.log(request);
    }
  }
</script>
