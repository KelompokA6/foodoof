<div class="col-md-12 col-xs-12 page-header-title hr-dashed" style="margin-bottom:10px padding-bottom:0;">
		{recipe_category_entries}
		<div class="col-md-1 col-xs-3 border-right category-recipe-list text-center text-capitalize category-recipe-list">
			<a href='<?php echo base_url();?>index.php/recipe/category/{recipe_category}'><h5>{recipe_category}</h5></a>
		</div>
		{/recipe_category_entries}
	</div>
<div class="col-md-12 col-xs-12 col-no-padding">
	<div class="panel panel-default">
	  	<div class="panel-body">
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
		          		<input id="rating-recipe" class="rating" data-recipeId="{recipe_id}" <?php if($this->session->userdata('user_id')==''){echo "data-readonly='true'";}?> data-min="0" data-max="5" value="{recipe_rating}" data-step="0.1" data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
					</div>
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding text-center" style="margin-bottom:5px">
					<div class="col-md-5 col-xs-6 text-right text-capitalize">
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
			              <li role="presentation" id="add-favorite"><a role="menuitem" tabindex="-1"><i class="fa fa-plus icons"></i> Favorite</a></li>
			              <li role="presentation" id="add-cook-later"><a role="menuitem" tabindex="-1"><i class="fa fa-plus icons"></i> Cook Later</a></li>
			            </ul>
					</div>
					<div class="col-md-6 col-xs-6" style="padding-left:5px" title="Print Recipe">
						<button class="btn button-primary col-md-12 col-xs-12"><i class="fa fa-print pull-left fa-inverse icons"></i>Print Recipe</button>
					</div>
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding text-center" style="margin-top:5px">
					<div class="col-md-6 col-xs-6" style="padding-right:5px" title="Share Recipe">
						<button type="button" class="btn button-primary col-md-12 col-xs-12" data-toggle="dropdown" aria-expanded="false">
  							<i class="fa fa-share-alt pull-left fa-inverse icons btn-add-to"></i>   Share
  							<i class="caret pull-right" style="color:#eee; margin-top:8px"></i>
  						</button>
						<ul class="dropdown-menu dropdown-option bullet pull-center" role="menu" aria-labelledby="dropdownMenu1">
			              <li role="presentation" id="share-fb"><a role="menuitem" tabindex="-1"><i class="fa fa-facebook icons"></i> Facebook</a></li>
			              <li role="presentation" id="share-twitter"><a role="menuitem" tabindex="-1"><i class="fa fa-twitter icons"></i> Twitter</a></li>
			              <li role="presentation" id="share-gplus"><a role="menuitem" tabindex="-1"><i class="fa fa-google-plus icons"></i> Google+</a></li>
			              <li role="presentation" id="share-path"><a role="menuitem" tabindex="-1"><i class="el el-path icons"></i> Path</a></li>
			            </ul>
					</div>
					<div class="col-md-6 col-xs-6" style="padding-left:5px" title="Report Recipe">
						<button class="btn button-primary col-md-12 col-xs-12" data-toggle="modal" data-target="#form-report">
							<i class="fa fa-flag pull-left fa-inverse icons"></i>  Report
						</button>
						<div id="form-report" class="modal fade">
						  	<div class="modal-dialog">
						  		<form class="form-horizontal" role="form">
						    	<div class="modal-content">
						      		<div class="modal-header">
						        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        		<h4 class="modal-title">Report</h4>
						      		</div>
							      	<div class="modal-body">
						        		<div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10 col-xs-12 text-left">
										      	<div class="checkbox">
										        	<label>
										          		<input type="checkbox"> SPAM
										        	</label>
										      	</div>
										    </div>
										</div>
										<div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10 col-xs-12 text-left">
										      	<div class="checkbox">
										        	<label>
										          		<input type="checkbox"> Advertisement
										        	</label>
										      	</div>
										    </div>
										</div>
										<div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10 col-xs-12 text-left">
										      	<div class="checkbox">
										        	<label>
										          		<input type="checkbox"> Pornographic
										        	</label>
										      	</div>
										    </div>
										</div>
										<div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10 col-xs-12 text-left">
										      	<div class="inputKeeper col-md-12 col-xs-12 col-no-padding">
												    <input type="text" class="form-control" placeholder="Other"/>
												</div>
										    </div>
										</div>
							      	</div>
							      	<div class="modal-footer" style="text-align:center">
							        	<button type="button" class="btn button-primary">Send Report</button>
							      	</div>
						    	</div><!-- /.modal-content -->
						    	</form>
						  	</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div>
				</div>
				<div class="col-md-12 col-xs-12 text-center" style="margin-top:5px" title="Generate Price">
					<button class="btn button-primary col-md-12 col-xs-12">
						<i class="fa fa-money pull-left fa-inverse icons"></i> Generate Price
					</button>
				</div>
				<div class="col-md-12 col-xs-12 col-no-padding" style="margin-top:15px" title="Description Recipe">
	  				<h4 class="page-header-title">Description Recipe</h4>
	  				<div clas="col-md-12 col-xs-12">
						{recipe_description}
	  				</div>
	  			</div>
	  			<div class="col-md-12 col-xs-12 col-no-padding related-recipe" style="margin-top:15px" title="Related Recipe">
	  				<h4 class="page-header-title">Related Recipes</h4>
	  				<div class="carousel-related-recipe left pull-left text-center owl-prev disabled">
  						<i class="fa fa-chevron-left" style="line-height:92px"></i>
  					</div>
	  				<div class="col-md-10 col-xs-10 col-no-padding related-recipe-entries">
	  					<div class="col-md-12 col-xs-12 col-no-padding owl-carousel">
	  						<!-- {related_recipe_entries} -->
	  						<div class="col-md-12 col-xs-12 related-recipe-entry item" title="{related_recipe_name}">
								<img src="<?php echo base_url();?>images/recipe/26.jpg" class="img-responsive col-md-12 col-xs-12 col-no-padding">
								<a class="text-capitalize col-md-12 col-xs-12 col-no-padding related-recipe-entry-name">{related_recipe_name}</a>
							</div>
							<div class="col-md-12 col-xs-12 related-recipe-entry item">
								<img src="<?php echo base_url();?>images/recipe/27.jpg" class="img-responsive col-md-12 col-xs-12 col-no-padding">
								<a class="text-capitalize col-md-12 col-xs-12 col-no-padding related-recipe-entry-name">{related_recipe_name}</a>
							</div>
							<div class="col-md-12 col-xs-12 related-recipe-entry item">
								<img src="<?php echo base_url();?>images/recipe/28.jpg" class="img-responsive col-md-12 col-xs-12 col-no-padding">
								<a class="text-capitalize col-md-12 col-xs-12 col-no-padding related-recipe-entry-name">{related_recipe_name}</a>
							</div>
							<div class="col-md-12 col-xs-12 related-recipe-entry item">
								<img src="<?php echo base_url();?>images/recipe/25.jpg" class="img-responsive col-md-12 col-xs-12 col-no-padding">
								<a class="text-capitalize col-md-12 col-xs-12 col-no-padding related-recipe-entry-name">{related_recipe_name}</a>
							</div>
							<div class="col-md-12 col-xs-12 related-recipe-entry item">
								<img src="<?php echo base_url();?>{recipe_photo}" class="img-responsive col-md-12 col-xs-12 col-no-padding">
								<a class="text-capitalize col-md-12 col-xs-12 col-no-padding related-recipe-entry-name">{related_recipe_name}</a>
							</div>
							<!-- {/related_recipe_entries} -->
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
						{recipe_ingredients}
							<tr>
								<td class="text-capitalize"> {ingre_name}
									<?php if(!empty($ingredient_info)):?>
										<i class="fa fa-info-circle icons-secondary fa-lg" role="button" data-toggle="popover" title="Info Ingredient" data-content="{ingre_name}" data-trigger="hover"></i>
									<?php endif;?>
								</td>
								<td> {ingre_quantity} {ingre_units}
								</td>
							</tr>
						{/recipe_ingredients}
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
							<a data-toggle="modal" data-toggle="modal" data-target="#step-{steps_number}"><img src="<?php echo base_url();?>{steps_photo}" class="img-rounded img-responsive"></a>
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
					<h4 class="page-header-title">Share Your Thought! (2 Comments)</h4>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-2 col-no-padding-left">
							<img src="http://localhost/foodoof/assets/img/user-male.png" class="img-responsive img-circle img-user-comment" title="Your">
						</div>
						<div class="col-md-10 col-xs-10 bubble">
							<form class="form-horizontal text-" role="form" method="post" style="margin:0">
								<div class="col-md-12 col-xs-12 col-no-padding-right form-group">
									<div class="textareaKeeper col-md-10 col-xs-9 col-no-padding">
									    <textarea class="form-control enter-comment" row="1" placeholder="Write Your Comment In Here ..."></textarea>
									</div>
									<div class="col-md-2 col-xs-3 col-no-padding-right" style="position:absolute; right:0; bottom:0">
										<button type="submit" class="btn button-secondary col-md-12 col-xs-12">Send</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-12 col-xs-12 comment-entry">
						<div class="col-md-2 col-xs-2 col-no-padding-left">
							<img src="http://localhost/foodoof/assets/img/user-male.png" class="img-responsive img-circle img-user-comment" title="Alfan">
						</div>
						<div class="col-md-10 col-xs-10 bubble">
							<div class="col-md-12 col-xs-12 col-no-padding-left comment-value">
								asjkhsjdfhkjsdafhdfgadjadsgfhjgsdaff;jsdajfkhsdfj
							</div>
							<div class="col-md-12 col-xs-12 col-no-padding-left comment-time border-dashed-top">
								Alfan | 4 hours ago
							</div>
						</div>
					</div>
					<div class="col-md-12 col-xs-12 comment-entry">
						<div class="col-md-2 col-xs-2 col-no-padding-left">
							<img src="http://localhost/foodoof/assets/img/user-male.png" class="img-responsive img-circle img-user-comment" title="Alfan">
						</div>
						<div class="col-md-10 col-xs-10 bubble">
							<div class="col-md-12 col-xs-12 col-no-padding-left comment-value">
								asjdkjhsfjdsj
							</div>
							<div class="col-md-12 col-xs-12 col-no-padding-left comment-time border-dashed-top">
								Alfan | 5 hours ago
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
