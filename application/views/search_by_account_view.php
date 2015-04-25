<div class="panel-body">
  <div class="col-md-12 col-xs-12">
    <h3 class="page-header-title" style="margin-top:5px">
      {search_by_account_result}
      <?php
        if($search_by_account_result > 1){
          echo "results";
        }
        else{
          echo "result"; 
        }
      ?>
      of '{search_by_account_key}' 
    </h3>
  </div>
  {search_by_account_entries}
  <div class="col-md-12 col-xs-12 col-no-padding-right page-header" style="margin-top:5px">
    <div class="col-md-2 col-xs-12 detail-list-img" style="margin-right:2px">
        <a href="<?php echo base_url();?>index.php/recipe/get/{search_by_account_id}" title="{search_by_account_name}">
          <img class="img-responsive img-rounded img-list-account" src="<?php echo base_url();?>{search_by_account_photo}"/>
        </a>
    </div>
    <div class="col-md-8 col-xs-12 detail-list-account">
      <div class="col-md-12 col-xs-12 details">
          <div class="col-md-12 col-xs-12">
            <a href="<?php echo base_url();?>index.php/user/timeline/{search_by_account_id}">
              <h4><p class="text-capitalize account-name">{search_by_account_name}</p></h4>
            </a>
          </div>
      </div>
      <div class="col-md-12 col-xs-12 details">
          <div class="col-md-2 col-xs-6 xs-text-right">
            <h4><p class="text-capitalize">{search_by_account_gender}, </p></h4>
          </div>
          <div class="col-md-10 col-xs-6 text-left border-dashed-left">
            <h4><p class="text-capitalize">{search_by_account_age} Years Old</p></h4>
          </div>
      </div>  
    </div>
  </div>
  {/search_by_account_entries}
  <div class="col-md-12 col-xs-12 text-center text-capitalize">
    <?php
    if($search_by_account_page_size == 0):?>
    no account found
    <?php
    endif;?>
    <?php
      if($search_by_account_page_size > 0){
        echo "<nav>
                <ul class='pager'>
                  <li class='";
        if($search_by_account_page_size - $search_by_account_page_now == ($search_by_account_size-1)){
            echo "disabled";
            echo "'><a aria-label='Previous'>
            <span aria-hidden='true'>&laquo;</span>
          </a></li>";
          }
          else{
        echo "'><a href='".base_url()."index.php/search/?q=".$search_by_account_key."&searchby=account&page=".($search_by_account_page_now - 1)."' aria-label='Previous'>
            <span aria-hidden='true'>&laquo;</span>
          </a></li>";
            
          }
        for ($i=1; $i <= $search_by_account_page_size ; $i++) { 
          $active = "";
          if($i == $search_by_account_page_now){
            $active = "active";
          }
          echo "
            <li class=".$active.">
              <a href='".base_url()."index.php/search/?q=".$search_by_account_key."&searchby=account&page=".$i."'>".$i."</a>
            </li>
          ";
        }

        echo "<li class='";
        if($search_by_account_page_size == $search_by_account_page_now){
            echo "disabled";
             echo "'><a aria-label='Next'>
            <span aria-hidden='true'>&raquo;</span>
          </a></li></ul></nav>
        ";
          }
          else{
        echo "'><a href='".base_url()."index.php/search/?q=".$search_by_account_key."&searchby=account&page=".($search_by_account_page_now + 1)."' aria-label='Next'>
            <span aria-hidden='true'>&raquo;</span>
          </a></li></ul></nav>
        ";
            
          }
      }
    ?>
  </div>
</div>