<div class="panel-body">
  <div class="col-md-12 col-xs-12">
    <h3 class="page-header" style="margin-top:5px">
      Recently Recipe
    </h3>
  </div>
  {recently_recipe_entries}
  <div class="col-md-12 col-xs-12 col-no-padding-right page-header" style="margin-top:5px">
    <div class="col-md-2 col-xs-3 detail-list-img" style="margin-right:2px">
        <a href="<?php echo base_url();?>recipe/get/{recently_recipe_id}">
          <img class="img-responsive img-rounded img-list-usertimeline" src="<?php echo base_url();?>{recently_recipe_photo}"/>
        </a>
    </div>
    <div class="col-md-6 col-xs-9 detail-list">
      <div class="col-md-12 details">
          <div class="col-md-12 col-xs-9">
            <a href="<?php echo base_url();?>recipe/get/{recently_recipe_id}">
              <h4><p class="text-capitalize">{recently_recipe_name}</p></h4>
            </a>
          </div>
      </div>
      <div class="col-md-12 col-xs-12 details">
          <div class="col-md-4 col-xs-3 col-no-padding-right">
            <p class="text-capitalize">Last update :</p>
          </div>
          <div class="col-md-8 col-xs-9 col-no-padding-left">
            <p class="text-capitalize">{recently_recipe_last_update}</p>
          </div>
      </div>
      <div class="col-md-12 col-xs-12 details">
        <div class="col-md-11" title="Rating">
            <input id="input-2b" class="rating" value="{recently_recipe_rating}" data-min="0" data-max="5" data-starts=3 data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
        </div>
      </div>  
    </div>
  </div>
  {/top_recipe_entries}
</div>