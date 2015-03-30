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
              <div class="btn-group" role="group" aria-label="" style="padding-left: 40px;">
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
          </form>
      </div>
    </ul>
  </nav>