<?php

class User extends DataMapper {

    var $table = "users"; 
    var $has_many = array('recipes', 'comments', 'conversations', 'conversation_list');
    //var $has_one = array('country');

    var $validation = array(
        'user_email' => array(
            'label' => 'Email Address',
            'rules' => array('required', 'trim', 'unique', 'valid_email'),
        ),
        'user_password' => array(
            'label' => 'Password',
            'rules' => array('required', 'min_length' => 6, 'encrypt'),
        ),
        'confirm_password' => array(
            'label' => 'Confirm Password',
            'rules' => array('encrypt', 'matches' => 'user_password'),
        ),
        'user_name' => array(
            'label' => 'Your Name',
            'rules' => array('trim', 'max_length' => 255)
        ),
    );

    function login()
    {
        // Create a temporary user object
        $u = new User();

        // Get this users stored record via their username
        $u->where('user_email', $this->user_email)->get();


        // Validate and get this user by their property values,
        // this will see the 'encrypt' validation run, encrypting the password with the salt
        $this->validate()->get();

        // If the username and encrypted password matched a record in the database,
        // this user object would be fully populated, complete with their ID.

        // If there was no matching record, this user would be completely cleared so their id would be empty.
        if (empty($this->user_id))
        {
            // Login failed, so set a custom error message
            $this->error_message('login', 'Username or password invalid');

            return FALSE;
        }
        else
        {
            // Login succeeded
            echo "Login Success";
            return TRUE;
        }
    }

    // Validation prepping function to encrypt passwords
    // If you look at the $validation array, you will see the password field will use this function
    function _encrypt($field)
    {
        // Don't encrypt an empty string
        if (!empty($this->{$field}))
        {
            // Encrypty password
            $this->load->library('encrypt');

            $this->{$field} =  $this->encrypt->encode({$field});
        }
    }
}

/* End of file user.php */
/* Location: ./application/models/user.php */