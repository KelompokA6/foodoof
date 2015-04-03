<div class="col-md-12">
	<div class="panel panel-default">
	  	<div class="panel-body">
	  		<h2 class="page-header-title text-capitalize"> Edit Recipe<!-- {edit_recipe_action} bisa Edit atau pun Create-->
	  			<div id="id-recipe" data-id={edit_recipe_id} class="hidden"></div>
	  		</h2>
	  		<form action="<?php echo base_url()?>recipe/saveRecipe/{edit_recipe_id}" method="POST" role="form">
	  			<div class="col-md-12 page-header-title col-no-padding">
			  		<div class="col-md-4">
			  			<div class="col-md-12 col-no-padding">
			  				<h4 class="page-header-title">Photo Recipe</h4>
			  				<input id="image-recipe" name="photo-recipe" data-src="<?php echo base_url()?>{edit_recipe_photo}" class="file-loading" data-id='{edit_recipe_id}' data-title="{edit_recipe_title}" multiple=false type="file" accept="image/*" >
			  			</div>
			  			<div class="col-md-12 col-no-padding" style="margin-top:15px">
			  				<h4 class="page-header-title">Description Recipe</h4>
			  				<div clas="col-md-12 col-no-padding">
			  					<textarea class="form-control" rows="6" placeholder="Description of your recipe">{edit_recipe_description}</textarea>
			  				</div>
			  			</div>
			  			<div class="col-md-12 col-xs-12 col-no-padding" style="margin-top:15px">
				  			<h4 class="page-header-title">Category</h4>
							<div class="col-md-12 col-xs-12 col-no-padding">
								<div class="form-group col-md-4 col-xs-6">
									<label class="checkbox-inline">
									  	<input type="checkbox" id="inlineCheckbox1" value="Pedas"> Pedas
									</label>
								</div>
								<div class="form-group col-md-4 col-xs-6">
									<label class="checkbox-inline">
									  	<input type="checkbox" id="inlineCheckbox2" value="Sayur"> Sayur
									</label>
								</div>
								<div class="form-group col-md-4 col-xs-6">
									<label class="checkbox-inline">
									  	<input type="checkbox" id="inlineCheckbox3" value="Daging"> Daging
									</label>
								</div>
								<div class="form-group col-md-4 col-xs-6">
									<label class="checkbox-inline">
									  	<input type="checkbox" id="inlineCheckbox1" value="Seafood"> Seafood
									</label>
								</div>
								<div class="form-group col-md-4 col-xs-6">
									<label class="checkbox-inline">
									  	<input type="checkbox" id="inlineCheckbox1" value="Chinese Food"> Chinese Food
									</label>
								</div>
								<div class="form-group col-md-4 col-xs-6">
									<label class="checkbox-inline">
									  	<input type="checkbox" id="inlineCheckbox1" value="French Food"> French Food
									</label>
								</div>
								<div class="form-group col-md-4 col-xs-6">
									<label class="checkbox-inline">
									  	<input type="checkbox" id="inlineCheckbox1" value="Other" checked> Other
									</label>
								</div>
							</div>
						</div>
			  		</div>
			  		<div class="col-md-8 col-no-padding-left edit-info">
			  			<h4 class="page-header-title h4-mobile">Information Recipe</h4>
			  			<div class="form-horizontal">
						  	<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Title</label>
						    	<div class="col-sm-10">
						      		<input type="text" value="{edit_recipe_photo}" name="recipe_title" class="form-control" placeholder="Title Recipe" required>
						    	</div>
							</div>
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Portion</label>
						    	<div class="col-sm-10">
						      		<input type="number" min="1" value="{edit_recipe_portion}" name="recipe_portion" class="form-control" placeholder="Portion Recipe" required>
						    	</div>
							</div>
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Duration (Minutes)</label>
						    	<div class="col-sm-10">
						      		<input type="number" min="1" value="{edit_recipe_duration}" name="recipe_duration" class="form-control" placeholder="Duration Cook The Recipe" required>
						    	</div>
							</div>
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 col-xs-12 control-label">Ingredients</label>
						    	<div id="ingredient-entry" class="col-sm-10 col-xs-12 col-no-padding">
						    		{edit_recipe_ingredient_entries}
							    	<div class="col-sm-10 col-xs-10 col-no-padding ingredient-item">
							    		<div class="col-sm-6 col-xs-6">
								      		<input type="text" value="{edit_recipe_ingredient_subject}" name="ingredient_subject[]" class="form-control" placeholder="Ingredient Name">
								    	</div>
								    	<div class="col-sm-3 col-xs-3 col-no-padding-left">
								      		<input type="text" value="{edit_recipe_ingredient_quantity}" name="ingredient_quantity[]" class="form-control" placeholder="Quantity">
								    	</div>
								    	<div class="col-sm-3 col-xs-3 col-no-padding-left">
								      		<input type="text" value="{edit_recipe_ingredient_unit}" name="ingredient_unit[]" class="form-control" placeholder="Unit">
								    	</div>
							    	</div>
							    	{/edit_recipe_ingredient_entries}
							    	<div id="add-and-remove-btn-ingredient" class="col-sm-2 col-xs-2 col-no-padding" style="padding:2.5px">
							      		<div class="col-sm-6 col-xs-6">
							      			<span id="add-ingredient" class="fa-stack fa-lg" title="Add Ingredient" style="cursor:pointer;">
											  	<i class="fa fa-square fa-stack-2x icon-default"></i>
											  	<i class="fa fa-plus fa-stack-1x fa-inverse"></i>
											</span>
							      		</div>
							      		<div class="col-sm-6 col-xs-6">
							      			<span id="remove-ingredient" class="fa-stack fa-lg" title="Remove Ingredient" style="cursor:pointer;">
											  	<i class="fa fa-square fa-stack-2x icon-default"></i>
											  	<i class="fa fa-minus fa-stack-1x fa-inverse"></i>
											</span>
							      		</div>
								    </div>
						    	</div>
							</div>
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 col-xs-12 control-label">Steps</label>
						    	<div id="step-entry" class="col-sm-10 col-xs-12 col-no-padding">
						    		{edit_recipe_step_entries}
							    	<div class="col-sm-10 col-xs-10 col-no-padding step-item">
									    <div class="col-sm-12 col-xs-12 col-no-padding list-item-step">
								    		<div class="col-sm-8 col-xs-7 col-no-padding-right">
									      		<textarea class="form-control" rows="6" name="step-description[]" placeholder="Steps">{edit_recipe_step_description}</textarea>
									    	</div>
									    	<div class="col-sm-4 col-xs-5">
									      		<input class="image-steps" name="photo-step" data-src="<?php echo base_url()?>{edit_recipe_step_photo}" index='{edit_recipe_step_no_step}' data-title="{edit_recipe_step_title}" type="file" accept="image/*" >
									    	</div>
									    </div>
							    	</div>
							    	{/edit_recipe_step_entries}
						    		<div id="add-and-remove-btn-step" class="col-sm-2 col-xs-2 col-no-padding" style="padding:2.5px">
							      		<div class="col-sm-6 col-xs-6">
							      			<span id="add-step" class="fa-stack fa-lg" title="Add Step" style="cursor:pointer;">
											  	<i class="fa fa-square fa-stack-2x icon-default"></i>
											  	<i class="fa fa-plus fa-stack-1x fa-inverse"></i>
											</span>
							      		</div>
							      		<div class="col-sm-6 col-xs-6">
							      			<span id="remove-step" class="fa-stack fa-lg" title="Remove Step" style="cursor:pointer;">
											  	<i class="fa fa-square fa-stack-2x icon-default"></i>
											  	<i class="fa fa-minus fa-stack-1x fa-inverse"></i>
											</span>
							      		</div>
								    </div>
						    	</div>
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
</div>