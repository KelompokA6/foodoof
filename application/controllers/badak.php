<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Badak extends CI_Controller {
  public function index()
  {
    $this->load->model('viewer');
    $this->viewer->show('welcome_message');
  }

  public function show($view)
  {
    $this->load->model('viewer');
    $this->viewer->show($view);
  }
}