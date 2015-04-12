<div class = "panel">
	<form class="form-horizontal" action="<?php echo base_url();?>admin/save" method="post" enctype="multipart/form-data">
	<div class="col-md-12 col-xs-12 col-no-padding-right page-header-title">
		<div class="col-md-3 col-no-padding-left" style="margin-top:10px">
			<div class="list-group">
		  	<a href="" class="list-group-item" title="highlight setting">
			    
				<center> Highlight Recipes </center>
		  	</a>
		  	<a href="" class="list-group-item" title="broadcast">
			  	
				<center> Broadcast Message </center>
			</a>
		  	<a href="" class="list-group-item" title="reported">
		  		
				<center> Reported User </center>
		  	</a>
		  </div>
  		</div>
  		
	  		<div class="col-md-9 col-no-padding-right" >
	  			<div class="panel panel-default">
	  				<div class="panel-body">
	  					<h3 class="page-header-title"> Set Highlight Recipes </h3>
			  			<div class="col-md-2 col-no-padding-right">
			  				Choose Recipes
			  			</div>
			  			<div class="col-md-4 col-no-padding-right">
			  				
			  				<div class="list-group" id="listHightlight"> 
			  				</div>
			  				
			  			</div>
			  			<div class="col-md-6 col-no-padding-right">
			  				<div id='div1' style='overflow:scroll;max-height:411px;display:block; border:1px'>
					    		<div class="checkbox" >
					    			{highlighted_recipe_entries}
			  					    <label class="form-control" style='padding-left:30px'>
								      	<input type="checkbox" class="checkedHighlight" name= 'id_highlight[]' value='{highlight_recipe_id}' {highlight_checked}> {highlight_recipe_name}
								    </label>
								   	{/highlighted_recipe_entries}
								</div> 
			  				</div>
			  			</div>
			  			
	  				</div>
	  			</div>
	  			
	  		</div>
  		
	</div>	
	<div class="col-md-12 text-center">
		<button class="btn btn-success btn-lg" type="submit" style="width:150px">
          	Save
        </button>
	</div></form>
</div>