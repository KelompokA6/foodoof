<head>

</head>
<body>
<center><h2>{recipe_name}</h2></center>
<h4>Categories : </h4>
<ul>
{recipe_category_entries}
	<li>{recipe_category}</li>
{/recipe_category_entries}
</ul>
<i class="fa fa-users fa-lg icons-secondary" title="Portion"></i> Recipe for : <span>{recipe_portion} Persons</span>   |      
<i class="fa fa-clock-o fa-lg icons-secondary" title="Duration"><span>Times to cook : {recipe_duration} Minutes</span><br>
<img src="<?php echo base_url();?>{recipe_photo}" class="img-rounded img-responsive img-recipe" style="margin:auto"><br>
Oleh : <a>{recipe_author_name}</a><br>
Dibuat pada : <span>{recipe_last_update}</span>
	<h4 class="page-header-title">Description Recipe</h4>
	<div clas="col-md-12 col-xs-12">
	{recipe_description}
	</div>
<h4>Ingredients</h4>
<table>
	<?php foreach ($recipe_ingredients as $obj) {?>
		<tr>
			<td><?php echo $obj['ingre_name'];?></td>
			<td><?php echo $obj['ingre_quantity'];?> <?php echo $obj['ingre_units'];?> <?php echo ($obj['ingre_info']);?></td>
		</tr>
	<?php }?>
</table>

<h4>Steps</h4>	
<table>
<tr><td><center>No</center></td><td><center>Description</center></td><td><center>Picture</center></td></tr>
{recipe_steps}
	<tr>
		<td>{steps_number}</td>
		<td>{steps_description}</td>
		<td><img src="<?php echo base_url();?>{steps_photo}"></td>
	</tr>
{/recipe_steps}
</table>
</body>