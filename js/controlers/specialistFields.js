var FieldsModel = {

  setFields: function(){
    var fields = [];
    $.ajax({
      type:'GET',
      async: false,
      url : "http://localhost/reservas/models/specialistField/getAllSpecialistFields.php",
      success:function(data, status){
        data = JSON.parse(data);
        for(var i=0; i<data.length; i++){
          fields.push(data[i]);
        }
      }
    })
    return fields;
  },

  addNewField: function(nameField){
    var request = {
       nameField: nameField
    };

    $.ajax({
      type:'POST',
      data:request,
      url : "http://localhost/reservas/models/specialistField/createSpecialistField.php",
      success: function(data, status){
         console.log(data);
         location.reload();
      }
   })
  },

  deleteField: function(id){
    var request = {
       idField: id
    };

    $.ajax({
      type:'POST',
      data:request,
      url : "http://localhost/reservas/models/specialistField/deleteSpecialistField.php",
      success: function(data, status){
        location.reload();
      }
   })
 },

 updateField: function(request){
   $.ajax({
     type:'POST',
     data:request,
     url : "http://localhost/reservas/models/specialistField/updateSpecialistField.php",
     success: function(data, status){
       location.reload();
     }
  })
 }

}
