<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class User3 extends CI_Model
{
  public function tes()
  {
    $this->load->model('viewer');
    $this->viewer->show('welcome_message');
  }
}