<nav class="navbar navbar-default navbar-fixed-top" style="background:#CC211F;">
  <div class="container">
    <div class="navbar-header col-md-1 col-no-padding-right" style="padding-bottom:10px">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a href="<?php echo base_url();?>index.php" class="brand-menubar col-no-padding-left">
        <img class="img-circle img-brand-menubar" width="75px" src="<?php echo base_url();?>assets/img/foodoof.png" style="padding-top: 5px;"/>
      </a>
      <a href="<?php echo base_url();?>index.php/recipe/create" class="btn-navbar-mobile pull-right text-center">
        <i class="fa fa-pencil-square-o fa-2x icon-default"></i><br>Write <br>A Recipe
      </a>
    </div>
    <div id="navbar">
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
        <div class="col-md-3 link-by-icon text-right" >
          <a id="createRecipeMenubar" title="New Recipe">
            <i class="fa fa-pencil-square-o fa-2x icon-default"></i>
          </a>
        </div>
        <div class="col-md-8 col-no-padding-right">
          <div class="btn-group" role="group" aria-label="" style="padding-left: 40px; ">
            <button type="button" class="btn btn-success btn-cus btn-popover" data-container="body" data-toggle="popover" data-placement="bottom" 
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