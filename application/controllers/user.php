<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_viewer');
	}

	public function index(){
		$this->timeline();
	}

	public function profile($id = -1){
		if ($id == -1) {
			$id = $this->wajiblogin();
		}
		$this->load->model('user_model');
		$profile = $this->user_model->getProfile($id);		
		$this->user_viewer->showProfile($profile);
	}

	public function timeline($id = -1){
		if ($id == -1) {
			$id = $this->wajiblogin();
		}
		$u = new User_model();
		$profile = $u->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getUserRecipe($id);
		$this->user_viewer->showUserTimeline($profile, $listRecipe);
	}

	public function favorite($id = -1){
		if ($id == -1) {
			$id = $this->wajiblogin();
		}
		$u = new User_model();
		$profile = $u->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getFavoriteRecipe($id);
		$this->user_viewer->showUserTimeline($profile, $listRecipe);
	}

	public function cooklater(){
		$id = $this->wajiblogin();
		$u = new User_model();
		$profile = $u->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getCooklaterRecipe($id);
		$this->user_viewer->showUserTimeline($profile, $listRecipe);
	}

	public function changepassword(){
		$id = $this->wajiblogin();
		$data = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['oldPass'] = $this->input->post("old_password");
			$data['newPass'] = $this->input->post("new_password");
			$data['confirmPass'] = $this->input->post("confirm_password");

			if($this->isValid($data)){
				$user = new User_model();
				$success = $user->updatePassword($id, $data['newPass']);
				$data['message'] = $success ? "success" : "failed";
			}
			else{
				$data['message'] = "invalid";
			}
		}

		$u = new User_model();
		$profile = $u->getProfile($id);

		$this->user_viewer->showChangePassword($profile, $data);
	}

	public function join(){
		$data['join_alert'] = '';
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$profile['name'] = $this->input->post("name");
			$profile['email'] = $this->input->post("email");
			$profile['gender'] = $this->input->post("genderOptions");
			$profile['password'] = $this->input->post("password"); 
			$profile['confrimPass'] = $this->input->post("confirm_password");

			if ($this->validateJoin($profile)) {
				$u = new User_model();
				if($u->createUser($profile)) {
					$profile_menubar = $u->login($profile['email'], $profile['password']);
					foreach ($profile_menubar as $key => $value) {
						$this->session->set_userdata($key, $value);
					}
					redirect(base_url().'user');
					die;
				} else {
					$data['join_alert'] = '<div class="label label-warning">join failed</div>';
				}
			} else {
				$data['join_alert'] = '<div class="label label-danger">invalid input data</div>';
			}
			foreach ($profile as $key => $value) $data[$key] = $value;
		}
		$this->user_viewer->showRegister($data);
	}

	public function edit(){
		$id = $this->wajiblogin();

		$u = new User_model();
		$profile = $u->getProfile($id);

		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['name'] = $this->input->post('user_name');
			$data['gender'] = $this->input->post('genderOptions');
			$data['phone'] = $this->input->post('user_phone');
			$data['bdate'] = $this->input->post('user_bdate');
			$data['twitter'] = $this->input->post('user_twitter');
			$data['facebook'] = $this->input->post('user_facebook');
			$data['googleplus'] = $this->input->post('user_gplus');
			$data['path'] = $this->input->post('user_path');
			if (true) {
				if($u->updateProfile($id, $data))
					$profile->message = 'success';
				else
					$profile->message = 'failed';
			} else $profile->message = 'invalid';
		}
		$this->user_viewer->showEditProfile($profile);
	}

	public function forgotpassword(){ //dari sequence lupa password, buat minta password nya dr userManager
		$data = array();
		$u = new User_model();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$email = $this->input->post('email');
			$data['email'] = $email;
			$password = $u->getPasswordByEmail($email);
			die("nyoh password: $password");
			if($password !== FALSE) {
				if ($this->sendPassword($email, $password)) {
					$data['message'] = 'success';
				}else $data['message'] = 'failed';
			} else $data['message'] = 'invalid';
		}
		$this->user_viewer->showForgotPassword($data);
	}

	public function validateJoin($profile){
		// cek email, udah ada belum?
		return true;
	}

	public function sendPassword($email, $password){
		$this->load->library('email');
		$this->email->from('admin@foodoof');
		$this->email->to($email);
		$this->email->subject('Your FoodooF Password');
		$this->email->message("You said that you have forgotten your password. Here you are! Your password is $password.");
		return $this->send();
	}

	private function wajiblogin()
	{
		$id = $this->session->userdata('user_id');
		if ($id < 1) {
			header('Location: '.base_url().'home/login');
			die();
		}
		return $id;
	}
}
