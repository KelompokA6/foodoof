<div class="panel panel-default">
<?php echo $this->session->flashdata('alert-notification');?>
  	<div class="panel-body">
    	<div class="col-md-12 col-xs-12 col-no-padding-right">
    		<h3 class="page-header" style="margin-top:5px;"> {favorite_user_name}'s Favorite</h3>
    	</div>
    	{favorite_recipe_entries}
    	<div class="col-md-12 col-xs-12 col-no-padding-right page-header-title">
			<div class="col-md-2 col-xs-6 col-md-offset-0 col-xs-offset-3 detail-list-img" style="margin-right:2px; margin-bottom:10px">
		        <a href="<?php echo base_url();?>index.php/recipe/get/{favorite_recipe_id}" title="{favorite_recipe_name}">
		        	<img class="img-responsive img-rounded img-list-usertimeline details-img-recipe" src="<?php echo base_url();?>{favorite_recipe_photo}"/>
		        </a>
		    </div>
		    <div class="col-md-7 col-xs-12 detail-list">
		    	<div class="col-md-12 col-xs-12 details xs-text-center">
		          	<div class="col-md-12 col-xs-12 col-no-padding-right">
		            	<a href="<?php echo base_url();?>index.php/recipe/get/{favorite_recipe_id}" title="{favorite_recipe_name}">
		            		<h4><p class="text-capitalize title-recipe">{favorite_recipe_name}</p></h4>
		            	</a>
		          	</div>
		        </div>
		        <div class="col-md-12 col-xs-6 col-no-padding details" style="font-size:12px">
		          	<div class="col-md-4 col-xs-5 col-no-padding-right xs-text-right">
		            	<p class="text-capitalize">Last update :</p>
		          	</div>
		          	<div class="col-md-8 col-xs-7 col-no-padding-right xs-text-right">
		            	<p class="text-capitalize">{favorite_recipe_last_update}</p>
		          	</div>
		        </div>
		        <div class="col-md-12 col-xs-6 details xs-text-center" style="margin-bottom:15px">
		        	<div class="col-md-11" title="Rating">
		          		<input id="input-2b" class="rating" data-recipeId="{favorite_recipe_id}" data-min="0" data-readonly='true' data-max="5" value="{favorite_recipe_rating}" data-step="0.1" data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
					</div>
		        </div>  
		    </div>
		    <div class="col-md-2 col-xs-12 col-no-padding col-edit-recipe-timeline">
		    	<?php if ($this->session->userdata('user_id') == $favorite_user_id): ?>
		    	<div class="col-md-12 col-xs-offset-4 col-xs-4 col-no-padding-right recipe-timeline-edit-btn">
  					<button id="remove-favorite" class="btn button-secondary" data-recipeid="{favorite_recipe_id}" style="width:90px">
  						<i class="fa fa-trash fa-lg"></i>
  						Remove
  					</button>
		    	</div>
		    <?php endif;?>
		    </div>
		</div>
		{/favorite_recipe_entries}
		<div class="col-md-12 col-xs-12 text-center">
		    <?php
		      if($favorite_recipe_page_size > 0){
		        echo "<nav>
		                <ul class='pager'>
		                  <li class='";
		        if($favorite_recipe_page_size - $favorite_recipe_page_now == ($favorite_recipe_page_size-1)){
		            echo "disabled";
		            echo "'><a aria-label='Previous'>
		            <span aria-hidden='true'>&laquo;</span>
		          </a></li>";
		          }
		          else{
		          	 echo "'><a href='".base_url()."index.php/user/favorite/{favorite_user_id}?page=".($favorite_recipe_page_now - 1)."' aria-label='Previous'>
		            <span aria-hidden='true'>&laquo;</span>
		          </a></li>";
		          }
		       
		        for ($i=1; $i <= $favorite_recipe_page_size ; $i++) { 
		          $active = "";
		          if($i == $favorite_recipe_page_now){
		            $active = "active";
		          }
		          echo "
		            <li class='".$active."'>
		              <a href='".base_url()."index.php/user/favorite/{favorite_user_id}?page=".$i."'>".$i."</a>
		            </li>
		          ";
		        }
		        echo "<li class='";
		        if($favorite_recipe_page_size == $favorite_recipe_page_now){
		            echo "disabled";
		            echo "'><a aria-label='Next'>
		            <span aria-hidden='true'>&raquo;</span>
		          </a></li>
		          </ul>
		          </nav>
		        ";
		          }
		        else{
		        echo "'><a href='".base_url()."index.php/user/favorite/{favorite_user_id}?page=".($favorite_recipe_page_now + 1)."' aria-label='Next'>
		            <span aria-hidden='true'>&raquo;</span>
		          </a></li>
		          </ul>
		          </nav>
		        ";
		        }
		      }
		    ?>
		</div>
  	</div>
</div>