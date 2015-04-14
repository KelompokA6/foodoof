<?php

class Rating extends DataMapper {

    var $table = "rating"; 
    var $has_one = array('user','recipe');

    /*function __construct($recipe_id = NULL, $user_id=NULL)
    {
        $this->recipe_id = $recipe_id;
        $this->user_id = $user_id;
    }*/

    function getRatingRecipeByUser($recipe_id = NULL, $user_id=NULL){
        if($recipe_id !=  NULL){
            $this->recipe_id = $recipe_id;
        }
        if($user_id !=  NULL){
            $this->user_id = $user_id;
        }
        if(!empty($recipe_id) && !empty($user_id)){
            $this->get_where(array('recipe_id' => $this->recipe_id, 'user_id' => $this->user_id));
            return true;    
        }
        return false;
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */