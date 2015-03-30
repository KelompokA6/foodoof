<?php if ($this->session->userdata('user_id')) {
	echo "
		<div class='col-md-12 text-right'>
			<a href='".base_url()."user/edit/{profile_user_id}''>
				<button class='btn btn-primary'>
					<i class='fa fa-pencil-square-o fa-lg'></i>
					Edit
				</button>
			</a>
		</div>
	";
}?>
<div class="col-md-12">
	<h3 class="text-capitalize"> {profile_user_name}</h3>
</div>
<div class="col-md-12">
	<h3 class="text-capitalize"> {profile_user_gender}, {profile_user_age} Years old</h3>
</div>
<div class="col-md-12">
	<div class="col-md-12 col-no-padding-left">
		<div class="col-md-1 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x"></i>
		  <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-no-padding-left">
			<a href="mailto:{profile_user_email}">
				<h5>{profile_user_email}</h5>
			</a>
		</div>
	</div>
	<div class="col-md-12 col-no-padding-left">
		<div class="col-md-1 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x"></i>
		  <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-no-padding-left">
			<h5>{profile_user_phone}</h5>
		</div>
	</div>
	<div class="col-md-12 col-no-padding-left">
		<div class="col-md-1 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x"></i>
		  <i class="fa fa-clock-o fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-no-padding-left">
			<h5>{profile_user_last_access}</h5>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="col-md-12 col-no-padding-left">
		<div class="col-md-1 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x"></i>
		  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-no-padding-left">
			<a href="http://https://twitter.com/{profile_user_twitter}">
				@{profile_user_twitter}
			</a>
		</div>
	</div>
	<div class="col-md-12 col-no-padding-left">
		<div class="col-md-1 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x"></i>
		  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-no-padding-left">
			<a href="#">
				{profile_user_facebook}
			</a>
		</div>
	</div>
	<div class="col-md-12 col-no-padding-left">
		<div class="col-md-1 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x"></i>
		  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-no-padding-left">
			<a href="#">
				{profile_user_googleplus}
			</a>
		</div>
	</div>
	<div class="col-md-12 col-no-padding-left">
		<div class="col-md-1 col-no-padding-left">
			<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x"></i>
		  <i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
		</span>
		</div>
		<div class="col-md-11 col-no-padding-left">
			<a href="#">
				{profile_user_path}
			</a>
		</div>
	</div>
	<div class="col-md-12 col-no-padding-left">
		<div class="col-md-1 col-no-padding-left">
		</div>
		<div class="col-md-11 col-no-padding-left">
		</div>
	</div>
</div>