<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index(){
		$this->load->model('home_viewer');
		$this->load->library('session');
		if($this->session->userdata('user_id')==''){
			redirect(base_url()."index.php/home/login", "refresh");
		}
		$u = new User_model();
		$u->get_by_id($this->session->userdata('user_id'));
		if(strtolower($u->status)!='admin'){
			return $this->pageNotFound();	
		}
		$this->load->library('parser');
		$data = array("recipe_author_id"=> 1);
		$menubar = $this->home_viewer->getMenubar();
		
		$r = new Recipe_model();
		$list = $r->getAllRecipe(1);
		$entries = array();
		foreach ($list as $obj) {
			$check="";
			if($obj->highlight=='1'){
				$check = "checked";
			}
			$temp = array(
				'highlight_recipe_id' => $obj->id,
				'highlight_recipe_photo' => $obj->photo,
				'highlight_recipe_name' => $obj->name,
				'highlight_status' => $obj->highlight,
				'highlight_checked' => $check,
			);
			array_push($entries, $temp);
		}

		$data1 = array(
			'highlighted_recipe_entries' => $entries,
			);
		$highlight_admin_view = $this->parser->parse('highlight_admin_view', $data1, TRUE);	
		$sidebar_admin = $this->parser->parse('sidebar_admin', array(), TRUE);	
		$data1 = array(
			'content_admin' => $highlight_admin_view,
			'sidebar_admin' => $sidebar_admin
			);
		$content_website = $this->parser->parse('template_admin', $data1, TRUE);	
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);
	}
	public function report(){
		$this->load->model('home_viewer');
		$this->load->library('session');
		if($this->session->userdata('user_id')==''){
			redirect(base_url()."index.php/home/login", "refresh");
		}
		$u = new User_model();
		$u->get_by_id($this->session->userdata('user_id'));
		if(strtolower($u->status)!='admin'){
			return $this->pageNotFound();	
		}
		$this->load->library('parser');
		$menubar = $this->home_viewer->getMenubar();
		$content_admin = $this->parser->parse('reported_user_view', array(), TRUE);	
		$sidebar_admin = $this->parser->parse('sidebar_admin', array(), TRUE);	
		$data1 = array(
			'content_admin' => $content_admin,
			'sidebar_admin' => $sidebar_admin
			);
		$content_website = $this->parser->parse('template_admin', $data1, TRUE);	
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);
	}

	public function save(){
		$this->load->library('session');
		if($this->session->userdata('user_id')==''){
			redirect(base_url()."index.php/home/login", "refresh");
		}
		$u = new User_model();
		$u->get_by_id($this->session->userdata('user_id'));
		if(strtolower($u->status)!='admin'){
			$this->pageNotFound();	
		}
		$recipe = new Recipe_model();
		$success = TRUE;
		$list = $recipe->getAllRecipe();
		foreach ($list as $obj) {
			$recipe->highlightRecipe($obj->id, FALSE);
		}	
		$highlight = $this->input->post("id_highlight");
		if (!empty($highlight)){
			foreach($highlight as $selected){
				if(!$recipe->highlightRecipe($selected, TRUE)){
					$success = FALSE;
				}
			}
		}		
		$highlight_alert = $success ? "<div class=\"alert alert-success text-center\">highlight recipe updated</div>" : "<div class=\"alert alert-danger\">update highlight failed</div>";
		$this->session->set_flashdata('alert-admin', $highlight_alert);
		redirect(base_url()."index.php/admin");
	}
	function pageNotFound(){
		$this->load->library('parser');
		$this->load->model('home_viewer');
		$menubar = $this->home_viewer->getMenubar();
		$content_website = $this->parser->parse('page_not_found', array(), TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);	
	}

	public function updateharga()
  {
    $now = (new DateTime());
    $m = (int)$now->format("m");
    $y = $now->format("Y");
    # UPDATE DARI 2010 COBA -_-

    $all_data = [];
    foreach (range(1,13) as $i) {
      $sumber = "http://infopangan.jakarta.go.id/api/price/series_by_location?type=market&lid=$i&m=$m&y=$y";
      $data = json_decode(file_get_contents($sumber))->data;
      // ambil name sama average aja
      $data = array_map(function($x){
        return (object)["name"=>$x->name, "price"=>$x->average];
      }, $data);
      foreach ($data as $d) {
        $all_data[$d->name] = $d->price;
      }
      echo "$sumber -- OK\n";
    }

    foreach (range(1,5) as $i) {
      $sumber = "http://infopangan.jakarta.go.id/api/price/series_by_location?type=city&lid=$i&m=$m&y=$y";
      $data = json_decode(file_get_contents($sumber))->data;
      // ambil name sama average aja
      $data = array_map(function($x){
        return (object)["name"=>$x->name, "price"=>$x->average];
      }, $data);
      foreach ($data as $d) {
        $all_data[$d->name] = $d->price;
      }
      echo "$sumber -- OK\n";
    }

    $catalog = new Catalog();
    foreach ($all_data as $name => $price) {
    	$units = "Rp/Kg";
    	if($name == "Garam Dapur") $units = "Rp/200 gram";
    	if($name == "Kelapa Kupas") $units = "Rp/butir";
    	if($name == "Susu Bubuk Bendera 400gr") $units = "Rp/kardus";
    	if($name == "Susu Bubuk Dancow 400gr") $units = "Rp/kardus";
    	if($name == "Susu Kental Bendera 200gr") $units = "Rp/kaleng";
    	if($name == "Susu Kental Enak 200gr") $units = "Rp/kaleng";
    	if($name == "Margarin Blueband Cup") $units = "Rp/kemasan";
    	if($name == "Margarin Blueband Sachet") $units = "Rp/kemasan";
      $catalog->ins($name, $units, $price);
    }

    print_r(sizeof($all_data));
  }

}