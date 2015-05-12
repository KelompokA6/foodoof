<div class="col-md-12 col-xs-12 col-no-padding">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="page-header-title"> Catalog Ingredient </h3>
			<?php
				echo $this->session->flashdata('alert-admin');
			?>
			<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding border-solid-bottom" style="margin:5px 0 15px 0">
				<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding-left text-right">
					<div id="add-entry-catalog" class="btn button-primary">
						<i class="fa fa-plus"></i> <span>Add Entry</span>
					</div>
				</div>
				<form class="form-horizontal col-md-12 col-xs-12 col-sm-12" action="<?php echo base_url();?>index.php/admin/saveNewCatalog" role="form" method="post" enctype="multipart/form-data" style="display:none">
					<div class="col-md-3 col-sm-3 col-xs-3">
			      		<input type="text" maxlength="254" name="entry_subject" class="form-control input-ingredient" placeholder="Ingredient Name">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="number" min="0" step="0.01" name="entry_quantity" class="form-control" placeholder="Quantity">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="text" maxlength="254" name="entry_unit" class="form-control ingredient-unit" placeholder="Unit" autocomplete="off">
			    	</div>
			    	<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding-left">
			      		<input type="number" min="0" step="1" name="entry_price" class="form-control" placeholder="Price">
			    	</div>
			    	<div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding:15px 15px 0">
			    		<button type="submit" class="btn button-primary">Save</button>
			    	</div>
				</form>
			</div>
			<!-- <form class="form-horizontal col-md-12 col-xs-12 col-sm-12 border-solid-bottom catalog-list" role="form" method="post" enctype="multipart/form-data" style="padding:15px"> -->
			<table id="catalog-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th>ID</th>
		                <th>Name</th>
		                <th>Quantity</th>
		                <th>Unit</th>
		                <th>Price</th>
		            </tr>
		        </thead>
		        <tfoot>
		            <tr>
		                <th>ID</th>
		                <th>Name</th>
		                <th>Quantity</th>
		                <th>Unit</th>
		                <th>Price</th>
		            </tr>
		        </tfoot>
		        {catalog_entries}
		        <tr>
	                <td>{catalog_id}</td>
	                <td class="edit" data-type="text" data-name="name" data-pk="{catalog_id}" data-title="Enter Name Catalog">
	                	{catalog_name}
	                </td>
	                <td class="edit" data-type="text" data-name="quantity" data-pk="{catalog_id}" data-title="Enter Quantity Catalog">
	                	{catalog_quantity}
	                </td>
	                <td class="edit" data-type="text" data-name="units" data-pk="{catalog_id}" data-title="Enter Unit Catalog">
	                	{catalog_unit}
	                </td>
	                <td class="edit" data-type="number" data-name="price" data-pk="{catalog_id}" data-title="Enter Price Catalog">
	                	{catalog_price}
	                </td>
	            </tr>
		        {/catalog_entries}
		    </table>
			<!-- </form> -->
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
	    		<button type="submit" class="btn button-primary">Update</button>
	    	</div>
		</div>
	</div>
</div>	