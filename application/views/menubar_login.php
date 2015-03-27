<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
  <div class="navbar-header col-md-1">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a href=""><img class="img-responsive pull-left" width="75px"  src="<?php echo base_url();?>assets/img/foodoof.png"/></a>
      <a href="" class="pull-right btn-navbar-mobile text-center"><i class="fa fa-pencil-square-o fa-2x"></i><br>Write <br>A Recipe</a>
  </div>
    <!-- /.navbar-header -->

  <ul class="nav navbar-top-links nav navbar-nav navbar-left col-md-11">
    <div class="col-md-12 form-inline inline-search">
        <form class="navbar-form collapse-navbar-search">
          <div class="col-md-1">
          </div>
          <div class="input-group form-group col-md-7" style="padding-left:20px;">
              <input type="text" class="form-control" placeholder="Search Recipe By Title"/>
              <div class="input-group-btn">
                <div class="btn-group" role="group">
                  <select name="category-search" class="form-control btn-info" style="width:120px">
                    <option value="title">Title</option>
                    <option value="ingredients">Ingredients</option>
                    <option value="account">Account</option>
                  </select>
                </div>
                <span class="btn-group" role="group">
                  <button class="btn btn-primary" type="submit" style="width:60px; height:33.9915px">
                     <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
          </div>
          
          <a href="" class="btn-navbar-not-collapse" style="margin-left:-80px">
            <button class="btn btn-primary" type="button">
              <i class="fa fa-pencil-square-o fa-lg"></i> Write A Recipe
            </button>
          </a>
          <div class="form-group btn-navbar-not-collapse text-center btn-log-nav" style="margin-left:20px">
             <div class="col-md-3">
                <img class="img-responsive"/>
             </div>
             <div class="col-md-4">Abid Nurul Hakim
             </div>
             <button type="button" class="btn btn-danger">    Logout    </button>
          </div>
        </form>
    </div>
  </ul>
</nav>