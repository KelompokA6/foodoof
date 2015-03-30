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
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$email = $this->input->post($email);
			$email = $this->input->post($email);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */