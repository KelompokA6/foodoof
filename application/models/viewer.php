<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewer extends CI_Model
{
  public function show($view, $data = array())
  {
    $this->load->library('parser');
    $this->load->library('session');
    $loginStatus = $this->session->userdata('login_status');

    $data = array();
    if($loginStatus === 1){
      $menubar = $this->parser->parse('menubar_login', $data, TRUE);  
    }
    else{
      $menubar = $this->parser->parse('menubar', $data, TRUE);
    }
    $category_home = $this->parser->parse('category_home', $data, TRUE);
    $top_recipe_home = $this->parser->parse('top_recipe_home', $data, TRUE);
    $recently_recipe_home = $this->parser->parse('recently_recipe_home', $data, TRUE);
    $datacomplete = array(
            "menubar"=> $menubar,
            "category_home"=> $category_home,
            "top_recipe_home"=> $top_recipe_home,
            "recently_recipe_home"=> $recently_recipe_home,
            );
    $this->parser->parse('template_default_home', $datacomplete);
    $this->load->view($view, $data);
  }
}