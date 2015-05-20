<?php

class Favorite extends DataMapper {

    var $table = "favorites"; 
    var $has_one = array('user','recipe');

    /*function __construct($recipe_id = NULL, $user_id=NULL)
    {
        $this->recipe_id = $recipe_id;
        $this->user_id = $user_id;
    }*/

    function getFavoriteRecipeByUser($user_id=NULL, $limit=10, $offset=0){
        if(empty($user_id)){
            $user_id = $this->user_id;
        }
        $recipeIdList = array();
        if(!empty($user_id)){
            $fav = new Favorite();
            $fav->where('user_id', $user_id)->order_by("recipe_id","asc")->get($limit, $offset);
            foreach ($fav as $obj) {
               array_push($recipeIdList, $obj->recipe_id);
            }  
        }
        return $recipeIdList;
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */