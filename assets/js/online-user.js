$(function() {
  id = $("#user_id").val();
  if( id > 0 )
  {
    // update ke database, last_access-nya, loop
    function update(){
      $.get("user/setonline/"+id, function(response){console.log(response);});
      setTimeout(update, 30000);
    }
    update();
  }
});