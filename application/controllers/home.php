<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('parser');
		$this->load->library('session');
	}

	public function index()
	{	
		$this->load->view('template_view');
		//$this->load->view('top');
	}	
	public function homepage(){
		$this->load->library('parser');
		$this->load->library('session');
		$loginStatus = $this->session->userdata('login_status');

		$data = array();
		if($loginStatus === 1){
			$menubar = $this->parser->parse('menubar_login', $data, TRUE);	
		}
		else{
			$menubar = $this->parser->parse('menubar_login', $data, TRUE);
		}	
		$category_home = $this->parser->parse('category_home', $data, TRUE);
		$top_recipe_home = $this->parser->parse('top_recipe_home', $data, TRUE);
		$recently_recipe_home = $this->parser->parse('recently_recipe_home', $data, TRUE);
		$data= array(
						"category_home"=> $category_home,
						"top_recipe_home"=> $top_recipe_home,
						"recently_recipe_home"=> $recently_recipe_home,
						);
		$content_website = $this->parser->parse('content_homepage', $data, TRUE);
		$datacomplete = array(
						"menubar"=> $menubar,
						"content_website"=> $content_website,
						);
		$this->parser->parse('template_content', $datacomplete);
	}
	public function profile(){
		$this->load->view('profile_view');
	}
	public function editprofile(){
		$this->load->view('edit_profile_view');
	}
	public function chpass(){
		$this->load->view('changepassword_view');
	}

	public function register(){
		$this->load->view('registration_view');
	}

	public function login1(){
		$this->load->view('login_view');
	}

	public function forgetpassword(){
		$this->load->view('forgetpassword_view');
	}

	public function usertimeline(){
		$this->load->library('parser');
		$data= array(
						"id"=> '1',
						);
		$this->parser->parse('usertimeline_view', $data);
	}

	public function login()
	{
		$email = $this->input->post("email_user");
		$password = $this->input->post("password_user");
		$user = new User_model();
		$profile = $user->login($email,$password);
		if($profile !== FALSE){
			foreach ($profile as $key => $value) {
				$this->session->set_userdata($key, $value);
			}
		}
		header('Location: '.base_url());
	}

	public function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_photo');
		header('Location: '.base_url());
	}

	public function changePassword(){
		$this->load->model('viewer');
		$this->viewer->show('forget_password_view', $data);
	}

/*	public function searchUser(){
		$key = $this->input->post('keyword');
		$this->load->model('user');
		$search_result = $this->user->searchUser($key);

		$data['listUserFound'] = $search_result;
		$this->load->model('viewer');
		$this->viewer->show('search_view', $data);
	}

	public function searchRecipe(){
		$key = $this->input->post('keyword');
		$this->load->model('recipe');
		$search_result = $this->recipe->getListRecipeByTitle($key);

		$data['listRecipe'] = $search_result;
		$this->load->model('viewer');
		$this->viewer->show('search_view', $data);
	}

	public function searchRecipeByIngedients(){
		$key = $this->input->post('keyword');
		$this->load->model('recipe');
		$search_result = $this->recipe->getListRecipeByIngredients($key);

		$data['listRecipe'] = $search_result;
		$this->load->model('viewer');
		$this->viewer->show('search_view', $data);
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */