<!DOCTYPE html>
<html>
<head>
  <title>Template View for Foodoof</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap-theme.min.css">
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('.dropdown-toggle').dropdown();
  </script>
</head>
<body>
  <header class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href=""><img class="img-responsive" src="<?php echo base_url();?>assets/img/foodoof-vs.png"/></a>
        </div>

        <nav class="collapse navbar-collapse bs-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="col-md-12 col-md-offset-4">
              <form class="navbar-form navbar-left col-md-12" role="search">
                <div class="form-group col-md-7">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                
                <!--Default buttons with dropdown menu-->
                <div class="btn-group col-md-3">
                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Resep <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Akun</a></li>
                        <li><a href="#">Resep</a></li>
                    </ul>
                </div>
                <button type="submit" class="btn btn-success col-md-2">Search</button>
              </form>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <button type="button" class="btn btn-primary navbar-btn">Login</button>
            </li>
            <li>
              <button type="button" class="btn btn-default navbar-btn">Join</button>
            </li>
          </ul>
        </nav>
    </div>
  </header>
</body>
</html>