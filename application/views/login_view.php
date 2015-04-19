<div id="loginbox" style="margin-top:20px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
    <div class="panel" >
        <div class="panel-home-title panel-heading col-md-12 col-xs-12" style="margin-bottom:15px;">
            <div class="panel-title col-md-2 col-xs-4">Login</div>
            <div class="panel-title col-md-4 col-xs-8 pull-right text-right"><a href="<?php echo base_url();?>index.php/user/forgotpassword" style="color:#fff">Forgot password?</a></div>
        </div>     
        <div style="padding-top:30px" class="panel-body" >
                {login_alert}
            <form id="loginform" class="form-horizontal" role="form" method="post" action="login">
                        
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon button-default"><i class="fa fa-user"></i></span>
                    <input id="login-username" type="text" class="form-control" name="email" value="{email}" placeholder="Email" required>                                        
                </div>        
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon button-default"><i class="fa fa-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="Password" required>
                </div>	
                <div style="margin-top:10px" class="form-group">
                    <!-- Button -->

                    <div class="col-sm-12 controls text-center">
                      <button id="btn-signin" type="submit" class="btn button-default">Login  </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account! 
                        <a href="<?php echo base_url();?>index.php/user/join">
                            Join Here
                        </a>
                        </div>
                    </div>
                </div>    
            </form>     
        </div>                     
    </div>  
</div>