<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header col-md-2">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="<?php echo base_url();?>" class="brand-menubar">
          <img class="img-circle img-brand-menubar" width="50px" src="<?php echo base_url();?>assets/img/foodoof.png"/>
        </a>
        <a href="<?php echo base_url();?>recipe/create" class="pull-right btn-navbar-mobile text-center"><i class="fa fa-pencil-square-o fa-2x"></i><br>Write <br>A Recipe</a>
    </div>
    <ul class="nav navbar-top-links nav navbar-nav navbar-left col-md-10">
      <div class="col-md-12 form-inline inline-search col-menubar">
          <form class="navbar-form collapse-navbar-search" method="get" action="<?php echo base_url();?>search/">
            <div class="input-group form-group col-md-8 pull-left" style="padding-left:20px;">
                <input type="text" class="form-control input-search" placeholder="Search Recipe By Title" style="width:533px"/>
                <div class="input-group-btn">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Search By<span class="caret"></span></button>
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
            <div class="form-group col-md-4 col-menu-user">
              <div class="col-md-2 link-by-icon" >
                <a href="<?php echo base_url();?>recipe/create" class="text-center" title="New Recipe">
                  <i class="fa fa-pencil-square-o fa-2x"></i>
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
              <div class="col-md-4 col-offset-md-3 pull-right">
                <a href="<?php echo base_url();?>home/logout">
                  <button type="button" class="btn btn-danger btn-sm">Logout</button>
                </a>
              </div>         
            </div>
          </form>
      </div>
    </ul>
  </nav>