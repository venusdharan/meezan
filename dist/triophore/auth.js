
setInterval(function() {
  $.get("ops/auth_check.php",function(d,s){
      if(s.trim() == "success")
      {
          if(d.trim() == false)
          {
              window.location = 'login';
          }
      }
  });
}, 10000);




