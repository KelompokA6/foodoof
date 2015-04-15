<div class="panel panel-default">
  	<div class="panel-body">
  		<form class="form-horizontal" action="<?php echo base_url();?>index.php/user/edit" method="post" enctype="multipart/form-data">
	    	<div class="col-md-12">
	    		<h3 class="page-header"> Edit Profile</h3>
	    		<?php echo $this->session->flashdata('alert-notification');?>
	    	</div>
	    	<div class="col-md-12">
	    	{edit_profile_alert}
				<h4>Personal Information</h4>
				<div class="col-md-12" style="margin-bottom:15px;">
					<input id="photo-profile" name="photo-user" type="file" multiple='false' data-src="<?php echo base_url()?>{edit_profile_photo}" class="file-loading" data-id='{edit_profile_id}' data-title="{edit_profile_title}" accept="image/*" >
				</div>
				<div class="col-md-12">
					<div class="form-group">
					   <label for="inputemail" class="col-sm-2 control-label">Email</label>
					   <div class="col-sm-10">
					     	<input type="text" disabled="disabled" class="form-control" value="{edit_profile_email}" required>
					   </div>
					</div>
					<div class="form-group">
					    <label for="inputname" class="col-sm-2 control-label">Name</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control form-profile" name="user_name" value="{edit_profile_name}" placeholder="Your Name" required>
					    </div>
					 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label for="inputgender" class="col-sm-2 control-label">Gender</label>
					    <div class="col-sm-10">
					      	<label class="radio-inline">
							  	<input type="radio" id="inlineRadio1" value="M" {edit_profile_male} disabled required>Male
							</label>
							<label class="radio-inline">
							  	<input type="radio" id="inlineRadio2" value="F" {edit_profile_female} disabled required>Female
							</label>
					    </div>
					 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label for="inputphone" class="col-sm-2 control-label">Phone</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control form-profile" name="user_phone" value="{edit_profile_phone}" placeholder="Your Phone Number">
					    </div>
					 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label for="inputbirth" class="col-sm-2 control-label">Birthdate</label>
					    <div class="col-sm-10">
					      	<input type="date" class="form-control form-profile" name="user_bdate" value="{edit_profile_birth_date}" placeholder="Your Birth Day" required>
					    </div>
					 </div>
				</div>
			</div>
			<div class="col-md-12">
				<h4>Social Media</h4>
				<div class="col-md-12">
					<div class="form-group">
					    <label class="col-sm-2 control-label">
						    <div class="col-no-padding-left">
	      						<span class="fa-stack fa-lg">
								  <i class="fa fa-square fa-stack-2x icon-default"></i>
								  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
								</span>
	      					</div>
	      				</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control input-lg form-profile" name="user_twitter" value="{edit_profile_twitter}" placeholder="@ Your Twitter">
					    </div>
					 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label class="col-sm-2 control-label">
						    <div class="col-no-padding-left">
	      						<span class="fa-stack fa-lg">
								  <i class="fa fa-square fa-stack-2x icon-default"></i>
								  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
								</span>
	      					</div>
	      				</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control input-lg form-profile" name="user_facebook" value="{edit_profile_facebook}" placeholder="Your Facebook">
					    </div>
					 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label class="col-sm-2 control-label">
						    <div class="col-no-padding-left">
	      						<span class="fa-stack fa-lg">
								  <i class="fa fa-square fa-stack-2x icon-default"></i>
								  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
								</span>
	      					</div>
	      				</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control input-lg form-profile" name="user_gplus" value="{edit_profile_google_plus}" placeholder="Your g+">
					    </div>
					 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label class="col-sm-2 control-label">
						    <div class="col-no-padding-left">
	      						<span class="fa-stack fa-lg">
								  <i class="fa fa-square fa-stack-2x icon-default"></i>
								  <i class="el el-path fa-stack-1x fa-inverse"></i>
								</span>
	      					</div>
	      				</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control input-lg form-profile" name="user_path" value="{edit_profile_path}" placeholder="Your Path">
					    </div>
					 </div>
				</div>
			</div>
			<div class="col-md-12 text-center">
				<button class="btn button-default btn-lg" type="submit" style="width:150px">
                	Save
              	</button>
			</div>
		</form>
  	</div>
</div>