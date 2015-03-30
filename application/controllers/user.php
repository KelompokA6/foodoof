<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('viewer');
	}

	public function index(){
		$this->load->view('profile_view');
	}

	public function profile($id = -1){
		if ($id == -1) {
			$id = $this->wajiblogin();
		}
		$this->load->model('user_model');
		$profile = $this->user_model->getProfile($id);		
		$this->viewer->showProfile($profile);
	}

	public function timeline($id = -1){
		if ($id == -1) {
			$id = $this->wajiblogin();
		}
		$u = new User_model();
		$profile = $u->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getUserRecipe($id);
		$this->viewer->showUserTimeline($profile, $listRecipe);
	}

	public function favorite($id = -1){
		if ($id == -1) {
			$id = $this->wajiblogin();
		}
		$u = new User_model();
		$profile = $u->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getFavoriteRecipe($id);
		$this->viewer->showUserTimeline($profile, $listRecipe);
	}

	public function cooklater(){
		$id = $this->wajiblogin();
		$u = new User_model();
		$profile = $u->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getCooklaterRecipe($id);
		$this->viewer->showUserTimeline($profile, $listRecipe);
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

		$this->viewer->showChangePassword($profile, $data);
	}

	public function join(){
		$data = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['name'] = $this->input->post("name");
			$data['email'] = $this->input->post("email");
			$data['password'] = $this->input->post("password"); 
			$data['confrimPass'] = $this->input->post("confirm_password");

			if($this->isValid($data)){
				$user = new User_model();
				$success = $user->createUser($data);
				$data['message'] = $success ? "success" : "failed";
			}
			else{
				$data['message'] = "invalid";
			}
		}
		
		$this->viewer->showRegister($data);
	}

	public function edit(){
		$id = $this->wajiblogin();

		$u = new User_model();
		$profile = $u->getProfile($id);

		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['name'] = $this->input->post('user_name');
			$data['gender'] = $this->input->post('inlineRadioOptions');
			$data['phone'] = $this->input->post('user_phone');
			$data['bdate'] = $this->input->post('user_bdate');
			$data['twitter'] = $this->input->post('user_twitter');
			$data['facebook'] = $this->input->post('user_facebook');
			$data['googleplus'] = $this->input->post('user_gplus');
			$data['path'] = $this->input->post('user_path');
			if ($this->isValid($data)) {
				if($u->updateProfile($id, $data))
					$profile['message'] = 'success';
				else
					$profile['message'] = 'failed';
			} else $profile['message'] = 'invalid';
		}
		$this->viewer->showEditProfile($profile);
	}

	public function forgotpassword(){ //dari sequence lupa password, buat minta password nya dr userManager
		$data = array();
		$u = new User_model();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$email = $this->input->post('email');
			$data['email'] = $email;
			$password = $u->getPasswordByEmail($email);
			echo "nyoh password: $password"; exit();
			if($password !== FALSE) {
				if ($this->sendPassword($email, $password)) {
					$data['message'] = 'success';
				}else $data['message'] = 'failed';
			} else $data['message'] = 'invalid';
		}
		$this->viewer->showForgotPassword($data);
	}

	public function isValid(){
		return TRUE;
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
			echo "you're not logged in";
			exit();
		}
		return $id;
	}
}
