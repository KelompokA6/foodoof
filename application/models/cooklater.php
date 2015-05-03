<?php

class Cooklater extends DataMapper {

    var $table = "cooklater"; 
    var $has_one = array('user','recipe');

    /*function __construct($recipe_id = NULL, $user_id=NULL)
    {
        $this->recipe_id = $recipe_id;
        $this->user_id = $user_id;
    }*/

    function getCookLaterRecipeByUser($user_id=NULL){
        if(empty($user_id)){
            $user_id = $this->user_id;
        }
        $recipeIdList = array();
        if(!empty($user_id)){
            $CL = new Cooklater();
            $CL->where('user_id', $user_id)->order_by("asc")->get();
            foreach ($CL as $obj) {
               array_push($recipeIdList, $obj->recipe_id);
            }  
        }
        return $recipeIdList;
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */