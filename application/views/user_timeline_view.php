<div class="panel panel-default">
<?php echo $this->session->flashdata('alert-notification');?>
  	<div class="panel-body">
    	<div class="col-md-12 col-xs-12 col-no-padding-right">
    		<h3 class="page-header" style="margin-top:5px;"> {user_timeline_name}'s Timeline</h3>
    		<div class="pull-right">
    			<?php
    			if($this->session->userdata('user_id') == $user_timeline_id): ?>
    			<a href="<?php echo base_url();?>index.php/recipe/create" title="Add Recipe">
    				<button class="btn button-default">
    					<i class="fa fa-plus fa-lg inverse" style="padding-top:2px"></i>
    				</button>
    			</a>
    			<?php endif; ?>
    		</div>
    	</div>
    	{user_timeline_recipe_entries}
    	<div class="col-md-12 col-xs-12 col-no-padding-right page-header-title">
			<div class="col-md-2 col-xs-6 col-md-offset-0 col-xs-offset-3 detail-list-img" style="margin-right:2px; margin-bottom:10px">
		        <a href="<?php echo base_url();?>index.php/recipe/get/{user_timeline_recipe_id}" title="{user_timeline_recipe_name}">
		        	<img class="img-responsive img-rounded img-list-usertimeline" src="<?php echo base_url();?>{user_timeline_recipe_photo}"/>
		        </a>
		    </div>
		    <div class="col-md-5 col-xs-12 detail-list">
		    	<div class="col-md-12 col-xs-12 details xs-text-center">
		          	<div class="col-md-12 col-xs-12 col-no-padding-right">
		            	<a href="<?php echo base_url();?>index.php/recipe/get/{user_timeline_recipe_id}" title="{user_timeline_recipe_name}">
		            		<h4><p class="text-capitalize title-recipe">{user_timeline_recipe_name}</p></h4>
		            	</a>
		          	</div>
		        </div>
		        <div class="col-md-12 col-xs-12 details" style="font-size:12px">
		          	<div class="col-md-4 col-xs-5 col-no-padding-right xs-text-right">
		            	<p class="text-capitalize">Last update :</p>
		          	</div>
		          	<div class="col-md-8 col-md-offset-0 col-xs-6 col-xs-offset-1 col-no-padding-left xs-text-left">
		            	<p class="text-capitalize">{user_timeline_recipe_last_update}</p>
		          	</div>
		        </div>
		        <div class="col-md-12 col-xs-12 details xs-text-center" style="margin-bottom:15px">
		        	<div class="col-md-11" title="Rating">
		          		<input id="input-2b" class="rating" data-recipeId="{user_timeline_recipe_id}" data-min="0" data-readonly='true' data-max="5" value="{user_timeline_recipe_rating}" data-step="0.1" data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
					</div>
		        </div>  
		    </div>
		    <div class="col-md-3 col-xs-12 col-no-padding col-edit-recipe-timeline">
		    	<div class="col-md-12 col-xs-4 col-no-padding-right text-right" title="Viewer">
		    		<div class="col-md-4 col-xs-4 col-no-padding-right recipe-timeline-view">
			            <i class="fa fa-eye icon-default"></i>
			        </div>
			        <div class="col-md-7 col-xs-8 text-viewer">
			            <p class="text-capitalize">{user_timeline_recipe_view} views</p>
			        </div>
		    	</div>
		    	<?php if ($this->session->userdata('user_id') == $user_timeline_id): ?>
		    	<div class="col-md-12 col-xs-4 col-no-padding-right recipe-timeline-edit-btn">
		    		<a href="<?php echo base_url()?>index.php/recipe/edit/{user_timeline_recipe_id}">
      					<button class="btn button-default btn-xs" style="width:90px">
      						<i class="fa fa-pencil-square-o fa-lg"></i>
      						Edit
      					</button>
      				</a>
		    	</div>
		    	<div class="col-md-12 col-xs-4 col-no-padding-right recipe-timeline-check-publish">
		    		<div class="checkbox">
					    <label>
					      	<input type="checkbox" class="checkedPublish" value='{user_timeline_recipe_id}' {checked_status}> Publish
					    </label>
					 </div>
		    	</div>
		    <?php endif;?>
		    </div>
		</div>
		{/user_timeline_recipe_entries}
		<div class="col-md-12 col-xs-12 text-center">
		    <?php
		      if($user_timeline_recipe_page_size > 0){
		        echo "<nav>
		                <ul class='pager'>
		                  <li class='";
		        if($user_timeline_recipe_page_size - $user_timeline_recipe_page_now == ($user_timeline_recipe_page_size-1)){
		            echo "disabled";
		            echo "'><a aria-label='Previous'>
		            <span aria-hidden='true'>&laquo;</span>
		          </a></li>";
		          }
		          else{
		          	 echo "'><a href='".base_url()."index.php/user/timeline/{user_timeline_id}?page=".($user_timeline_recipe_page_now - 1)."' aria-label='Previous'>
		            <span aria-hidden='true'>&laquo;</span>
		          </a></li>";
		          }
		       
		        for ($i=1; $i <= $user_timeline_recipe_page_size ; $i++) { 
		          $active = "";
		          if($i == $user_timeline_recipe_page_now){
		            $active = "active";
		          }
		          echo "
		            <li class='".$active."'>
		              <a href='".base_url()."index.php/user/timeline/{user_timeline_id}?page=".$i."'>".$i."</a>
		            </li>
		          ";
		        }
		        echo "<li class='";
		        if($user_timeline_recipe_page_size == $user_timeline_recipe_page_now){
		            echo "disabled";
		            echo "'><a aria-label='Next'>
		            <span aria-hidden='true'>&raquo;</span>
		          </a></li>
		          </ul>
		          </nav>
		        ";
		          }
		        else{
		        echo "'><a href='".base_url()."index.php/user/timeline/{user_timeline_id}?page=".($user_timeline_recipe_page_now + 1)."' aria-label='Next'>
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