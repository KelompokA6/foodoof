<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends DataMapper {

    var $table = "users"; 
    var $has_many = array('recipe_model', 'comment', 'conversation', 'conversation_list');

    function login($email, $password)
    {
        if (strlen($email) < 1)
            $email = 'invalid';
        if( $this->where('email', $this->db->escape_str($email))->count() < 1 ) return 'email is not registered';
        $this->where('email', $this->db->escape_str($email))->get();
        if(strtolower($this->status) == 'banned') return "account is banned";
        $ci =& get_instance();
        $ci->load->library('encrypt');
        $ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        $decrypted_password = $ci->encrypt->decode($this->password);
        $this->photo = file_exists('images/user/'.$this->id.'.jpg') ? 'images/user/'.$this->id.'.jpg' : 'assets/img/'.($this->gender == 'M' ? 'user-male.png' : 'user-female.png');
        return ($decrypted_password == $password) ?
            array(
                'user_id' => $this->id,
                'user_name' => $this->name,
                'user_photo' => $this->photo,
                'theme' => $this->theme,
            ) : "password doesn't match";
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
        $ret->photo = $this->photo ? $this->photo : 'assets/img/'.($this->gender == 'M' ? 'user-male.png' : 'user-female.png');
        $ret->facebook = $this->facebook;
        $ret->twitter = $this->twitter;
        $ret->googleplus = $this->googleplus;
        $ret->path = $this->path;
        $ret->last_access = $this->last_access;
        return $ret;
    }

    function getPasswordByEmail($email)
    {
        if($this->where('email', $this->db->escape_str($email))->count() < 1) return FALSE;
        $this->where('email', $this->db->escape_str($email))->get();
        
        // decrypt the password
        $ci =& get_instance();
        $ci->load->library('encrypt');
        $ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        $this->password = $ci->encrypt->decode($this->password);
        return $this->password;
    }

    function getNameByEmail($email)
    {
        if($this->where('email',$this->db->escape_str($email))->count() < 1) return FALSE;
        $this->where('email',$this->db->escape_str($email))->get();
        return $this->name;
    }

    function updatePassword($id, $password)
    {
        // encrypt the password
        $ci =& get_instance();
        $ci->load->library('encrypt');
        $ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        $password = $ci->encrypt->encode($password);
        return $this->where('id', $id)->update('password', $this->db->escape_str($password));
    }

    function updateProfile($id, $dataProfile)
    {
        return $this->where('id', $id)->update(array_map(function($x){return ($x);}, $dataProfile));
    }

    function createUser($profile)
    {
        // if( $this->where('email', $profile['email'])->count() > 0 ) return FALSE;
        foreach ($profile as $key => $value)
            if($key != 'password')
                $this->$key = $this->db->escape_str($value);
            else
                $this->$key = $value;
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
            header('Location: '.base_url().'index.php/home/login');
            die();
        }
        return $id;
    }

    function searchAccountByName($q, $limit = 10, $offset = 0)
    {
        $u = new User_model();
        $arrayKey = explode(" ", $q);
        $searchkey = "";
        for ($i=0; $i < sizeof($arrayKey); $i++) { 
            if(!empty($arrayKey)){
                if($i == 0){
                    $searchkey .= "LOWER(name) LIKE LOWER('%".$arrayKey[$i]."%')"; 
                }
                else {
                    $searchkey .= " OR LOWER(name) LIKE LOWER('%".$arrayKey[$i]."%')"; 
                }    
            }
        }
        $sql = "SELECT * FROM users WHERE MATCH (name) AGAINST ('".$q."') OR ".$searchkey." order by MATCH (name) AGAINST ('".$q."') DESC LIMIT ".$limit." OFFSET ".$offset."";
        $u->query($sql);
        $accountList = array();
        foreach ($u as $user) {
            $data = new stdClass();
            $data->id = $user->id;
            $data->name = $user->name;
            $data->email = $user->email;
            $data->gender = (strtolower($user->gender) == "f") ? "Female" : "Male";
            $data->bdate = $user->bdate;
            $data->phone = $user->phone;
            $data->status = $user->status;
            $data->photo = $user->photo;
            $data->facebook = $user->facebook;
            $data->twitter = $user->twitter;
            $data->googleplus = $user->googleplus;
            $data->path = $user->path;
            $data->last_access = $user->last_access;
            // print_r($data->name);
            array_push($accountList, $data);
        }
        // print_r($offset);
        // print_r($limit);
        // print_r(sizeof($accountList));
        // die();
        // for ($i=0; $i < $limit && $i < sizeof($accountList); $i++) { 
        //     array_push($res, $accountList[$i]);
        // }
        return $accountList;

        
    }
    /*
        Memperoleh semua conversation dari seorang user dan message+pengirim pesan tersebut terakhir pada conversation tersebut
    */
    function getAllConversationUser($user_id=null, $limit=100){
        if(empty($user_id)){
            $user_id=$this->user_id;
        }
        if(!empty($user_id)){
            $listConversation = array();
            $conversations = new Conversation();
            $conversations->where("user_id", $user_id);
            $conversations->order_by("submit", "desc");
            $conversations->get();
            foreach ($conversations as $conversation) {
                $messages = new Message();
                $messages->where("conversation_id", $conversation->id);
                $messages->order_by("submit", "desc");
                $messages->limit(1);
                $messages->get();
                /*$subject = $conversation->subject;
                $u = new User_model();
                if(empty($subject)){
                    $tmpConv = new Conversation();
                    $tmp=$tmpConv->getMembers($conversation->id, $user_id);
                    $subject .= "You";
                    foreach ($tmp as $id_user) {
                        $subject .= ", ".$u->getProfile($id_user)->name;                    
                    }
                }*/
                $data = new stdClass();
                $data->id = $conversation->id;
                $data->subject = $conversation->subject;
                $data->sender_id = $messages->sender_id;
                $data->last_message = $messages->description;
                $data->time_last_message = $messages->submit;
                array_push($listConversation, $data);
            }
            return $listConversation;
        }
        return array();
    }
    function getFavorite($user_id=NULL, $limit=10, $offset=0){
        $favorite = new Favorite();
        if(!empty($user_id)){
            return $favorite->getFavoriteRecipeByUser($user_id, $limit, $offset);
        }
        else{
            return array();
        }
    }

    /*
        Digunakan untuk menyimpan recipe to favorite list, bila sudah ada maka akan dihapus dari list
    */
    function addFavorite($user_id=null, $recipe_id=null){
        if(empty($recipe_id)){
            $recipe_id = $this->id;
        }
        if(!empty($recipe_id) && !empty($user_id)){
            $favorite = new Favorite();
            $favorite->recipe_id = $recipe_id;
            $favorite->user_id = $user_id;
            $favoritetmp = new Favorite();
            $favoritetmp->where('recipe_id', $recipe_id);
            $favoritetmp->where('user_id', $user_id);
            if($favoritetmp->count() > 0){
                if($this->db->delete('favorites', array('recipe_id' => $recipe_id, 'user_id' => $user_id ))){
                    $result['status'] = true;
                    $result['action'] = "delete";
                    return $result;
                }
                else{
                    return false;
                } 
            }
            else{
                if($favorite->skip_validation()->save()){
                    $result['status'] = true;
                    $result['action'] = "add";
                    return $result;
                }
                else{
                    return false;
                }
            }
        }
        return false;
    }

    /*
        Digunakan untuk menyimpan recipe to cook later list, bila sudah ada maka akan dihapus dari list
    */
    function addCookLater($user_id=null, $recipe_id=null){
        if(empty($recipe_id)){
            $recipe_id = $this->id;
        }
        if(!empty($recipe_id) && !empty($user_id)){
            $CL = new Cooklater();
            $CL->recipe_id = $recipe_id;
            $CL->user_id = $user_id;
            $CLtmp = new Cooklater();
            $CLtmp->where('recipe_id', $recipe_id);
            $CLtmp->where('user_id', $user_id);
            if($CLtmp->count() > 0){
                if($this->db->delete('cooklater', array('recipe_id' => $recipe_id, 'user_id' => $user_id ))){
                    $result['status'] = true;
                    $result['action'] = "delete";
                    return $result;
                }
                else{
                    return false;
                } 
            }
            else{
                if($CL->skip_validation()->save()){
                    $result['status'] = true;
                    $result['action'] = "add";
                    return $result;
                }
                else{
                    return false;
                }
            }
        }
        return false;
    }
}

/* End of file user.php */
/* Location: ./application/models/user.php */