<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function index(){
		$this->load->view('profile_view');
	}

	public function profile($id){
		$this->load->model('user_model');
		$profile = $this->user_model->getProfile($id);
		$this->load->model('viewer');
		$this->viewer->showProfile($profile);
	}

	public function timeline($id){
		$u = new User_model();
		$profile = $u->getProfile($id);
		// $r = new Recipe();
		// $listRecipe = $r->getUserRecipe($id);
		$this->load->model('viewer');
		$this->viewer->showUserTimeline($profile, $listRecipe);
	}

	public function updatePassword($id){
		$data['oldPass'] = $this->input->post("old_password");
		$data['newPass'] = $this->input->post("new_password");
		$data['confirmPass'] = $this->input->post("confirm_password");
		 
		if($this->isValid($data)){
			$user = new User_model();
			$isChanged = $user->updatePassword($id, $data['newPass']);
			if($isChanged){
				$dataMessage['message'] = "Change Password Success"; 
			}
			else{
				$dataMessage['message'] = "Change Password Failed";
			}
		}
		else{
			$dataMessage['message'] = "Change Password Failed";
		} 

		$this->load->model('viewer');
		$this->viewer->show('change_password_view', $dataMessage);
	}

	public function viewChangePass(){
		$this->load->model('viewer');
		$this->viewer->show('change_password_view');
	}

	public function register(){
		$data['name'] = $this->input->post("name");
		$data['email'] = $this->input->post("email");
		$data['password'] = $this->input->post("password"); 
		$data['confrimPass'] = $this->input->post("confirm_password");
		
		if($this->isValid($data)){
			$user = new User_model();
			$isCreate = $user->createUser($data);
			if($isCreate){
				$dataMessage['message'] = "Registration Success"; 
			}
			else{
				$dataMessage['message'] = "Registration Failed";
			}
		}
		else{
			$dataMessage['message'] = "Registration Failed";
		} 

		$this->load->model('viewer');
		$this->viewer->show('register_view', $dataMessage);
	}

	public function edit($id){
		$u = new User_model();
		$data['dataProfile'] = $u->getProfile($id);

		$this->load->model('viewer');
		$this->viewer->show('edit_profile_view', $data);
	}
/*
	public function authEdit($id){ 		//
//		$this->load->model('viewer');
//		$this->viewer->show('edit_profile_view');

		$data['photo'] = $this->input->post("photo_user");
		$data['name'] = $this->input->post("name_user");
		$data['gender'] = $this->input->post("gender_user");
		$data['email'] = $this->input->post("email_user");
		$data['phone'] = $this->input->post("phone_user");
		$data['bdate'] = $this->input->post("birthDate_user");

		$data['twitter'] = $this->input->post("twitter_user");
		$data['fb'] = $this->input->post("fb_user");
		$data['ig'] = $this->input->post("ig_user");
		$data['gplus'] = $this->input->post("gplus_user");
		$data['linkedin'] = $this->input->post("linkedin_user");

		if($this->isValid($data)){
			$u = new User_model();
			$isUpdated = $u->updateProfile($id, $data);
			if($isUpdated){
				$dataMessage['message'] = "Update Success"; 
			}
			else{
				$dataMessage['message'] = "Update Failed";
			}
		}
		else{
			$dataMessage['message'] = "Update Failed";
		}

		$this->load->model('viewer');
		$this->viewer->show('edit_profile_view', $dataMessage);
	}
*/
	public function getPassword($email){ //dari sequence lupa password, buat minta password nya dr userManager
		$u = new User_model();
		$data['password'] = $u->getPassword($email);
		$data['email'] = $email;
		if($this->sendEmail($data)){
			$dataMessage['message'] = "Email Sent";
			$this->load->model('viewer');
			$this->viewer->show('forget_password_view', $dataMessage); //else nya?
		}
	}

	public function isValid(){
		return TRUE;
	}

	public function sendEmail(){
		return TRUE;
	}
}
//udah mulai mabok -_-