<?php

class Cooklater extends DataMapper {

    var $table = "cooklater"; 
    var $has_one = array('user','recipe');

    /*function __construct($recipe_id = NULL, $user_id=NULL)
    {
        $this->recipe_id = $recipe_id;
        $this->user_id = $user_id;
    }*/

    function getCookLaterRecipeByUser($user_id=NULL, $limit=10, $offset=0){
        if(empty($user_id)){
            $user_id = $this->user_id;
        }
        $recipeIdList = array();
        if(!empty($user_id)){
            $CL = new Cooklater();
            $CL->where('user_id', $user_id)->order_by("recipe_id","asc")->get($limit, $offset);
            $id = array();
            $flag = array();
            $data = array();
            foreach ($CL as $obj) {
                $data = array(
                            'id' => $obj->recipe_id,
                            'flag' =>  $obj->flag,);
                array_push($recipeIdList, $data);
            } 
        }
        return $recipeIdList;
    }

    function setFinishedCookLater($user_id=NULL, $recipe_id=NULL, $value){
        $CL = new Cooklater();
        print_r($recipe_id);
        return $CL->where('user_id', $user_id)->where('recipe_id', $recipe_id)->update('flag', $value);
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */