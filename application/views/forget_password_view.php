<div id="forgetbox" style="margin-top:20px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Forgot Password</div>
        </div>     

        <div style="padding-top:30px" class="panel-body" >
            {forget_password_alert}                
            <form id="loginform" class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>index.php/user/forgotpassword">
                        
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon button-default"><i class="fa fa-user"></i></span>
                    <input id="login-username" type="text" class="form-control" name="email_user" value="" placeholder="Email" required>                                        
                </div>        
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls text-center">
                      <button id="btn-signin" type="submit" class="btn button-default">Send My Password </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account! 
                        <a href="<?php echo base_url();?>index.php/user/join" >
                            Join Here
                        </a>
                        </div>
                    </div>
                </div>    
            </form>     
        </div>                     
    </div>  
</div>
