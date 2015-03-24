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
        $this->author = $this->session->userdata('user_id'):
        if($this->save()){
            return $this->db->insert_id();
        }
        else{
            return -1;
        }
    }

    function saveRecipe($name=NULL, $portion=NULL, $duration=NULL, $description=NULL, $last_update=NULL, $ingredients=NULL, $steps=NULL, $id=NULL){
        if($id !=  NULL){
            $this->id = $id;
        }
        if($name !=  NULL){
            $this->$name = $name;
        }
        if($portion !=  NULL){
            $this->$portion = $portion;
        }
        if($duration !=  NULL){
            $this->$duration = $duration;
        }
        if($description !=  NULL){
            $this->$description = $description;
        }
        if($duration !=  NULL){
            $this->$last_update = $last_update;
        }
        if(!empty($this->id) && !empty($this->$name) && !empty($this->$portion) 
            && !empty($this->$duration) && !empty($this->$description) && !empty($this->$last_update)
            && !empty($steps) && !empty($ingredients)){
            if(!$this->save()){
                return FALSE;
            }
            $this->trans_begin();
            if(is_array($ingredients)){
                $rcp = new Ingredient();
                $rcp->get_by_id($this->recipe_id);
                $rcp->delete();
                foreach ($ingredients as $ingredient) {
                    $ingre = new Ingredient();
                    $ingre->saveIngredient($this->recipe_id, $ingredient->name, $ingredient->quantity, $ingredient->units);
                }
            }
            else{
                $rcp = new Ingredient();
                $rcp->get_by_id($this->recipe_id);
                $rcp->delete();
                $ingre = new Ingredient();
                $ingre->saveIngredient($this->recipe_id, $ingredients->name, $ingredients->quantity, $ingredients->units);
            }
            if(is_array($steps)){
                $x=1;
                $stp = new Step();
                $stp->get_by_id($this->recipe_id);
                $stp->delete();
                foreach ($steps as $step) {
                    $stp = new Step();
                    $stp->saveStep($this->recipe_id, $x, $step->description);
                    $x += 1;
                }
            }
            else{
                $stp = new Step();
                $stp->get_by_id($this->recipe_id);
                $stp->delete();
                $stp = new Step();
                $stp->saveStep($this->recipe_id, $x, $steps->description);
            }
            if ($this->trans_status() === FALSE)
            {
                // Transaction failed, rollback
                $this->trans_rollback();
                // Add error message
                $this->error_message('transaction', 'The transaction failed to save (insert)');
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
        if($id!=NULL){
            $this->id = $id;
        }
        $this->get_by_id($id);
        if($this->status){
            return true;
        }
        else{
            if($this->author==$user_id){
                return true;
            }
            return false
        }
    }

    function _member($field){
        if (!empty($this->{$field}))
        {
            $u = new User();
            // Get email have used.
            if($u->where('id', $this->{$field})->count() !== 0){
                return true;
            }
            else{
                $this->error_message('notmember', 'ID Author is not member');
                return false;
            }
        }
        else{
            return false;
        }
    }
    function getHightlight($limit=10){
        $this->get_by_highlight("1")->limit($limit);
    }
    function getRecently($limit=10){
        $this->order_by("create_date", "desc")->get($limit,0);
    }
    function getTopRecipe($limit=10){
        $this->order_by("rating", "desc")->get($limit,0);
    }
    function getUserRecipe($userId){
        $this->get_by_author($userId);
    }
    function addRating($user_id,$value){
        if(!empty($this->id)){
            return $this->query("INSERT INTO rating VALUES('".$this->id."', '".$user_id."', '".$value."')");    
        }
        return false;
    }
    function authEditRecipe($recipe_id=NULL, $user_id=NULL){
        if(!empty($this->id) && !empty($user_id)){
            $r = new Recipe();
            $r->where('id',$recipe_id);
            $r->where('author'=> $user_id);
            if($r->count()>0){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        return FALSE;
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */