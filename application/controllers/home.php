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
		$this->home_viewer->showHome($listTopRecipe, $listHightlight, $listRecently);
	}

	public function login()
	{
		$data = array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['email'] = $email = $this->input->post('email');
			$data['password'] = $password = $this->input->post('password');
			$u = new User_model();
			$profile = $u->login($email, $password);
			if($profile !== FALSE) {
				foreach ($profile as $key => $value) {
					$this->session->set_userdata($key, $value);
				}
				redirect(base_url());
			} else {
				$data['message'] = 'failed';
				die('failed');
			}
		}
		$this->home_viewer->showLogin($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */