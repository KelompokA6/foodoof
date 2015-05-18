  <div class="col-md-12 col-xs-12 page-header-title text-left">
    <h4 class="col-md-4 col-xs-6 col-no-padding"style="margin:5px; font-size:18px">Recently Recipe</h4>
    <a href="<?php echo base_url()?>index.php/home/recently" class="text-right pull-right"><button class="btn button-secondary">See More</button></a>
  </div>
  <!-- <div class="panel-body"> -->
  <div class="col-md-12 col-xs-12 col-no-padding">
    {recently_recipe_entries}
    <div class='col-md-3 col-xs-6 col-no-padding'>
      <div class="recently-recipe card">
        <a class="col-md-12 col-xs-12 col-no-padding" href="<?php echo base_url();?>index.php/recipe/get/{recently_recipe_id}">
          <img class="img-responsive details-img-recipe" src="<?php echo base_url();?>{recently_recipe_photo}"  title="{recently_recipe_name}"/>
        </a>
        <a class="col-md-12 col-xs-12 text-capitalize title-recipe-home" href="<?php echo base_url();?>index.php/recipe/get/{recently_recipe_id}" title="{recently_recipe_name}">
          {recently_recipe_name}
        </a>
        <a class="col-md-12 col-xs-12 author-recipe-home" href="<?php echo base_url();?>index.php/user/timeline/{recently_recipe_author}">
          <img class="img-responsive img-circle img-recipe-author" src="<?php echo base_url();?>{recently_recipe_author_photo}" title="{recently_recipe_author_name}"/>
          <span class="recipe-author-name" title="{recently_recipe_author_name}">{recently_recipe_author_name}</span>
        </a>
        <div class="col-md-12 col-xs-12 time-recipe-home col-no-padding-right" title="Create Date">
          <div class="col-md-1 col-xs-2 col-no-padding-left">
            <i class="fa fa-calendar icon icons-secondary"></i>
          </div>
          <div class="col-md-10 col-xs-10 col-no-padding-left-mobile col-no-padding-right">
            <span data-livestamp="{recently_recipe_create_date}"></span>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="col-md-12 col-xs-12 item-recipe-home col-no-padding">
      <div class="col-md-3 col-xs-4 detail-list-img-recipe-home">
        <a href="<?php //echo base_url();?>index.php/recipe/get/{recently_recipe_id}">
          <img class="img-responsive img-rounded img-list-recipe-home" style="margin:auto;" src="<?php //echo base_url();?>{recently_recipe_photo}"/>
        </a>
      </div>
      <div class="col-md-8 col-xs-7 detail-list-recipe-home">
        <div class="col-md-12 col-xs-12 details-recipe-home">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-cutlery pull-left icons-secondary"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php //echo base_url();?>index.php/recipe/get/{recently_recipe_id}">
              <p class="text-capitalize"style="text-overflow:ellipsis; overflow:hidden">{recently_recipe_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 details-recipe-home">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-user pull-left icons-secondary"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <a href="<?php //echo base_url();?>index.php/user/timeline/{recently_recipe_author}">
              <p class="text-capitalize">{recently_recipe_author_name}</p>
            </a>
          </div>
        </div>
        <div class="col-md-12 col-xs-12 details-recipe-home">
          <div class="col-md-2 col-xs-3 icons">
            <i class="fa fa-calendar pull-left icons-secondary"></i>
          </div>
          <div class="col-md-10 col-xs-9">
            <p class="text-capitalize">{recently_recipe_create_date}</p>
          </div>
        </div>
      </div>
    </div> -->
    {/recently_recipe_entries}
  <!--  <a href="<?php //echo base_url();?>index.php/home/recently" class="pull-right" style="padding:0 20px 15px">See More...</a>
  </div> -->
 </div>