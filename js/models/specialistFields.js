var FieldsModel = {

  setFields: function(){
    var fields = [];
    $.ajax({
      type:'GET',
      async: false,
      url : "http://localhost/reservas/controladores/specialistField/getAllSpecialistFields.php",
      success:function(data, status){
        data = JSON.parse(data);
        for(var i=0; i<data.length; i++){
          fields.push(data[i].name);
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
      url : "http://localhost/reservas/controladores/specialistField/createSpecialistField.php",
      success: function(data, status){
         console.log(data);
         toastr.success('especializacion creada con exito');
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
      url : "http://localhost/reservas/controladores/specialistField/deleteSpecialistField.php",
      success: function(data, status){
         console.log(data);
      }
   })
  }
}

export {FieldsModel};
