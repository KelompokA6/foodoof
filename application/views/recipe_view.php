<div class="col-md-12 col-xs-12 page-header-title hr-dashed" style="margin-bottom:10px padding-bottom:0;">
		{recipe_category_entries}
		<div class="col-md-1 col-xs-3 border-right category-recipe-list text-center text-capitalize">
			<a href='<?php echo base_url();?>index.php/recipe/category/{recipe_category}'><h5>{recipe_category}</h5></a>
		</div>
		{/recipe_category_entries}
	</div>
<div class="col-md-12 col-xs-12 col-no-padding">
	<div class="panel panel-default">
	  	<div class="panel-body">
	  		<?php echo $this->session->flashdata('alert-notification');?>
	  		<div class="col-md-12 col-xs-12 col-no-padding-right page-header-title text-capitalize hr-dashed"  style="line-height:33px; font-size:16px;">
	  			<div class="col-md-9 col-xs-12"><h2 style="margin:0">{recipe_name}</h2></div>
	  			<div class="col-md-3 col-xs-12 pull-right col-no-padding text-center" style="bottom:0">
	  				<i class="fa fa-users fa-lg icons-secondary" title="Portion"></i> <span title="Portion">{recipe_portion} Persons</span>   |      
		  			<i class="fa fa-clock-o fa-lg icons-secondary" title="Duration"></i> <span title="Duration">{recipe_duration} Minutes </span>
	  			</div>
	  		</div>	
			<div class="col-md-4 col-xs-12 col-no-padding-left border-solid-bottom" style="margin:10px 0 15px 0; padding-bottom:20px;">
				<div class="col-md-12 col-xs-12 col-no-padding">
					<img src="<?php echo base_url();?>{recipe_photo}" class="img-rounded img-responsive img-recipe" style="margin:auto">
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding text-center">
					<div class="col-md-11 rating-recipe-default" title="Rating">
		          		<input id="rating-recipe" class="rating" data-recipeid="{recipe_id}" <?php if($this->session->userdata('user_id')==''){echo "data-readonly='true'";}?> data-min="0.1" data-max="5" value="{recipe_rating}" data-step="0.1" data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
					</div>
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding text-center" style="margin-bottom:5px">
					<div class="col-md-5 col-xs-6 text-right text-capitalize user-name">
						<a href="<?php echo base_url();?>index.php/user/timeline/{recipe_author_id}" title="{recipe_author_name}">{recipe_author_name}</a>
					</div>
					<div class="col-md-7 col-xs-6 text-left text-capitalize border-dashed-left">
						<i class="fa fa-calendar icons-secondary" title="Last Update"></i>  <span title="Last Update">{recipe_last_update}</span>
					</div>
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding text-center" style="margin-top:5px;">
					<div class="col-md-6 col-xs-6" style="padding-right:5px" title="Add To">
						<button type="button" class="btn button-primary col-md-12 col-xs-12" data-toggle="dropdown" aria-expanded="false">
  							<i class="fa fa-plus pull-left fa-inverse icons btn-add-to"></i>   Add To
  							<i class="caret pull-right" style="color:#eee; margin-top:8px"></i>
  						</button>
			            <ul class="dropdown-menu dropdown-option bullet pull-center" role="menu" aria-labelledby="dropdownMenu1">
			            	<?php if(!empty($this->session->userdata("user_id"))):?>
			              	<li role="presentation" id="add-favorite" data-recipeid="{recipe_id}"><a role="menuitem" tabindex="-1"><i class="fa fa-plus icons"></i> Favorite</a></li>
			              	<li role="presentation" id="add-cook-later" data-recipeid="{recipe_id}"><a role="menuitem" tabindex="-1"><i class="fa fa-plus icons"></i> Cook Later</a></li>
			              	<?php endif;
					      	if(empty($this->session->userdata("user_id"))):?>
					      	<div class="text-center">
					      		Please Login First
					      	</div>
					      	<div class="text-center" style="padding:10px 15px">
					      		<a href="<?php echo base_url();?>index.php/home/login"><button class="btn button-secondary">Login</button></a>
					      	</div>
					  		<?php endif;?>
			            </ul>
					</div>
					<div class="col-md-6 col-xs-6" style="padding-left:5px" title="Print Recipe">
						<a href="<?php echo base_url();?>index.php/recipe/printRecipe/<?php echo $recipe_id?>"><button class="btn button-primary col-md-12 col-xs-12"><i class="fa fa-print pull-left fa-inverse icons"></i>Print Recipe</button></a>
					</div>
				</div>
				<div id="meta">
					<meta property="og:locale" content="ina_ID" />
					<meta property="og:type" content="website" />
					<meta property="og:title" content="{recipe_name}" />
					<meta property="og:description" content="{recipe_description}" />
					<meta property="og:url" content="{URL}" />
					<meta property="og:site_name" content="foodoof" />
					<meta property="og:image" content="<?php echo base_url();?>{recipe_photo}" />
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding text-center" style="margin-top:5px">
					<div class="col-md-6 col-xs-6" style="padding-right:5px" title="Share Recipe">
						<button type="button" class="btn button-primary col-md-12 col-xs-12" data-toggle="dropdown" aria-expanded="false">
  							<i class="fa fa-share-alt pull-left fa-inverse icons btn-add-to"></i>   Share
  							<i class="caret pull-right" style="color:#eee; margin-top:8px"></i>
  						</button>
						<ul class="dropdown-menu dropdown-option bullet pull-center" role="menu" aria-labelledby="dropdownMenu1">

	            <li role="presentation" id="share-fb">
	              <a role="menuitem" class="fb-share" tabindex="-1" href="https://www.facebook.com/sharer/sharer.php?u={URL}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
	                <span class="fa-stack fa-lg fa-stack-lg">
	                  <i class="fa fa-square fa-stack-1x icons-secondary"></i>
	                  <i class="fa fa-facebook fa-stack-1x fa-inverse fa-xs"></i>
	                </span>
	                Facebook
	              </a>
	            </li>

	            <li role="presentation" id="share-twitter">
	              <a role="menuitem" class="twitter-share" tabindex="-1" href="https://twitter.com/intent/tweet?text={recipe_name} on FoodooF &url={URL}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
	                <span class="fa-stack fa-lg fa-stack-lg">
	                  <i class="fa fa-square fa-stack-1x icons-secondary"></i>
	                  <i class="fa fa-twitter fa-stack-1x fa-inverse fa-xs"></i>
	                </span>
	                Twitter
	              </a>
	            </li>

	            <li role="presentation" id="share-gplus">
	              <a role="menuitem" class="gplus-share" tabindex="-1" href="https://plus.google.com/share?url={URL}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
	                <span class="fa-stack fa-lg fa-stack-lg">
	                  <i class="fa fa-square fa-stack-1x icons-secondary"></i>
	                  <i class="fa fa-google-plus fa-stack-1x fa-inverse fa-xs"></i>
	                </span>
	                Google+
	              </a>
	            </li>

			      </ul>
					</div>
					<div class="col-md-6 col-xs-6" style="padding-left:5px" title="Report Recipe">
						<button id="report-btn" class="btn button-primary col-md-12 col-xs-12" role="button" title='Report' data-toggle="popover-x" data-target="#form-report" data-placement="bottom">
							<i class="fa fa-flag pull-left fa-inverse icons"></i>  Report
						</button>
						<div id="form-report" class="popover popover-default">
						    <div class="arrow"></div>
						    <div class="popover-title popover-primary"><span class="close" data-dismiss="popover-x">&times;</span>Report</div>
						    <div class="popover-content">
						    	<?php if(!empty($this->session->userdata("user_id"))):?>
						    	<form id="report-form" role="form" action="<?php echo base_url();?>index.php/home/addReport/{recipe_id}" class="form-horizontal" method="post" enctype="multipart/form-data">
								    <div class="checkbox col-md-12 col-sm-12 col-xs-12 text-left">
							        	<label>
							          		<input type="checkbox" name="report_category[]" value="spam"> SPAM
							        	</label>
							      	</div>
							      	<div class="checkbox col-md-12 col-sm-12 col-xs-12 text-left">
							        	<label>
							          		<input type="checkbox" name="report_category[]" value="advertisement"> Advertisement
							        	</label>
							      	</div>
								    <div class="checkbox col-md-12 col-sm-12 col-xs-12 text-left">
							        	<label>
							          		<input type="checkbox" name="report_category[]" value="pornographic"> Pornographic
							        	</label>
							      	</div>
								    <div class="inputKeeper col-md-12 col-sm-12 col-xs-12 text-left col-no-padding">
										<input id="report-other" type="text" class="form-control" maxlength="254" name="report_other" placeholder="Other">
								    </div>
							      	<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding text-center border-solid-top" style="padding:10px 0;">
							        	<button type="submit" class="btn button-primary">Send Report</button>
							      	</div>
						      	</form>
						      	<?php endif;
						      	if(empty($this->session->userdata("user_id"))):?>
						      	<div class="text-center">
						      		Please Login First
						      	</div>
						      	<div class="text-center" style="padding:10px 15px">
						      		<a href="<?php echo base_url();?>index.php/home/login"><button class="btn button-secondary">Login</button></a>
						      	</div>
						  		<?php endif;?>
						    </div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-xs-12 text-center" style="margin-top:5px" title="Generate Price">
					<button id="generate-price" data-recipeid="{recipe_id}" data-status="0" class="btn button-primary col-md-12 col-xs-12">
						<i class="fa fa-money pull-left fa-inverse icons"></i> Generate Price
					</button>
					<div id="panel-price" class="col-md-12 col-sm-12 col-xs-12" style="display:none; padding:15px 0;">
						<i class="fa fa-spinner fa-pulse"></i>
					</div>
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding" style="margin-top:15px" title="Description Recipe">
	  				<h4 class="page-header-title">Description Recipe</h4>
	  				<div clas="col-md-12 col-xs-12">
						{recipe_description}
	  				</div>
	  			</div>
	  			<div class="col-md-12 col-xs-12 col-no-padding related-recipe" style="margin-top:15px" title="Related Recipe">
	  				<h4 class="page-header-title">Related Recipes</h4>
	  				<div class="carousel-related-recipe left pull-left text-center owl-prev disabled hide">
  						<i class="fa fa-chevron-left" style="line-height:92px"></i>
  					</div>
	  				<div class="col-md-10 col-xs-10 col-no-padding related-recipe-entries">
	  					<div class="col-md-12 col-xs-12 col-no-padding owl-carousel">
	  						{related_recipe_entries}
	  						<div class="col-md-12 col-xs-12 related-recipe-entry item" title="{related_recipe_name}">
								<a href='<?php echo base_url();?>index.php/recipe/get/{related_recipe_id}'>
									<img href='<?php echo base_url();?>index.php/recipe/get/{related_recipe_id}' src="<?php echo base_url();?>{related_recipe_photo}" class="img-responsive col-md-12 col-xs-12 col-no-padding">
									<div class="text-capitalize col-md-12 col-xs-12 col-no-padding related-recipe-entry-name">{related_recipe_name}</div>
								</a>
							</div>
							{/related_recipe_entries}
	  					</div>
	  				</div>
	  				<div class="carousel-related-recipe pull-right right text-center owl-next">
						<i class="fa fa-chevron-right" style="line-height:92px;"></i>
  					</div>
	  			</div>
			</div>
			<div class="col-md-8 col-xs-12" style="margin:10px 0 15px 0;">
				<div class="col-md-12 col-xs-12 col-no-padding">
					<div class="col-md-12 col-xs-12 col-no-padding">
						<h3 style="margin-top:0" class="page-header-title">Ingredients
						<?php if ($this->session->userdata('user_id') == $recipe_author):?>
							<a href='<?php echo base_url();?>index.php/recipe/edit/{recipe_id}' class='pull-right'>
								<button class='btn button-primary'>
									<i class='fa fa-pencil fa-lg'></i>
									Edit
								</button>
							</a>
						<?php endif;?>
						</h3>
					</div>
					<div class="col-md-12 col-xs-12 col-no-padding-right">
						<table class="table table-striped table-hover">
						<?php foreach ($recipe_ingredients as $obj) {?>
							<tr>
								<td class="text-capitalize"> <?php echo $obj['ingre_name'];?>
									<?php if(!empty($obj['ingre_info'])):?>
										<i class="fa fa-info-circle icons-secondary fa-lg info-ingredients-popover" role="button" data-toggle="popover" title="Info Ingredient" data-content=	"<?php echo $obj['ingre_info'];?>" data-trigger="hover"></i>
									<?php endif;?>
								</td>
								<td> <?php echo $obj['ingre_quantity'];?> <?php echo $obj['ingre_units'];?>
								</td>
							</tr>
						<?php }?>
						</table>
					</div>
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding">
					<div class="col-md-12 col-xs-12 col-no-padding">
						<h3 style="margin-top:0" class="page-header-title">Steps</h3>
					</div>
					{recipe_steps}
					<div class="col-md-12 col-xs-12 col-no-padding-right page-header step-entry" style="margin:10px 0">
						<div class="col-md-1 col-xs-1 col-no-padding-right">
							{steps_number}
						</div>
						<div class="col-md-9 col-xs-8 col-no-padding-right">
							{steps_description}
						</div>
						<div class="col-md-2 col-xs-3 col-no-padding-right">
							<a data-toggle="modal" data-target="#step-{steps_number}" style="cursor:pointer;"><img src="<?php echo base_url();?>{steps_photo}" class="img-rounded img-responsive"></a>
							<div id="step-{steps_number}" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							    <div class='lightbox-dialog text-center' style="padding-top:10%;">
							        <div class='lightbox-content'>
							            <img src="<?php echo base_url();?>{steps_photo}">
							            <div class='lightbox-caption'>
							                {steps_description}
							            </div>
							        </div>
							    </div>
							</div>
						</div>
					</div>
					{/recipe_steps}
				</div>
				<div id="comment" class="col-md-12 col-xs-12 border-solid-top">
					<?php if($this->session->userdata('user_id') != ""):?>
					<h4 class="page-header-title">Share Your Thought! <?php if(!empty($comments_recipe_entries)){ echo "(".sizeof($comments_recipe_entries)." Comments)";}?></h4>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-2 col-no-padding-left">
							<img src="<?php echo base_url();?>{user_photo}" class="img-responsive img-circle img-user-comment" title="You">
						</div>
						<div class="col-md-10 col-xs-10 bubble">
							<form id="form-comment" class="form-horizontal" action="<?php echo base_url();?>index.php/recipe/addComment/{recipe_id}" role="form" method="post" style="margin:0">
								<div class="col-md-12 col-xs-12 col-no-padding-right form-group">
									<div class="textareaKeeper col-md-10 col-xs-9 col-no-padding">
									    <textarea id="enter-comment" class="form-control enter-comment" row="1" name="comment" placeholder="Write your comment here..." required></textarea>
									</div>
									<div class="col-md-2 col-xs-3 col-no-padding-right" style="position:absolute; right:0; bottom:0">
										<button type="submit" class="btn button-secondary col-md-12 col-xs-12">Send</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php endif;?>
					{comments_recipe_entries}
					<div class="col-md-12 col-xs-12 comment-entry">
						<div class="col-md-2 col-xs-2 col-no-padding-left">
							<a href="<?php echo base_url();?>index.php/user/timeline/{comment_user_id}">
								<img src="<?php echo base_url();?>{comment_user_photo}" class="img-responsive img-circle img-user-comment" title="{comment_user_name}">
							</a>
						</div>
						<div class="col-md-10 col-xs-10 bubble">
							<div class="col-md-12 col-xs-12 col-no-padding-left comment-value">
								{comment_description}
							</div>
							<div class="col-md-12 col-xs-12 col-no-padding-left comment-time border-dashed-top">
								<a href="<?php echo base_url();?>index.php/user/timeline/{comment_user_id}">{comment_user_name}</a> | <span data-livestamp="{comment_submit}"></span>
							</div>
						</div>
					</div>
					{/comments_recipe_entries}
				</div>
			</div>
		</div>
	</div>
</div>
