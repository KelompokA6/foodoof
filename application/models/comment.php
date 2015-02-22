<?php

class Comment extends DataMapper {

    var $table = "comments"; 
    //var $has_many = array('ingredient', 'comments', 'category');
    var $has_one = array('recipe', 'user');

    var $validation = array(
        'user_id' => array(
            'label' => 'Ingredient Name',
            'rules' => array('required',  'memberuser')
        ),
        'recipe_id' => array(
            'label' => 'Ingredient Name',
            'rules' => array('required',  'memberrecipe')
        ),
    );

    function __construct($recipe_id = NULL)
    {
        parent::__construct($recipe_id);
    }

    function _memberrecipe($field){
        if (!empty($this->{$field}))
        {
            $u = new Recipe();
            // Get email have used.
            if($u->where('id', $this->{$field})->count() !== 0){
                return true;
            }
            else{
                $this->error_message('notmember', 'ID recipe is not exist');
                return false;
            }
        }
        else{
            return false;
        }
    }

    function _memberuser($field){
        if (!empty($this->{$field}))
        {
            $u = new User();
            // Get email have used.
            if($u->where('id', $this->{$field})->count() !== 0){
                return true;
            }
            else{
                $this->error_message('notmember', 'ID user is not exist');
                return false;
            }
        }
        else{
            return false;
        }
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */