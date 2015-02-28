<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	/**
	This is controller for registration user and forget password
	 */
	public function index()
	{	
		$this->load->view('registration');
	}
	public function register(){
		$user = new User();
		$user->email = $this->input->post("email_user");
		$user->password = $this->input->post("password_user");
		$user->name = $this->input->post("name_user");
		$user->confirm_password = $this->input->post("retype_password_user");
		if($user->save()){
			echo "Register success";
		}
		else{
			echo "Register Failed";
			echo $user->error->member;
		}
	}
	public function login(){
		$user = new User();
		$user->email = $this->input->post("email_user");
		$user->password = $this->input->post("password_user");
		if($user->login()){
			 echo "Login Success";
			 echo $this->session->userdata('user_id');
		}
		else{
			echo "Login Failed";
		}
	}

	public function forgetpassword(){
		$user = new User();
		$user->email = $this->input->post("email_user");
		echo $user->remember();
	}

	public function addRecipe(){
		$recipe = new Recipe();
		$recipe->name = "Nasi Goreng";
		$recipe->author = "1";
		$recipe_id = $recipe->saveRecipe();
		if($recipe_id != 0){
			$i = new Ingredient();
			$i->recipe_id = $recipe_id;
			$i->name = "Bawang Putih";
			$i->quantity = 1;
			$i->price = 1000;
			$i->units = "Buah";
			$i->save();
			$i->recipe_id = $recipe_id;
			$i->name = "Bawang Merah";
			$i->quantity = 2;
			$i->price = 1500;
			$i->units = "Buah";
			$i->save();
			$i->recipe_id = $recipe_id;
			$i->name = "Cabai";
			$i->quantity = 3;
			$i->price = 1000;
			$i->units = "Buah";
			$i->save();
			echo "Add Recipe Success";
		}
		else{
			echo "Failed Nambah Bahan";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */