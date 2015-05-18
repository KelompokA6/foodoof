<div class="panel-body">
  <div class="col-md-12 col-xs-12">
    <h3 class="page-header-title text-capitalize" style="margin-top:5px">
      Highlight Recipe
    </h3>
  </div>
  <?php
  if(empty(($highlight_recipe_entries))){
      echo "No Recipes Found";
    }
  ?>
  {highlight_recipe_entries}
  <div class="col-md-12 col-xs-12 col-no-padding-right page-header" style="margin-top:5px">
      <div class="col-md-2 col-xs-12 detail-list-img" style="margin-right:2px">
          <a href="<?php echo base_url();?>recipe/get/{highlight_recipe_id}" title="{highlight_recipe_name}">
            <img class="img-responsive img-rounded img-list-highlight" src="<?php echo base_url();?>{highlight_recipe_photo}"/>
          </a>
      </div>
    <div class="col-md-9 col-xs-12 detail-list">
      <div class="col-md-12 col-xs-12 details">
        <div class="col-md-12 col-xs-12 xs-text-center">
          <a href="<?php echo base_url();?>recipe/get/{highlight_recipe_id}" title="{highlight_recipe_name}">
            <h4><p class="text-capitalize title-recipe">{highlight_recipe_name}</p></h4>
          </a>
        </div>
      </div>
      <div class="col-md-12 col-xs-6 details col-no-padding">
          <div class="col-md-4 col-xs-6 col-no-padding-right details-user-recipe">
            <a href="<?php echo base_url();?>index.php/user/timeline/{highlight_recipe_author_id}" class="author-recipe">
              <img class="img-responsive img-circle img-recipe-author" src="<?php echo base_url();?>{highlight_recipe_author_photo}" title="{highlight_recipe_author_name}"/>
              <span class="recipe-author-name user-name" title="{highlight_recipe_author_name}">{highlight_recipe_author_name}</span>
            </a>
          </div>
          <div class="col-md-8 col-xs-6 col-no-padding-right details-time-recipe border-dashed-left">
            <p class="text-capitalize">{highlight_recipe_last_update}</p>
          </div>
      </div>
      <div class="col-md-12 col-xs-6 details details-rating">
        <div class="col-md-12 col-xs-12" title="Rating">
            <input id="input-2b" class="rating" data-recipeId="{highlight_recipe_id}" value="{highlight_recipe_rating}" data-readonly='true' data-min="0" data-max="5" data-starts=3 data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
        </div>
      </div>  
    </div>
  </div>
  {/highlight_recipe_entries}
</div>