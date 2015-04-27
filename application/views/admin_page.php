<form class="form-horizontal" action="<?php echo base_url();?>index.php/admin/save" method="post" enctype="multipart/form-data">
	<div class="col-md-12 col-xs-12 col-no-padding-right">
  		<div class="col-md-9 col-xs-12 pull-right" >
  			<div class="panel panel-default">
  				<div class="panel-body">
  					<h3 class="page-header-title"> Set Highlight Recipes </h3>
  					<?php
  						echo $this->session->flashdata('alert-admin');
  					?>
		  			<div class="col-md-5 col-xs-6 col-no-padding-right">
		  				<div class="list-group" id="listHightlight"></div>
		  			</div>
		  			<div class="col-md-7 col-xs-6 col-no-padding-right">
		  				<div style='overflow:scroll;max-height:411px;display:block; border:1px'>
				    		<div class="checkbox" style="padding:0">
				    			{highlighted_recipe_entries}
		  					    <label class="form-control" style='padding-left:30px'>
							      	<input type="checkbox" class="checkedHighlight" data-imgsrc="{highlight_recipe_photo}" data-recipename="{highlight_recipe_name}" name= 'id_highlight[]' value='{highlight_recipe_id}' {highlight_checked}>{highlight_recipe_name}
							    </label>
							   	{/highlighted_recipe_entries}
							</div> 
		  				</div>
		  			</div>
		  			<div class="col-md-12 col-xs-12 text-center">
						<button class="btn button-primary btn-lg" type="submit" style="width:150px; margin:30px 0">
				          	Save
				        </button>
					</div>
  				</div>
  			</div>
  		</div>
  		<div class="col-md-3 col-xs-12 pull-left">
			<div class="list-group">
			  	<a href="" class="list-group-item" title="highlight setting">
					<center> Highlight Recipes </center>
			  	</a>
			  	<a href="" class="list-group-item disabled" title="broadcast">
					<center> Broadcast Message </center>
				</a>
			  	<a href="" class="list-group-item disabled" title="reported">
					<center> Reported User </center>
			  	</a>
		  	</div>
  		</div>
	</div>	
</form>