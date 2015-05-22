<div class="col-md-9 pull-right col-no-padding">
<?php echo $this->session->flashdata('alert-notification');?>
  <div class="col-md-12 col-xs-12 col-no-padding-right col-no-padding-left-mobile" style="margin-bottom:10px;">
    <a href='<?php echo base_url();?>index.php/home/highlight' class='col-md-12'>
      <h3 class="panel-home-title text-center" style="margin:0px">Highlight Recipe</h3>
    </a>
    <div class="col-md-12">
      {carousel_highlight}
    </div>
  </div>
  <div class="col-md-12 col-xs-12 col-no-padding-right col-no-padding-left-mobile">
    {top_recipe_home}
  </div>
  <div class="col-md-12 col-xs-12 col-no-padding-right col-no-padding-left-mobile" style="margin:10px 0">
    {recently_recipe_home}
  </div>
</div>
<div class="col-md-3 category-menu pull-left col-no-padding-left col-no-padding-right">
  {category_home}
</div>