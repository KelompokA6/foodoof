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
    /*
        mengembalikan list user-user yang telah dilaporkan
    */
    function getListReportUser(){
        $user = new User_model();
        $user->ilike("status","reported");
        $user->get();
        $list_reported_user = array();
        foreach ($user as $reports) {
            $data = new stdClass();
            $data->id = $reports->id;
            array_push($list_reported_user, $data);
        }
        return $list_reported_user;
    }
    /*
        mengembalikan list recipe-recipe yang dilaporkan berdasarkan id user
    */
    function getListReportByUserId($user_id=null){
        if(empty($user_id)){
            $user_id = $this->id;
        }
        if(!empty($user_id)){
            $report = new Report();
            $recipe = new Recipe_model();
            $listRecipe = array();
            $recipe->get_by_author($user_id);
            foreach ($recipe as $rcp) {
                array_push($listRecipe, $rcp->id);
            }
            $report->where_in("recipe_id", $listRecipe);
            $report->get();
            $list_reported_recipe = array();
            foreach ($report as $reports) {
                $data = new stdClass();
                $data->recipe_id = $reports->recipe_id;
                array_push($list_reported_recipe, $data);
            }
            return $list_reported_recipe;
        }
        return array();
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */