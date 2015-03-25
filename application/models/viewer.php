<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewer extends CI_Model
{
  public function show($view, $data = array())
  {
    $this->load->library('parser');
    $this->load->library('session');
    $hasLogin = $this->session->userdata('login_status');

    $data = array();
    $menubar = $this->parser->parse($hasLogin ? 'menubar_login' : 'menubar', $data, TRUE);  
    $datacomplete = array(
            "menubar"=> $menubar,
            );
    $this->parser->parse($view, $datacomplete);
  }
}