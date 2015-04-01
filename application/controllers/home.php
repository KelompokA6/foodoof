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
		$listTopRecipe = $r->getTopRecipe(5);
		$listHightlight = $r->getHightlight(5);
		$listRecently = $r->getRecently(5);
		$u = new User_model();
		foreach ($listTopRecipe as $row)
			$row->author_name = $u->getProfile($row->author)->name;
		foreach ($listRecently as $row)
			$row->author_name = $u->getProfile($row->author)->name;
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
				redirect(base_url());
			} else {
				$data['login_alert'] = '<div class="label label-danger">login failed</div>';
			}
		}
		$this->home_viewer->showLogin($data);
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_photo');
		redirect(base_url());
		die;
	}

	public function toprecipe()
	{
		$r = new Recipe_model();
		$listTopRecipe = $r->getTopRecipe(1001);
		$u = new User_model();
		foreach ($listTopRecipe as $row)
			$row->author_name = $u->getProfile($row->author)->name;
		
		$this->home_viewer->showTop($listTopRecipe);
	}

	public function recently()
	{
		$r = new Recipe_model();
		$listRecently = $r->getRecently(1001);
		$u = new User_model();
		foreach ($listRecently as $row)
			$row->author_name = $u->getProfile($row->author)->name;
		
		$this->home_viewer->showRecently($listRecently);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */