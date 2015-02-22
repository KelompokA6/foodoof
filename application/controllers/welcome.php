<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$this->load->library('encrypt');
		$msg = 'My secret message';
		$encrypted_string = $this->encrypt->encode($msg);
		echo $encrypted_string;
		$this->load->view('welcome_message');
	}
	public function register(){
		$user = new User();
		$user->user_email = "abidnurulhakim@gmail.com";
		$user->user_password = "abidnurulhakim";
		$user->user_name = "Abid Nurul Hakim";
		if($user->save()){
			echo "Register success";
		}
		else{
			echo $user->error->member;
		}
	}
	public function login(){
		$user = new User();
		$user->user_email = "abidnurulhakim@gmail.com";
		$user->user_password = "abidnurulhakim";
		if($user->login()){
			 echo "Login Success";
			 echo $this->session->userdata('user_id');
		}
		else{
			echo "Login Failed";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */