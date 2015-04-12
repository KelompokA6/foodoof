<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends DataMapper {

    var $table = "users"; 
    var $has_many = array('recipe_model', 'comment', 'conversation', 'conversation_list');

    function login($email, $password)
    {
        if (strlen($email) < 1)
            $email = 'invalid';
        if( $this->where('email', $email)->count() < 1 ) return FALSE;
        $this->where('email', $email)->get();
        $ci =& get_instance();
        $ci->load->library('encrypt');
        $ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        $decrypted_password = $ci->encrypt->decode($this->password);
        // hack
        // $decrypted_password = $password;
        // FOTONE ENDI?
        $this->photo = file_exists('images/user/'.$this->id.'.jpg') ? 'images/user/'.$this->id.'.jpg' : 'assets/img/'.($this->gender == 'M' ? 'man.png' : 'woman.png');
        return ($decrypted_password == $password) ?
            array(
                'user_id' => $this->id,
                'user_name' => $this->name,
                'user_photo' => $this->photo,
            ) : FALSE;
    }

    function getProfile($id)
    {
        if($this->where('id', $id)->count() < 1) NULL;
        $this->where('id', $id)->get();
        $ret = new stdClass();
        $ret->id = $this->id;
        $ret->email = $this->email;
        $ret->name = $this->name;
        $ret->password = $this->password;
        $ret->gender = $this->gender;
        $ret->bdate = $this->bdate;
        $ret->phone = $this->phone;
        $ret->status = $this->status;
        $ret->photo = $this->photo ? $this->photo : 'assets/img/'.($this->gender == 'M' ? 'man.png' : 'woman.png');
        $ret->facebook = $this->facebook;
        $ret->twitter = $this->twitter;
        $ret->googleplus = $this->googleplus;
        $ret->path = $this->path;
        $ret->last_access = $this->last_access;
        return $ret;
    }

    function getPasswordByEmail($email)
    {
        if($this->where('email', $email)->count() < 1) return FALSE;
        $this->where('email', $email)->get();
        
        // decrypt the password
        $ci =& get_instance();
        $ci->load->library('encrypt');
        $ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        $this->password = $ci->encrypt->decode($this->password);
        return $this->password;
    }

    function updatePassword($id, $password)
    {
        // encrypt the password
        $ci =& get_instance();
        $ci->load->library('encrypt');
        $ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        $password = $ci->encrypt->encode($password);
        return $this->where('id', $id)->update('password', $password);
    }

    function updateProfile($id, $dataProfile)
    {
        return $this->where('id', $id)->update($dataProfile);
    }

    function createUser($profile)
    {
        // if( $this->where('email', $profile['email'])->count() > 0 ) return FALSE;
        foreach ($profile as $key => $value) $this->$key = $value;
        // encrypt the password
        $ci =& get_instance();
        $ci->load->library('encrypt');
        $ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        $this->password = $ci->encrypt->encode($this->password);
        return $this->save();
    }

    function wajiblogin()
    {
        $ci =& get_instance();
        $ci->load->library('session');
        $id = $ci->session->userdata('user_id');
        if ($id < 1) {
            header('Location: '.base_url().'home/login');
            die();
        }
        return $id;
    }

    function searchAccountByName($q, $limit = 10, $offset = 0)
    {
        /*$u = new User_model();
        $sql = "SELECT * FROM recipes WHERE MATCH (name) AGAINST ('".$search_key."') AND status=1 order by MATCH (name) AGAINST ('".$search_key."')";
        $recipe->query($sql);
        $recipeList = array();
        $total = 0;
        foreach ($recipe as $recipes) {
            $validRecipe = true;
            if($total >= $offset && $limit > 0){
                if(!empty($category)){
                    $categories = new Category();
                    $categories->where('recipe_id', $recipes->id);
                    if(is_array($category)){
                        for ($i=0; $i <$category ; $i++) { 
                            $categories->or_ilike('name', $category[$i]);
                        }
                    }
                    else{
                        $categories->or_ilike('name', $category);
                    }
                    if($categories->count()==0){
                        $validRecipe = false;
                        $total--;
                    }
                }                    
                if($validRecipe){
                    $data = new stdClass();
                    $data->id = $recipes->id;
                    $data->name = $recipes->name;
                    $data->description = $recipes->description;
                    $data->portion = $recipes->portion;
                    $data->duration = $recipes->duration;
                    $data->author = $recipes->author;
                    $data->create_date = $recipes->create_date;
                    $data->last_update = $recipes->last_update;
                    $data->rating = $recipes->rating;
                    $data->status = $recipes->status;
                    $data->views = $recipes->views;
                    $data->photo = $recipes->photo;
                    $data->highlight = $recipes->highlight;
                    array_push($recipeList, $data);
                    $limit--;
                }
            }
            $total++;
        }
        $arrResult = array(
                            "total" => $total,
                            "recipe_list" => $recipeList,
                            );
        return $arrResult;*/
        // LENGKAPI MI
    }
}

/* End of file user.php */
/* Location: ./application/models/user.php */