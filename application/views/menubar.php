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
              <input type="text" class="form-control" placeholder="Search Recipe. Use Comma (,) As Separator For Search By Ingredient"/>
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