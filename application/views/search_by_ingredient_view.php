<div class="panel-body">
  <div class="col-md-12 col-xs-12">
    <h3 class="page-header-title" style="margin-top:5px">
      {search_by_ingredient_recipe_result}
      <?php
        if($search_by_ingredient_recipe_result > 1){
          echo "results";
        }
        else{
          echo "result"; 
        }
      ?>
      of '{search_by_ingredient_recipe_key}'
    </h3>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
  <form id="filterRecipe" action="<?php echo base_url();?>search?">
    <input type="hidden" name="searchby" value="ingredient">
    <input type="hidden" name="q" value="{search_by_ingredient_recipe_key}">
    <div class="pull-right dropdown">
      <button data-toggle="dropdown" class="btn button-category dropdown-toggle">
        All Category    <span class="caret"></span>
      </button>
      <ul id="filterCategory" class="dropdown-menu bullet pull-center">
        <li>
          <input type="checkbox" id="ex2_1" name="ex2" value="Indonesian Food">
          <label for="ex2_1">Indonesian Food</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_2" name="ex2" value="Traditional Food">
          <label for="ex2_2">Traditional Food</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_3" name="ex2" value="Rice">
          <label for="ex2_3">Rice</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_4" name="ex2" value="Noodle">
          <label for="ex2_4">Noodle</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_5" name="ex2" value="Meat">
          <label for="ex2_5">Meat</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_6" name="ex2" value="Vegetarian">
          <label for="ex2_6">Vegetarian</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_7" name="ex2" value="Seafood">
          <label for="ex2_7">Seafood</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_8" name="ex2" value="Snack">
          <label for="ex2_8">Snack</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_9" name="ex2" value="Dessert">
          <label for="ex2_9">Dessert</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_10" name="ex2" value="Beverage">
          <label for="ex2_10">Beverage</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_11" name="ex2" value="Chinese Food">
          <label for="ex2_11">Chinese Food</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_12" name="ex2" value="Western Food">
          <label for="ex2_12">Western Food</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_13" name="ex2" value="Middle-Eastern Food">
          <label for="ex2_13">Middle-Eastern Food</label>
        </li>
        <li>
          <input type="checkbox" id="ex2_14" name="ex2" value="Other">
          <label for="ex2_14">Other</label>
        </li>
      </ul>
      </form>
      <a href="javascript: submitform()">
        <button class="btn button-secondary"> Filter</button>
      </a>
    </div>
  </div>
  {search_by_ingredient_recipe_entries}
  <div class="col-md-12 col-xs-12 col-no-padding-right page-header" style="margin-top:5px">
    <div class="col-md-3 col-xs-12 detail-list-img" style="margin-right:2px">
        <a href="<?php echo base_url();?>recipe/get/{search_by_ingredient_recipe_id}" title="{search_by_ingredient_recipe_name}">
          <img class="img-responsive img-rounded img-list-search-ingredient" src="<?php echo base_url();?>{search_by_ingredient_recipe_photo}"/>
        </a>
    </div>
    <div class="col-md-8 col-xs-12 detail-list-search-ingredient">
      <div class="col-md-12 col-xs-12 details">
        <div class="col-md-12 col-xs-12 xs-text-center">
          <a href="<?php echo base_url();?>recipe/get/{search_by_ingredient_recipe_id}" title="{search_by_ingredient_recipe_name}">
            <h4><p class="text-capitalize title-recipe">{search_by_ingredient_recipe_name}</p></h4>
          </a>
        </div>
      </div>
      <div class="col-md-12 col-xs-6 details col-no-padding">
          <div class="col-md-4 col-xs-6 col-no-padding-right details-user-recipe">
            <a href="<?php echo base_url();?>index.php/user/timeline/{search_by_ingredient_recipe_author_id}" class="author-recipe">
              <img class="img-responsive img-circle img-recipe-author" src="<?php echo base_url();?>{search_by_ingredient_recipe_author_photo}" title="{search_by_ingredient_recipe_author_name}"/>
              <span class="recipe-author-name" title="{search_by_ingredient_recipe_author_name}">{search_by_ingredient_recipe_author_name}</span>
            </a>
          </div>
          <div class="col-md-8 col-xs-6 col-no-padding-right details-time-recipe border-dashed-left">
            <p class="text-capitalize">{search_by_ingredient_recipe_last_update}</p>
          </div>
      </div>
      <div class="col-md-12 col-xs-6 details details-rating">
        <div class="col-md-12 col-xs-12" title="Rating">
            <input id="input-2b" class="rating" data-recipeId="{search_by_ingredient_recipe_id}" value="{search_by_ingredient_recipe_rating}" data-readonly='true' data-min="0" data-max="5" data-starts=3 data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
        </div>
      </div>
      <div class="col-md-12 col-xs-12 details" style="padding:10px 15px 0">
          Found '{search_by_ingredient_recipe_found}'
      </div>  
    </div> 
  </div>
  {/search_by_ingredient_recipe_entries}
  <div class="col-md-12 col-xs-12 text-center text-capitalize">
    <?php
    if($search_by_ingredient_recipe_page_size == 0):?>
    no recipes found
    <?php
    endif;?>
    <?php
      if($search_by_ingredient_recipe_page_size > 0){
        echo "<nav>
                <ul class='pager'>
                  <li class='";
        if($search_by_ingredient_recipe_page_size - $search_by_ingredient_recipe_page_now == ($search_by_ingredient_recipe_page_size-1)){
            echo "disabled";
             echo "'><a aria-label='Previous'>
            <span aria-hidden='true'>&laquo;</span>
          </a></li>";
          }else{
            
        echo "'><a href='".base_url()."index.php/search/?q=".$search_by_ingredient_recipe_key."&searchby=ingredient&page=".($search_by_ingredient_recipe_page_now - 1)."' aria-label='Previous'>
            <span aria-hidden='true'>&laquo;</span>
          </a></li>";
          }
        for ($i=1; $i <= $search_by_ingredient_recipe_page_size ; $i++) { 
          $active = "";
          if($i == $search_by_ingredient_recipe_page_now){
            $active = "active";
          }
          echo "
            <li class=".$active.">
              <a href='".base_url()."index.php/search/?q=".$search_by_ingredient_recipe_key."&searchby=ingredient&page=".$i."'>".$i."</a>
            </li>
          ";
        }

        echo "<li class='";
        if($search_by_ingredient_recipe_page_size == $search_by_ingredient_recipe_page_now){
            echo "disabled";
            echo "'><a aria-label='Next'>
            <span aria-hidden='true'>&raquo;</span>
          </a></li></ul></nav>
        ";
          }
          else{
        echo "'><a href='".base_url()."index.php/search/?q=".$search_by_ingredient_recipe_key."&searchby=ingredient&page=".($search_by_ingredient_recipe_page_now + 1)."' aria-label='Next'>
            <span aria-hidden='true'>&raquo;</span>
          </a></li></ul></nav>
        ";  
          }
      }
    ?>
  </div>
</div>

<script type="text/javascript">
function submitform()
{
  document.filterRecipe.submit();
}
</script>