<div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    {list_recipes1}
      <li data-target="#carousel-example-captions" data-slide-to="{num}" class="{isactive}"></li>
    {/list_recipes1}
    <!-- <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-captions" data-slide-to="1" class=""></li>
    <li data-target="#carousel-example-captions" data-slide-to="2" class=""></li> -->
  </ol>
  <div class="carousel-inner" role="listbox">
    {list_recipes2}
      <div class="item {isactive}">
        <img data-src="holder.js/900x500/auto/#777:#777" alt="{name}" src="{photo}" class="img-responsive center-block img-thumbnail" data-holder-rendered="true" style="height:400px">
        <div class="carousel-caption bg-warning">
          <a href="<?php echo base_url();?>recipe/get/{id}"><h3>{name}<a class="anchorjs-link" href="#first-slide-label"><span class="anchorjs-icon"></span></a></h3></a>
          <p style="color:black;">{description}</p>
        </div>
      </div>
    {/list_recipes2}
  </div>
  <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>