<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugin/bower-components/closify/css/style.css">
		<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/closify/js/jquery-1.11.1.min.js" ></script>
		<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/closify/js/jquery-ui.min.js" ></script>
		<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/closify/js/closify-min.js" ></script>
	</head>
	<body>
		<div id="tiny-img" class="closify" height="100" width="400"></div>
		<div id="profile-img" class="closify" height="300" width="300">ashdkjahsdjksahdkjdshjk</div>

		<form method="post" action = "<?php echo base_url();?>index.php/processUpload/uploadProfileuser/1" enctype="multipart/form-data">
			<input type="file" name="test-file"/>
			<button type="submit">submit</button>
		</form>
	</body>
	<script type="text/javascript">
		
     		//alert(jQuery("#profile-img").attr('height'));
		    // Closify a div with default options
		    jQuery("#tiny-img").closify();
		                     
		    // Closify a div with custom options
		    jQuery("#profile-img").closify(
		        {
		            menuBackgroundColor:"rgba(0, 10, 255, 0.99)",   // Change menu background color
		            menuTextColor:"yellow",                         // Change menu text color
		            progressBarColor:'red',             // Change progress bar color
		            loadingImageUrl: '<?php echo base_url();?>assets/plugin/bower-components/closify/images/ajax-loader.gif',
		            backgroundImageUrl: '<?php echo base_url();?>assets/plugin/bower-components/closify/images/arrow-upload-icon.png',
		            startWithThisImg:'<?php echo base_url();?>assets/plugin/bower-components/closify/images/profile.png',
		            position: {top:'10px',left:'0'},
		            circularCanvas: false,
		            hardTrim: true,
		            responsive: true,
		            quality: 1,
		            dynamicStorage:false,
		            topLeftCorner: true,                // Enable or disable top-left round corner to get various container shapes
		            topRightCorner: true,               // Enable or disable top-right round corner to get various container shapes
		            bottomLeftCorner: true,             // Enable or disable bottom-left round corner to get various container shapes
		            bottomRigthCorner: true,            // Enable or disable bottom-right round corner to get various container shapes
		            progress:false,                     // Enable progress bar
		            allowedFileSize: 1024 * 1024 * 5,  // (10 MB) Maximum image size limit
		            url: "<?php echo base_url();?>index.php/processUpload/uploadProfileuser/1",           // URL on where the photo should be submitted
		            /*targetOutput: "#output-profile-img",// Where to render errors and notification messages
		            error: alert("Yah Gagal"),           // Event handler for upload error
		            success: alert("Yeah Berhasil"),         // Event handler for successful upload
		            uploadProgress: anyFunctionTarget,  // Event handler for upload progress (In Percentage)
		            beforeSubmit:  anyFunctionTarget,    // Before submission event handler
		            finishUploading: anyFunctionTarget, // Event handler for finish image upload
		            finishCropping: anyFunctionTarget   // Event for finish image cropping action*/
		        });
		
	</script>
</html>