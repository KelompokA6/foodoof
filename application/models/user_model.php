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
        // $decrypted_password = $ci->encrypt->decode($this->password);
        // hack
        $decrypted_password = $password;
        return ($decrypted_password == $password) ?
            array(
                'user_id' => $this->id,
                'user_name' => $this->name,
                'user_photo' => $this->photo ? $this->photo : 'images/user/0.jpg',
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
        $ret->photo = $this->photo ? $this->photo : 'images/user/0.jpg';
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
        return $this->where('id', $id)->update('password', $password);
    }

    function updateProfile($id, $dataProfile)
    {
        return $this->where('id', $id)->update($dataProfile);
    }

    function createUser($profile)
    {
        if( $this->where('email', $profile['email'])->count() > 0 ) return FALSE;
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
}

/* End of file user.php */
/* Location: ./application/models/user.php */