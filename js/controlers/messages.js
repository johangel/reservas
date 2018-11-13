messagesModels = {

  getSpecialistFromClient: function(request){
    $.ajax({
      type:'GET',
      url:"http://localhost/reservas/models/Specialists/getSpecialistFromClient.php",
      data: request,
      success: function(data, status){
        data =JSON.parse(data);
        $('#userList').html('');
        for(var i = 0; i<data.length; i++){
          if(data[i].amount > 0){
            $('#userList').append('<li class="p-1 pl-2 chatUser position-relative" onclick="openChat('+data[i].id +', \''+data[i].nombre+'\','+data[i].amount+')">'+data[i].nombre+'<span style="right: 10px; top: 7px;" id="notification'+data[i].id+'" class="badge badge-primary position-absolute">'+data[i].amount+'</span></li>');
          }else{
            $('#userList').append('<li class="p-1 pl-2 chatUser" onclick="openChat('+data[i].id +', \''+data[i].nombre+'\','+data[i].amount+')">'+data[i].nombre+'</li>');
          }
        }
      }
    })
  },

  openChat: function(request){
    $.ajax({
      type:'GET',
      data: request,
      url:"http://localhost/reservas/models/Chat/getMessages.php",
      success: function(data, status){
        data = JSON.parse(data)
        data.sort(function(a,b){
            return a['id'] - b['id'];
        });
        for(var i= 0; i<data.length; i++){
          if(data[i].receptor_id == request.selfId){
            $('#chatMessages').append('<li class="mb-2 guessMessage message_container"><div class="p-1 message_text">'+ data[i].message_body +'<small class="small" style="font-size: 10px; display: block;">'+moment(data[i].time).fromNow()+'</small></div></li>');
          }else{
            $('#chatMessages').append('<li class="mb-2 selfMessage message_container"><div class="p-1 message_text selfText">'+ data[i].message_body +'<small class="small" style="font-size: 10px; display: block;"> '+moment(data[i].time).fromNow()+'</small></div></li>');
          }
        }
      }
    })
  },

  submitMessage: function(request, event){
    $.ajax({
      type:'POST',
      data:request,
      url:"http://localhost/reservas/models/Chat/sendMessage.php",
      success:function(data, status){
        console.log(data);
        event.target.value = "";
        $('#chatMessages').append('<li class="message_container mb-2 selfMessage"> <div class="p-1 message_text selfText"> '+ request.message +'<small class="small" style="font-size: 10px; display: block;"> '+moment().fromNow()+' </div></li>');
      }
    })
  },

  deleteNotificationHeader: function(request){
    $.ajax({
      type:'POST',
      data:request,
      url:"http://localhost/reservas/models/Chat/deleteNotificationHeader.php",
      success:function(data, status){
        console.log(data);
      }
    })
  },

  getNotificationHeader: function(){
    var messagesArray = [];
    $.ajax({
      type:'GET',
      async: false,
      url:"http://localhost/reservas/models/Chat/getNotificationHeader.php",
      success:function(data, status){
        messagesArray = JSON.parse(data);
      }
    })
    return messagesArray;
  }

}
