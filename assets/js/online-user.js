$(function() {
  branch = "/foodoof";
  id = $("#user_id").val();

  sample = $('#sample-online-user');
  function getonline(){
    $.get(branch+"/index.php/user/getOnline", function(response){
      response = eval(response);
      $('#online-panel').empty();
      $('#online-count-1').html(response.length+" Users Online");
      $('#online-count-2').html(response.length+" Users Online");
      for (var i = 0; i < response.length; ++i) {
        html = sample.clone();
        html.removeAttr('hidden');
        html.find('#imge').attr('src', branch+'/'+response[i].photo);
        html.find('#ling').attr('href', branch+'/index.php/user/timeline/'+response[i].id);
        html.find('#uname').html(response[i].name);
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
      $.get(branch+"/index.php/user/setOnline", function(response){
        if(response == "not logged in") window.location.reload();
        else console.log(response);
      });
      setTimeout(setonline, 10000);
    }
    setonline();
  }
});