<div class="panel">
  <div class="col-md-12 panel-home-title text-center">
    <a href="<?php echo base_url()?>index.php/home/toprecipe" style="color:#fff">Top Recipe</a>
  </div>
  <div class="panel-body col-no-padding">
    {top_recipe_entries}
    <div class="col-md-12 col-xs-12 page-header recipe-list-home  col-no-padding-right">
      <div class="col-md-3 col-xs-3 detail-list-img">
        <a href="<?php echo base_url();?>index.php/recipe/get/{recently_recipe_id}">
          <img class="img-responsive img-rounded img-list" src="<?php echo base_url();?>{top_recipe_photo}"/>
        </a>
      </div>
      <div class="col-md-8 col-xs-8 detail-list col-no-padding">
        <div class="col-md-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-cutlery pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php echo base_url();?>index.php/recipe/get/{top_recipe_id}">
              <p class="text-capitalize">{top_recipe_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-user pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php echo base_url();?>index.php/user/timeline/{top_recipe_author}">
              <p class="text-capitalize">{top_recipe_author_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 details col-no-padding">
          <div class="col-md-12 col-xs-12 " title="Rating">
              <input id="input-2b" class="rating" value="{top_recipe_rating}" data-readonly='true' data-min="0" data-max="5" data-starts=3 data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
          </div>
        </div>
        <!-- <div class="col-md-12 details">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-eye pull-left icon-default"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <p class="text-capitalize">{top_recipe_views} Views</p>
          </div>
        </div> -->
      </div>
    </div>
    {/top_recipe_entries}
    <a href="<?php echo base_url()?>index.php/home/toprecipe" class="pull-right">See More...</a>
  </div>
</div>