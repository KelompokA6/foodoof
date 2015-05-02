<?php

class Suggestion extends DataMapper {

    var $table = "log_suggestion"; 
    var $has_one = array('user','recipe');

    /*function __construct($recipe_id = NULL, $user_id=NULL)
    {
        $this->recipe_id = $recipe_id;
        $this->user_id = $user_id;
    }*/

    function __construct($id = NULL)
    {
        parent::__construct($id);
        $ci = &get_instance();
        $ci->load->library('session');
        $ci->load->helper('cookie');
        $this->session = $ci->session;
    }

    function getRecipeSuggestion($id_cookie=null, $recipe_id=null, $limit_suggest=10, $limit=10){
        if(!empty($id_cookie) && empty($recipe_id)){
            return false;
        }
        if(empty($id_cookie) && !empty($recipe_id)){
            $this->recipe_id = $recipe_id;
            $this->submit = date("Y-m-d H:i:s");
            if($this->skip_validation()->save()){
                return $this->db->insert_id();
            }
            return false;
        }
        $this->clear();
        $this->recipe_id = $recipe_id;
        $this->cookie_id = $id_cookie;
        $this->submit = date("Y-m-d H:i:s");
        if(!$this->skip_validation()->save()){
            return false;
        }
        $recipeIdList = array();
        if($this->where("cookie_id", $id_cookie)->count()>=5){
            $dataCategory = array();
            $s = new Suggestion();
            $s->order_by("submit")->get($limit);
            $x=0;
            foreach ($s as $obj) {
                $r = new Recipe_model();
                $category = $r->getCategories($obj->recipe_id);
                foreach ($category as $cat) {
                    if(array_key_exists($cat->name, $dataCategory)){
                        $dataCategory[$cat->name] += 1; 
                    }
                    else{
                        $dataCategory[$cat->name] = 1;    
                    }
                    $x++;
                }
            }
            arsort($dataCategory);
            $category = new Category();
            $category->where("recipe_id !=", $recipe_id);
            foreach ($dataCategory as $key=>$cat) {
                $dataCategory[$key] = $cat/$x;
                $category->or_where("name", $key);
            }
            $dataRecipe = array();
            $category->order_by("recipe_id")->get();
            foreach ($category as $cat) {
                if($cat->recipe_id != $recipe_id){
                    if(array_key_exists($cat->recipe_id, $dataRecipe)){
                        $dataRecipe[$cat->recipe_id] += 100*$dataCategory[$cat->name]; 
                    }
                    else{
                        $dataRecipe[$cat->recipe_id] = 100*$dataCategory[$cat->name];    
                    }
                }
            }
            arsort($dataRecipe);
            foreach ($dataRecipe as $key => $value) {
                if($limit_suggest>0){
                    array_push($recipeIdList, $key);
                }
                $limit_suggest--;
            }
        }
        return $recipeIdList;
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */