<?php

class Ingredient extends DataMapper {

    var $table = "ingredients"; 
    //var $has_many = array('ingredient', 'comments', 'category');
    var $has_one = array('recipe');

    var $validation = array(
        'recipe_id' => array(
            'label' => 'ID Recipe',
            'rules' => array('required', 'member')
        ),
        'name' => array(
            'label' => 'Ingredient Name',
            'rules' => array('required',  'min_length' => 1)
        ),
        'quantity' => array(
            'label' => 'Ingredient Quantity',
            'rules' => array('required')
        ),
        'units' => array(
            'label' => 'Ingredient Unit',
            'rules' => array('required',  'min_length' => 1)
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