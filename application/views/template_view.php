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
  <!--<header class="navbar navbar-default navbar-fixed-top">
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

        <!--<nav class="collapse navbar-collapse bs-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="col-md-12 col-md-offset-4">
              <form class="navbar-form navbar-left col-md-12" role="search">
                <div class="form-group col-md-7">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                
                <!--Default buttons with dropdown menu
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
        </nav>-->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header col-md-2">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a href=""><img class="img-responsive pull-left" width="75px"  src="<?php echo base_url();?>assets/img/foodoof.png"/></a>
          <a href="" class="pull-right btn-navbar-mobile text-center"><i class="fa fa-pencil-square-o fa-2x"></i><br>Write <br>Your Recipe</a>
      </div>
        <!-- /.navbar-header -->

      <ul class="nav navbar-top-links nav navbar-nav navbar-left col-md-10">
        <div class="col-md-12 form-inline inline-search">
            <form class="navbar-form collapse-navbar-search">
              <div class="col-md-2 form-group col-xs-4 text-right">
                <select class="form-control form-group btn-primary">
                  <option> Recipe </option>
                  <option> Account </option>
                </select>
              </div>
              <div class="input-group form-group col-md-7 col-xs-8">
                  <input type="text" class="form-control" placeholder="Search recipes or accounts separated by commas (,)"/>
                  <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">
                          <i class="fa fa-search"></i>
                      </button>
                  </span>
              </div>
              <div class="form-group bs-navbar-collapse text-center btn-log-nav">
                  <div class="btn-group" role="group" aria-label="">
                      <button type="button" class="btn btn-success btn-cus">    Login    </button>
                      <button type="button" class="btn btn-primary btn-cus">    Join    </button>
                  </div>
              </div>
            </form>
        </div>
      </ul>
    </nav>
    <!--</div>
  </header>-->
    <div class="container container-mobile">
      <div class="row">
        <div class="col-md-9 pull-right">
          <div class="panel-body col-md-12">
            <div id="carousel-example-generic col-md-12" class="carousel slide" data-ride="carousel" >
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src="<?php echo base_url();?>assets/img/01.jpg" class="img-responsive" alt="Coba1">
                  <div class="carousel-caption">
                    Perccobaan
                  </div>
                </div>
                <div class="item">
                  <img src="<?php echo base_url();?>assets/img/02.jpg" class="img-responsive" alt="...">
                  <div class="carousel-caption">
                    Percobaan 2
                  </div>
                </div>
                <div class="item">
                  <img src="<?php echo base_url();?>assets/img/03.jpg" class="img-responsive" alt="...">
                  <div class="carousel-caption">
                    Percobaan 3
                  </div>
                </div>
              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="panel panel-info">
              <div class="panel-heading text-center">Top Recipe</div>
              <div class="panel-body">
                <div class="col-md-12 col-xs-12 page-header category-list">
                  <div class="col-md-3 col-xs-3 detail-list-img">
                    <img class="img-responsive img-rounded img-list" src="<?php echo base_url();?>assets/img/Nasi-Goreng.jpg"/>
                  </div>
                  <div class="col-md-9 col-xs-9 detail-list">
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-cutlery pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">nasi goreng</p>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-user pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">abid nurul hakim</p>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-eye pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">104 times</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-xs-12 page-header category-list">
                  <div class="col-md-3 col-xs-3 detail-list-img">
                    <img class="img-responsive img-rounded img-list" src="<?php echo base_url();?>assets/img/sate-ayam.jpg"/>
                  </div>
                  <div class="col-md-9 col-xs-9 detail-list">
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-cutlery pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">sate ayam</p>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-user pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">Alfan nur fauzan</p>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-eye pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">94 times</p>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="pull-right">See More...</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="panel panel-info">
              <div class="panel-heading text-center">Recently Recipe</div>
              <div class="panel-body">
                <div class="col-md-12 col-xs-12 page-header category-list">
                  <div class="col-md-3 col-xs-3 detail-list-img">
                    <img class="img-responsive img-rounded img-list" src="<?php echo base_url();?>assets/img/Nasi-Goreng.jpg"/>
                  </div>
                  <div class="col-md-9 col-xs-9 detail-list">
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-cutlery pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">nasi goreng</p>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-user pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">abid nurul hakim</p>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-clock-o pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">20 minutes ago</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-xs-12 page-header category-list">
                  <div class="col-md-3 col-xs-3 detail-list-img">
                    <img class="img-responsive img-rounded img-list" src="<?php echo base_url();?>assets/img/sate-ayam.jpg"/>
                  </div>
                  <div class="col-md-9 col-xs-9 detail-list">
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-cutlery pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">sate ayam</p>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icons">
                        <i class="fa fa-user pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                        <p class="text-capitalize">Alfan nur fauzan</p>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-xs-3 icon">
                        <i class="fa fa-clock-o pull-left"></i>
                      </div>
                      <div class="col-md-10 col-xs-9">
                       <p class="text-capitalize">4 hours ago</p>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="pull-right">See More...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 category-menu pull-left">
          <div class="panel panel-info">
            <div class="panel-heading text-center">Category Recipe</div>
            <div class="panel-body panel-category" for="category">
              <div class="col-md-12 col-xs-12 page-header category-list">
                <a href="#">
                  <div class="col-md-3 col-xs-5 img-category">
                    <img class="img-responsive img-rounded" src="<?php echo base_url();?>assets/img/sate-ayam.jpg"/>
                  </div>
                  <div class="col-md-8 col-xs-6 category-menu-name">
                    Masakan Pedas
                  </div>
                  <i class="fa fa-chevron-right pull-right chevron-menu" style="line-height:inherit"></i>
                </a>
              </div>
              <div class="col-md-12 col-xs-12 page-header category-list">
                <a href="#">
                  <div class="col-md-3 col-xs-5">
                    <img class="img-responsive img-circle" src="<?php echo base_url();?>assets/img/foodoof-vs.png"/>
                  </div>
                  <div class="col-md-8 col-xs-6 category-menu-name">
                    Sayuran
                  </div>
                  <i class="fa fa-chevron-right pull-right chevron-menu" style="line-height:inherit"></i>
                </a>
              </div>
              <div class="col-md-12 col-xs-12 page-header category-list">
                <a href="#">
                  <div class="col-md-3 col-xs-5">
                    <img class="img-responsive img-circle" src="<?php echo base_url();?>assets/img/foodoof-vs.png"/>
                  </div>
                  <div class="col-md-8 col-xs-6 category-menu-name">
                    Chinese Food
                  </div>
                  <i class="fa fa-chevron-right pull-right chevron-menu" style="line-height:inherit"></i>
                </a>
              </div>
              <div class="col-md-12 col-xs-12 page-header category-list">
                <a href="#">
                  <div class="col-md-3 col-xs-5">
                    <img class="img-responsive img-circle" src="<?php echo base_url();?>assets/img/foodoof-vs.png"/>
                  </div>
                  <div class="col-md-8 col-xs-6 category-menu-name">
                    French Food
                  </div>
                  <i class="fa fa-chevron-right pull-right chevron-menu" style="line-height:inherit"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    $('.carousel').carousel();
  </script>
</html>