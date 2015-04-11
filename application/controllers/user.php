<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('user_viewer');
	}

	public function index(){
		$this->timeline();
	}

	public function profile($id = -1){
		if ($id == -1) {
			$id = $this->user_model->wajiblogin();
		}
		$profile = $this->user_model->getProfile($id);
		$this->user_viewer->showProfile($profile);
	}

	public function timeline($id = -1){
		if ($id == -1) {
			$id = $this->user_model->wajiblogin();
		}
		$profile = $this->user_model->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getUserRecipe($id, 1001);
		$this->user_viewer->showUserTimeline($profile, $listRecipe);
	}

	public function favorite($id = -1){
		if ($id == -1) {
			$id = $this->user_model->wajiblogin();
		}
		$profile = $this->user_model->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getFavoriteRecipe($id);
		$this->user_viewer->showUserTimeline($profile, $listRecipe);
	}

	public function cooklater(){
		$id = $this->user_model->wajiblogin();
		$profile = $this->user_model->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getCooklaterRecipe($id);
		$this->user_viewer->showUserTimeline($profile, $listRecipe);
	}

	public function changepassword(){
		$id = $this->user_model->wajiblogin();
		$data = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['oldPass'] = $this->input->post("old_password");
			$data['newPass'] = $this->input->post("new_password");
			$data['confirmPass'] = $this->input->post("confirm_password");

			if($this->isValid($data)){
				$success = $this->user_model->updatePassword($id, $data['newPass']);
				$data['message'] = $success ? "success" : "failed";
			}
			else{
				$data['message'] = "invalid";
			}
		}

		$profile = $this->user_model->getProfile($id);

		$this->user_viewer->showChangePassword($profile, $data);
	}

	public function join(){
		$data['join_alert'] = '';
		$data['name'] = '';
		$data['email'] = '';
		$data['gender'] = '';
		$data['checked_male'] = '';
		$data['checked_female'] = '';

		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['name'] = $this->input->post("name");
			$data['email'] = $this->input->post("email");
			$data['gender'] = $this->input->post("genderOptions");
			$data['checked_male'] = $data['gender'] == 'M' ? 'checked="checked"' : '';
			$data['checked_female'] = $data['gender'] == 'F' ? 'checked="checked"' : '';
			$data['password'] = $this->input->post("password"); 
			$data['confirm_password'] = $this->input->post("confirm_password");

			if ($this->_validateJoin($data)) {
				if(!$this->_send_email($data)) {
					die("email gagal");
				}
				if($this->user_model->createUser($data)) {
					$profile_menubar = $this->user_model->login($data['email'], $data['password']);
					foreach ($profile_menubar as $key => $value) {
						$this->session->set_userdata($key, $value);
					}
					redirect(base_url().'user');
					die;
				} else {
					$data['join_alert'] = '<div class="alert alert-warning">Join Failed!</div>';
				}
			} else {
				$data['join_alert'] = '<div class="alert alert-danger">Email Invalid!</div>';
			}
		}
		$this->user_viewer->showRegister($data);
	}

	private function _send_email($profile)
	{
		extract($profile);
		$this->load->library('email');
		$this->email->from('noreply@foodoof.com');
		$this->email->to($email);
		$this->email->subject('Welcome to Foodoof');
		$this->email->message("Hello $name! Nice to glad you in Foodoof.\nYour account has been created. You can login in http://foodoof.com/home/login, using this email and your password is $password");
		return $this->email->send();
	}

	public function edit(){
		$data['id'] = $this->user_model->wajiblogin();

		$message = '';
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
				if($this->user_model->updateProfile($data['id'], $data)){
					$message = 'success';
					$this->session->set_userdata('user_name', $data['name']);
					$this->session->set_userdata('user_photo', @$data['photo'] ? $data['photo'] : 'images/user/0.jpg');
				}
				else
					$message = 'failed';
			} else $message = 'invalid';
		}
		$profile = $this->user_model->getProfile($data['id']);
		$profile->message = $message;
		$this->user_viewer->showEditProfile($profile);
	}

	public function forgotpassword(){ //dari sequence lupa password, buat minta password nya dr userManager
		$data = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$email = $this->input->post('email');
			$data['email'] = $email;
			$password = $this->user_model->getPasswordByEmail($email);
			die("nyoh password: $password");
			if($password !== FALSE) {
				if ($this->_sendPassword($email, $password)) {
					$data['message'] = 'success';
				}else $data['message'] = 'failed';
			} else $data['message'] = 'invalid';
		}
		$this->user_viewer->showForgotPassword($data);
	}

	private function _validateJoin($profile){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		if($profile['password'] !== $profile['confirm_password'] || strlen($profile['password']) < 5) return FALSE;
		return $this->form_validation->run();
	}

	private function _sendPassword($email, $password){
		$this->load->library('email');
		$this->email->from('noreply@foodoof');
		$this->email->to($email);
		$this->email->subject('Your FoodooF Password');
		$this->email->message("You said that you have forgotten your password. Here you are! Your password is $password.");
		return $this->send();
	}
}
