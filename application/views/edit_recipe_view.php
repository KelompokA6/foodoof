<div class="col-md-12">
	<div class="panel panel-default">
	  	<div class="panel-body">
	  		<h2 class="page-header-title text-capitalize"> Edit Recipe<!-- {edit_recipe_action} bisa Edit atau pun Create-->
	  		</h2>
	  		<form action="<?php echo base_url()?>recipe/saveRecipe/{edit_recipe_id}" method="POST" role="form">
	  			<div class="col-md-12 page-header-title col-no-padding">
			  		<div class="col-md-4">
			  			<div class="col-md-12 col-no-padding">
			  				<h4 class="page-header-title">Photo Recipe</h4>
			  				<input id="image-recipe" name="photo-recipe" data-src="<?php echo base_url()?>{edit_recipe_photo}" class="file-loading" multiple=false type="file" accept="image/*" >
			  			</div>
			  			<div class="col-md-12 col-no-padding" style="margin-top:15px">
			  				<h4 class="page-header-title">Description Recipe</h4>
			  				<div clas="col-md-12 col-no-padding">
			  					<textarea class="form-control" rows="6" placeholder="Description of your recipe">{edit_recipe_description}</textarea>
			  				</div>
			  			</div>
			  		</div>
			  		<div class="col-md-8 col-no-padding-left edit-info">
			  			<h4 class="page-header-title h4-mobile">Information Recipe</h4>
			  			<div class="form-horizontal">
						  	<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Title</label>
						    	<div class="col-sm-10">
						      		<input type="text" value="{edit_recipe_photo}" name="recipe_title" class="form-control" placeholder="Title Recipe">
						    	</div>
							</div>
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Ingredients</label>
						    	{edit_recipe_ingredient_entries}
						    	<div class="col-sm-9 col-xs-11 col-no-padding">
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
						    	<div class="col-sm-1 col-xs-1 col-no-padding-left" style="padding:2.5px">
						      		<i class="fa fa-plus fa-2x icon-default" title="add ingredient"></i> 
							    </div>
							</div>
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Steps</label>
						    	<div class="col-sm-9 col-xs-11 col-no-padding">
						    		{edit_recipe_step_entries}
								    <div class="col-sm-12 col-xs-12 col-no-padding list-item-step">
							    		<div class="col-sm-8 col-xs-7 col-no-padding-right">
								      		<textarea class="form-control" rows="6" placeholder="Steps"></textarea>
								    	</div>
								    	<div class="col-sm-4 col-xs-5">
								      		<input class="image-steps" name="photo-step" data-src="<?php echo base_url()?>{edit_recipe_step_photo}" index='{edit_recipe_step_no_step}' type="file" accept="image/*" >
								    	</div>
								    </div>
								    {/edit_recipe_step_entries}
						    	</div>
						    	<div class="col-sm-1 col-xs-1 col-no-padding-left" style="padding:2.5px">
						      		<i class="fa fa-plus fa-2x icon-default" title="add ingredient"></i> 
							    </div>
							</div>
						</div>
						<h4 class="page-header-title">Category</h4>
						<div class="col-md-12">
							<div class="form-group">
								<label class="checkbox-inline">
								  	<input type="checkbox" id="inlineCheckbox1" value="option1"> Pedas
								</label>
								<label class="checkbox-inline">
								  	<input type="checkbox" id="inlineCheckbox2" value="option2"> Sayur
								</label>
								<label class="checkbox-inline">
								  	<input type="checkbox" id="inlineCheckbox3" value="option3"> Daging
								</label>
							</div>
							<div class="form-group">
								<label class="checkbox-inline">
								  	<input type="checkbox" id="inlineCheckbox1" value="option1"> Seafood
								</label>
								<label class="checkbox-inline">
								  	<input type="checkbox" id="inlineCheckbox2" value="option2"> Chinese Food
								</label>
								<label class="checkbox-inline">
								  	<input type="checkbox" id="inlineCheckbox3" value="option3"> French Food
								</label>
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