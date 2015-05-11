<div class="col-md-12 col-xs-12 col-no-padding">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="page-header-title"> Catalog Ingredient </h3>
			<?php
				echo $this->session->flashdata('alert-admin');
			?>
			<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding border-solid-bottom">
				<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding-left text-right">
					<div id="add-entry-catalog" class="btn button-primary">
						<i class="fa fa-plus"></i> <span>Add Entry</span>
					</div>
				</div>
				<form class="form-horizontal col-md-12 col-xs-12 col-sm-12" role="form" method="post" enctype="multipart/form-data" style="display:none">
					<div class="col-md-3 col-sm-3 col-xs-3">
			      		<input type="text" maxlength="254" name="entry_subject" class="form-control input-ingredient" placeholder="Ingredient Name">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="text" maxlength="254" name="entry_unit" class="form-control ingredient-unit" placeholder="Unit" autocomplete="off">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="number" min="0" step="0.01" name="entry_quantity" class="form-control" placeholder="Quantity">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="number" min="0" step="1" name="entry_price" class="form-control" placeholder="Price">
			    	</div>
			    	<div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding:15px 15px 0">
			    		<button type="submit" class="btn button-primary">Save</button>
			    	</div>
				</form>
			</div>
			<form class="form-horizontal col-md-12 col-xs-12 col-sm-12 border-solid-bottom catalog-list" action="<?php echo base_url();?>index.php/admin/update"role="form" method="post" enctype="multipart/form-data" style="padding:15px">
				{catalog_entries}
				<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding" style="margin:2px 0;">
					<div class="col-md-3 col-sm-3 col-xs-3">
						<input type="text" maxlength="254" value="{catalog_id}" name="catalog_id[]" class="form-control input-ingredient hidden" placeholder="Ingredient Name">
			      		<input type="text" maxlength="254" value="{catalog_name}" name="catalog_name[]" class="form-control input-ingredient" placeholder="Ingredient Name">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="text" maxlength="254" value="{catalog_unit}" name="catalog_unit[]" class="form-control ingredient-unit" placeholder="Unit" autocomplete="off">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="number" min="0" step="0.01" value="{catalog_quantity}" name="catalog_quantity[]" class="form-control" placeholder="Quantity">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="number" min="0" step="1" value="{catalog_price}" name="catalog_price[]" class="form-control" placeholder="Price">
			    	</div>
				</div>
				{/catalog_entries}
			</form>
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
	    		<button type="submit" class="btn button-primary">Update</button>
	    	</div>
		</div>
	</div>
</div>	