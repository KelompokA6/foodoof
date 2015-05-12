<html id="html" lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website resep makanan berbasis media sosial.">
    <meta name="keywords" content="Web recipe, cooking, resep, masakan, food">
    <meta name="author" content="Abid Nurul Hakim, Agnes Agustinamora, Alfan Nur Fauzan, Fahmi Rahmat Kurniawan, dan Jean Fathanah">
    <title>FoodooF - Infinite Cooking Idea</title>
    <link href="<?php echo base_url();?>assets/plugin/bower-components/kartik-star-rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugin/bower-components/kartik-file-input/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugin/bower-components/bootstrap/dist/css/bootstrap.min.css">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/font-awesome/css/iconFont.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/elusive-icons/css/elusive-icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/bootstrap-lightbox/bootstrap-lightbox.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/badges/iosbadge.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugin/bower-components/typeahead/bootstrap-tagsinput.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugin/bower-components/bootstrap-popover-x/bootstrap-popover-x.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/plugin/bower-components/enhancement/css/dropdowns-enhancement.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugin/bower-components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/plugin/bower-components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugin/bower-components/bootstrap3-editable/css/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default/jasny-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default/foodoof.css">
  </head>
  <body>
    <div id="wrapper">
      {menubar}
    	<div class="container container-mobile">
    	  	<div class="row">
    	  		<div class="col-md-12">
    	  			{content_website}
    	  		</div>
    	  	</div>
    	</div>
      <?php
        $user_id = $this->session->userdata("user_id");
        $online_users = json_decode(file_get_contents(base_url('index.php/user/getonline/'.$user_id)));
      ?>
      <div id="users-online" class="btn btn-default col-md-2 col-xs-4 col-no-padding text-left" 
      style="position:fixed; left:0; bottom:0; z-index:100; border-bottom-right-radius:0">
        <div id="panel-users" class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title" id="online-count-1"><?php echo sizeof($online_users);?> Users Online</h3>
          </div>
          <div class="panel-body" id="online-panel">
            <div id="sample-online-user" hidden class="col-md-12 list-user-online col-no-padding-right">
              <div class="col-md-3 col-no-padding">
                <img id="imge" class="img-responsive img-rounded img-user-online" src="/foodoof/userphoto">
              </div>
              <div class="col-md-9 text-left col-no-padding-right name-user-online">
                <a id="ling" href="/foodoof/index.php/user/timeline/userid">username</a>
              </div>
            </div>
            <?php foreach ($online_users as $user): ?>
            <div class="col-md-12 list-user-online col-no-padding-right">
              <div class="col-md-3 col-no-padding">
                <img class="img-responsive img-rounded img-user-online" src="/foodoof/<?php echo $user->photo;?>">
              </div>
              <div class="col-md-9 text-left col-no-padding-right name-user-online">
                <a href="/foodoof/index.php/user/timeline/<?php echo $user->id;?>"><?php echo $user->name;?></a>
              </div>
            </div>
            <?php endforeach;?>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 col-no-padding" id="toggle-online-user">
          <div class="col-md-9 col-xs-8 text-left">
            <i class="fa fa-user fa-lg"></i>
            <span style="padding-left:15px;font-size:14px" id="online-count-2"><?php echo sizeof($online_users);?> Users Online</span>
          </div>
          <div class="col-md-2 col-xs-4"style="padding:3.5px;">
            <i class="fa fa-chevron-up fa-lg"></i>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <h4>Apa itu Foodoof ?</h4>
            <p class="text-justify">
              Website menyimpan resep makanan berbasis media sosial. Foodoof bertujuan sebagai wadah bagi kamu-kamu yang suka masak ataupun kalian yang ingin belajar masak
            </p>
          </div>
          <div class="col-md-3 col-xs-6">
            <h4>About Us</h4>
            <ul class="nav-pills nav-stacked">
              <li><a href="">About</a></li>
              <li><a href="">Contact Us</a></li>
              <li><a href="">Our Team</a></li>
            </ul>
          </div>
          <div class="col-md-3 col-xs-6">
            <h4>Guide</h4>
            <ul class="nav-pills nav-stacked">
              <li><a href="">Term of Services</a></li>
              <li><a href="">F.A.Q</a></li>
            </ul>
          </div>
          <div class="col-md-12 col-xs-12 text-center" style="margin:10px 0">
            &copy 2015, FoodooF. All rights reserved.
          </div>
        </div>
      </div>
    </footer>
  <div class="modal fade modal-loading" id="modalWaiting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-loading">
      <div class="modal-content">
        <div class="modal-body text-center">
          <img class="responsive" width="50px" src="/foodoof/assets/img/loading-spinner.gif"/>
        </div>
      </div>
    </div>
  </div>    
	</body>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/kartik-star-rating/js/star-rating.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/kartik-file-input/js/fileinput.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/bootstrap-popover-x/bootstrap-popover-x.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/typeahead/bootstrap3-typeahead.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/typeahead/bootstrap-tagsinput.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/plugin/bower-components/typeahead/bloodhound.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/enhancement/js/dropdowns-enhancement.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/bootstrap-notify/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/bootstrap-lightbox/bootstrap-lightbox.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/owl-carousel/owl.carousel.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/owl-carousel/jquery.mousewheel.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/autosize/autosize.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/badges/iosbadge.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/tinymce/tinymce.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/moment/moment.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/livestamp/livestamp.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/datatables/media/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugin/bower-components/bootstrap3-editable/js/bootstrap-editable.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jasny-bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/foodoof.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/online-user.js"></script>
</html>
