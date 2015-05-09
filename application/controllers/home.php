<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('home_viewer');
	}

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
			if($profile !== FALSE) {
				// print_r($profile); die;
				foreach ($profile as $key => $value) {
					$this->session->set_userdata($key, $value);
				}
				$alert = "<div id='alert-notification' data-status='success' data-message='Success Login' class='hidden'></div>";
				$this->session->set_flashdata('alert-notification', $alert);
				$u->where('email', $this->input->post('email'))->get();
				if(strtolower($u->status) === "admin"){
					redirect(base_url()."index.php/admin");
				}
				redirect(base_url());
			} else {
				$data['login_alert'] = '<div class="alert alert-danger">email not registered or password doesn\'t match</div>';
			}
		}
		$this->home_viewer->showLogin($data);
	}

	public function logout()
	{
		// hilangkan jejak online
		$user_id = $this->session->userdata('user_id');
		if($user_id)
			(new User_model())->where('id', $user_id)->update('last_access', (new DateTime())->modify("-30 second")->format("Y-m-d H:i:s"));
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_photo');
		$alert = "<div id='alert-notification' data-status='success' data-message='You just logged out' class='hidden'></div>";
		$this->session->set_flashdata('alert-notification', $alert);
		redirect(base_url());
		die;
	}

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

	public function addReport($recipe_id){
		$recipe_id = $this->session->userdata('user_id');		
		$cat_report = $this->input->post("report_category");
		$report = new Report();
		foreach ($cat_report as $obj) {
			if(!empty($report)){
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
		$alert = "<div id='alert-notification' data-status='Success' data-message='Thanks for your report' class='hidden'></div>";
		$this->session->set_flashdata('alert-notification', $alert);
		redirect(base_url()."index.php/recipe/get/$recipe_id");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
