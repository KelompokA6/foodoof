<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('home_viewer');
	}

	/*
	digunakan untuk menampilkan halaman homepage
	*/
	public function index()
	{
		$r = new Recipe_model();
		$listTopRecipe = $r->getTopRecipe(4);
		$listHightlight = $r->getHightlight(5);
		$listRecently = $r->getRecently(4);
		// print_r($listHightlight); die();
		$u = new User_model();
		foreach ($listTopRecipe as $row){
			$row->author_name = $u->getProfile($row->author)->name;
			$row->author_photo = $u->getProfile($row->author)->photo;
		}
		foreach ($listRecently as $row){
			$row->author_name = $u->getProfile($row->author)->name;
			$row->author_photo = $u->getProfile($row->author)->photo;
		}
		foreach ($listHightlight as $row)
			$row->author_name = $u->getProfile($row->author)->name;
		
		$this->home_viewer->showHome($listTopRecipe, $listHightlight, $listRecently);
	}

	/*
	digunakan untuk login user
	*/
	public function login()
	{
		if ($this->session->userdata('user_id') > 0) {
			redirect(base_url()); die;
		}
		$data['email'] = '';
		$data['login_alert'] = '';
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['email'] = $email = $this->input->post('email');
			$data['password'] = $password = $this->input->post('password');
			$u = new User_model();
			$profile = $u->login($email, $password);
			if(is_array($profile)) {
				// print_r($profile); die;
				foreach ($profile as $key => $value) {
					$this->session->set_userdata($key, $value);
				}
				$alert = "<div id='alert-notification' data-status='success' data-message='Login Success' class='hidden'></div>";
				$this->session->set_flashdata('alert-notification', $alert);
				$u->where('email', $this->input->post('email'))->get();
				if(strtolower($u->status) === "admin"){
					redirect(base_url()."index.php/admin");
				}
				redirect(base_url());
			} else {
				$data['login_alert'] = '<div class="alert alert-danger">'.$profile.'</div>';
			}
		}
		$this->home_viewer->showLogin($data);
	}

	/*
	digunakan untuk logout
	*/
	public function logout()
	{
		// hilangkan jejak online
		$user_id = $this->session->userdata('user_id');
		if($user_id)
			(new User_model())->where('id', $user_id)->update('last_access', (new DateTime())->modify("-30 second")->format("Y-m-d H:i:s"));
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_photo');
		$this->session->unset_userdata('theme');
		$alert = "<div id='alert-notification' data-status='success' data-message='You just logged out' class='hidden'></div>";
		$this->session->set_flashdata('alert-notification', $alert);
		redirect(base_url());
		die;
	}

	/*
	digunakan untuk menampilkan halaman highlight resep
	*/
	public function highlight()
	{
		$r = new Recipe_model();
		$listHightlight = $r->getHightlight(11);
		$u = new User_model();
		foreach ($listHightlight as $row) {
			$a = $u->getProfile($row->author);
			$row->author_name = $a->name;
			$row->author_photo = $a->photo;
		}
		
		$this->home_viewer->showHighlight($listHightlight);
	}

	/*
	digunakan untuk menampilkan halaman top resep
	*/
	public function toprecipe()
	{
		$r = new Recipe_model();
		$listTopRecipe = $r->getTopRecipe(11);
		$u = new User_model();
		foreach ($listTopRecipe as $row) {
			$a = $u->getProfile($row->author);
			$row->author_name = $a->name;
			$row->author_photo = $a->photo;
		}
		
		$this->home_viewer->showTop($listTopRecipe);
	}

	/*
	digunakan untuk menampilkan halaman recently resep
	*/
	public function recently()
	{
		$r = new Recipe_model();
		$listRecently = $r->getRecently(11);
		$u = new User_model();
		foreach ($listRecently as $row) {
			$a = $u->getProfile($row->author);
			$row->author_name = $a->name;
			$row->author_photo = $a->photo;
		}
		
		$this->home_viewer->showRecently($listRecently);
	}

	/*
	digunakan untuk report terhadap sebuah resep
	*/
	public function addReport($recipe_id){
		$r = new Recipe_model();
		$user_id = $r->getRecipe($recipe_id)->author;		
		$cat_report = $this->input->post("report_category");
		$report = new Report();
		$isSuccess = false;
		if(sizeof($cat_report)>0){
			$isSuccess = true;
			foreach ($cat_report as $obj) {
				if(empty(trim($obj)) && (strlen($obj) > 0)|| empty($obj)){
					$isSuccess = false;
				}
			}
			if($isSuccess){
				$alert = "<div id='alert-notification' data-status='success' data-message='Thanks for your report' class='hidden'></div>";		
			}
			else{
				$alert = "<div id='alert-notification' data-status='failed' data-message='Please choose at least 1 category report for your report' class='hidden'></div>";
			}
		}
		if($isSuccess){
			$user = new User_model();
			if($user->where("id", $user_id)->where("status","BANNED")->count()==0){
				$user->clear();
				$user->where("id", $user_id);
				$user->update("status","REPORTED");
			}
			foreach ($cat_report as $obj) {
				if(!empty(trim($obj))){
					$report->recipe_id = $recipe_id;
					$report->reason = $obj;
					if(!$report->skip_validation()->save()){
						$alert = "<div id='alert-notification' data-status='failed' data-message='Failed Report' class='hidden'></div>";
						$this->session->set_flashdata('alert-notification', $alert);
						redirect(base_url()."index.php/recipe/get/$recipe_id");
					}
					$report->clear();
				}
			}
			$report->recipe_id = $recipe_id;
			if(!empty($this->input->post("report_other"))){
				$report->reason = $this->input->post("report_other");
				if(!$report->skip_validation()->save()){
					$alert = "<div id='alert-notification' data-status='failed' data-message='Failed Report' class='hidden'></div>";
					$this->session->set_flashdata('alert-notification', $alert);
					redirect(base_url()."index.php/recipe/get/$recipe_id");
				}
				$report->clear();	
			}
		}
		else{
			$alert = "<div id='alert-notification' data-status='failed' data-message='Please choose at least 1 category report for your report' class='hidden'></div>";		
		}
		$this->session->set_flashdata('alert-notification', $alert);
		redirect(base_url()."index.php/recipe/get/$recipe_id");
	}

	/*
	digunakan untuk mengubah theme
	*/
	public function changeTheme()
	{
		$url = $this->input->get('url');
		if($url === FALSE) $url = base_url();
		$themenow = $this->session->userdata('theme');
		if($themenow === FALSE) $themenow = '';
		if($themenow) // $themenow != FALSE, berarti ini tema 2
		{
			(new User_model())->where('id', $this->session->userdata('user_id'))->update('theme', '');
			$this->session->set_userdata('theme', '');
		}
		else // nah, ini baru tema 2
		{
			(new User_model())->where('id', $this->session->userdata('user_id'))->update('theme', '2');
			$this->session->set_userdata('theme', '2');
		}
		redirect($url);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
