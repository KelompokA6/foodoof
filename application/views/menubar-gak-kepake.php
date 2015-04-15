<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
  <div class="navbar-header col-md-1">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a href="<?php echo base_url();?>"><img class="img-responsive pull-left" width="75px"  src="<?php echo base_url();?>assets/img/foodoof.png"/></a>
      <a href="<?php echo base_url();?>index.php/recipe/create" class="pull-right btn-navbar-mobile text-center"><i class="fa fa-pencil-square-o fa-2x"></i><br>Write <br>A Recipe</a>
  </div>
    <!-- /.navbar-header -->

  <ul class="nav navbar-top-links nav navbar-nav navbar-left col-md-11">
    <div class="col-md-12 form-inline inline-search">
        <form class="navbar-form collapse-navbar-search">
          <div class="col-md-1">
          </div>
          <div class="input-group form-group col-md-7" style="padding-left:20px;">
              <input type="text" class="form-control" placeholder="Search Recipe By Title"/>
              <div class="input-group-btn">
                <div class="btn-group" role="group">
                  <select name="category-search" class="form-control btn-info" style="width:120px">
                    <option value="title">Title</option>
                    <option value="ingredients">Ingredients</option>
                    <option value="account">Account</option>
                  </select>
                </div>
                <span class="btn-group" role="group">
                  <button class="btn btn-primary" type="submit" style="width:60px; height:33.9915px">
                     <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
          </div>
          
          <a href="<?php echo base_url();?>recipe/create" class="btn-navbar-not-collapse" style="margin-left:-80px">
            <button class="btn btn-primary" type="button">
              <i class="fa fa-pencil-square-o fa-lg"></i> Write A Recipe
            </button>
          </a>
          <div class="form-group btn-navbar-not-collapse text-center btn-log-nav" style="margin-left:20px">
              <div class="btn-group" role="group" aria-label="">
                  <button type="button" class="btn btn-success btn-cus" data-container="body" data-toggle="popover" data-placement="bottom" 
                  data-html="TRUE"
                  data-content="
                    <form id='loginform' class='form-horizontal' role='form' method='post' action='<?php base_url()?>login'>      
                        <div class='input-group'>
                            <span class='input-group-addon'><i class='fa fa-user'></i></span>
                            <input id='login-username' type='text' class='form-control' name='email' value='' placeholder='email'>                                        
                        </div><br>        
                        <div class='input-group'>
                                    <span class='input-group-addon'><i class='fa fa-lock'></i></span>
                                    <input id='login-password' type='password' class='form-control' name='password' placeholder='password'>
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
                  <a href="<?php base_url()?>user/join">
                    <button type="button" class="btn btn-primary btn-cus">    Join    </button>
                  </a>
              </div>
          </div>
        </form>
    </div>
  </ul>
</nav>