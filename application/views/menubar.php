<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header col-md-1 col-no-padding-right" style="padding-bottom:10px">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a href="<?php echo base_url();?>" class="brand-menubar col-no-padding-left">
        <img class="img-circle img-brand-menubar" width="75px" src="<?php echo base_url();?>assets/img/foodoof.png"/>
      </a>
      <a href="<?php echo base_url();?>recipe/create" class="btn-navbar-mobile pull-right text-center">
        <i class="fa fa-pencil-square-o fa-2x"></i><br>Write <br>A Recipe
      </a>
    </div>
    <div id="navbar">
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
      <div class="col-md-4 navbar-collapse collapse col-menu-user col-no-padding-right" style="padding-left:20px; width: 380px;">
        <div class="col-md-3 link-by-icon text-right" >
          <a href="<?php echo base_url();?>recipe/create" title="New Recipe">
            <i class="fa fa-pencil-square-o fa-2x"></i>
          </a>
        </div>
        <div class="col-md-8 col-no-padding-right">
          <div class="btn-group" role="group" aria-label="" style="padding-left: 40px; ">
            <button type="button" class="btn btn-success btn-cus" data-container="body" data-toggle="popover" data-placement="bottom" 
            data-html="TRUE"
            data-content="
              <form id='loginform' class='form-horizontal' role='form' method='post' action='<?php echo base_url();?>home/login'>      
                  <div class='input-group'>
                      <span class='input-group-addon'><i class='fa fa-user'></i></span>
                      <input id='login-username' type='text' class='form-control' name='email_user' value='' placeholder='Email'>                                        
                  </div><br>        
                  <div class='input-group'>
                              <span class='input-group-addon'><i class='fa fa-lock'></i></span>
                              <input id='login-password' type='password' class='form-control' name='password_user' placeholder='Password'>
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
                          <a href='<?php echo base_url();?>home/forgot-password'>
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
            <a href="<?php echo base_url();?>user/join"  class="btn-group">
              <button type="button" class="btn btn-primary btn-cus">Join</button>
            </a>
          </div>
        </div>
      </div>
      <!-- <div class="col-md-4 navbar-collapse collapse col-menu-user">
        <div class="col-md-2 link-by-icon" >
          <a href="<?php echo base_url();?>recipe/create" class="text-center" title="New Recipe">
            <i class="fa fa-pencil-square-o fa-2x"></i>
          </a>
        </div>
        <div class="btn-group" role="group" aria-label="" style="padding-left: 60px;">
          <button type="button" class="btn btn-success btn-cus" data-container="body" data-toggle="popover" data-placement="bottom" 
          data-html="TRUE"
          data-content="
            <form id='loginform' class='form-horizontal' role='form' method='post' action='<?php echo base_url();?>home/login'>      
                <div class='input-group'>
                    <span class='input-group-addon'><i class='fa fa-user'></i></span>
                    <input id='login-username' type='text' class='form-control' name='email_user' value='' placeholder='Email'>                                        
                </div><br>        
                <div class='input-group'>
                            <span class='input-group-addon'><i class='fa fa-lock'></i></span>
                            <input id='login-password' type='password' class='form-control' name='password_user' placeholder='Password'>
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
                        <a href='<?php echo base_url();?>home/forgot-password'>
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
          <a href="<?php echo base_url();?>user/join"  class="btn-group">
            <button type="button" class="btn btn-primary btn-cus">Join</button>
          </a>
        </div>
      </div> -->
    </div><!--/.nav-collapse -->
  </div>
</nav>