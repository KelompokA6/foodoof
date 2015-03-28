<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Badak extends CI_Controller {
  public function index($view = 'welcome_message')
  {
    $this->load->model('viewer');
    $this->viewer->show($view);
    // $this->output->enable_profiler(TRUE);
  }

  public function show($view)
  {
    $this->index($view);
  }

  public function getProfile($id)
  {
    $this->load->model('user');
    print_r( $this->user->getProfile($id));
  }
}