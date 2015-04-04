<?php

class Step extends DataMapper {

    var $table = "steps"; 
    //var $has_many = array('ingredient', 'comments', 'category');
    var $has_one = array('recipe_model');

    var $validation = array(
        'recipe_id' => array(
            'label' => 'ID Recipe',
            'rules' => array('required', 'member')
        ),
    );

    function __construct($recipe_id = NULL)
    {
        parent::__construct($recipe_id);
    }

    function _member($field){
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
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */