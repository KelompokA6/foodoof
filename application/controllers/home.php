<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{	
		$this->load->view('template_view');
		//$this->load->view('top');
	}
	public function home1(){
		// $this->load->library('parser'); // gak usah, udah diload di autoloads
		$data = array();
		$menubar = $this->parser->parse('menubar', $data, TRUE);
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
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */