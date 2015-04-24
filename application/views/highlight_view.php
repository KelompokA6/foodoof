<div class="col-md-12 col-xs-12">
  <h3 class="page-header-title text-capitalize" style="margin-top:20px">
    Highlight Recipe
  </h3>
</div>
{highlight_recipe_entries}
<div class="col-md-12 col-xs-12 col-no-padding-right card">
  <div class="col-md-3 col-xs-12 detail-list-img" style="margin-right:2px">
      <a href="<?php echo base_url();?>index.php/recipe/get/{highlight_recipe_id}">
        <img class="img-responsive img-rounded details-img-recipe" src="<?php echo base_url();?>{highlight_recipe_photo}"/>
      </a>
  </div>
  <div class="col-md-8 col-xs-12 detail-list">
    <div class="col-md-12 col-xs-12 details">
        <div class="col-md-12 col-xs-12">
          <a href="<?php echo base_url();?>index.php/recipe/get/{highlight_recipe_id}">
            <h4><p class="text-capitalize">{highlight_recipe_name}</p></h4>
          </a>
        </div>
    </div>
    <div class="col-md-12 col-xs-6 details col-no-padding">
        <div class="col-md-4 col-xs-6 col-no-padding-right details-user-recipe">
          <a href="<?php echo base_url();?>index.php/user/timeline/{highlight_recipe_author_id}"><p class="text-capitalize">{highlight_recipe_author_name}</p></a>
        </div>
        <div class="col-md-8 col-xs-6 col-no-padding-right details-time-recipe border-dashed-left">
          <p class="text-capitalize">{highlight_recipe_last_update}</p>
        </div>
    </div>
    <div class="col-md-12 col-xs-6 details details-rating">
      <div class="col-md-12 col-xs-12" title="Rating">
          <input id="input-2b" class="rating" value="{highlight_recipe_rating}" data-recipeId="{highlight_recipe_id}" data-readonly='true' data-min="0" data-max="5" data-starts=3 data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
      </div>
    </div>  
  </div>
</div>
{/highlight_recipe_entries}
