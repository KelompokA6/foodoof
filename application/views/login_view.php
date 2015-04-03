<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Sign In</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="<?php echo base_url();?>user/forgotpassword">Forgot password?</a></div>
        </div>     

        <div style="padding-top:30px" class="panel-body" >
                {login_alert}
            <form id="loginform" class="form-horizontal" role="form" method="post" action="login">
                        
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="login-username" type="text" class="form-control" name="email" value="{email}" placeholder="Email">                                        
                </div>        
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                </div>	
                <div style="margin-top:10px" class="form-group">
                    <!-- Button -->

                    <div class="col-sm-12 controls">
                      <button id="btn-signin" type="submit" class="btn btn-success">Login  </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account! 
                        <a href="<?php echo base_url();?>user/join">
                            Join Here
                        </a>
                        </div>
                    </div>
                </div>    
            </form>     
        </div>                     
    </div>  
</div>