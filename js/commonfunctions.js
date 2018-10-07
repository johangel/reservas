function onlyNumbers(evt){
   if (evt.which<48 || evt.which>57  )
      {
        if(evt.which!=8){
          evt.preventDefault();
        }
      }
}


function disableNumbers(evt){
   if (!(evt.which<48 || evt.which>57 ))
      {
          evt.preventDefault();
      }
}

function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

function maxValue(value, event){
  console.log(value);
  console.log(event.target.value);
  if(event.target.value > value){
    event.target.value = value;
  }
}
