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
		if ($this->session->userdata('user_id') > 0) {
			print_r($this->session->userdata()); die;
		}
		$data = array();
		$data['login_alert'] = '';
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['email'] = $email = $this->input->post('email');
			$data['password'] = $password = $this->input->post('password');
			$u = new User_model();
			$profile = $u->login($email, $password);
			if($profile !== FALSE) {
				print_r($profile); die;
				/*foreach ($profile as $key => $value) {
					$this->session->set_userdata($key, $value);
				}*/
				redirect(base_url());
			} else {
				$data['login_alert'] = 'login failed';
				// die('failed');
			}
		}
		$this->home_viewer->showLogin($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */