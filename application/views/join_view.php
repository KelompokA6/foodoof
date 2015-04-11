<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Join Us</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a href="<?php echo base_url();?>home/login">Login</a></div>
        </div>  
        <div class="panel-body" >
            {join_alert}
            <form id="signupform" class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>user/join">
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="{email}" required>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="firstname" class="col-md-3 control-label">Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="name" placeholder="Your Name" value="{name}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-md-3 control-label">Gender</label>
                    <div class="col-md-9">
                        <label class="radio-inline">
                          <input type="radio" name="genderOptions" id="inlineRadio1" value="F" {checked_female}> Female
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="genderOptions" id="inlineRadio2" value="M" {checked_male}> Male
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" placeholder="Password" required min-length=4>
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Retype Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Retype Password" required min-length=4>
                    </div>
                </div>

                <div class="form-group">                                        
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Join &nbsp</button> 
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>