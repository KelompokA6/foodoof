$(function() {
  id = $("#user_id").val();

  sample = $('#sample-online-user');
  function getonline(){
    $.get("/foodoof/index.php/user/getonline/"+id, function(response){
      response = eval(response);
      console.log("online users: "+response.length);
      $('#online-panel').empty();
      $('#online-count-1').html(response.length+" Users Online");
      $('#online-count-2').html(response.length+" Users Online");
      for (var i = 0; i < response.length; ++i) {
        html = sample.clone();
        html.removeAttr('hidden');
        html.find('#imge').attr('src', '/foodoof/'+response[i].photo);
        html.find('#ling').attr('href', '/foodoof/index.php/user/timeline/'+response[i].id);
        html.find('#ling').html(response[i].name);
        $('#online-panel').append(html);
      };
    });
    setTimeout(getonline, 10000);
  }
  getonline();

  if( id > 0 )
  {
    // update ke database, last_access-nya, loop
    function setonline(){
      $.get("/foodoof/index.php/user/setonline/"+id, function(response){
        // ngapain?
      });
      setTimeout(setonline, 10000);
    }
    setonline();
  }
});