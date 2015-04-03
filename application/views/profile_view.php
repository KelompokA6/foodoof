<?php if ($this->session->userdata('user_id') == $profile_user_id) {
	echo "
		<div class='col-md-12 text-right'>
			<a href='".base_url()."user/edit'>
				<button class='btn btn-primary'>
					<i class='fa fa-pencil fa-lg'></i>
					Edit
				</button>
			</a>
		</div>
	";
}?>
<div class="col-md-12 col-xs-12">
	<h3 class="text-capitalize"> {profile_user_name}</h3>
</div>
<div class="col-md-12 col-xs-12">
	<h3 class="text-capitalize"> {profile_user_gender}, {profile_user_age} Years old</h3>
</div>
<div class="col-md-12 col-xs-12">
	<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
		<div class="col-md-1 col-xs-2 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
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
		<div class="col-md-1 col-xs-2 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-xs-10 col-no-padding-left">
			<h4>{profile_user_phone}</h4>
		</div>
	</div>
	<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
		<div class="col-md-1 col-xs-2 col-no-padding-left">
			<span class="fa-stack fa-lg">
			  	<i class="fa fa-square fa-stack-2x icon-default"></i>
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
		<div class="col-md-1 col-xs-2 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-xs-10 col-no-padding-left">
			<a href="http://https://twitter.com/{profile_user_twitter}">
				<h4>@{profile_user_twitter}</h4>
			</a>
		</div>
	</div>
	<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
		<div class="col-md-1 col-xs-2 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-xs-10 col-no-padding-left">
			<a href="#">
				<h4>{profile_user_facebook}</h4>
			</a>
		</div>
	</div>
	<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
		<div class="col-md-1 col-xs-2 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-xs-10 col-no-padding-left">
			<a href="#">
				<h4>{profile_user_googleplus}</h4>
			</a>
		</div>
	</div>
	<div class="col-md-12 col-xs-12 col-no-padding-left profile-info">
		<div class="col-md-1 col-xs-2 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
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