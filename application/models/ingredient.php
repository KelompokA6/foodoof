<?php

class Ingredient extends DataMapper {

    var $table = "ingredients"; 
    //var $has_many = array('ingredient', 'comments', 'category');
    var $has_one = array('recipe_model');

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
            $u = new Recipe_model();
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
    function saveIngredient($recipe_id=NULL, $name=NULL, $quantity=NULL, $units=NULL){
        if($recipe_id !=  NULL){
            $this->recipe_id = $recipe_id;
        }
        if($name !=  NULL){
            $this->$name = $name;
        }
        if($quantity !=  NULL){
            $this->$quantity = $quantity;
        }
        if($units !=  NULL){
            $this->$units = $units;
        }
        if(!empty( $this->recipe_id) && !empty($this->$name) && !empty($this->$quantity) && !empty( $this->$units)){
            if($this->get_where(array('recipe_id' => $this->recipe_id, 'name' => $this->name))->count() == 0){
                return $this->save();    
            }
            return false;
        }
        return false;
    }
    function deleteIngredient($recipe_id=NULL, $name=NULL){
        if($recipe_id !=  NULL){
            $this->recipe_id = $recipe_id;
        }
        if($name !=  NULL){
            $this->$name = $name;
        }
        if(!empty($this->recipe_id) && !empty($this->$name)){
            if($this->get_where(array('recipe_id' => $this->recipe_id, 'name' => $this->name))->count() != 0){
                $this->get_where(array('recipe_id' => $this->recipe_id, 'name' => $this->name));
                return $this->delete();
            }
            return false;
        }
        return false;
    }
    function getById($id)
    {
        $this->where('recipe_id', $id)->get();
        return $this;
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */