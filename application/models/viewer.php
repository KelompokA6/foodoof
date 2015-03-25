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
    $datacomplete = array(
            "menubar"=> $menubar,
            );
    $this->parser->parse($view, $datacomplete);
  }
}