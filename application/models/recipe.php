<?php

class Recipe extends DataMapper {

    var $table = "recipes"; 
    var $has_many = array('ingredient', 'comments', 'category');
    var $has_one = array('user');

    var $validation = array(
        'name' => array(
            'label' => 'Recipe Name',
            'rules' => array('required', 'trim', 'min_length' => 1)
        ),
        'author' => array(
            'label' => 'Author Recipe',
            'rules' => array('required', 'member')
        ),
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    function createRecipe(){
        $this->author = $this->session->userdata('user_id');
        if($this->skip_validation()->save()){
            return $this->db->insert_id();
        }
        else{
            return -1;
        }
    }

    function saveRecipe($id=NULL, $name=NULL, $portion=NULL, $duration=NULL, $description=NULL, $last_update=NULL, $ingredients=NULL, $steps=NULL){
        if($id ==  NULL){
            $id = $this->id;
        }
        if($name ==  NULL){
            $name = $this->$name;
        }
        if($portion ==  NULL){
            $portion = $this->$portion;
        }
        if($duration ==  NULL){
            $duration = $this->$duration;
        }
        if($description ==  NULL){
            $description = $this->$description;
        }
        if($last_update ==  NULL){
            $last_update = $this->$last_update;
        }
        $this->author = $this->session->userdata('user_id');
        $this->$name = $name;
        if(!empty($id) && !empty($name) && !empty($portion) 
            && !empty($duration) && !empty($description) && !empty($last_update)
            && !empty($steps) && !empty($ingredients)){
            if(!$this::save()){
                return FALSE;
            }
            $this::trans_begin();
            if(is_array($ingredients)){
                $rcp = new Ingredient();
                $rcp::get_by_id($this->recipe_id);
                $rcp::delete();
                foreach ($ingredients as $ingredient) {
                    $ingre = new Ingredient();
                    $ingre->saveIngredient($this->recipe_id, $ingredient->name, $ingredient->quantity, $ingredient->units);
                }
            }
            else{
                $rcp = new Ingredient();
                $rcp::get_by_id($this->recipe_id);
                $rcp::delete();
                $ingre = new Ingredient();
                $ingre->saveIngredient($this->recipe_id, $ingredients->name, $ingredients->quantity, $ingredients->units);
            }
            if(is_array($steps)){
                $x=1;
                $stp = new Step();
                $stp::get_by_id($this->recipe_id);
                $stp::delete();
                foreach ($steps as $step) {
                    $stp = new Step();
                    $stp->saveStep($this->recipe_id, $x, $step->description);
                    $x += 1;
                }
            }
            else{
                $stp = new Step();
                $stp::get_by_id($this->recipe_id);
                $stp::delete();
                $stp = new Step();
                $stp::saveStep($this->recipe_id, $x, $steps->description);
            }
            if ($this::trans_status() === FALSE)
            {
                // Transaction failed, rollback
                $this::trans_rollback();
                // Add error message
                $this::error_message('transaction', 'The transaction failed to save (insert)');
                return false;
            }
            else
            {
                // Transaction successful, commit
                $this->trans_commit();
            }
        }
        return false;
    }
    function getRecipe($id=NULL, $user_id=NULL){
        if($id != NULL){
            $this->id = $id;
        }
        $this::get_by_id($id);
        if($this->status){
            return true;
        }
        else{
            if($this->author==$user_id){
                return true;
            }
            return false;
        }
    }

    function _member($field){
        if (!empty($this->{$field}))
        {
            $u = new User();
            // Get email have used.
            if($u::where('id', $this->{$field})->count() !== 0){
                return true;
            }
            else{
                $this::error_message('notmember', 'ID Author is not member');
                return false;
            }
        }
        else{
            return false;
        }
    }
    function getHightlight($limit=10){
        $this::get_by_highlight("1")->limit($limit);
    }
    function getRecently($limit=10){
        $this::order_by("create_date", "desc")->get($limit,0);
    }
    function getTopRecipe($limit=10){
        $this::order_by("rating", "desc")->get($limit,0);
    }
    function getUserRecipe($userId){
        $this::get_by_author($userId);
    }
    function addRating($user_id,$value){
        if(!empty($this->id)){
            return $this::query("INSERT INTO rating VALUES('".$this->id."', '".$user_id."', '".$value."')");    
        }
        return false;
    }
    function authEditRecipe($recipe_id=NULL, $user_id=NULL){
        if($recipe_id==NULL){
            $recipe_id = $this->id;
        }
        if(!empty($recipe_id) && !empty($user_id)){
            $r = new Recipe();
            $r::where('id', $recipe_id);
            $r::where('author', $user_id);
            if($r->count()>0){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        return FALSE;
    }
    function publishRecipe($id=NULL, $status=FALSE){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id) && !empty($status)){
            return $this->where('id', $id)->update('status', $status);
        }
        else{
            return false;
        }
    }
    function deleteRecipe($id=NULL){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id)){
            return $this->where('id', $id)->delete();
        }
        else{
            return false;
        }
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */