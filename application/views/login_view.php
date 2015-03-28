<html>
<head>
  <title>Template View for Foodoof</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap-theme.css">
  <link href="/foodoof/assets/plugin/bower-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
	  <div class="navbar-header col-md-2">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	      </button>
	      <a href="" class="brand-menubar">
	      	<img class="img-circle img-brand-menubar" width="50px" src="<?php echo base_url();?>assets/img/foodoof.png"/>
	      </a>
	      <a href="" class="pull-right btn-navbar-mobile text-center"><i class="fa fa-pencil-square-o fa-2x"></i><br>Write <br>A Recipe</a>
	  </div>
	  <ul class="nav navbar-top-links nav navbar-nav navbar-left col-md-10">
	    <div class="col-md-12 form-inline inline-search col-menubar">
	        <form class="navbar-form collapse-navbar-search">
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
	          		<a href="" class="text-center" title="New Recipe">
		            	<i class="fa fa-pencil-square-o fa-2x"></i>
		          	</a>
	          	</div>
	            <a href="user/profile">
	            	<div class="col-md-4 hover-menubar text-left" title="Profile">
		            	<div class="col-md-6 col-no-padding-left col-no-padding-right div-img-profile-menubar">
		            		<img class="img-circle img-profile-menubar" src="<?php echo base_url();?>assets/img/01.jpg"/>
		            	</div>
			            <div class="col-md-6 col-no-padding" style="line-height:34px">
			            	Abid
			            </div>
		            </div>
	            </a>
	            <div class="col-md-2 col-offset-md-2">
	            	<button type="button" class="btn btn-danger btn-sm">Logout</button>
	            </div>
	           	
	          </div>
	        </form>
	    </div>
	  </ul>
	</nav>
	<div class="container container-mobile">
      <div class="row">
      	<div class="col-md-12">
      		<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
	            <div class="panel panel-info" >
	                <div class="panel-heading">
	                    <div class="panel-title">Sign In</div>
	                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="forgetpassword">Forgot password?</a></div>
	                </div>     

	                <div style="padding-top:30px" class="panel-body" >

	                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
	                        
	                    <form id="loginform" class="form-horizontal" role="form" method="post" action="login">
	                                
	                        <div style="margin-bottom: 25px" class="input-group">
	                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	                            <input id="login-username" type="text" class="form-control" name="email_user" value="" placeholder="email">                                        
	                        </div>        
	                        <div style="margin-bottom: 25px" class="input-group">
	                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                                    <input id="login-password" type="password" class="form-control" name="password_user" placeholder="password">
	                                </div>
	                        <div class="input-group">
	                            <div class="checkbox">
	                                <label>
	                                  <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
	                                </label>
	                              </div>
	                            </div>
	                        <div style="margin-top:10px" class="form-group">
	                            <!-- Button -->

	                            <div class="col-sm-12 controls">
	                              <button id="btn-signin" type="submit" class="btn btn-success">Login  </button>
	                              <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="col-md-12 control">
	                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
	                                    Don't have an account! 
	                                <a href="#" onClick="$('#loginbox').hide(); $('#forgetbox').hide(); $('#signupbox').show()">
	                                    Sign Up Here
	                                </a>
	                                </div>
	                            </div>
	                        </div>    
	                    </form>     
	                </div>                     
	            </div>  
	        </div>
     	</div>
      </div>
    </div>
</body>
</html>
