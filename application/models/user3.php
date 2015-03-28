<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class User extends CI_Model
{
  public function login($email, $password)
  {
    $this->load->library('encrypt');
    echo "$email -- $password\n";
  }
}