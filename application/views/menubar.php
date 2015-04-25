<div class="navmenu navmenu-default navmenu-fixed-left offcanvas bg-sidemenu" role="navigation">
  <div class="col-xs-12 text-center page-header-title">
    <a href="<?php echo base_url();?>index.php" class="brand-menubar col-no-padding-left">
      <img class="img-circle img-brand-menubar" width="75px" src="<?php echo base_url();?>assets/img/foodoof.png" style="padding-top: 5px;"/>
    </a>  
  </div>
  <div id="btn-group-slide-menu" class="col-xs-12 text-center col-no-padding">
    <div class="col-xs-12">
      <form id='loginform-slide-menu' class='form-horizontal hidden' role='form' method='post' action='<?php echo base_url();?>index.php/home/login'>      
        <div class='input-group'>
            <span class='input-group-addon button-default'><i class='fa fa-user'></i></span>
            <input id='login-username' type='text' class='form-control' name='email' value='' placeholder='Email' required>                                        
        </div><br>        
        <div class='input-group'>
                    <span class='input-group-addon button-default'><i class='fa fa-lock'></i></span>
                    <input id='login-password' type='password' class='form-control' name='password' placeholder='Password' required>
                </div>
        <div style='margin-top:10px' class='form-group'>
            <div class='col-sm-12 controls text-center'>
              <button id='btn-signin' type='submit' class='btn btn-success'>Login</button>
            </div>
        </div>
        <div class='form-group'>
            <div class='col-md-12 control'>
                <div class="border-solid-top" style='padding-top:15px; font-size:85%; color:#000'>
                    Forgot password? 
                <a href='<?php echo base_url();?>index.php/user/forgotpassword'>
                    Remember Here
                </a>
                </div>
            </div>
        </div>    
      </form>
    </div>
    <div class="btn-group col-xs-12" role="group">
      <button type="button" class="btn btn-success btn-cus" id="btn-login-slide-menu" style="width:120px">Login</button>
      <a id="btn-join-slide-menu" href="<?php echo base_url();?>index.php/user/join" class="btn-group">
        <button type="button" class="btn button-default" style="width:120px">Join</button>
      </a>
    </div>
  </div>
</div>
<nav class="navbar navbar-default navbar-fixed-top bg-foodoof">
  <div class="container">
    <div class="navbar-header col-md-2 col-no-padding-right" style="padding-bottom:10px">
      <button type="button" class="navbar-toggle navbar-toggle-foodoof" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" data-placement='left' style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar icon-default"></span>
          <span class="icon-bar icon-default"></span>
          <span class="icon-bar icon-default"></span>
      </button>
      <a href="<?php echo base_url();?>index.php" class="brand-menubar col-no-padding-left col-md-12 col-xs-9">
        <img class="img-responsive img-brand-menubar" src="<?php echo base_url();?>assets/img/foodoof.png" style="padding-top: 12px;"/>
      </a>
      <a href="<?php echo base_url();?>index.php/recipe/create" class="btn-navbar-mobile pull-right text-center">
        <i class="fa fa-pencil-square-o fa-2x icon-default"></i><br>Write <br>A Recipe
      </a>
    </div>
    <div id="navbar" class="col-md-10">
      <form id="form-search" class="collapse-navbar-search col-md-7 col-no-padding-right" method="get" action="<?php echo base_url();?>index.php/search">
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
      <div class="col-md-4 navbar-collapse collapse col-menu-user col-no-padding-right" style="padding-left:20px; width: 380px;">
        <div class="col-md-2">
        </div>
        <div class="col-md-2 link-by-icon text-center" >
          <a id="createRecipeMenubar" title="New Recipe">
            <i class="fa fa-pencil-square-o fa-2x icon-default" style="cursor:pointer"></i>
          </a>
        </div>
        <div class="col-md-8 col-no-padding-right">
          <div class="btn-group" role="group" aria-label="" style="padding-left: 40px; ">
            <button type="button" class="btn btn-default-theme3 btn-cus btn-popover" data-container="body" data-toggle="popover" data-placement="bottom" 
            data-html="TRUE"
            data-content="
              <form id='loginform' class='form-horizontal' role='form' method='post' action='<?php echo base_url();?>index.php/home/login'>      
                  <div class='input-group'>
                      <span class='input-group-addon button-default'><i class='fa fa-user'></i></span>
                      <input id='login-username' type='text' class='form-control' name='email' value='' placeholder='Email' required>                                        
                  </div><br>        
                  <div class='input-group'>
                              <span class='input-group-addon button-default'><i class='fa fa-lock'></i></span>
                              <input id='login-password' type='password' class='form-control' name='password' placeholder='Password' required>
                          </div>
                  <div style='margin-top:10px' class='form-group'>
                      <div class='col-sm-12 controls text-center'>
                        <button id='btn-signin' type='submit' class='btn btn-success'>Login</button>
                      </div>
                  </div>
                  <div class='form-group'>
                      <div class='col-md-12 control'>
                          <div style='border-top: 1px solid#888; padding-top:15px; font-size:85%' >
                              Forgot password? 
                          <a href='<?php echo base_url();?>index.php/user/forgotpassword'>
                              Remember Here
                          </a>
                          </div>
                      </div>
                  </div>    
              </form>
            "
            >
            Login    
            </button>
            <a href="<?php echo base_url();?>index.php/user/join"  class="btn-group">
              <button type="button" class="btn button-default btn-cus">Join</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>