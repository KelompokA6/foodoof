<!DOCTYPE html>
<html>
<head>
  <title>Template View for Foodoof</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap-theme.min.css">
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
          <a href="<?php echo base_url();?>" class="navbar-brand">
            <img src="<?php echo base_url();?>assets/img/foodoof-vs.png">
          </a>
        <!-- <a href="<?php echo base_url();?>" class="nav navbar-nav">
        <img src="<?php echo base_url();?>assets/img/foodoof-vs.png" alt="Home">
        </a> -->
        </div>

        <nav class="collapse navbar-collapse bs-navbar-collapse">
          <ul class="nav navbar-nav">
            <li>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <button type="button" class="btn btn-default navbar-btn">Login</button>
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