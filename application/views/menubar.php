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
        <form class="navbar-form collapse-navbar-search">
          <div class="col-md-1">
          </div>
          <div class="input-group form-group col-md-7 col-xs-12" style="padding-left:20px;">
              <input type="text" class="form-control" placeholder="Search Recipe By Title"/>
              <span class="input-group-btn">
                  <!-- <button class="btn btn-primary" type="submit">
                      <i class="fa fa-search"></i>
                  </button> -->
                  <div class="btn-group">
                    <button id="searchBy" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      Title <span class="caret"></span>
                    </button>
                    <input id="categorySearch" name="categorySearch" class="hidden" value="title">
                    <ul class="dropdown-menu" id="listSearchBy"role="menu">
                      <li class="selectSearch"><a href="#">Title</a></li>
                      <li class="selectSearch"><a href="#">Ingredients</a></li>
                      <li class="selectSearch"><a href="#">Account</a></li>
                    </ul>
                  </div>
                  <button class="btn btn-primary" type="submit" style="width:20px">
                     <i class="fa fa-search"></i>
                  </button>
              </span>
          </div>
          
          <a href="" class="btn-navbar-not-collapse">
            <button class="btn btn-primary" type="button">
              <i class="fa fa-pencil-square-o fa-lg"></i> Write A Recipe
            </button>
          </a>
          <div class="form-group nav-bar-mobile text-center btn-log-nav">
              <div class="btn-group" role="group" aria-label="">
                  <button type="button" class="btn btn-success btn-cus" data-container="body" data-toggle="popover" data-placement="bottom" 
                  data-html="TRUE"
                  data-content="
                    <form id='loginform' class='form-horizontal' role='form' method='post' action='login'>      
                        <div class='input-group'>
                            <span class='input-group-addon'><i class='fa fa-user'></i></span>
                            <input id='login-username' type='text' class='form-control' name='email_user' value='' placeholder='email'>                                        
                        </div><br>        
                        <div class='input-group'>
                                    <span class='input-group-addon'><i class='fa fa-lock'></i></span>
                                    <input id='login-password' type='password' class='form-control' name='password_user' placeholder='password'>
                                </div>
                        <div style='margin-top:10px' class='form-group'>
                            <div class='col-sm-12 controls text-center'>
                              <button id='btn-signin' type='submit' class='btn btn-success'>Login</button>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class='col-md-12 control'>
                                <div style='border-top: 1px solid#888; padding-top:15px; font-size:85%' >
                                    Don't have an account! 
                                <a href='#'>
                                    Sign Up Here
                                </a>
                                </div>
                            </div>
                        </div>    
                    </form>
                  "
                  >
                        Login    
                  </button>
                  <button type="button" class="btn btn-primary btn-cus">    Join    </button>
              </div>
          </div>
        </form>
    </div>
  </ul>
</nav>