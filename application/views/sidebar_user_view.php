<div class="col-md-12 col-no-padding-left text-center">
	<a href="<?php echo base_url();?>user/profile/{sidebar_user_id}"><img src="<?php echo base_url();?>{sidebar_user_photo}" class="img-responsive img-rounded"/></a>
</div>
<div class="col-md-12 col-no-padding-left" style="margin-top:10px">
	<div class="list-group">
  	<a href="<?php echo base_url();?>user/profile/{sidebar_user_id}" class="list-group-item" title="Profile">
	    <span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-user fa-stack-1x fa-inverse"></i>
		</span>
		Profile
  	</a>
  	<a href="<?php echo base_url();?>user/timeline/{sidebar_user_id}" class="list-group-item" title="My Recipe">
	  	<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-cutlery fa-stack-1x fa-inverse"></i>
		</span>
		My Recipe
	</a>
  	<a href="<?php echo base_url();?>user/favorite/{sidebar_user_id}" class="list-group-item disabled" title="Favorite Recipe">
  		<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
		</span>
		Favorite
  	</a>
  	<a href="<?php echo base_url();?>user/cooklater/{sidebar_user_id}" class="list-group-item disabled" title="Cook Later">
  		<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-list-alt fa-stack-1x fa-inverse"></i>
		</span>
		Cook Later
  	</a>
  	<a href="<?php echo base_url();?>user/changepassword" class="list-group-item" title="Change Password">
  		<span class="fa-stack fa-lg">
		  <i class="fa fa-square fa-stack-2x icon-default"></i>
		  <i class="fa fa-key fa-stack-1x fa-inverse"></i>
		</span>
		Change Password
  	</a>
</div>
</div>
