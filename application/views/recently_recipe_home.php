<div class="panel panel-info">
  <div class="col-md-12 page-header-title text-center">
    Recently Recipe
  </div>
  <div class="panel-body">
    {recently_recipe_entries}
    <div class="col-md-12 col-xs-12 page-header recipe-list-home">
      <div class="col-md-3 col-xs-3 detail-list-img">
        <a href="<?php echo base_url();?>recipe/get/{recently_recipe_id}">
          <img class="img-responsive img-rounded img-list" src="<?php echo base_url();?>{recently_recipe_photo}"/>
        </a>
      </div>
      <div class="col-md-8 col-xs-8 detail-list">
        <div class="col-md-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-cutlery pull-left"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php echo base_url();?>recipe/get/{recently_recipe_id}">
              <p class="text-capitalize">{recently_recipe_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-user pull-left"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php echo base_url();?>user/timeline/{recently_recipe_author}">
              <p class="text-capitalize">{recently_recipe_author_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-calendar pull-left"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <p class="text-capitalize">{recently_recipe_create_date}</p>
          </div>
        </div>
      </div>
    </div>
    {/recently_recipe_entries}
    <a href="<?php echo base_url();?>home/recently" class="pull-right">See More...</a>
  </div>
</div>