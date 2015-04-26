<div class="col-md-12 col-xs-12 page-header-title text-left">
  <h4 class="col-md-4 col-xs-6 col-no-padding"style="margin:5px; font-size:18px">Top Recipe</h4>
  <a href="<?php echo base_url()?>index.php/home/toprecipe" class="text-right pull-right"><button class="btn button-default">See More</button></a>
</div>
<div class="col-md-12 col-xs-12 col-no-padding">
  {top_recipe_entries}
  <div class='col-md-3 col-xs-6 col-no-padding'>
    <div class="top-recipe card">
      <a class="col-md-12 col-xs-12 col-no-padding" href="<?php echo base_url();?>index.php/recipe/get/{top_recipe_id}">
        <img class="img-responsive details-img-recipe" src="<?php echo base_url();?>{top_recipe_photo}" title="{top_recipe_name}"/>
      </a>
      <a class="col-md-12 col-xs-12 text-capitalize title-recipe-home" href="<?php echo base_url();?>index.php/recipe/get/{top_recipe_id}" title="{top_recipe_name}">
        {top_recipe_name}
      </a>
      <a class="col-md-12 col-xs-12 author-recipe-home" href="<?php echo base_url();?>index.php/user/timeline/{top_recipe_author}">
        <img class="img-responsive img-circle img-recipe-author" src="<?php echo base_url();?>{top_recipe_author_photo}" title="{top_recipe_author_name}"/>
        <span class="recipe-author-name" title="{top_recipe_author_name}">{top_recipe_author_name}</span>
      </a>
      <div class="col-md-12 col-xs-12 rating-recipe col-no-padding-right" title="Rating">
        <div class="col-md-9 col-xs-9 col-no-padding">
          <input id="input-2b" class="rating" value="{top_recipe_rating}" data-readonly='true' data-min="0" data-max="5" data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} " data-star-captions="{}" data-show-clear="false">
        </div>
        <div class="col-md-3 col-xs-3 col-no-padding rating-users text-center" title="Total User">(<i class="fa fa-user"></i><!-- {top_recipe_total_user_rating} -->18)</div>
      </div>
    </div>
  </div>
  <!-- <div class="col-md-12 col-xs-12 item-recipe-home col-no-padding">
    <div class="col-md-3 col-xs-4 detail-list-img-recipe-home">
      <a href="<?php //echo base_url();?>index.php/recipe/get/{top_recipe_id}">
        <img class="img-responsive img-rounded img-list-recipe-home" style="margin:auto;" src="<?php //echo base_url();?>{top_recipe_photo}"/>
      </a>
    </div>
    <div class="col-md-8 col-xs-7 detail-list-recipe-home col-no-padding">
      <div class="col-md-12 col-xs-12 details-recipe-home">
        <div class="col-md-2 col-xs-3 icons">
          <i class="fa fa-cutlery pull-left icons-default"></i>
        </div>
        <div class="col-md-10 col-xs-9">
          <a href="<?php //echo base_url();?>index.php/recipe/get/{top_recipe_id}">
            <p class="text-capitalize">{top_recipe_name}</p>
          </a>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 details-recipe-home">
        <div class="col-md-2 col-xs-3 icons">
          <i class="fa fa-user pull-left icons-default"></i>
        </div>
        <div class="col-md-10 col-xs-9">
          <a href="<?php //echo base_url();?>index.php/user/timeline/{top_recipe_author}">
            <p class="text-capitalize">{top_recipe_author_name}</p>
          </a>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 details-recipe-home col-no-padding text-center">
        <div class="col-md-12 col-xs-12 " title="Rating">
            <input id="input-2b" class="rating" value="{top_recipe_rating}" data-readonly='true' data-min="0" data-max="5" data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} " data-star-captions="{}" data-show-clear="false">
        </div>
      </div>
      <!-- <div class="col-md-12 details">
        <div class="col-md-2 col-xs-3 icons">
          <i class="fa fa-eye pull-left icons-default"></i>
        </div>
        <div class="col-md-10 col-xs-9">
          <p class="text-capitalize">{top_recipe_views} Views</p>
        </div>
      </div> 
    </div>
  </div> -->
  {/top_recipe_entries}
</div>