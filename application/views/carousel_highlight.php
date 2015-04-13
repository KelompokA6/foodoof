<?php if(sizeof($list_recipes1) > 0):?>
<div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
  <a href='<?php echo base_url();?>home/highlight' style="position:relative; z-index:1000px; left:15px; top:15px;"><h3>Highlight Recipe</h3></a>
  <ol class="carousel-indicators" style="bottom:10px;">
    {list_recipes1}
      <li data-target="#carousel-example-captions" data-slide-to="{num}" class="{isactive}" style="background-color:rgb(56,150,211);"></li>
    {/list_recipes1}
  </ol>
  <div class="carousel-inner" role="listbox">
    {list_recipes2}
      <div class="item {isactive}">
        <img data-src="holder.js/900x500/auto/#777:#777" alt="{name}" src="{photo}" class="img-responsive center-block img-thumbnail" data-holder-rendered="true" style="height:400px">
        <div class="carousel-caption bg-warning" style="bottom:0">
          <a href="<?php echo base_url();?>recipe/get/{id}"><h3>{name}<a class="anchorjs-link" href="#first-slide-label"><span class="anchorjs-icon"></span></a></h3></a>
          <p style="color:black;">{description}</p>
        </div>
      </div>
    {/list_recipes2}
  </div>
  <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color:rgb(56,150,211);"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color:rgb(56,150,211);"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php endif;?>