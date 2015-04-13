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
		$page = $this->input->get('page');
		if($page === FALSE) $page = 1;
		$limit = 5;
		$flag = $id == $this->session->userdata('user_id') ? 'all' : '';
		$listRecipe = $r->getUserRecipe($id, $flag, $limit, $limit * $page - $limit);
		/*if ($id != $this->session->userdata('user_id')) {
			$listRecipe = array_filter($listRecipe, function($row){return $row->status == 1;});
		}*/
		$totalpage = ceil(sizeof( $r->getUserRecipe($id, $flag, 1000111) )/$limit);
		$this->user_viewer->showUserTimeline($profile, $listRecipe, $page, $totalpage);
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
		$data['id'] = $this->user_model->wajiblogin();
		$data['change_password_alert'] = '';
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['oldPass'] = $this->input->post("old_password");
			$data['newPass'] = $this->input->post("new_password");
			$data['confirmPass'] = $this->input->post("confirm_new_password");

			if($this->_is_valid_changepassword($data)){
				$success = $this->user_model->updatePassword($data['id'], $data['newPass']);
				$data['change_password_alert'] = $success ? "<div class=\"alert alert-success\">password has been changed successfully</div>" : "<div class=\"alert alert-danger\">change password failed</div>";
			}
			else{
				$data['change_password_alert'] = "<div class=\"alert alert-danger\">old password or confirm password doesn't match</div>";
			}
		}

		$profile = $this->user_model->getProfile($data['id']);

		$this->user_viewer->showChangePassword($profile, $data);
	}

	private function _is_valid_changepassword($data)
	{
		$u = new User_model();
		if($u->where('id', $data['id'])->count() > 0)
		{
			$u->where('id', $data['id'])->get();
			$email = $u->email;
			if($u->login($email, $data['oldPass']) !== FALSE)
			{
				return $data['newPass'] == $data['confirmPass'] && strlen($data['newPass']) >= 5;
			}
		}
		return FALSE;
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
			$data['photo'] = $data['gender'] == 'M' ? 'assets/img/user-male.png' : 'assets/img/user-female.png';
			$data['password'] = $this->input->post("password"); 
			$data['confirm_password'] = $this->input->post("confirm_password");

			if ($this->_validate_join($data) === TRUE) {
				if(!$this->_send_email($data)) { }
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
				$data['join_alert'] = '<div class="alert alert-danger">'.$this->_validate_join($data).'</div>';
			}
		}
		$data['checked_male'] = $data['gender'] == 'M' ? 'checked="checked"' : '';
		$data['checked_female'] = $data['gender'] == 'F' ? 'checked="checked"' : '';
		$this->user_viewer->showRegister($data);
	}

	private function _send_email($profile)
	{
		extract($profile);
		$tosend = array(
			'email' => $email,
			'password' => $password,
			'from' => 'noreply@foodoof',
			'to' => $email,
			'subject' => 'Welcome to Foodoof',
			'message' => "Hello $name! Nice to glad you in Foodoof.\nYour account has been created. You can login in FoodooF page using this email and your password is $password",
			);
		file_get_contents('http://alfan.coderhutan.com/bejometer/numpang/ngemail?'.http_build_query($tosend));
		$this->load->library('email');
		$this->email->from('noreply@foodoof');
		$this->email->to($email);
		$this->email->subject('Welcome to Foodoof');
		$this->email->message("Hello $name! Nice to glad you in Foodoof.\nYour account has been created. You can login in FoodooF page using this email and your password is $password");
		return $this->email->send();
	}

	public function edit(){
		$data['id'] = $this->user_model->wajiblogin();

		$data['edit_profile_alert'] = '';
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if (file_exists('images/tmp/user/'.$data['id'].'.jpg')) {
				rename('images/tmp/user/'.$data['id'].'.jpg', 'images/user/'.$data['id'].'.jpg');
				$data['photo'] = 'images/user/'.$data['id'].'.jpg';
			}
			$data['name'] = $this->input->post('user_name');
			$data['phone'] = $this->input->post('user_phone');
			$data['bdate'] = $this->input->post('user_bdate');
			$data['twitter'] = $this->input->post('user_twitter');
			$data['facebook'] = $this->input->post('user_facebook');
			$data['googleplus'] = $this->input->post('user_gplus');
			$data['path'] = $this->input->post('user_path');
			$message = $this->_validate_edit_profile($data);
			if ($message === TRUE) { // jika data editan benar
				unset($data['edit_profile_alert']);
				if($this->user_model->updateProfile($data['id'], $data)) {
					$data['edit_profile_alert'] = "<div class=\"alert alert-success\">profile has been updated successfully</div>";
					$this->session->set_userdata('user_name', $data['name']);
					if(file_exists('images/user/'.$data['id'].'.jpg')) {
						$this->session->set_userdata('user_photo', 'images/user/'.$data['id'].'.jpg');
					}
				}
				else
					$data['edit_profile_alert'] = "<div class=\"alert alert-warning\">update profile failed</div>";
			} else $data['edit_profile_alert'] = "<div class=\"alert alert-danger\">$message</div>";
		}
		$profile = $this->user_model->getProfile($data['id']);
		foreach ($data as $key => $value) $profile->$key = $value;
		$this->user_viewer->showEditProfile($profile);
	}

	private function _validate_edit_profile($profile)
	{
		// cek bdate
		if( (new DateTime($profile['bdate'])) > (new DateTime) ) return 'invalid birth date';
		if( !preg_match('/^[0-9]*$/', $profile['phone']) ) return 'invalid phone number';
		return TRUE;
	}

	public function forgotpassword(){ //dari sequence lupa password, buat minta password nya dr userManager
		$data['forget_password_alert'] = '';
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$email = $this->input->post('email_user');
			$data['email'] = $email;
			$password = $this->user_model->getPasswordByEmail($email);
			if($password !== FALSE) {
				if ($this->_sendPassword($email, $password)) {
					// $data['forget_password_alert'] = "<div class=\"alert alert-success\">password: $password</div>";
				}else $data['forget_password_alert'] = '<div class="alert alert-warning">sending email failed</div>';
			} else $data['forget_password_alert'] = "<div class=\"alert alert-danger\">$email not registered</div>";
		}
		$this->user_viewer->showForgotPassword($data);
	}

	private function _validate_join($profile){
		// email sudah kedaftar belum?
		$u = new User_model();
		if($u->where('email', $profile['email'])->count() > 0) return $profile['email']." has been registered";
		if(!filter_var($profile['email'], FILTER_VALIDATE_EMAIL)) return "invalid email";
		if($profile['password'] !== $profile['confirm_password']) return "password doesn't match";
		if(strlen($profile['password']) < 5) return "minimum password length is 5";
		return TRUE;
	}

	private function _sendPassword($email, $password){
		$tosend = array(
			'email' => $email,
			'password' => $password,
			'from' => 'noreply@foodoof',
			'to' => $email,
			'subject' => 'Your FoodooF Password',
			'message' => "You said that you have forgotten your password. Here you are! Your password is $password.",
			);
		file_get_contents('http://alfan.coderhutan.com/bejometer/numpang/ngemail?'.http_build_query($tosend));
		// die('http://alfan.coderhutan.com/bejometer/numpang/ngemail?'.http_build_query($tosend));
		$this->load->library('email');
		$this->email->from('noreply@foodoof');
		$this->email->to($email);
		$this->email->subject('Your FoodooF Password');
		$this->email->message("You said that you have forgotten your password. Here you are! Your password is $password.");
		return $this->email->send();
	}
}
