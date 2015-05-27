<div class="panel panel-default">
	<div class="panel-body">
		<?php if ($this->session->userdata('user_id') == $profile_user_id): ?>
			<div class='col-md-12 col-xs-12 text-right' title="edit">
				<a href='<?php echo base_url();?>index.php/user/edit'>
					<button class='btn button-secondary'>
						<i class='fa fa-pencil fa-lg'></i>
						Edit
					</button>
				</a>
			</div>
		<?php endif;?>
		<div class="col-md-12 col-xs-12">
			<h3 class="text-capitalize"> {profile_user_name}</h3>
		</div>
		<div class="col-md-12 col-xs-12">
			<h3 class="text-capitalize"> {profile_user_gender}, {profile_user_age}</h3>
		</div>
		<div class="col-md-12 col-xs-12">
			<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
				<div class="col-md-1 col-xs-2 col-no-padding-left" title="Email">
					<span class="fa-stack fa-lg">
				  <i class="fa fa-square fa-stack-2x icons-secondary"></i>
				  <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
				</span>
				</div>
				<div class="col-md-11 col-xs-10 col-no-padding-left">
					<a href="mailto:{profile_user_email}">
						<h4>{profile_user_email}</h4>
					</a>
				</div>
			</div>
			<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
				<div class="col-md-1 col-xs-2 col-no-padding-left" title="Phone Number">
					<span class="fa-stack fa-lg">
				  <i class="fa fa-square fa-stack-2x icons-secondary"></i>
				  <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
				</span>
				</div>
				<div class="col-md-11 col-xs-10 col-no-padding-left">
					<h4>{profile_user_phone}</h4>
				</div>
			</div>
			<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
				<div class="col-md-1 col-xs-2 col-no-padding-left" title="Birth Date">
					<span class="fa-stack fa-lg">
				  <i class="fa fa-square fa-stack-2x icons-secondary"></i>
				  <i class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i>
				</span>
				</div>
				<div class="col-md-11 col-xs-10 col-no-padding-left">
					<h4>{profile_user_bdate}</h4>
				</div>
			</div>
			<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
				<div class="col-md-1 col-xs-2 col-no-padding-left" title="Last Access">
					<span class="fa-stack fa-lg">
					  	<i class="fa fa-square fa-stack-2x icons-secondary"></i>
					  	<i class="fa fa-clock-o fa-stack-1x fa-inverse"></i>
					</span>
				</div>
				<div class="col-md-11 col-xs-10 col-no-padding-left">
					<h4>{profile_user_last_access}</h4>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-xs-12">
			<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
				<div class="col-md-1 col-xs-2 col-no-padding-left" title="Twitter">
					<span class="fa-stack fa-lg">
				  <i class="fa fa-square fa-stack-2x icons-secondary"></i>
				  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
				</span>
				</div>
				<div class="col-md-11 col-xs-10 col-no-padding-left">
					<a href="https://twitter.com/{profile_user_twitter}">
						<h4>{profile_user_twitter}</h4>
					</a>
				</div>
			</div>
			<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
				<div class="col-md-1 col-xs-2 col-no-padding-left" title="Facebook">
					<span class="fa-stack fa-lg">
				  <i class="fa fa-square fa-stack-2x icons-secondary"></i>
				  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
				</span>
				</div>
				<div class="col-md-11 col-xs-10 col-no-padding-left">
					<a href="https://facebook.com/{profile_user_facebook}">
						<h4>{profile_user_facebook}</h4>
					</a>
				</div>
			</div>
			<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
				<div class="col-md-1 col-xs-2 col-no-padding-left" title="Google+">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-square fa-stack-2x icons-secondary"></i>
					  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
					</span>
				</div>
				<div class="col-md-11 col-xs-10 col-no-padding-left">
					<a href="https://plus.google.com/{profile_user_googleplus}">
						<h4>{profile_user_googleplus}</h4>
					</a>
				</div>
			</div>
			<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
				<div class="col-md-1 col-xs-2 col-no-padding-left" title="Path">
					<span class="fa-stack fa-lg">
				  <i class="fa fa-square fa-stack-2x icons-secondary"></i>
				  <i class="el el-path fa-stack-1x fa-inverse" style="padding: 8px;"></i>
				</span>
				</div>
				<div class="col-md-11 col-xs-10 col-no-padding-left">
					<a href="#">
						<h4>{profile_user_path}</h4>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>