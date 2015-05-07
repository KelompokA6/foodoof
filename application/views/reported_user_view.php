<form class="form-horizontal" action="<?php echo base_url();?>index.php/admin/banneduser" method="post" enctype="multipart/form-data">
	<div class="col-md-12 col-xs-12 col-no-padding">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php
					echo $this->session->flashdata('alert-admin');
				?>
				<h3 class="page-header-title"> Reported User </h3>
				{reported_user_entries}
				<div class="col-md-12 col-xs-12 col-sm-12 border-solid-bottom" style="padding:5px 0">
					<label class=" col-md-9 col-xs-9 col-sm-3 control-label text-left">
			      		<input type="checkbox" class="col-md-1 col-xs-1 col-sm-1 checkboxuser" name= 'id_reported[]' value='{report_user_id}' {highlight_checked}>
				      	<div class="col-md-1 col-xs-2 col-sm-1 col-no-padding">
							<img src="<?php echo base_url();?>{reported_user_photo}" class="img-responsive img-rounded img-report">
						</div>
						<div class="col-md-8 col-xs-8 col-sm-8 col-no-padding user-report text-left">
							{reported_user_name}
						</div>
			    	</label>
					<div class="col-md-3 col-xs-3 col-sm-3" style="padding-top:7px">
						<div class="btn button-secondary details-button">Details <i class="fa fa-chevron-right"></i></div>
					</div>
					<div class='col-md-offset-1 col-md-11 col-xs-11 col-sm-11 details-reported' style='padding:5px 0 5px 44px'>
				        <ul class="list-group">
				        	{reported_recipe_entries}
				          	<li class="col-md-12 col-sm-12 col-xs-12 col-no-padding">
				            	<div class="col-md-4 col-xs-4 col-sm-4 col-no-padding">
				              		{reported_recipe_name}
				            	</div>
				            	<div class="col-md-8 col-xs-8 col-sm-8 col-no-padding-right">
				              		<div class="col-md-2 col-xs-2 col-sm-2 col-no-padding">
				              			Advertisement : {reported_recipe_count_ads},
				              		</div>
				              		<div class="col-md-2 col-xs-2 col-sm-2 col-no-padding">
				              			Pornographic : {reported_recipe_count_porn},
				              		</div>
				              		<div class="col-md-2 col-xs-2 col-sm-2 col-no-padding">
				              			SPAM : {reported_recipe_count_spam},
				              		</div>
				              		<div class="col-md-2 col-xs-2 col-sm-2 col-no-padding">
				              			Other : <?php if($reported_recipe_count_other > 0):?>
				              			<span role="button" title='Report' data-toggle="popover-x" data-target="#details-other" data-placement="bottom" title="details">
				              				$reported_recipe_count_other
				              			</span>
				              			<div id="details-other" class="popover popover-default">
										    <div class="arrow"></div>
										    <div class="popover-title popover-primary"><span class="close" data-dismiss="popover-x">&times;</span>Report</div>
										    <div class="popover-content details-other">
										    	<ul class="list-group">
										    		{reported_recipe_other_entries}
										    		<li>
										    			{reported_recipe_other_detail}
										    		</li>
										    		{/reported_recipe_other_entries}
										    	</ul>
										    </div>
									    </div>
									    <?php endif;?> 
				              		</div>
				            	</div>
				          	</li>
				          	{/reported_recipe_entries}
				        </ul>
			      	</div>
			    </div>
			    {/reported_user_entries}
			</div>
		</div>
	</div>	
</form>