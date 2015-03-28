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

  public function login($p1 = NULL, $p2 = NULL)
  {
    $this->load->model('user');
    echo "$p1 dan $p2\n";
    $this->user->login($p1, $p2);
  }
}