<div class="col-md-12">
	<div class="panel panel-default">
	  	<div class="panel-body">
	  		<h2 class="page-header-title text-capitalize"> Edit Recipe<!-- {edit_recipe_action} bisa Edit atau pun Create-->
	  		</h2>
	  		<form>
	  			<div class="col-md-12 page-header-title col-no-padding">
			  		<div class="col-md-4">
			  			<div class="col-md-12 col-no-padding">
			  				<h4 class="page-header-title">Photo Recipe</h4>
			  				<input id="image-recipe" name="photo-recipe" class="file-loading" multiple=false type="file" accept="image/*" >
							<script>
							/* Initialize your widget via javascript as follows */
							$photoRecipe = $("#image-recipe");
							$photoRecipe.fileinput({
								previewFileType: "image",
								browseClass: "btn button-default btn-block",
								browseLabel: "  Pick Image",
								browseIcon: '<i class="fa fa-image"> </i>',
								showCaption: false,
								showRemove: false,
								showUpload: false,
    							maxFileCount: 1,
								uploadUrl: "http://localhost/foodoof/processUpload/uploadProfileRecipe/edit_recipe_id", // server upload action
								uploadAsync: false,
								previewTemplates: {
							    	image: "<div class='file-preview-frame' id='{previewId}' data-fileindex='{fileindex}'>\n" +
						        "   <img src='{data}' class='file-preview-image img-responsive' title='{caption}' alt='{caption}'>\n" +
						        "   {footer}\n" +
						        "</div>\n",
							    },
							    layoutTemplates:{
							    	preview: "<div class='file-preview {class}''>\n" +
								        "    <div class='close fileinput-remove' style='display:none'>&times;</div>\n" +
								        "    <div class=''>\n" +
								        "    <div class='file-preview-thumbnails'>\n" +
								        "    </div>\n" +
								        "    <div class='clearfix'></div>" +
								        "    <div class='file-preview-status text-center text-success'></div>\n" +
								        "    <div class='kv-fileinput-error'></div>\n" +
								        "    </div>\n" +
								        "</div>",
								    progress: '<div class="progress" style="display:none;">\n' +
								        '    <div class="{class}" role="progressbar" aria-valuenow="{percent}" aria-valuemin="0" aria-valuemax="100" style="width:{percent}%;">\n' +
								        '        {percent}%\n' +
								        '     </div>\n' +
								        '</div>',
							    },
								initialPreview: [
							        "<img src='<?php echo base_url();?>assets/img/Nasi-Goreng.jpg' class='file-preview-image img-responsive' alt='abid' title='Abid'>",
							    ],
							    overwriteInitial: true,
							    maxFileSize: 500,
							}).on("filebatchselected", function(event, files) {
						    	// trigger upload method immediately after files are selecte
						    	$photoRecipe.fileinput("upload");
							});
							</script>
			  			</div>
			  			<div class="col-md-12 col-no-padding" style="margin-top:15px">
			  				<h4 class="page-header-title">Description Recipe</h4>
			  				<div clas="col-md-12 col-no-padding">
			  					<textarea class="form-control" rows="6" placeholder="Description of your recipe"></textarea>
			  				</div>
			  			</div>
			  		</div>
			  		<div class="col-md-8 col-no-padding-left edit-info">
			  			<h4 class="page-header-title h4-mobile">Information Recipe</h4>
			  			<div class="form-horizontal">
						  	<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Title</label>
						    	<div class="col-sm-10">
						      		<input type="text" class="form-control" placeholder="Title Recipe">
						    	</div>
							</div>
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Ingredients</label>
						    	<div class="col-sm-9 col-xs-11 col-no-padding">
						    		<div class="col-sm-6 col-xs-6">
							      		<input type="text" class="form-control" placeholder="Ingredient Name">
							    	</div>
							    	<div class="col-sm-3 col-xs-3 col-no-padding-left">
							      		<input type="text" class="form-control" placeholder="Quantity">
							    	</div>
							    	<div class="col-sm-3 col-xs-3 col-no-padding-left">
							      		<input type="text" class="form-control" placeholder="Unit">
							    	</div>
						    	</div>
						    	<div class="col-sm-1 col-xs-1 col-no-padding-left" style="padding:2.5px">
						      		<i class="fa fa-plus fa-2x icon-default" title="add ingredient"></i> 
							    </div>
							</div>
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">Steps</label>
						    	<div class="col-sm-9 col-xs-11 col-no-padding">
						    		<div class="col-sm-12 col-xs-12 col-no-padding list-item-step">
							    		<div class="col-sm-8 col-xs-7 col-no-padding-right">
								      		<textarea class="form-control" rows="6" placeholder="Steps"></textarea>
								    	</div>
								    	<div class="col-sm-4 col-xs-5 ">
								      		<input class="image-steps" name="photo-step" type="file" accept="image/*" >
								    	</div>
								    </div>
								    <div class="col-sm-12 col-xs-12 col-no-padding list-item-step">
							    		<div class="col-sm-8 col-xs-7 col-no-padding-right">
								      		<textarea class="form-control" rows="6" placeholder="Steps"></textarea>
								    	</div>
								    	<div class="col-sm-4 col-xs-5">
								      		<input class="image-steps" name="photo-step" type="file" accept="image/*" >
								    	</div>
								    </div>
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
		<script>
		/* Initialize your widget via javascript as follows */
		$photoStep = $(".image-steps");
		$photoStep.click(function() {
			this.fileinput({
				previewFileType: "image",
				browseClass: "btn button-default btn-block",
				browseLabel: "  Pick Image",
				browseIcon: '<i class="fa fa-image"> </i>',
				showCaption: false,
				showRemove: false,
				showUpload: false,
				uploadUrl: "http://localhost/foodoof/processUpload/uploadStepsRecipe/1/"+($photoStep.index(this)+1), // server upload action
				uploadAsync: false,	
				previewTemplates: {
			    	image: "<div class='file-preview-frame' id='{previewId}' data-fileindex='{fileindex}'>\n" +
		        "   <img src='{data}' class='file-preview-image img-responsive' title='{caption}' alt='{caption}'>\n" +
		        "   {footer}\n" +
		        "</div>\n",
			    },
			    layoutTemplates:{
			    	preview: "<div class='file-preview {class}''>\n" +
				        "    <div class='close fileinput-remove' style='display:none'>&times;</div>\n" +
				        "    <div class=''>\n" +
				        "    <div class='file-preview-thumbnails'>\n" +
				        "    </div>\n" +
				        "    <div class='clearfix'></div>" +
				        "    <div class='file-preview-status text-center text-success'></div>\n" +
				        "    <div class='kv-fileinput-error'></div>\n" +
				        "    </div>\n" +
				        "</div>",
				    progress: '<div class="progress" style="display:none;">\n' +
				        '    <div class="{class}" role="progressbar" aria-valuenow="{percent}" aria-valuemin="0" aria-valuemax="100" style="width:{percent}%;">\n' +
				        '        {percent}%\n' +
				        '     </div>\n' +
				        '</div>',
			    },
				initialPreview: [
			        "<img src='<?php echo base_url();?>assets/img/Nasi-Goreng.jpg' class='file-preview-image img-responsive' alt='abid' title='Abid'>",
			    ],
			    overwriteInitial: true,
			    maxFileSize: 500,
			}).on("filebatchselected", function(event, files) {
		    	// trigger upload method immediately after files are selecte
		    	this.fileinput("upload");
			});
		});
		
		</script>
	</div>
</div>