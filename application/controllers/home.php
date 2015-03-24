<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{	
		$this->load->view('template_view');
		//$this->load->view('top');
	}
	public function home1(){
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
	}

	public function login()
	{
		$email = $this->input->post("email_user");
		$password = $this->input->post("password_user");
		$isLogin = User::login($email,$password);
		if($isLogin){
			$this->session->set_userdata('login_status', 1);
			$this->home1();
		}
		else{
			$this->home1();
		}
	}

	public function logout(){
		$this->session->set_userdata('login_status', 0);
		$this->home1();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */