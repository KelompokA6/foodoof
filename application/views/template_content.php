<html>
<head>
  <title>Template View for Foodoof</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap-theme.css">
  <link href="/foodoof/assets/plugin/bower-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
  <body>
    {menubar}
	<div class="container container-mobile">
	  	<div class="row">
	  		<div class="col-md-12">
	  			{content_website}
	  		</div>
	  	</div>
	</div>
	</body>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('.carousel').carousel();
    $('.btn-cus').popover();
    $('.popoverMenubar').popover();
  </script>
</html>
