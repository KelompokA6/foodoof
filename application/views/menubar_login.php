<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
  <div class="navbar-header col-md-1">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a href=""><img class="img-responsive pull-left" width="75px"  src="<?php echo base_url();?>assets/img/foodoof.png"/></a>
      <a href="" class="pull-right btn-navbar-mobile text-center"><i class="fa fa-pencil-square-o fa-2x"></i><br>Write <br>A Recipe</a>
  </div>
    <!-- /.navbar-header -->

  <ul class="nav navbar-top-links nav navbar-nav navbar-left col-md-11">
    <div class="col-md-12 form-inline inline-search">
        <form class="navbar-form collapse-navbar-search" style="padding-left:100px">
          <div class="input-group form-group col-md-8" style="padding-left:20px;">
              <input type="text" class="form-control" placeholder="Search Recipe By Title"/>
              <div class="input-group-btn">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Search By<span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-search" role="menu" aria-labelledby="dropdownMenu1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Recipe</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ingredient</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Account</a></li>
                </ul>
                <span class="btn-group">
                  <button class="btn btn-primary" type="submit" style="width:60px; height:33.9915px">
                     <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
          </div>
          <div class="form-group col-md-3 pull-right btn-navbar-not-collapse text-center btn-log-nav" style="width:320px; line-height:32px; padding:0">
            <div class="col-md-3">
              <img class="img-responsive img-circle img-profile-menubar" src="<?php echo base_url();?>assets/img/01.jpg"/>
            </div>
            <div class="col-md-5" style="font-size:14px; padding:0; text-align:left">
                <p id="dropdownMenuUser" class="popoverMenubar" data-toggle="popover" data-container="body" data-placement="bottom" 
                  data-html="TRUE"
                  data-content="
                    <ul class='link-menubar-dropdown'>
                      <li><a href='#'>My Profile</a></li>
                      <li><a href='#'>My Recipe ()</a></li>
                      <li><a href='#'>Message ()</a></li>
                      <li><a href='#'>Cook Later ()</a></li>
                      <li><a href='#'>Favorite ()</a></li>
                    </ul>
                  ">
                  <span class="link-menubar">Abid</span>
                </p>
                <!-- <ul class="dropdown-menu link-menubar-dropdown" role="menu" aria-labelledby="dropdownMenu1">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">My Profile</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">My Recipe ()</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Message ()</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Cook Later ()</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Favorite ()</a></li>
                </ul> -->
            </div>
            <button type="button" class="btn btn-danger">Logout</button>
          </div>
          <div class="pull-right">
            <a href="" class="btn-navbar-not-collapse" style="margin-left:-80px" alt="New Recipe">
              <button class="btn btn-primary" type="button">
                <i class="fa fa-pencil-square-o fa-lg"></i> <i class="small"></i>
              </button>
            </a>
          </div>
          
        </form>
    </div>
  </ul>
</nav>