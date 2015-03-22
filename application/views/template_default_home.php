<!DOCTYPE html>
<html>
<head>
  <title>Template View for Foodoof</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap-theme.css">
  <link href="/foodoof/assets/plugin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('.dropdown-toggle').dropdown();
  </script>
</head>
  <body>
    {menubar}
  </header>-->
    <div class="container container-mobile">
      <div class="row">
        <div class="col-md-9 pull-right">
          <div class="col-md-12 col-xs-12">
            {carousel_highlight}
          </div>
          <div class="col-md-6 col-xs-12">
            {top_recipe_home}
          </div>
          <div class="col-md-6 col-xs-12">
            {recently_recipe_home}
          </div>
        </div>
        <div class="col-md-3 category-menu pull-left">
          {category_home}
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    $('.carousel').carousel();
  </script>
</html>