<div class="panel panel-info">
  <div class="col-md-12 panel-home-title text-center">
    <a href="<?php echo base_url()?>home/toprecipe" style="color:#fff">Top Recipe</a>
  </div>
  <div class="panel-body">
    {top_recipe_entries}
    <div class="col-md-12 col-xs-12 page-header recipe-list-home">
      <div class="col-md-3 col-xs-3 detail-list-img">
        <a href="<?php echo base_url();?>recipe/get/{recently_recipe_id}">
          <img class="img-responsive img-rounded img-list" src="<?php echo base_url();?>{top_recipe_photo}"/>
        </a>
      </div>
      <div class="col-md-8 col-xs-8 detail-list">
        <div class="col-md-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-cutlery pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php echo base_url();?>recipe/get/{top_recipe_id}">
              <p class="text-capitalize">{top_recipe_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-user pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php echo base_url();?>user/timeline/{top_recipe_author}">
              <p class="text-capitalize">{top_recipe_author_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-eye pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <p class="text-capitalize">{top_recipe_views} Views</p>
          </div>
        </div>
      </div>
    </div>
    {/top_recipe_entries}
    <a href="<?php echo base_url()?>home/toprecipe" class="pull-right">See More...</a>
  </div>
</div>