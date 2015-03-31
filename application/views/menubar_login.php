<nav class="navbar navbar-default navbar-fixed-top" style="/*background:rgb(56,150,211);*/">
  <div class="container">
    <div class="navbar-header col-md-1 col-no-padding-right" style="padding-bottom:10px">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a href="<?php echo base_url();?>" class="brand-menubar col-no-padding-left">
        <img class="img-circle img-brand-menubar" width="75px" src="<?php echo base_url();?>assets/img/foodoof.png" style="padding-top: 5px;"/>
      </a>
      <a href="<?php echo base_url();?>recipe/create" class="btn-navbar-mobile pull-right text-center" style="color:white">
        <i class="fa fa-pencil-square-o fa-2x icon-default">
        </i><br>Write <br>A Recipe
      </a>
    </div>
    <div id="navbar" class="">
      <form class="collapse-navbar-search col-md-7" method="get" action="<?php echo base_url();?>search/title">
        <div class="input-group form-group search-bar-menu">
          <input type="text" class="form-control" name="q" placeholder="Search Recipe By Title">
          <div class="input-group-btn">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="border-radius:0">
              Title<span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-search" role="menu" aria-labelledby="dropdownMenu1">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Recipe</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ingredient</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Account</a></li>
            </ul>
            <span class="btn-group">
              <button class="btn btn-primary button-group-normal" type="submit" >
                 <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </div>
      </form>
      <div class="col-md-4 navbar-collapse collapse col-menu-user" style="padding-left:30px">
        <div class="col-md-3 link-by-icon text-right" >
          <a href="<?php echo base_url();?>recipe/create" title="New Recipe">
            <i class="fa fa-pencil-square-o fa-2x icon-default"></i>
          </a>
        </div>
        <a href="user/profile" class="col-md-5">
          <div class="col-md-12 hover-menubar text-left" title="Profile">
            <div class="col-md-6 col-no-padding-left col-no-padding-right div-img-profile-menubar text-left">
              <img class="img-circle img-profile-menubar" src="<?php echo base_url();?>{menubar_user_photo}"/>
            </div>
            <div class="col-md-4 col-no-padding text-left" style="line-height:34px">
              {menubar_user_name}
            </div>
          </div>
        </a>
        <div class="col-md-4 col-offset-md-2 text-right">
          <a href="<?php echo base_url();?>home/logout">
            <button type="button" class="btn btn-danger btn-sm">Logout</button>
          </a>
        </div> 
      </div>
    </div><!--/.nav-collapse -->
  </div>
</nav>