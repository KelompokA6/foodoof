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
      <a href="<?php echo base_url();?>recipe/create" class="btn-navbar-mobile pull-right text-center">
        <i class="fa fa-pencil-square-o fa-2x icon-default">
        </i><br>Write <br>A Recipe
      </a>
    </div>
    <div id="navbar" class="col-md-11">
      <form id="form-search" class="collapse-navbar-search col-md-7 col-no-padding-right" method="get" action="<?php echo base_url();?>search">
        <div class="input-group form-group search-bar-menu">
          <input type="search" id="searchbar" class="form-control input-group-dropdown" name="q" class="typeahead" autocomplete="off" data-provide="typeahead" placeholder="Search Recipe By Title">
          <div class="input-group-btn">
            <div class="btn-group">
              <button type="button" class="btn dropdown-cat-search dropdown-toggle" data-toggle="dropdown" style="border-radius:0">
                Title <span class="caret"></span>
              </button>
              <ul id="listSearch" class="dropdown-menu dropdown-search bullet pull-center">
                <li>
                  <input type="radio" id="ex1_1" value='title' name="searchby" checked>
                    <label for="ex1_1">Title </label>
                </li>
                <li>
                  <input type="radio" id="ex1_2" value='ingredient' name="searchby">
                    <label for="ex1_2">Ingredient </label>
                </li>
                <li>
                  <input type="radio" id="ex1_3" value='account' name="searchby">
                    <label for="ex1_3">Account </label>
                </li>
              </ul>
            </div>
            <span class="btn-group">
              <button class="btn button-default button-group-normal" type="submit" >
                 <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </div>
      </form>
      <div class="col-md-4 col-menu-user mobile-hidden" style="padding-left:30px">
        <div class="col-md-3 link-by-icon text-right" >
          <a href="<?php echo base_url();?>recipe/create" title="New Recipe">
            <i class="fa fa-pencil-square-o fa-2x icon-default"></i>
          </a>
        </div>
        <a href="<?php echo base_url();?>user/timeline" class="col-md-6">
          <div class="col-md-12 hover-menubar text-left" title="Profile">
            <div class="col-md-4 col-no-padding-left col-no-padding-right div-img-profile-menubar text-left">
              <img class="img-circle img-profile-menubar" src="<?php echo base_url();?>{menubar_user_photo}"/>
            </div>
            <div class="col-md-8 col-no-padding text-left" style="line-height:34px">
              {menubar_user_name}
            </div>
          </div>
        </a>
        <div class="col-md-3 text-right col-no-padding-left">
          <a href="<?php echo base_url();?>home/logout">
            <button type="button" class="btn button-default btn-sm">Logout</button>
          </a>
        </div> 
      </div>
    </div><!--/.nav-collapse -->
  </div>
</nav>