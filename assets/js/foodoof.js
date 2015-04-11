$( document ).ready(function() {
	
	$recipeId = $("#image-recipe").data("id");
	$lock = 0;
	$submitStatus=false;
	/*
	script for init fileinput of user's photo
	*/
	$("#photo-profile").fileinput({
		previewFileType: "image",
		browseClass: "btn button-default btn-block",
		browseLabel: "  Pick Image",
		browseIcon: '<i class="fa fa-image"> </i>',
		showCaption: false,
		showRemove: false,
		showUpload: false,
		uploadUrl: "http://localhost/foodoof/processAjax/uploadProfileUser/"+$("#photo-profile").data("id"), // server upload action
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
	        "<img src='"+$("#photo-profile").data("src")+"' class='file-preview-image img-responsive' alt='"+$("#photo-profile").data("title")+"' title='"+$("#photo-profile").data("title")+"'>",
	    ],
	    overwriteInitial: true,
	    maxFileSize: 500,
	}).on("filebatchselected", function(event, files) {
    	// trigger upload method immediately after files are selecte
    	$("#photo-profile").fileinput("upload");
	});

	/*
	script for init fileinput of recipe's photo
	*/
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
		uploadUrl: "http://localhost/foodoof/processAjax/uploadProfileRecipe/"+$recipeId, // server upload action
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
	        "<img src='"+$("#image-recipe").data("src")+"' class='file-preview-image img-responsive' alt='"+$("#image-recipe").data("title")+"' title='"+$("#image-recipe").data("title")+"'>",
	    ],
	    overwriteInitial: true,
	    maxFileSize: 500,
	}).on("filebatchselected", function(event, files) {
    	// trigger upload method immediately after files are selecte
    	$photoRecipe.fileinput("upload");
	});
	$photoRecipe.on('filelock', function(event, filestack, extraData) {
	    $lock++;
    });
    $photoRecipe.on('fileunlock', function(event, filestack, extraData) {
	    $lock -= 2;
	    if ($submitStatus){
	    	$("form").trigger("submit");
	    }
    });

	/*
	script for init fileinput of step's photo
	*/
	var index = 0;
	$(".image-steps").click(function(){
		index = $(".image-steps").index(this)+1;
	});
	$input = $(".image-steps");
	$input.each(function(i){
		$(this).fileinput({
			previewFileType: "image",
			browseClass: "btn button-default btn-block",
			browseLabel: "  Pick Image",
			browseIcon: '<i class="fa fa-image"> </i>',
			showCaption: false,
			showRemove: false,
			showUpload: false,
			uploadUrl: "http://localhost/foodoof/processAjax/uploadStepsRecipe/"+$recipeId+"/", // server upload action
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
	        	"<img src='"+$(".image-steps[index='"+(i+1)+"']").data("src")+"' class='file-preview-image img-responsive' alt='"+$(".image-steps[index='"+(i+1)+"']").data("title")+"' title='"+$(".image-steps[index='"+(i+1)+"']").data("title")+"'>",
	    	],
		    uploadExtraData:
		    		function() {
					    return {
					       no_step: index,
					    };
					}
		    ,
		    overwriteInitial: true,
		    maxFileSize: 500,
		}).on("filebatchselected", function(event, files) {
	    	// trigger upload method immediately after files are selecte
	    	$(this).fileinput("upload");
		});
		$(this).on('filelock', function(event, filestack, extraData) {
	    	$lock++;
	    });
	    $(this).on('fileunlock', function(event, filestack, extraData) {
		    $lock-=2;
		    if ($submitStatus){
		    	$("form").trigger("submit");
		    }
	    });
	});

	/*
	init ingredient if create recipe
	*/
	$countIngredient = $(".ingredient-item").length;
	if($countIngredient<1){
		$colAddRemoveBtnIngredient = $("#add-and-remove-btn-ingredient").clone();
		$ingredientItemFirst = "<div class='col-sm-10 col-xs-10 col-no-padding ingredient-item'><div class='col-sm-6 col-xs-6'><input type='text' value='' name='ingredient_subject[]' class='form-control' placeholder='Ingredient Name'></div><div class='col-sm-3 col-xs-3 col-no-padding-left'><input type='text' value='' name='ingredient_quantity[]' class='form-control' placeholder='Quantity'></div><div class='col-sm-3 col-xs-3 col-no-padding-left'><input type='text' value='' name='ingredient_unit[]'' class='form-control' placeholder='Unit'></div></div>";
		$("#add-and-remove-btn-ingredient").remove();
		$("#ingredient-entry").append($ingredientItemFirst);
		$("#ingredient-entry").append($colAddRemoveBtnIngredient);
	}
	$(".ingredient-item:first > div > input").each(function(i){
		$(this).prop('required',true);
	});

	/*
	init step if create recipe
	*/
	$countStep = $(".step-item").length;
	if($countStep < 1){
		$colAddRemoveBtnStep = $("#add-and-remove-btn-step").clone();
		$stepItem = "<div class='col-sm-10 col-xs-10 col-no-padding step-item'><div class='col-sm-8 col-xs-7 col-no-padding-right'><textarea class='form-control' rows='6' name='step-description[]' placeholder='Steps'></textarea></div><div class='col-sm-4 col-xs-5'><input class='image-steps' name='photo-step' data-src='../assets/img/01.jpg' index='1' data-title='new step' type='file' accept='image/*'></div></div>";
		$("#add-and-remove-btn-step").remove();
		$("#step-entry").append($stepItem);
		$("#step-entry").append($colAddRemoveBtnStep);
		$inputStepFirst = $(".image-steps[index='1']");
		$inputStepFirst.fileinput({
			previewFileType: "image",
			browseClass: "btn button-default btn-block",
			browseLabel: "  Pick Image",
			browseIcon: '<i class="fa fa-image"> </i>',
			showCaption: false,
			showRemove: false,
			showUpload: false,
			uploadUrl: "http://localhost/foodoof/processAjax/uploadStepsRecipe/"+$recipeId+"/", // server upload action
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
	        	"<img src='"+$inputStepFirst.data("src")+"' class='file-preview-image img-responsive' alt='"+$inputStepFirst.data("title")+"' title='"+$inputStepFirst.data("title")+"'>",
	    	],
		    uploadExtraData:
		    		function() {
					    return {
					       no_step: 1,
					    };
					}
		    ,
		    overwriteInitial: true,
		    maxFileSize: 500,
		}).on("filebatchselected", function(event, files) {
	    	// trigger upload method immediately after files are selecte
	    	$inputStepFirst.fileinput("upload");
		});
		$inputStepFirst.on('filelock', function(event, filestack, extraData) {
		    $lock++;
	    });
	    $inputStepFirst.on('fileunlock', function(event, filestack, extraData) {
		    $lock-=2;
		    if ($submitStatus){
		    	$("form").trigger("submit");
		    }
	    });
	}
	$(".step-item:first > div > textarea").prop('required',true);

	$('.typeahead').typeahead({ 
		source : function(query, process) {
                return ["Deluxe Bicycle", "Super Deluxe Trampoline", "Super Duper Scooter"];
            },
		autoSelect :true, 
	});
	
	/*
	event handler for search bar
	*/
	$("ul#listSearch > li").click(function(e){
		var search = $(this).find("label").html();
		if(search==="Title"){	
			$("#searchbar").attr("placeholder", "Search Recipe By Title");
		}
		else if(search==="Ingredient"){	
			$("#searchbar").attr("placeholder", "Search Recipe By Ingredient");
		}
		else if(search==="Account"){	
			$("#searchbar").attr("placeholder", "Search Account");
		}
	});

	/*
	event for add ingredient
	*/
	$countIngredient = $(".ingredient-item").length;
	$(document).ready(function(){
		if($countIngredient=1){
			alert($countIngredient);
			$("#remove-ingredient").hide();
		}
	});

	$colAddRemoveBtnIngredient = $("#add-and-remove-btn-ingredient").clone();
	$ingredientItem = 	"<div class='col-sm-10 col-xs-10 col-no-padding ingredient-item'>"+"<div class='col-sm-6 col-xs-6'>"+"<input type='text' value='' name='ingredient_subject[]' class='form-control' placeholder='Ingredient Name'>"+"</div>"+"<div class='col-sm-3 col-xs-3 col-no-padding-left'>"+"<input type='text' value='' name='ingredient_quantity[]' class='form-control' placeholder='Quantity'>"+"</div>"+"<div class='col-sm-3 col-xs-3 col-no-padding-left'>"+"<input type='text' value='' name='ingredient_unit[]'' class='form-control' placeholder='Unit'>"+"</div>"+"</div>";
	$(document).on('click',"#add-ingredient",function(){
		$("#add-and-remove-btn-ingredient").remove();
		$("#ingredient-entry").append($ingredientItem);
		$("#ingredient-entry").append($colAddRemoveBtnIngredient);
		$("#remove-ingredient").show();
		$countIngredient++;
	});
	$(document).on('click',"#remove-ingredient",function(){
		$("#add-and-remove-btn-ingredient").remove();
		$(".ingredient-item:last").remove();
		$("#ingredient-entry").append($colAddRemoveBtnIngredient);
		$countIngredient--;
		if($countIngredient>1){
			$("#remove-ingredient").show();	
		}
		else{
			$("#remove-ingredient").hide();	
		}
	});

	/*
	event for add step
	*/
	$countStep = $(".step-item").length;
	if($countstep=1){
		$("#remove-step").hide();
	}
	$colAddRemoveBtnStep = $("#add-and-remove-btn-step").clone();
	$(document).on('click',"#add-step",function(){
		$countStep++;
		$stepItem = "<div class='col-sm-10 col-xs-10 col-no-padding step-item'>"+"<div class='col-sm-8 col-xs-7 col-no-padding-right'>"+"<textarea class='form-control' rows='6' name='step-description[]' placeholder='Steps'></textarea>"+"</div>"+"<div class='col-sm-4 col-xs-5'>"+"<input class='image-steps' name='photo-step' data-src='../assets/img/01.jpg' index='"+$countStep+"' data-title='new step' type='file' accept='image/*'>"+"</div>"+"</div>";
		$("#add-and-remove-btn-step").remove();
		$("#step-entry").append($stepItem);
		$("#step-entry").append($colAddRemoveBtnStep);
		$("#remove-step").show();
		
		/*
		init pick photo for new step
		*/
		$input = $(".image-steps[index='"+($countStep)+"']");
		$input.fileinput({
			previewFileType: "image",
			browseClass: "btn button-default btn-block",
			browseLabel: "  Pick Image",
			browseIcon: '<i class="fa fa-image"> </i>',
			showCaption: false,
			showRemove: false,
			showUpload: false,
			uploadUrl: "http://localhost/foodoof/processAjax/uploadStepsRecipe/"+$recipeId+"/", // server upload action
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
	        	"<img src='"+$input.data("src")+"' class='file-preview-image img-responsive' alt='"+$input.data("title")+"' title='"+$input.data("title")+"'>",
	    	],
		    uploadExtraData:
		    		function() {
					    return {
					       no_step: $countStep,
					    };
					}
		    ,
		    overwriteInitial: true,
		    maxFileSize: 500,
		}).on("filebatchselected", function(event, files) {
	    	// trigger upload method immediately after files are selecte
	    	$input.fileinput("upload");
		});
		$input.on('filelock', function(event, filestack, extraData) {
		    $lock++;
	    });
	    $input.on('fileunlock', function(event, filestack, extraData) {
		    $lock-=2;
		    if ($submitStatus){
		    	$("form").trigger("submit");
		    }
	    });
	});

	$(document).on('click',"#remove-step",function(){
		$("#add-and-remove-btn-step").remove();
		$(".step-item:last").remove();
		$("#step-entry").append($colAddRemoveBtnStep);
		$countStep--;
		if($countStep>1){
			$("#remove-step").show();	
		}
		else{
			$("#remove-step").hide();	
		}
	});

	/*
	handler event click save rating recipe
	*/
	$(document).on("click", ".rating-container", function(){
		$valueRating = $("#rating-recipe").val();
		$recipeIdView = $("#rating-recipe").data("recipeId");
		$.get( "../processAjax/setRating/"+$recipeIdView+"/"+$valueRating, function( data ) {
		  	if(data.status == '1'){
		  		console.log(data.message);
		  	}
		  	else{
		  		console.log(data.message);
		  	}
		},"json");
	});

	/*
	handler event click add favorite recipe
	*/
	$(document).on("click", "#add-favorite", function(){
		$recipeIdFav = window.location.href;
		$recipeIdFav = $recipeIdFav.split("/");
		$length = $recipeId.length;
		$recipeIdFav = $recipeIdFav[$length].split("?");
		$.get( "../processAjax/addFavorite/"+$recipeIdFav[0], function( data ) {
		  	if(data.status == '1'){
		  		$.notify({
					// options
					message: data.message
				},{
					// settings
					type: 'success'
				});  		
		  	}
		  	else{
		  		$.notify({
					// options
					message: data.message 
				},{
					// settings
					type: 'warning'
				});  	
		  	}
		},"json");
	});

	/*
	handler event click add cook-later recipe
	*/
	$(document).on("click", "#add-cook-later", function(){
		$recipeIdCL = window.location.href;
		$recipeIdCL = $recipeIdCL.split("/");
		$length = $recipeId.length;
		$recipeIdCL = $recipeIdCL[$length].split("?");
		$.get( "../processAjax/addCookLater/"+$recipeIdCL[0], function( data ) {
		  	if(data.status == '1'){
		  		$.notify({
					// options
					message: data.message 
				},{
					// settings
					type: 'success'
				});  		
		  	}
		  	else{
		  		$.notify({
					// options
					message: data.message 
				},{
					// settings
					type: 'warning'
				});  	
		  	}
		},"json");
	});

	/*
	handler event click publish recipe
	*/
	$(document).on("change", ".checkedPublish", function(){
		var check = $(this).prop('checked');
		alert($(this).val());
		$.get( "foodoof/processAjax/setPublish/"+$(this).val(), function( data ) {
		  	if(data.status == '1'){
		  		$.notify({
					// options
					message: data.message 
				},{
					// settings
					type: 'success'
				});  		
		  	}
		  	else{
		  		$.notify({
					// options
					message: data.message 
				},{
					// settings
					type: 'warning'
				});  	
		  	}
		},"json");
	});

	/*
	handler buat submit form
	*/
	$("form").on("submit", function(e){
		if($lock>0){
			e.preventDefault();
			$("#modalWaiting").modal("show");
		}
		else{
			$("#modalWaiting").modal("hide");	
		}
	});
	/*
	init javascript bootstrap;
	*/
	$('.carousel').carousel();
    $('.btn-popover').popover();
    //$('.popoverMenubar').popover();
});
