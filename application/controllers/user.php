<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function getProfile($id){
		$user = new User();
		$profile = $user->getProfile($id);

		$data['data_profile'] = $profile;
		$this->load->model('viewer');
		$this->viewer->show('profile_page_view', $data);
	}

	public function getUserTimeline($id){
		$r = new Recipe();
		$recipe = $r->getListRecipe($id);

		$data['user'] = $id;
		$data['listRecipe'] = $recipe;
		$this->load->model('viewer');
		$this->viewer->show('user_timeline_view', $data);
	}

	public function changePassword(){
		$data['oldPass'] = $this->input->post("password_user");
		$data['newPass'] = $this->input->post("new_password");
		$data['confirmPass'] = $this->input->post("confirm_password");

		if($this->isValid($data)){

		}
		else{

		}
	}

	public function viewChangePass(){
		$this->load->model('viewer');
		$this->viewer->show(change_password_view);
	}

	public function register(){
		$data['name'] = $this->input->post("name_user");
		$data['email'] = $this->input->post("email_user");
		$data['password'] = $this->input->post("password_user"); 
		$data['confrimPass'] = $this->input->post("confrim_password");

		
		if($this->isValid($data)){
			$user = new User();
			$isCreate = $user->createUser($data);
			if($isCreate){
				$dataSuccess['message'] = "Registration Success"; //cara masukin nilainya gini bukan ya??
			}
			else{
				$dataSuccess['message'] = "Registration Failed";
			}
		}
		else{
			$dataSuccess['message'] = "Registration Failed";
		} 
	}

	public function editProfile($id){

	}

	public function getPassword($id){ //dari sequence lupa password

	}

	public function isValid(){
		return TRUE;
	}
}