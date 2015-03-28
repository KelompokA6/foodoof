<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tempview extends CI_Controller {
	
	public function recipe()
	{	
		$this->load->library('parser');
		$data = array();
		$menubar = $this->parser->parse('menubar_login', $data, TRUE);
		$content_website = $this->parser->parse('recipe_view', $data, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);

	}	

}