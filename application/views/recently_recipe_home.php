<div class="panel">
  <div class="col-md-12 panel-home-title text-center">
    <a href="<?php echo base_url();?>index.php/home/recently" style="color:#fff; font-size:15px">Recently Recipe</a>
  </div>
  <div class="panel-body  col-no-padding">
    {recently_recipe_entries}
    <div class="col-md-12 col-xs-12 item-recipe-home">
      <div class="col-md-3 col-xs-4 detail-list-img-recipe-home">
        <a href="<?php echo base_url();?>index.php/recipe/get/{recently_recipe_id}">
          <img class="img-responsive img-rounded img-list-recipe-home" style="margin:auto;" src="<?php echo base_url();?>{recently_recipe_photo}"/>
        </a>
      </div>
      <div class="col-md-8 col-xs-7 detail-list-recipe-home">
        <div class="col-md-12 col-xs-12 details-recipe-home">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-cutlery pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php echo base_url();?>index.php/recipe/get/{recently_recipe_id}">
              <p class="text-capitalize">{recently_recipe_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 details-recipe-home">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-user pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php echo base_url();?>index.php/user/timeline/{recently_recipe_author}">
              <p class="text-capitalize">{recently_recipe_author_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 details-recipe-home">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-calendar pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <p class="text-capitalize">{recently_recipe_create_date}</p>
          </div>
        </div>
      </div>
    </div>
    {/recently_recipe_entries}
    <a href="<?php echo base_url();?>index.php/home/recently" class="pull-right" style="padding:0 20px 15px">See More...</a>
  </div>
</div>