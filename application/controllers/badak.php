<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Badak extends CI_Controller {
  public function index()
  {
    $this->load->model('viewer');
    $this->viewer->show('welcome_message');
  }
}