$(function() {
  $('#tema').change(function() {
    setTimeout(function(){
      window.location = '/foodoof/index.php/home/changeTheme?url='+encodeURI(window.location.toString());
    }, 500);
  });
});