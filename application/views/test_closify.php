<html>
	<head>
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/kartik-star-rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugin/bower-components/kartik-file-input/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugin/bower-components/enhancement/css/dropdowns-enhancement.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap-theme.css">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/elusive-icons/css/elusive-icons.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default/foodoof.css">
	</head>
	<body>
		<input type="text" class='typeahead' data-provide="typeahead"/>
	</body>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/kartik-star-rating/js/star-rating.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/kartik-file-input/js/fileinput.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/typeahead/bootstrap3-typeahead.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/enhancement/js/dropdowns-enhancement.js"></script>
  <!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/bootstrap-notify/bootstrap-notify.min.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/foodoof.js"></script>
  <script type="text/javascript">
	$('.typeahead').typeahead({ 
		local: ['alpha','allpha2','alpha3','bravo','charlie','delta','epsilon','gamma','zulu']
		autoSelect :true, 
	});
	</script>
</html>