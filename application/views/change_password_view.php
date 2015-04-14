<div class="panel panel-default">
  	<div class="panel-body">
    	<form class="form-horizontal" action="<?php echo base_url();?>index.php/user/changepassword" method="post" enctype="multipart/form-data">
	    	<div class="col-md-12">
	    		<h3 class="page-header"> Change Password</h3>
	    	</div>
	    	<div class="col-md-12">
	    	{change_password_alert}
				<div class="col-md-12">
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-3 control-label">Old Password</label>
					    <div class="col-sm-9">
					      	<input type="password" class="form-control" name="old_password" placeholder="Old Password" required>
					    </div>
					 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-3 control-label">New Password</label>
					    <div class="col-sm-9">
					      	<input type="password" class="form-control" name="new_password" placeholder="New Password" required min-length=4>
					    </div>
					 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>
					    <div class="col-sm-9">
					      	<input type="password" class="form-control" name="confirm_new_password" placeholder="Confirm New Password" required min-length=4>
					    </div>
					 </div>
				</div>
			</div>
			<div class="col-md-12 text-center">
				<button class="btn btn-success btn-lg" type="submit" style="width:150px">
                	Save
              	</button>
			</div>
		</form>
  	</div>
</div>