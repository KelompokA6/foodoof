<div id="users-online" class="btn btn-default col-md-2 col-xs-4 col-no-padding text-left" style="position:fixed; left:0; bottom:0; z-index:100">
  <div id="panel-users" class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{online_user_count} Users Online</h3>
    </div>
    <div class="panel-body">
      {online_users}
      <div class="col-md-12 list-user-online col-no-padding-right">
        <div class="col-md-3 col-no-padding">
          <img class="img-responsive img-rounded img-user-online" src="{user_photo}">
        </div>
        <div class="col-md-9 text-left col-no-padding-right name-user-online">
          <a href="/foodoof/index.php/user/timeline/{user_id}">{user_name}</a>
        </div>
      </div>
      {/online_users}
    </div>
  </div>
  <div class="col-md-12 col-xs-12 col-no-padding" id="toggle-online-user">
    <div class="col-md-9 col-xs-8 text-left">
      <i class="fa fa-user fa-2x"></i>
      <span style="padding-left:15px;font-size:18px"> {online_user_count} Online</span>
    </div>
    <div class="col-md-2 col-xs-4">
      <i class="fa fa-chevron-up fa-2x"></i>
    </div>
  </div>
</div>