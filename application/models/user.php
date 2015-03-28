<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends DataMapper {

    var $table = "users"; 
    var $has_many = array('recipe', 'comment', 'conversation', 'conversation_list');

    function login($email, $password)
    {
        if( $this->where('email', $email)->count() < 1 ) return FALSE;
        $this->where('email', $email)->get();
        $ci =& get_instance();
        $ci->load->library('encrypt');
        $ci->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $ci->encrypt->set_mode(MCRYPT_MODE_CBC);
        $decrypted_password = $ci->encrypt->decode($this->password);        
        return ($decrypted_password == $password);
    }

    function getProfile($id)
    {
        if($this->where('id', $id)->count() < 1) return NULL;
        $this->where('id', $id)->get();
        $ret['id'] = $this->id;
        $ret['email'] = $this->email;
        $ret['name'] = $this->name;
        $ret['password'] = 'bintangbintang';
        $ret['gender'] = $this->gender;
        $ret['bdate'] = $this->bdate;
        $ret['phone'] = $this->phone;
        $ret['status'] = $this->status;
        $ret['photo'] = $this->photo;
        $ret['last_access'] = $this->last_access;
        return $ret;
    }

    function updatePassword($id, $password)
    {
        return $this->where('id', $id)->update('password', $password);
    }

    function updateProfile($id, $dataProfile)
    {
        return $this->where('id', $id)->update($dataProfile);
    }

    var $validation = array(
        'email' => array(
            'label' => 'Email Address',
            'rules' => array('required', 'trim', 'notmember', 'valid_email', 'max_length' => 255),
        ),
        'confirm_password' => array(
            'label' => 'Confirm Password',
            'rules' => array('matches' => 'password'),
        ),
        'password' => array(
            'label' => 'Password',
            'rules' => array('required', 'min_length' => 5, 'encrypt'),
        ),
        'name' => array(
            'label' => 'Your Name',
            'rules' => array('trim', 'max_length' => 255)
        ),
    );
}

/* End of file user.php */
/* Location: ./application/models/user.php */