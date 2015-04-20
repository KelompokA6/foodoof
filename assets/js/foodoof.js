$(document).ready(function() {
	$validateDuplicate = true;
	$validatePassword = true;	
	$recipeId = $("#image-recipe").data("id");
	$lock = 0;
	$submitStatus=false;
	$hasChanged = false;
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
	    maxFileSize: 5120,
	}).on("filebatchselected", function(event, files) {
    	// trigger upload method immediately after files are selecte
    	$("#photo-profile").fileinput("upload");
	});
	$("#photo-profile").on('filelock', function(event, filestack, extraData) {
	    $lock++;
	    $hasChanged = true;
    });
   $("#photo-profile").on('fileunlock', function(event, filestack, extraData) {
	    $lock-=2;
	    if ($submitStatus){
	    	$("form").trigger("submit");
	    }
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
	    maxFileSize: 5120,
	}).on("filebatchselected", function(event, files) {
    	// trigger upload method immediately after files are selecte
    	$photoRecipe.fileinput("upload");
	});
	$photoRecipe.on('filelock', function(event, filestack, extraData) {
	    $lock++;
	    $hasChanged = true;
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
	    	$hasChanged = true;
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
		$ingredientItemFirst = "<div class='col-sm-10 col-xs-10 col-no-padding ingredient-item'><div class='col-sm-6 col-xs-6'><input type='text' maxlength='254' value='' name='ingredient_subject[]' class='form-control  input-ingredient' placeholder='Ingredient Name'></div><div class='col-sm-3 col-xs-3 col-no-padding-left'><input type='number' min='0' step='0.01' value='' name='ingredient_quantity[]' class='form-control' placeholder='Quantity'></div><div class='col-sm-3 col-xs-3 col-no-padding-left'><input type='text' maxlength='254' value='' name='ingredient_unit[]'' class='form-control' placeholder='Unit'></div></div>";
		$("#add-and-remove-btn-ingredient").remove();
		$("#ingredient-entry").append($ingredientItemFirst);
		$("#ingredient-entry").append($colAddRemoveBtnIngredient);
	}
	$(".ingredient-item:first > div > input").each(function(i){
		$(this).prop('required',true);
	});
	$(".ingredient-item > div > input[type='number']").prop('required',false);

	/*
	init step if create recipe
	*/
	$countStep = $(".step-item").length;
	if($countStep < 1){
		$colAddRemoveBtnStep = $("#add-and-remove-btn-step").clone();
		$stepItem = "<div class='col-sm-10 col-xs-10 col-no-padding step-item'><div class='col-sm-8 col-xs-7 col-no-padding-right'><textarea class='form-control' rows='6' name='step-description[]' placeholder='Steps'></textarea></div><div class='col-sm-4 col-xs-5'><input class='image-steps' name='photo-step' data-src='/foodoof/assets/img/step-default.jpg' index='1' data-title='new step' type='file' accept='image/*'></div></div>";
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
		    maxFileSize: 5120,
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
		if(search==="Title "){	
			$("#searchbar").attr("placeholder", "Search Recipe By Title");
		}
		else if(search==="Ingredient "){	
			$("#searchbar").attr("placeholder", "Search Recipe By Ingredient");
		}
		else if(search==="Account "){	
			$("#searchbar").attr("placeholder", "Search Account");
		}
	});

	function getUrlParameter(sParam)
	{
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++) 
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0].toLowerCase() === sParam) 
	        {
	            return sParameterName[1];
	        }
	    }
	}
	$searchBy = getUrlParameter('searchby')+"";
	if($searchBy.toLowerCase() === "title"){
		$("ul#listSearch > li > input[value='title']").prop('checked', true);
		$("ul#listSearch > li > input[value='ingredient']").prop('checked', false);
		$("ul#listSearch > li > input[value='account']").prop('checked', false);
		$("button.dropdown-cat-search").html("Title <span class='caret'></span>");
		$("#searchbar").attr("placeholder", "Search Recipe By Title");
	}
	if($searchBy.toLowerCase() === "ingredient"){
		$("ul#listSearch > li > input[value='title']").prop('checked', false);
		$("ul#listSearch > li > input[value='ingredient']").prop('checked', true);
		$("ul#listSearch > li > input[value='account']").prop('checked', false);
		$("button.dropdown-cat-search").html("Ingredient <span class='caret'></span>");
		$("#searchbar").attr("placeholder", "Search Recipe By Ingredient");
	}
	if($searchBy.toLowerCase() === "account"){
		$("ul#listSearch > li > input[value='title']").prop('checked', false);
		$("ul#listSearch > li > input[value='ingredient']").prop('checked', false);
		$("ul#listSearch > li > input[value='account']").prop('checked', true);
		$("button.dropdown-cat-search").html("Account <span class='caret'></span>");
		$("#searchbar").attr("placeholder", "Search Account");
	}     
	/*
	event for add ingredient
	*/
	$countIngredient = $(".ingredient-item").length;
	if($countIngredient == 1){
		$("#remove-ingredient").hide();
	}

	$colAddRemoveBtnIngredient = $("#add-and-remove-btn-ingredient").clone();
	$ingredientItem = 	"<div class='col-sm-10 col-xs-10 col-no-padding ingredient-item animated fadeInDown'>"+"<div class='col-sm-6 col-xs-6'>"+"<input type='text' value='' name='ingredient_subject[]' class='form-control input-ingredient' placeholder='Ingredient Name'>"+"</div>"+"<div class='col-sm-3 col-xs-3 col-no-padding-left'>"+"<input type='text' step='0.01' value='' name='ingredient_quantity[]' class='form-control' placeholder='Quantity'>"+"</div>"+"<div class='col-sm-3 col-xs-3 col-no-padding-left'>"+"<input type='text' value='' name='ingredient_unit[]'' class='form-control' placeholder='Unit'>"+"</div>"+"</div>";
	$(document).on('click',"#add-ingredient",function(){
		$("#add-and-remove-btn-ingredient").remove();
		$("#ingredient-entry").append($ingredientItem);
		$("#ingredient-entry").append($colAddRemoveBtnIngredient);
		$("#remove-ingredient").show();
		$countIngredient++;
		$hasChanged = true;
		$(".ingredient-item > div > .input-ingredient").last().focus();
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
		$hasChanged = true;
	});

	/*
	event for add step
	*/
	$countStep = $(".step-item").length;
	if($countStep == 1){
		$("#remove-step").hide();
	}
	$colAddRemoveBtnStep = $("#add-and-remove-btn-step").clone();
	$(document).on('click',"#add-step",function(){
		$countStep++;
		$.get("/foodoof/processAjax/addStepImage/"+$recipeId+"/"+$countStep, function( data ) {
			if(data.status == '1'){
		  		console.log(data.message);  		
		  	}
		  	else{
		  		console.log(data.message);
		  	}
		},"json");
		$stepItem = "<div class='col-sm-10 col-xs-10 col-no-padding step-item animated fadeInDown'>"+"<div class='col-sm-8 col-xs-7 col-no-padding-right'>"+"<textarea class='form-control' rows='6' name='step-description[]' placeholder='Steps'></textarea>"+"</div>"+"<div class='col-sm-4 col-xs-5'>"+"<input class='image-steps' name='photo-step' data-src='/foodoof/assets/img/step-default.jpg' index='"+$countStep+"' data-title='new step' type='file' accept='image/*'>"+"</div>"+"</div>";
		$("#add-and-remove-btn-step").remove();
		$("#step-entry").append($stepItem);
		$("#step-entry").append($colAddRemoveBtnStep);
		$("#remove-step").show();
		$(".step-item > div > textarea").last().focus();
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
		    $hasChanged = true;
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
		$.get("/foodoof/processAjax/removeStepImage/"+$recipeId+"/"+$countStep, function( data ) {
			if(data.status == '1'){
		  		console.log(data.message);  		
		  	}
		  	else{
		  		console.log(data.message);
		  	}
		},"json");
		$countStep--;
		if($countStep>1){
			$("#remove-step").show();	
		}
		else{
			$("#remove-step").hide();	
		}
		$hasChanged = true;
	});

	/*
	handler event click save rating recipe
	*/
	$(document).on("click", ".rating-container", function(){
		$valueRating = $("#rating-recipe").val();
		$recipeIdView = $("#rating-recipe").data("recipeid");
		$.get( "/foodoof/processAjax/setRating/"+$recipeIdView+"/"+$valueRating, function( data ) {
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
		$.get( "/foodoof/processAjax/addFavorite/"+$recipeIdFav[0], function( data ) {
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
		$.get( "/foodoof/processAjax/addCookLater/"+$recipeIdCL[0], function( data ) {
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
		$.get( "/foodoof/processAjax/setPublish/"+$(this).val(), function( data ) {
		  	if(data.status == '1'){
		  		$.notify({
					// options
					message: data.message 
				},{
					// settings
					mouse_over:'pause',
					newest_on_top: true,
					allow_dismiss: false,
					type: 'success',
					delay: 1500,
					placement: {
						from: 'top',
						align: 'center'
					},
				});  		
		  	}
		  	else{
		  		$.notify({
					// options
					message: data.message 
				},{
					// settings
					mouse_over:'pause',
					newest_on_top: true,
					allow_dismiss: false,
					type: 'warning',
					delay: 1500,
					placement: {
						from: 'top',
						align: 'center'
					},
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
		else if(!$validateDuplicate){
			e.preventDefault();
			$.notify({
				// options
				message: "There Are Duplicate Ingredient."
			},{
				// settings
				mouse_over:'pause',
				newest_on_top: true,
				allow_dismiss: false,
				type: 'danger',
				delay: 5000,
				placement: {
					from: 'top',
					align: 'center'
				},
			});
		}
		else if(!$validatePassword){
			e.preventDefault();
			$.notify({
			// options
				message: "Your Old and New Password is Same, Please Change." 
			},{
				// settings
				mouse_over:'pause',
				newest_on_top: true,
				allow_dismiss: false,
				type: 'danger',
				delay: 2000,
				placement: {
					from: 'top',
					align: 'center'
				},
			});
		}
		else{
			$hasChanged = false;
			$("#modalWaiting").modal("hide");	
		}
	});

	$(window).bind('beforeunload', function(){ 
		if($hasChanged){
			return 'You have unsaved changes!';	
		}
		else{
			return ;
		}
	});

	/*
	handle click untuk create resep bila belum login
	*/
	$("#createRecipeMenubar").click(function(e){
		$('.btn-popover').popover('show');	
	});

	/*
	init admin page
	*/
	$(".checkedHighlight").each(function(i){
		if($(this).prop('checked')){
			$idHighlight = $(this).val();
			$addHighlightRecipe="<div class='col-md-12 list-group-item' data-id='"+$idHighlight+"'title='highlight setting'><div class='col-md-3 col-xs-3 col-no-padding'><img class='img-responsive' src='../"+$(this).data('imgsrc')+"'/></div><div class='col-md-9 col-xs-9'>"+$(this).data('recipename')+"</div></div>";
			$("#listHightlight").append($addHighlightRecipe);
		}
	});
	/*
	handle for check highlight recipe
	*/
	$countHighlight = $("#listHightlight > .list-group-item").length;
	$(document).on('change', ".checkedHighlight", function(e){
		$hasChanged = true;
		$idHighlight = $(this).val();
		if($(this).prop('checked')){
			if($countHighlight < 5){
				$addHighlightRecipe="<div class='col-md-12 list-group-item' data-id='"+$idHighlight+"'title='highlight setting'><div class='col-md-3 col-xs-3 col-no-padding'><img class='img-responsive' src='../"+$(this).data('imgsrc')+"'/></div><div class='col-md-9 col-xs-9'>"+$(this).data('recipename')+"</div></div>";
				$("#listHightlight").append($addHighlightRecipe);
				$countHighlight++;
			}
			else{
				$.notify({
					// options
					message: "You have selected 5 recipes" 
				},{
					// settings
					mouse_over:'pause',
					newest_on_top: true,
					allow_dismiss: false,
					type: 'warning',
					delay: 1500,
					placement: {
						from: 'top',
						align: 'center'
					},
				});
				$(this).prop('checked', false);
			}
		}
		else{
			$("#listHightlight").find(".list-group-item[data-id='"+$idHighlight+"']").remove();
			$countHighlight--;	
		}

	});

	/*
	handle if has change in page
	*/
	$("input .option-category-recipe").change(function(e){
		$hasChanged = true;
	});
	$(".ingredient-item > div > input").change(function(e){
		$hasChanged = true;
	});
	$(".step-item > div > textarea").change(function(e){
		$hasChanged = true;
	});
	$("input.form-profile").change(function(e){
		$hasChanged = true;
	});

	/*
	validate same ingredient
	*/
	$(document).on("change", ".input-ingredient", function(x){
		$indexValidation = $(".input-ingredient").index(this);
		$valueIngredient = $(this).val().toLowerCase();
		$validateDuplicate = true;
		$(".ingredient-item > div > .input-ingredient").each(function(e){
			if(e != $indexValidation){
				if($(this).val().toLowerCase() == $valueIngredient){
					$validateDuplicate = false;
					$.notify({
						// options
						message: "There are duplicate in ingredient" 
					},{
						// settings
						element: "body",
						mouse_over:'pause',
						newest_on_top: true,
						allow_dismiss: false,
						type: 'danger',
						delay: 5000,
						placement: {
							from: 'top',
							align: 'center'
						},
					});
				}
			}
		});
	});

	/*
	validate old and new password
	*/
	$("input[type='password'][name='old_password']").change(function(e){
		if($(this).val()==$("input[type='password'][name='new_password']").val()){
			$validatePassword=false;
			$.notify({
			// options
				message: "Your Old and New Password is Same, Please Change." 
			},{
				// settings
				mouse_over:'pause',
				newest_on_top: true,
				allow_dismiss: false,
				type: 'danger',
				delay: 2000,
				placement: {
					from: 'top',
					align: 'center'
				},
			});
		}
		else{
			$validatePassword=true;
		}
	});
	$("input[type='password'][name='new_password']").change(function(e){
		if($(this).val()==$("input[type='password'][name='old_password']").val()){
			$validatePassword=false;
			$.notify({
			// options
				message: "Your Old and New Password is Same, Please Change." 
			},{
				// settings
				mouse_over:'pause',
				newest_on_top: true,
				allow_dismiss: false,
				type: 'danger',
				delay: 2000,
				placement: {
					from: 'top',
					align: 'center'
				},
			});
		}
		else{
			$validatePassword=true;
		}
	});
	/*
	show alert
	*/
	if($("#alert-notification").data('status')=='success'){
		$.notify({
			// options
			message: $("#alert-notification").data('message') 
		},{
			// settings
			mouse_over:'pause',
			newest_on_top: true,
			allow_dismiss: false,
			type: 'success',
			delay: 2000,
			placement: {
				from: 'top',
				align: 'center'
			},
		});
	}
	if($("#alert-notification").data('status')=='failed'){
		$.notify({
			// options
			message: $("#alert-notification").data('message') 
		},{
			// settings
			mouse_over:'pause',
			newest_on_top: true,
			allow_dismiss: false,
			type: 'danger',
			delay: 2000,
			placement: {
				from: 'top',
				align: 'center'
			},
		});
	}

	if($("#alert-notification").data('status')=='warning'){
		$.notify({
			// options
			message: $("#alert-notification").data('message') 
		},{
			// settings
			mouse_over:'pause',
			newest_on_top: true,
			allow_dismiss: false,
			type: 'warning',
			delay: 2000,
			placement: {
				from: 'top',
				align: 'center'
			},
		});
	}

	/*
	slide menubar
	*/
	$("#btn-login-slide-menu").click(function(){
		$("#loginform-slide-menu").removeClass('hidden');
		$("#loginform-slide-menu").addClass('animated fadeInDown');
		$(this).addClass('hidden');
		$("#btn-join-slide-menu").removeClass('btn-group');
	});

	/*
	init javascript bootstrap;
	*/
	$('.carousel').carousel();
    $('.btn-popover').popover();

    $maxHeightItem = 0;
    $maxHeightDetail = 0;
    $(".item-recipe-home").each(function(){
    	if($(this).height() > $maxHeightItem){
    		$maxHeightItem = $(this).height();
    	}
    });
    $(".item-recipe-home").each(function(){
    	$(this).height($maxHeightItem);
    });
    $(".detail-list-recipe-home").each(function(){
    	if($(this).height() > $maxHeightDetail){
    		$maxHeightDetail = $(this).height();
       	}
    });
    $(".detail-list-recipe-home").each(function(){
    	$(this).height($maxHeightDetail);
    });
    $(".detail-list-recipe-home > .details-recipe-home").each(function(){
    	$height = $(this).find('.col-md-10').height();
    	$(this).find(".icons").css('padding-top', ($height/2)-($(this).find(".icons").height()/2));
    });
    $(".detail-list-img-recipe-home").each(function(){
    	$heightImg = $maxHeightDetail - $(this).find("a").find("img").height();
    	$(this).height($maxHeightDetail);
    	$(this).css('padding-top', $heightImg/2);
    });
    $( window ).resize(function() {
    	$maxHeightItemtmp = 0;
	    $maxHeightDetailtmp = 0;
	    $(".item-recipe-home").each(function(){
	    	if($(this).height() > $maxHeightItemtmp){
	    		$maxHeightItemtmp = $(this).height();
	    	}
	    });
	    $(".item-recipe-home").each(function(){
	    	$(this).height($maxHeightItem);
	    });
	    $(".detail-list-recipe-home").each(function(){
	    	if($(this).height() > $maxHeightDetailtmp){
	    		$maxHeightDetailtmp = $(this).height();
	       	}
	    });
	    $(".detail-list-recipe-home").each(function(){
	    	$(this).height($maxHeightDetailtmp);
	    });
	    $(".detail-list-recipe-home > .details-recipe-home").each(function(){
	    	$heighttmp = $(this).find('.col-md-10').height();
	    	$(this).find(".icons").css('padding-top', ($heighttmp/2)-($(this).find(".icons").height()/2));
	    });
	    $(".detail-list-img-recipe-home").each(function(){
	    	$heightImgtmp = $maxHeightDetailtmp - $(this).find("a").find("img").height();
	    	$(this).height($maxHeightDetailtmp);
	    	$(this).css('padding-top', $heightImgtmp/2);
	    });
    });
});
