<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	public function index(){
		$this->highlight();
	}

	/*
		digunakan untuk menampilkan halaman pengaturan highlight resep
	*/
	public function highlight(){
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

	/*
		digunakan untuk menampilkan halaman pengaturan report resep
	*/
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
		$reported_user_entries = array();
		$user = new Report();
		$listRepo = $user->getListReportUser();
		foreach ($listRepo as $objRepo) {
			$report = new Report();
			$list = $report->getListReportByUserId($objRepo->id);
			$s = new User_model();
			$user_name = $s->getProfile($objRepo->id)->name;
			$user_photo = $s->getProfile($objRepo->id)->photo;
			$details = array();
			foreach ($list as $obj1) {
				$detilres = new Recipe_model();
				$obj = $detilres->getDetailsReportByRecipeId($obj1->recipe_id);
				$other_detil = array();
				foreach ($obj->count_other_details as $other_details) {
					array_push($other_detil, array("reported_recipe_other_detail"=>$other_details->detail));
				}
				$temp = array(
				 		'reported_recipe_name' => $obj->name, 
				 		'reported_recipe_count_ads' => $obj->count_advertisement,
				 		'reported_recipe_count_porn' => $obj->count_pornographic,
				 		'reported_recipe_count_spam' => $obj->count_spam,
				 		'reported_recipe_count_other' => $obj->count_other,
				 		'reported_recipe_other_entries' => $other_detil,
				 	);
				array_push($details, $temp);
			}
			$data1 = array(
				'reported_recipe_entries' => $details,
				'reported_user_id' => $objRepo->id,
				'reported_user_name' => $user_name,
				'reported_user_photo' => $user_photo,
				);
			array_push($reported_user_entries, $data1);
		}
		$data = array(
			"reported_user_entries" => $reported_user_entries
			);
		$content_admin = $this->parser->parse('reported_user_view', $data, TRUE);	
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

	/*
		digunakan untuk menyimpan pengaturan highlight resep
	*/
	public function saveHighlight(){
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

	/*
		digunakan untuk menampilkan halaman pengaturan catalog bahan
	*/
	public function catalog(){
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
		
		$cat = new Catalog();
		$list = $cat->getCatalog();
		$entries = array();
		foreach ($list as $obj) {
			$temp = array(
				'catalog_id' => $obj->id,
				'catalog_name' => $obj->name,
				'catalog_quantity' => $obj->quantity,
				'catalog_unit' => $obj->units,
				'catalog_price' => $obj->price,
				'catalog_last_update' => $obj->last_update,
			);
			array_push($entries, $temp);
		}
		$data1 = array(
			'catalog_entries' => $entries,
			);
		$content_admin = $this->parser->parse('catalog_view', $data1, TRUE);	
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

	/*
	 melakukan update catalog pada database
	 */
	public function updateCatalogAjax(){
		$id = $this->input->post("pk");
		$attr = $this->input->post("name");
		$value = $this->input->post("value");
		$catalog = new Catalog();
		$catalog->where("id", $id);
		if($catalog->update($attr, $value)){
			$data = array(
					"status"	=>	"success",
					"message"	=>	"Successfully Edit ".strtoupper($attr),
			);
		}
		else{
			$data = array(
					"status"	=>	"failed",
					"message"	=>	"Failed Edit ".strtoupper($attr),
			);
		}
		echo json_encode($data);
	}

	/*
		digunakan untuk menambahkan catalog bahan yang baru
	*/
	public function saveNewCatalog(){
		$this->load->library('session');
		if($this->session->userdata('user_id')==''){
			redirect(base_url()."index.php/home/login", "refresh");
		}
		$u = new User_model();
		$u->get_by_id($this->session->userdata('user_id'));
		if(strtolower($u->status)!='admin'){
			$this->pageNotFound();	
		}
		$cat = new Catalog();
		$success = TRUE;
		$duplicate = FALSE;		
		$name = $this->input->post("entry_subject");
		$quantity = $this->input->post("entry_quantity");
		$units = $this->input->post("entry_unit");
		$price = $this->input->post("entry_price");
		if($cat->ilike("name", $name)->ilike("units", $units)->count()<1){
			if(!$cat->addCatalog($name, $quantity, $units, $price)){
				$success = FALSE;
			}	
		}
		else{
			$duplicate = true;
		}
		
		$highlight_alert = $success ? "<div class=\"alert alert-success text-center\">catalog updated</div>" : "<div class=\"alert alert-danger\">update catalog failed</div>";
		if($duplicate){
			$highlight_alert = "<div class=\"alert alert-danger\">There are duplicate catalog</div>";
		}
		$this->session->set_flashdata('alert-admin', $highlight_alert);
		redirect(base_url()."index.php/admin/catalog");
	}

	/*
		digunakan untuk menampilkan halaman mengirim email
	*/
	public function sendemail(){
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
		$content_admin = $this->parser->parse('sendemail_view', array(), TRUE);	
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

	/*
		digunakan untuk mengirim email
	*/
	public function sendmail($toall = FALSE){
		if($this->session->userdata('user_id')==''){
			redirect(base_url()."index.php/home/login", "refresh");
		}
		$u = new User_model();
		$u->get_by_id($this->session->userdata('user_id'));
		if(strtolower($u->status)!='admin'){
			return $this->pageNotFound();	
		}
		if(!$toall) $users_email = explode(",", $this->input->post("email_users"));
		$success = true;
		$data = array();
		$subject = $this->input->post("subject");
		$message = $this->input->post("message");
		if($toall)
		{
			$data = array();
			$data["subject"] = $subject;
			$data["message"] = $message;
			$success = $this->_send_email($data, $toall);
		} else {
			foreach ($users_email as $email) {
				$data = array();
				$data["email"] = $email;
				$data["subject"] = $subject;
				$data["message"] = $message;
				$user = new User_model();
				$user->where("email", $email);
				$user->get();
				$data["name"] = $user->name;
				$success = $this->_send_email($data, $toall);
			}
		}

		if($success === FALSE) $success = "Send Email Failed";
		$send_email_alert = $success === TRUE ? "<div id='alert-notification' data-message='Send Email Success' data-status='success' class='hidden'></div>" : "<div id='alert-notification' data-message='$success' data-status='failed' class='hidden'></div>";;
		$this->session->set_flashdata('alert-admin', $send_email_alert);
		redirect(base_url()."index.php/admin/".($toall ? 'broadcast' : 'sendemail'));
	}

	/*
		digunakan untuk mengirim email
	*/
	private function _send_email($profile, $toall = FALSE)
	{
		extract($profile);
		if(strlen(trim($subject)) == 0) return "subject cannot be empty";
		if(strlen(trim($message)) == 0) return "message cannot be empty";
		return $this->_send_smtp_email([
			"receiver" => @$email,
			"receiver_name" => @$name,
			"subject" => $subject,
			"message" => $message,
			], $toall);
	}

	
	/* KALO MAU KIRIM KE SEMUA USER, PANGGIL FUNGSI INI DENGAN PARAMETER KEDUA TRUE */
	function _send_smtp_email($data, $toall = FALSE)
	{
		// $data: sender, sender_name, receiver, receiver_name, subject, message
		extract($data);
		if($toall) {
			$all = (new User_model())->get();
			$alluser = [];
			foreach ($all as $one) $alluser[$one->email] = $one->name;
		} else $alluser = [$receiver => $receiver_name];
		return "Message sent!" == file_get_contents("http://alfan.coderhutan.com/mailer/sendgmail.php?".http_build_query([
			"to" => $alluser,
			"subject" => $subject,
			"message" => $message,
			]));
	}

	/*
		digunakan untuk menampilkan halaman yang tidak ditemukan
	*/
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

	/*
		digunakan untuk mengupdate harga bahan secara otomatis dari infopangan.co.id
	*/
	public function updatePrice() {
  	$now = (new DateTime());
    $m = (int)$now->format("m");
    $y = $now->format("Y");

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
    }

    foreach ($all_data as $name => $price) {
    	$units = "kg";
    	$quantity = 1;

    	if($name == "Garam Dapur") {
    		$units = "gram";
    		$quantity = 200;
    	}
    	if($name == "Kelapa Kupas") $units = "butir";
    	if($name == "Susu Bubuk Bendera 400gr") {
    		$name = "Susu Bubuk Bendera";
    		$units = "gram";
    		$quantity = 400;
    	}
    	if($name == "Susu Bubuk Dancow 400gr") {
    		$name = "Susu Bubuk Dancow";
    		$units = "gram";
    		$quantity = 400;
    	}
    	if($name == "Susu Kental Bendera 200gr") {
    		$name = "Susu Kental Bendera";
    		$units = "gram";
    		$quantity = 200;
    	}
    	if($name == "Susu Kental Enak 200gr")  {
    		$name = "Susu Kental Enak";
    		$units = "gram";
    		$quantity = 200;
    	}
    	if($name == "Gas Elpiji 3kg") continue;
    	if($name == "Margarin Blueband Cup") $units = "kemasan";
    	if($name == "Margarin Blueband Sachet") $units = "kemasan";

    	if(preg_match("/beras.*/", strtolower($name))) $name = "beras";

      	(new Catalog())->addCatalog(strtolower($name), $quantity, $units, $price);
    }
    redirect(base_url('index.php/admin/catalog'));
  }

  /*
		digunakan untuk mengbanned user
	*/
 	public function bannedUser(){
	  	$user = new User_model();
	  	$ban = $this->input->post("id_reported");
	  	$issuccess = true;
	  	foreach ($ban as $userid) {
	  		if(!$user->where('id', $userid)->update('status', "BANNED")){
	  			echo "gagal";
	  		}
	  		$user->clear();
	  	}
	  	if(sizeof($ban) == 0 || (sizeof($ban)==1 && empty($ban[0]))){
	  		$issuccess = false;
	  	}
	  	if($issuccess){
	  		$alert = "<div id='alert-notification' data-message='Banned User Success' data-status='success' class='hidden'></div>";
	  	}
	  	if(!$issuccess){
	  		$alert = "<div id='alert-notification' data-message='Banned User Failed' data-status='failed' class='hidden'></div>";
	  	}
		$this->session->set_flashdata('alert-admin', $alert);
		redirect(base_url()."index.php/admin/report");
  	}

 	 /*
		digunakan untuk menampilkan halaman broadcast
	*/
 	public function broadcast(){
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
		$content_admin = $this->parser->parse('broadcast_view', array(), TRUE);
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
	
}