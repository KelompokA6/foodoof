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
        <i class="fa fa-pencil-square-o fa-2x icon-default"></i><br>Write <br>A Recipe
      </a>
    </div>
    <div id="navbar">
      <form class="collapse-navbar-search col-md-7 col-no-padding-right" method="get" action="<?php echo base_url();?>search/title">
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
              <button class="btn button-default button-group-normal" type="submit" >
                 <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </div>
      </form>
      <div class="col-md-4 navbar-collapse collapse col-menu-user col-no-padding-right" style="padding-left:20px; width: 380px;">
        <div class="col-md-3 link-by-icon text-right" >
          <a href="<?php echo base_url();?>recipe/create" title="New Recipe">
            <i class="fa fa-pencil-square-o fa-2x icon-default"></i>
          </a>
        </div>
        <div class="col-md-8 col-no-padding-right">
          <div class="btn-group" role="group" aria-label="" style="padding-left: 40px; ">
            <button type="button" class="btn btn-success btn-cus btn-popover" data-container="body" data-toggle="popover" data-placement="bottom" 
            data-html="TRUE"
            data-content="
              <form id='loginform' class='form-horizontal' role='form' method='post' action='<?php echo base_url();?>home/login'>      
                  <div class='input-group'>
                      <span class='input-group-addon'><i class='fa fa-user'></i></span>
                      <input id='login-username' type='text' class='form-control' name='email' value='' placeholder='Email'>                                        
                  </div><br>        
                  <div class='input-group'>
                              <span class='input-group-addon'><i class='fa fa-lock'></i></span>
                              <input id='login-password' type='password' class='form-control' name='password' placeholder='Password'>
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
              <button type="button" class="btn button-default btn-cus">Join</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>