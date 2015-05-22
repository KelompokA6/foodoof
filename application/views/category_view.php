<div class="panel-body">
  <div class="col-md-12 col-xs-12">
    <h3 class="page-header-title text-capitalize" style="margin-top:5px">
      '{category_name}' Recipe's
    </h3>
  </div>
  <?php
  if(empty(($category_recipe_entries))){
      echo "No Recipes Found";
    }
  ?>
  {category_recipe_entries}
  <div class="col-md-12 col-xs-12 col-no-padding-right page-header" style="margin-top:5px">
    <div class="col-md-2 col-xs-12 detail-list-img" style="margin-right:2px">
        <a href="<?php echo base_url();?>index.php/recipe/get/{category_recipe_id}">
          <img class="img-responsive img-rounded img-list-category" src="<?php echo base_url();?>{category_recipe_photo}"/>
        </a>
    </div>
    <div class="col-md-9 col-xs-12 detail-list">
      <div class="col-md-12 col-xs-12 details">
        <div class="col-md-12 col-xs-12 xs-text-center">
          <a href="<?php echo base_url();?>index.php/recipe/get/{category_recipe_id}">
            <h4><p class="text-capitalize title-recipe">{category_recipe_name}</p></h4>
          </a>
        </div>
      </div>
      <div class="col-md-12 col-xs-6 details col-no-padding detail-time-recipe">
        <div class="col-md-3 col-xs-5 col-no-padding-right">
          <p class="text-capitalize">Last update :</p>
        </div>
        <div class="col-md-9 col-xs-7 col-no-padding-left">
          <p class="text-capitalize">{category_recipe_last_update}</p>
        </div>
      </div>
      <div class="col-md-12 col-xs-6 details detail-rating-recipe">
        <div class="col-md-11" title="Rating">
            <input id="input-2b" class="rating" value="{category_recipe_rating}" data-readonly='true' data-min="0" data-max="5" data-starts=3 data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
        </div>
      </div>  
    </div>
  </div>
  {/category_recipe_entries}
  <div class="col-md-12 col-xs-12 text-center">
    <?php
      if($category_recipe_page_size > 0){
        echo "<nav>
                <ul class='pager'>
                  <li class='";
        if($category_recipe_page_size - $category_recipe_page_now == ($category_recipe_page_size-1)){
            echo "disabled";
          }
        echo "'><a href='".base_url()."index.php/recipe/category/".$category_name."?page=".($category_recipe_page_now - 1)."' aria-label='Previous'>
            <span aria-hidden='true'>&laquo;</span>
          </a></li>";
        for ($i=1; $i <= $category_recipe_page_size ; $i++) { 
          $active = "";
          if($i == $category_recipe_page_now){
            $active = "active";
          }
          echo "
            <li class=".$active.">
              <a href='".base_url()."index.php/recipe/category/".$category_name."?page=".$i."'>".$i."</a>
            </li>
          ";
        }

        echo "<li class='";
        if($category_recipe_page_size == $category_recipe_page_now){
            echo "disabled";
          }
        echo "'><a href='".base_url()."index.php/recipe/category/".$category_name."?page=".($category_recipe_page_now + 1)."' aria-label='Next'>
            <span aria-hidden='true'>&raquo;</span>
          </a></li></ul></nav>
        ";
      }
    ?>
  </div>
</div>