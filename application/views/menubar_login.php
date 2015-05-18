<div class="navmenu navmenu-default navmenu-fixed-left offcanvas bg-sidemenu" role="navigation">
  <div class="col-xs-12 text-center page-header-title">
    <a href="<?php echo base_url();?>" class="brand-menubar col-no-padding-left">
      <img class="img-responsive img-brand-menubar" src="<?php echo base_url();?>assets/img/foodoof.png" style="padding-top: 5px;"/>
    </a>  
  </div>
  <ul class="list-group text-foodoof">
    <a href="<?php echo base_url();?>index.php/user/timeline">
      <li class="col-xs-12 border-solid-bottom" style="padding:10px 15px; margin:0 0 10px; font-size:18px;">
        <div class="col-xs-4 text-center">
          <img class="img-circle img-profile-slide-menu" src="<?php echo base_url();?>{menubar_user_photo}"/>
        </div>
        <div class="col-xs-8" style="line-height:50px;">
          {menubar_user_name}
        </div>  
      </li>
    </a>
    <a href="<?php echo base_url();?>index.php/user/messages">
      <li class="col-xs-12 border-solid-bottom" style="padding:10px 15px; margin:0 0 10px; font-size:18px;">
        <span class="fa-stack fa-lg" id="icon-message-sidebar" data-countmessage="{menubar_count_unread_message}">
          <i class="fa fa-square fa-stack-2x icons-default"></i>
          <i class="fa fa-comment fa-stack-1x fa-inverse"></i>
        </span>
        Messages
      </li>
    </a>
    <a href="<?php echo base_url();?>index.php/user/profile">
      <li class="col-xs-12 border-solid-bottom" style="padding:10px 15px; margin:0 0 10px; font-size:18px;">
        <span class="fa-stack fa-lg">
          <i class="fa fa-square fa-stack-2x icons-default"></i>
          <i class="fa fa-user fa-stack-1x fa-inverse"></i>
        </span>
        Profile
      </li>
    </a>
    <a href="<?php echo base_url();?>index.php/user/favorite">
      <li class="col-xs-12 border-solid-bottom" style="padding:10px 15px; margin:0 0 10px; font-size:18px;">
        <span class="fa-stack fa-lg">
          <i class="fa fa-square fa-stack-2x icons-default"></i>
          <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
        </span>
        Favorite
      </li>
    </a>
    <a href="<?php echo base_url();?>index.php/user/cooklater">
      <li class="col-xs-12 border-solid-bottom" style="padding:10px 15px; margin:0 0 10px; font-size:18px;">
        <span class="fa-stack fa-lg">
          <i class="fa fa-square fa-stack-2x icons-default"></i>
          <i class="fa fa-list-alt fa-stack-1x fa-inverse"></i>
        </span>
        Cook Later
      </li>
    </a>
    <a href="<?php echo base_url();?>index.php/user/changepassword">
      <li class="col-xs-12 border-solid-bottom" style="padding:10px 15px; margin:0 0 10px; font-size:18px;">
        <span class='fa-stack fa-lg'>
          <i class='fa fa-square fa-stack-2x icons-default'></i>
          <i class='fa fa-key fa-stack-1x fa-inverse'></i>
        </span>
        Change Password
      </li>
    </a>
  </ul>
  <a href="<?php echo base_url();?>index.php/home/logout" class="col-xs-12 text-center">
    <button type="button" class="btn button-default">Logout</button>
  </a>
</div>
<nav class="navbar navbar-default navbar-fixed-top bg-foodoof">
  <div class="container">
    <div class="navbar-header col-md-2 col-no-padding-right mobile-hidden" style="padding-bottom:10px">
      <button type="button" class="navbar-toggle navbar-toggle-foodoof" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" data-placement='left' style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar icons-secondary"></span>
          <span class="icon-bar icons-secondary"></span>
          <span class="icon-bar icons-secondary"></span>
      </button>
      <a href="<?php echo base_url();?>" class="brand-menubar col-no-padding-left col-md-12 col-xs-9">
        <img class="img-responsive img-brand-menubar" src="<?php echo base_url();?>assets/img/foodoof.png" style="padding-top: 12px;"/>
      </a>
      <a href="<?php echo base_url();?>index.php/recipe/create" class="btn-navbar-mobile pull-right text-center">
        <i class="fa fa-pencil-square-o fa-2x icons-secondary">
        </i><br>Write <br>A Recipe
      </a>
    </div>
    <div class="navbar-header col-md-2 mobile-visible" style="padding-bottom:10px">
      <a href="<?php echo base_url();?>index.php/recipe/create" class="btn-navbar-mobile pull-right text-center">
        <i class="fa fa-pencil-square-o fa-2x icons-secondary">
        </i><br>Write <br>A Recipe
      </a>
      <a href="<?php echo base_url();?>" class="brand-menubar col-md-12 col-xs-9 pull-right text-center">
        <img class="img-responsive img-brand-menubar" src="<?php echo base_url();?>assets/img/foodoof.png" style="padding-top: 12px; margin:auto"/>
      </a>
      <button type="button" class="navbar-toggle navbar-toggle-foodoof pull-left" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" data-placement='left' style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar icons-secondary"></span>
          <span class="icon-bar icons-secondary"></span>
          <span class="icon-bar icons-secondary"></span>
      </button>
    </div>
    <div id="navbar" class="col-md-10">
      <form id="form-search" class="collapse-navbar-search col-md-7 col-no-padding-right" method="get" action="<?php echo base_url();?>index.php/search">
        <div class="input-group form-group search-bar-menu">
          <span class="input-group-btn"> 
            <div class="btn-group">
              <button class="btn dropdown-cat-search button-secondary" data-toggle="dropdown" aria-expanded="false" title="Search Recipe By Title">
                <i class="fa fa-cutlery fa-lg"></i>
              </button>
              <ul id="listSearch" class="dropdown-menu dropdown-menu-search bullet pull-center">
                <li>
                  <input type="radio" id="ex1_1" value='title' name="searchby" checked/>
                  <label for="search-title">
                    <i class="fa fa-cutlery fa-lg"></i><span style="margin-left:15px">Title </span>
                  </label>
                </li>
                <li>
                  <input type="radio" id="ex1_2" value='ingredient' name="searchby"/>
                  <label for="search-ingredient">
                    <i class="icon-basket" style="font-size:1.333em"></i><span style="margin-left:15px">Ingredient </span>
                  </label>
                </li>
                <li>
                  <input type="radio" id="ex1_3" value='account' name="searchby"/>
                  <label for="search-account">
                    <i class="fa fa-user fa-lg"></i><span style="margin-left:15px">Account </span>
                  </label>
                </li>
              </ul>
            </div>
          </span>
          <input type="search" id="searchbar" class="form-control" name="q" class="typeahead" autocomplete="off" data-provide="typeahead" placeholder="Search Recipe By Title">
          <span class="input-group-btn">
            <button type="submit" class="btn button-secondary button-group-normal">
               <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <div class="col-md-5 col-menu-user mobile-hidden col-no-padding-right" style="padding-left:30px">
        <div class="col-md-2 link-by-icon text-right" >
          <a href="<?php echo base_url();?>index.php/recipe/create" title="New Recipe">
            <i class="fa fa-pencil-square-o fa-2x icons-secondary" style="cursor:pointer"></i>
          </a>
        </div>
        <div id="icon-message" class="col-md-2 link-by-icon text-right" style="padding:0 6px" data-countmessage="{menubar_count_unread_message}">
          <a href="<?php echo base_url();?>index.php/user/message" title="Messages">
            <i class="fa fa-comment fa-2x icons-secondary" style="cursor:pointer"></i>
          </a>
        </div>
        <a href="<?php echo base_url();?>index.php/user/timeline" class="col-md-5 col-no-padding">
          <div class="col-md-12 hover-menubar text-left" title="My Profile">
            <div class="col-md-4 col-no-padding-left col-no-padding-right div-img-profile-menubar text-right">
              <img class="img-rounded img-profile-menubar" src="<?php echo base_url();?>{menubar_user_photo}"/>
            </div>
            <div class="col-md-8 col-no-padding text-center user-name" style="line-height:34px">
              {menubar_user_name}
            </div>
          </div>
        </a>
        <div class="col-md-3 text-right col-no-padding ">
          <a href="<?php echo base_url();?>index.php/home/logout" title="Logout">
            <button type="button" class="btn button-secondary">Logout</button>
          </a>
        </div> 
      </div>
    </div><!--/.nav-collapse -->
  </div>
</nav>