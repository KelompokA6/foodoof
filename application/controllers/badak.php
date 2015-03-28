<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Badak extends CI_Controller {
  public function index($view = 'welcome_message')
  {
    $this->load->model('viewer');
    $this->viewer->show('recipe_view');
    // $this->output->enable_profiler(TRUE);
  }

  public function show($view)
  {
    $this->index($view);
  }

  public function tes($id = 1, $name = 'bebek')
  {
    echo "masuk tes--";
    // $this->user = new User();
    $this->load->model('user');
    $x = 1;
    $x = $this->user->updateProfile($id, array('name' => $name));
    echo $x ? "string" : "no";
  }
}