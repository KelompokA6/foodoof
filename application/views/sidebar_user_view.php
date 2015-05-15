<div class="col-md-12 col-no-padding-left text-center">
	<a href="<?php echo base_url();?>index.php/user/profile/{sidebar_user_id}"><img style="margin:auto;" src="<?php echo base_url();?>{sidebar_user_photo}" class="img-responsive img-rounded img-user"/></a>
</div>
<div class="col-md-12 col-no-padding-left" style="margin-top:10px">
	<div class="list-group">
	  	<a href="<?php echo base_url();?>index.php/user/profile/{sidebar_user_id}" class="list-group-item" title="Profile">
		    <span class="fa-stack fa-lg">
			  <i class="fa fa-square fa-stack-2x icons-default"></i>
			  <i class="fa fa-user fa-stack-1x fa-inverse"></i>
			</span>
			Profile
	  	</a>
	  	<a href="<?php echo base_url();?>index.php/user/timeline/{sidebar_user_id}" class="list-group-item" title="Recipe List">
		  	<span class="fa-stack fa-lg">
			  <i class="fa fa-square fa-stack-2x icons-default"></i>
			  <i class="fa fa-cutlery fa-stack-1x fa-inverse"></i>
			</span>
			Recipes
		</a>
	  	<a href="<?php echo base_url();?>index.php/user/favorite/{sidebar_user_id}" class="list-group-item" title="Favorite Recipe">
	  		<span class="fa-stack fa-lg">
			  <i class="fa fa-square fa-stack-2x icons-default"></i>
			  <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
			</span>
			Favorite
	  	</a>
	  	<?php if($this->session->userdata('user_id') == $sidebar_user_id): ?>
	  	<a class="list-group-item disabled" title="Cook Later">
	  		<span class="fa-stack fa-lg">
			  <i class="fa fa-square fa-stack-2x icons-default"></i>
			  <i class="fa fa-list-alt fa-stack-1x fa-inverse"></i>
			</span>
			Cook Later
	  	</a>
	  	<?php endif; ?>
	  	<?php if($this->session->userdata('user_id') == $sidebar_user_id): ?>
	  		<a href='<?php echo base_url();?>index.php/user/changepassword' class='list-group-item' title='Change Password'>
			  		<span class='fa-stack fa-lg'>
					  <i class='fa fa-square fa-stack-2x icons-default'></i>
					  <i class='fa fa-key fa-stack-1x fa-inverse'></i>
					</span>
					Change Password
			  	</a>
		<?php endif; ?>
		<?php if($this->session->userdata('user_id')!='' && strtolower($sidebar_user_status_profile)==='admin' && strtolower($sidebar_user_status_admin)==='admin'): ?>
	  		<a href='<?php echo base_url();?>index.php/admin' class='list-group-item' title='Admin Page'>
			  		<span class='fa-stack fa-lg'>
					  <i class='fa fa-square fa-stack-2x icons-default'></i>
					  <i class='fa fa-gear fa-stack-1x fa-inverse'></i>
					</span>
					Admin Page
			  	</a>
		<?php endif; ?>
	</div>
</div>
