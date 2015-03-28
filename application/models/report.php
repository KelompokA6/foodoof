<?php

class Report extends DataMapper {

    var $table = "reports"; 
    //var $has_many = array('ingredient', 'comments', 'category');
    var $has_one = array('user');

    var $validation = array(
        'user_id' => array(
            'label' => 'User ID',
            'rules' => array('required',  'memberuser')
        ),
    );

    function __construct($recipe_id = NULL)
    {
        parent::__construct($recipe_id);
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