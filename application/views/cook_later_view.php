<div class="panel panel-default">
<?php echo $this->session->flashdata('alert-notification');?>
  	<div class="panel-body">
    	<div class="col-md-12 col-xs-12 col-no-padding-right">
    		<h3 class="page-header" style="margin-top:5px;"> <?php echo $cook_later_user_name;?>'s Cook Later</h3>
    	</div>
    	<!-- Tabs Above -->
		<div class='tabs-x tabs-above '>
		    <ul id="myTab-5" class="nav nav-tabs" role="tablist">
		        <li class="active col-md-6 col-xs-6 col-sm-6 col-no-padding text-center"><a href="#unfinished" role="tab" data-toggle="tab">Unfinish</a></li>
		        <li class="col-md-6 col-xs-6 col-sm-6 col-no-padding text-center"><a href="#finished" role="tab-kv" data-toggle="tab">Finished</a></li>
		    </ul>
		    <div id="myTabContent-5" class="tab-content">
		        <div class="tab-pane fade in active" id="unfinished">
		        	<?php foreach ($cook_later_recipe_entries_unfinished as $obj){?>
			    		<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding page-header-title">
							<div class="col-md-2 col-xs-6 col-md-offset-0 col-xs-offset-3 detail-list-img" style="margin-right:2px; margin-bottom:10px">
						        <a href="<?php echo base_url();?>index.php/recipe/get/<?php echo $obj->cook_later_recipe_id;?>" title="<?php echo $obj->cook_later_recipe_name;?>">
						        	<img class="img-responsive img-rounded img-list-usertimeline details-img-recipe" src="<?php echo base_url();?><?php echo ($obj->cook_later_recipe_photo); ?>"/>
						        </a>
						    </div>
						    <div class="col-md-7 col-xs-12 detail-list">
						    	<div class="col-md-12 col-xs-12 details xs-text-center">
						          	<div class="col-md-12 col-xs-12 col-no-padding-right">
						            	<a href="<?php echo base_url();?>index.php/recipe/get/<?php echo $obj->cook_later_recipe_id; ?>" title="<?php echo $obj->cook_later_recipe_name;?>">
						            		<h4><p class="text-capitalize title-recipe"><?php echo ($obj->cook_later_recipe_name); ?></p></h4>
						            	</a>
						          	</div>
						        </div>
						        <div class="col-md-12 col-xs-6 col-no-padding details" style="font-size:12px">
						          	<div class="col-md-4 col-xs-5 col-no-padding-right xs-text-right">
						            	<p class="text-capitalize">Last update :</p>
						          	</div>
						          	<div class="col-md-8 col-xs-7 col-no-padding-right xs-text-right">
						            	<p class="text-capitalize"><?php echo $obj->cook_later_recipe_last_update; ?></p>
						          	</div>
						        </div>
						        <div class="col-md-12 col-xs-6 details xs-text-center" style="margin-bottom:15px">
						        	<div class="col-md-11" title="Rating">
						          		<input id="input-2b" class="rating" data-recipeId="<?php echo $obj->cook_later_recipe_id; ?>" data-min="0" data-readonly='true' data-max="5" value="<?php echo $obj->cook_later_recipe_rating; ?>" data-step="0.1" data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
									</div>
						        </div>  
						    </div>
						    <div class="col-md-2 col-xs-12 col-no-padding col-edit-recipe-cooklater">
						    	<div class="col-md-12 col-xs-offset-3 col-xs-3 col-no-padding-left text-center xs-text-right">
						    		<div class="checkbox">
									    <label>
									      	<input type="checkbox" class="checked-cook-later" value="<?php echo $obj->cook_later_recipe_id;?>"><span> Finished</span>
									    </label>
									 </div>
						    	</div>
						    	<div class="col-md-12 col-xs-3 col-no-padding-right recipe-cooklater-remove-btn text-center xs-text-left">
							    	<div class="col-md-12 col-md-offset-0 col-xs-offset-4 col-xs-4 col-no-padding-right recipe-cooklater-remove-btn">
					  					<button id="remove-cooklater" class="btn button-secondary" data-recipeid="<?php echo $obj->cook_later_recipe_id; ?>" style="width:90px">
					  						<i class="fa fa-trash fa-lg"></i>
					  						Remove 
					  					</button>
							    	</div>
						    	</div>
						    </div>
						</div>
			    	<?php }?>
		        </div>
		        <div class="tab-pane fade" id="finished">
		        	<?php foreach ($cook_later_recipe_entries_finished as $obj){?>
			    		<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding page-header-title">
							<div class="col-md-2 col-xs-6 col-md-offset-0 col-xs-offset-3 detail-list-img" style="margin-right:2px; margin-bottom:10px;">
						        <a href="<?php echo base_url();?>index.php/recipe/get/<?php echo $obj->cook_later_recipe_id;?>" title="<?php echo $obj->cook_later_recipe_name;?>">
						        	<img class="img-responsive img-rounded img-list-usertimeline details-img-recipe" src="<?php echo base_url();?><?php echo ($obj->cook_later_recipe_photo); ?>"/>
						        </a>
						    </div>
						    <div class="col-md-7 col-xs-12 detail-list">
						    	<div class="col-md-12 col-xs-12 details xs-text-center">
						          	<div class="col-md-12 col-xs-12 col-no-padding-right">
						            	<a href="<?php echo base_url();?>index.php/recipe/get/<?php echo $obj->cook_later_recipe_id; ?>" title="<?php echo $obj->cook_later_recipe_name;?>">
						            		<h4><p class="text-capitalize title-recipe"><?php echo ($obj->cook_later_recipe_name); ?></p></h4>
						            	</a>
						          	</div>
						        </div>
						        <div class="col-md-12 col-xs-6 col-no-padding details" style="font-size:12px">
						          	<div class="col-md-4 col-xs-5 col-no-padding-right xs-text-right">
						            	<p class="text-capitalize">Last update :</p>
						          	</div>
						          	<div class="col-md-8 col-xs-7 col-no-padding-right xs-text-right">
						            	<p class="text-capitalize"><?php echo $obj->cook_later_recipe_last_update; ?></p>
						          	</div>
						        </div>
						        <div class="col-md-12 col-xs-6 details xs-text-center" style="margin-bottom:15px">
						        	<div class="col-md-11" title="Rating">
						          		<input id="input-2b" class="rating" data-recipeId="<?php echo $obj->cook_later_recipe_id; ?>" data-min="0" data-readonly='true' data-max="5" value="<?php echo $obj->cook_later_recipe_rating; ?>" data-step="0.1" data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
									</div>
						        </div>  
						    </div>
						    <div class="col-md-2 col-xs-12 col-no-padding col-edit-recipe-cooklater">
						    	<div class="col-md-12 col-xs-12 col-no-padding-right recipe-cooklater-remove-btn text-center">
							    	<div class="col-md-12 col-xs-12 col-no-padding-right recipe-cooklater-remove-btn">
					  					<button id="remove-cooklater" class="btn button-secondary" data-recipeid="<?php echo $obj->cook_later_recipe_id; ?>" style="width:90px">
					  						<i class="fa fa-trash fa-lg"></i>
					  						Remove 
					  					</button>
							    	</div>
						    	</div>
						    </div>
						</div>
			    	<?php }?>
		        </div>
		    </div>
		</div>
		<!-- {/cook_later_recipe_entries} -->
		<div class="col-md-12 col-xs-12 text-center">
		    <?php
		      if($cook_later_recipe_page_size > 0){
		        echo "<nav>
		                <ul class='pager'>
		                  <li class='";
		        if($cook_later_recipe_page_size - $cook_later_recipe_page_now == ($cook_later_recipe_page_size-1)){
		            echo "disabled";
		            echo "'><a aria-label='Previous'>
		            <span aria-hidden='true'>&laquo;</span>
		          </a></li>";
		          }
		          else{
		          	 echo "'><a href='".base_url()."index.php/user/timeline/{cook_later_id}?page=".($cook_later_recipe_page_now - 1)."' aria-label='Previous'>
		            <span aria-hidden='true'>&laquo;</span>
		          </a></li>";
		          }
		       
		        for ($i=1; $i <= $cook_later_recipe_page_size ; $i++) { 
		          $active = "";
		          if($i == $cook_later_recipe_page_now){
		            $active = "active";
		          }
		          echo "
		            <li class='".$active."'>
		              <a href='".base_url()."index.php/user/timeline/{cook_later_id}?page=".$i."'>".$i."</a>
		            </li>
		          ";
		        }
		        echo "<li class='";
		        if($cook_later_recipe_page_size == $cook_later_recipe_page_now){
		            echo "disabled";
		            echo "'><a aria-label='Next'>
		            <span aria-hidden='true'>&raquo;</span>
		          </a></li>
		          </ul>
		          </nav>
		        ";
		          }
		        else{
		        echo "'><a href='".base_url()."index.php/user/timeline/{cook_later_id}?page=".($cook_later_recipe_page_now + 1)."' aria-label='Next'>
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