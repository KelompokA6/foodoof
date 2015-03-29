<div class="panel panel-default">
  	<div class="panel-body">
    	<div class="col-md-12 col-no-padding-right">
    		<h3 class="page-header" style="margin-top:5px;"> User Timeline</h3>
    	</div>
    	{user_timeline_recipe_entries}
    	<div class="col-md-12 col-no-padding-right">
			<div class="col-md-2 col-xs-3 detail-list-img" style="margin-right:2px">
		        <img class="img-responsive img-rounded img-list-usertimeline" src="<?php echo base_url();?>{user_timeline_recipe_photo}"/>
		    </div>
		    <div class="col-md-6 col-xs-8 detail-list">
		    	<div class="col-md-12 details">
		          	<div class="col-md-12 col-xs-9">
		            	<h4><p class="text-capitalize">{user_timeline_recipe_name}</p></h4>
		          	</div>
		        </div>
		        <div class="col-md-12 details">
		          	<div class="col-md-4 col-xs-3 col-no-padding-right">
		            	<p class="text-capitalize">Last update :</p>
		          	</div>
		          	<div class="col-md-8 col-xs-9 col-no-padding-left">
		            	<p class="text-capitalize">{user_timeline_recipe_last_update}</p>
		          	</div>
		        </div>
		        <div class="col-md-12 details">
		        	<div class="col-md-11" title="Rating">
		          		<input id="input-2b" class="rating" data-min="0" data-max="5" data-starts=3 data-step="0.1" data-stars=5 data-symbol="&#xe005;" data-size="xs" data-default-caption="{rating} hearts" data-star-captions="{}" data-show-clear="false">
					</div>
		        </div>  
		    </div>
		    <div class="col-md-3 col-no-padding" style="margin-left:62px; margin-top:10px">
		    	<div class="col-md-12 col-no-padding-right text-right">
		    		<div class="col-md-4 col-xs-3 icons col-no-padding-right" style="margin-left:5px; margin-right:-15px">
			            <i class="fa fa-eye"></i>
			        </div>
			        <div class="col-md-7 col-xs-9">
			            <p class="text-capitalize">{user_timeline_recipe_view} views</p>
			        </div>
		    	</div>
		    	<div class="col-md-12 col-no-padding-right" style="padding-left:67px">
		    		<a href="recipe/edit/{user_timeline_recipe_id}">
      					<button class="btn btn-primary btn-xs" style="width:90px">
      						<i class="fa fa-pencil-square-o fa-lg"></i>
      						Edit
      					</button>
      				</a>
		    	</div>
		    	<div class="col-md-12 col-no-padding-right" style="padding-left:79px">
		    		<div class="checkbox">
					    <label>
					      	<input type="checkbox" {if user_timeline_publish == '1'}checked{/if}> Publish
					    </label>
					 </div>
		    	</div>
		    </div>
		</div>
		{/user_timeline_recipe_entries}
  	</div>
</div>