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

    function saveRecipe(){
        if($this->save()){
            return $this->db->insert_id();
        }
        else{
            return 0;
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
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */