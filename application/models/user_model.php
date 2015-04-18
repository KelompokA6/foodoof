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
        $this->photo = file_exists('images/user/'.$this->id.'.jpg') ? 'images/user/'.$this->id.'.jpg' : 'assets/img/'.($this->gender == 'M' ? 'user-male.png' : 'user-female.png');
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
        $u = new User_model();
        $arrayKey = explode(" ", $q);
        $searchkey = "";
        for ($i=0; $i < sizeof($arrayKey); $i++) { 
            if(!empty($arrayKey)){
                if($i == 0){
                    $searchkey .= "LOWER(name) LIKE LOWER('".$arrayKey[$i]." %') OR LOWER(name) LIKE LOWER('% ".$arrayKey[$i]."') OR LOWER(name) LIKE LOWER('% ".$arrayKey[$i]." %') OR LOWER(name) LIKE LOWER('".$arrayKey[$i]."')"; 
                }
                else {
                    $searchkey .= " OR LOWER(name) LIKE LOWER('".$arrayKey[$i]." %') OR LOWER(name) LIKE LOWER('% ".$arrayKey[$i]."') OR LOWER(name) LIKE LOWER('% ".$arrayKey[$i]." %') OR LOWER(name) LIKE LOWER('".$arrayKey[$i]."')"; 
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
}

/* End of file user.php */
/* Location: ./application/models/user.php */