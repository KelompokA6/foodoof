<html>
<head>
  <title>Template View for Foodoof</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/t1/bootstrap-theme.css">
  <link href="/foodoof/assets/plugin/bower-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
	  <div class="navbar-header col-md-2">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse" style="margin:21px 10px 21px 10px">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	      </button>
	      <a href="" class="brand-menubar">
	      	<img class="img-circle img-brand-menubar" width="50px" src="<?php echo base_url();?>assets/img/foodoof.png"/>
	      </a>
	      <a href="" class="pull-right btn-navbar-mobile text-center"><i class="fa fa-pencil-square-o fa-2x"></i><br>Write <br>A Recipe</a>
	  </div>
	  <ul class="nav navbar-top-links nav navbar-nav navbar-left col-md-10">
	    <div class="col-md-12 form-inline inline-search col-menubar">
	        <form class="navbar-form collapse-navbar-search">
	          <div class="input-group form-group col-md-8 pull-left" style="padding-left:20px;">
	              <input type="text" class="form-control input-search" placeholder="Search Recipe By Title" style="width:533px"/>
	              <div class="input-group-btn">
	                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Search By<span class="caret"></span></button>
	                <ul class="dropdown-menu dropdown-search" role="menu" aria-labelledby="dropdownMenu1">
	                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Recipe</a></li>
	                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ingredient</a></li>
	                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Account</a></li>
	                </ul>
	                <span class="btn-group">
	                  <button class="btn btn-primary button-group-normal" type="submit" >
	                     <i class="fa fa-search"></i>
	                  </button>
	                </span>
	              </div>
	          </div>
	          <div class="form-group col-md-4 col-menu-user">
	          	<div class="col-md-2 link-by-icon" >
	          		<a href="" class="text-center" title="New Recipe">
		            	<i class="fa fa-pencil-square-o fa-2x"></i>
		          	</a>
	          	</div>
	            <a href="user/profile">
	            	<div class="col-md-4 hover-menubar text-left" title="Profile">
		            	<div class="col-md-6 col-no-padding-left col-no-padding-right div-img-profile-menubar">
		            		<img class="img-circle img-profile-menubar" src="<?php echo base_url();?>assets/img/01.jpg"/>
		            	</div>
			            <div class="col-md-6 col-no-padding" style="line-height:34px">
			            	Abid
			            </div>
		            </div>
	            </a>
	            <div class="col-md-2 col-offset-md-2">
	            	<button type="button" class="btn btn-danger btn-sm">Logout</button>
	            </div>
	           	
	          </div>
	        </form>
	    </div>
	  </ul>
	</nav>
	<div class="container container-mobile">
      <div class="row">
      	<div class="col-md-12">
      		<div class="col-md-3 col-no-padding-left">
      			<div class="col-md-12 col-no-padding-left">
      				<img src="<?php echo base_url();?>assets/img/01.jpg" class="img-responsive img-rounded"/>
      			</div>
      			<div class="col-md-12 col-no-padding-left" style="margin-top:10px">
      				<div class="list-group">
					  	<a href="#" class="list-group-item" title="Profile">
						    <span class="fa-stack fa-lg">
							  <i class="fa fa-square fa-stack-2x icon-profile"></i>
							  <i class="fa fa-user fa-stack-1x fa-inverse"></i>
							</span>
							Profile
					  	</a>
					  	<a href="#" class="list-group-item" title="My Recipe">
						  	<span class="fa-stack fa-lg">
							  <i class="fa fa-square fa-stack-2x icon-recipe"></i>
							  <i class="fa fa-cutlery fa-stack-1x fa-inverse"></i>
							</span>
							My Recipe
						</a>
					  	<a href="#" class="list-group-item" title="Favorite Recipe">
					  		<span class="fa-stack fa-lg">
							  <i class="fa fa-square fa-stack-2x icon-favorite"></i>
							  <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
							</span>
							Favorite
					  	</a>
					  	<a href="#" class="list-group-item" title="Cook Later">
					  		<span class="fa-stack fa-lg">
							  <i class="fa fa-square fa-stack-2x icon-cooklater"></i>
							  <i class="fa fa-list-alt fa-stack-1x fa-inverse"></i>
							</span>
							Cook Later
					  	</a>
					  	<a href="#" class="list-group-item" title="Change Password">
					  		<span class="fa-stack fa-lg">
							  <i class="fa fa-square fa-stack-2x icon-key"></i>
							  <i class="fa fa-key fa-stack-1x fa-inverse"></i>
							</span>
							Change Password
					  	</a>
					</div>
      			</div>
      		</div>
      		<div class="col-md-9">
      			<div class="panel panel-default">
				  	<div class="panel-body">
				  		<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					    	<div class="col-md-12">
					    		<h3 class="page-header"> Edit Profile</h3>
					    	</div>
					    	<div class="col-md-12">
								<h4>Personal Information</h4>
								<div class="col-md-12">
									<div class="form-group">
									    <label for="inputEmail3" class="col-sm-2 control-label">Photo</label>
									    <div class="col-sm-10">
									      	<input type="file" class="form-control" id="inputEmail3" placeholder="Email">
									    </div>
									 </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
									    <div class="col-sm-10">
									      	<input type="text" class="form-control" id="inputEmail3" placeholder="Your Name">
									    </div>
									 </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									    <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
									    <div class="col-sm-10">
									      	<label class="radio-inline">
											  	<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>Male
											</label>
											<label class="radio-inline">
											  	<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">Female
											</label>
									    </div>
									 </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									    <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
									    <div class="col-sm-10">
									      	<input type="text" class="form-control" id="inputEmail3" placeholder="Your Phone Number">
									    </div>
									 </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									    <label for="inputEmail3" class="col-sm-2 control-label">Birthdate</label>
									    <div class="col-sm-10">
									      	<input type="date" class="form-control" id="inputEmail3" placeholder="Your Birth Day">
									    </div>
									 </div>
								</div>
							</div>
							<div class="col-md-12">
								<h4>Social Media</h4>
								<div class="col-md-12">
									<div class="form-group">
									    <label class="col-sm-2 control-label">
										    <div class="col-no-padding-left">
					      						<span class="fa-stack fa-lg">
												  <i class="fa fa-square fa-stack-2x"></i>
												  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
												</span>
					      					</div>
					      				</label>
									    <div class="col-sm-10">
									      	<input type="text" class="form-control input-lg" id="inputEmail3" placeholder="@ Your Twitter">
									    </div>
									 </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									    <label class="col-sm-2 control-label">
										    <div class="col-no-padding-left">
					      						<span class="fa-stack fa-lg">
												  <i class="fa fa-square fa-stack-2x"></i>
												  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
												</span>
					      					</div>
					      				</label>
									    <div class="col-sm-10">
									      	<input type="text" class="form-control input-lg" id="inputEmail3" placeholder="Your Facebook">
									    </div>
									 </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									    <label class="col-sm-2 control-label">
										    <div class="col-no-padding-left">
					      						<span class="fa-stack fa-lg">
												  <i class="fa fa-square fa-stack-2x"></i>
												  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
												</span>
					      					</div>
					      				</label>
									    <div class="col-sm-10">
									      	<input type="text" class="form-control input-lg" id="inputEmail3" placeholder="Your g+">
									    </div>
									 </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									    <label class="col-sm-2 control-label">
										    <div class="col-no-padding-left">
					      						<span class="fa-stack fa-lg">
												  <i class="fa fa-square fa-stack-2x"></i>
												  <i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
												</span>
					      					</div>
					      				</label>
									    <div class="col-sm-10">
									      	<input type="text" class="form-control input-lg" id="inputEmail3" placeholder="Your Path">
									    </div>
									 </div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<button class="btn btn-success btn-lg" type="submit" style="width:150px">
			                    	Save
			                  	</button>
							</div>
						</form>
				  	</div>
				</div>
      		</div>
      	</div>
      </div>
    </div>
</body>
</html>
