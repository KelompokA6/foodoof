<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	public function index(){
		$this->highlight();
	}
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
		$listRepo = $user -> getListReportUser();
		foreach ($listRepo as $objRepo) {
			$recipe = new Report();
			$list = $recipe -> getListReportByUserId($objRepo->id);
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

	public function updateCatalogAjax(){
		$id = $this->input->post("pk");
		$attr = $this->input->post("name");
		$value = $this->input->post("value");
		$catalog = new Catalog();
		$catalog->where("id", $id);
		if($catalog->update($attr, $value)){
			$data = array(
				"status"	=>	"success",
				"message"	=>	"Successfully Edit ".$attr." Catalog With ID ".$id,
			);	
		}
		else{
			$data = array(
				"status"	=>	"failed",
				"message"	=>	"Failed Edit ".$attr." Catalog With ID ".$id,
			);	
		}
		echo json_encode($data);
	}

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
		
		$name = $this->input->post("entry_subject");
		$quantity = $this->input->post("entry_quantity");
		$units = $this->input->post("entry_unit");
		$price = $this->input->post("entry_price");
		
		if(!$cat->addCatalog($name, $quantity, $units, $price)){
			$success = FALSE;
		}
		
		$highlight_alert = $success ? "<div class=\"alert alert-success text-center\">catalog updated</div>" : "<div class=\"alert alert-danger\">update catalog failed</div>";
		$this->session->set_flashdata('alert-admin', $highlight_alert);
		redirect(base_url()."index.php/admin/catalog");
	}

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
			if(!$this->_send_email($data, $toall)){
				$success = false;
			}
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
				if(!$this->_send_email($data, $toall)){
					$success = false;
				}
			}
		}

		$send_email_alert = $success ? "<div id='alert-notification' data-message='Send Email Success' data-status='success' class='hidden'></div>" : "<div id='alert-notification' data-message='Send Email Failed' data-status='failed' class='hidden'></div>";;
		$this->session->set_flashdata('alert-admin', $send_email_alert);
		redirect(base_url()."index.php/admin/sendemail");
	}

	private function _send_email($profile, $toall = FALSE)
	{
		extract($profile);
		return $this->_send_smtp_email([
			"sender" => "foodoofa6@gmail.com",
			"sender_name" => "FoodooF Administrator",
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
		require_once('application/libraries/mailer/PHPMailerAutoload.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();                       // telling the class to use SMTP
		$mail->SMTPDebug = 0;                  // 0 = no output, 1 = errors and messages, 2 = messages only.
		$mail->SMTPAuth = true;                // enable SMTP authentication 
		$mail->SMTPSecure = "tls";             // sets the prefix to the servier
		$mail->Host = "smtp.gmail.com";        // sets Gmail as the SMTP server
		$mail->Port = 587;                     // set the SMTP port for the GMAIL 

		$mail->Username = "foodoofa6";         // Gmail username
		$mail->Password = "badakfoodoof";      // Gmail password

		// $mail->CharSet = 'windows-1250';
		$mail->SetFrom (@$sender, @$sender_name);
		$mail->Subject = @$subject;
		$mail->ContentType = 'text/html';
		$mail->IsHTML(TRUE);
		$mail->Body = @$message; 
		// you may also use $mail->Body = file_get_contents('your_mail_template.html');

		if($toall) {
			foreach ((new User_model())->get() as $user) {
				$mail->clearAddresses();
				$mail->AddAddress ($user->email, $user->name);
				$mail->Send();
			}
			return TRUE;
		}
		$mail->AddAddress ($receiver, @$receiver_name);
		// you may also use this format $mail->AddAddress ($recipient);
		return $mail->Send();
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

	public function updateharga() {
  	/*$now = (new DateTime());
    $m = (int)$now->format("m");
    $y = $now->format("Y");

    $all_data = [];
    foreach (range(1,13) as $i) {
      $sumber = "http://infopangan.jakarta.go.id/api/price/series_by_location?type=market&lid=$i&m=$m&y=$y";
      die(file_get_contents($sumber));
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
    }*/

    # AMPAS!
    include('webParser.php');
		$wp = new webParser();
		$wp->set_url('http://pasarjaya.co.id/komoditas');
    // die(file_get_contents("http://pasarjaya.co.id/komoditas"));
		$json = $wp->element_to_json('#detil');
		die($json);

    foreach ($all_data as $name => $price) {
    	$units = "Kg";
    	if($name == "Garam Dapur") { $units = "gram"; $price *= 5; }
    	if($name == "Kelapa Kupas") $units = "butir";
    	if($name == "Susu Bubuk Bendera 400gr") $units = "kardus";
    	if($name == "Susu Bubuk Dancow 400gr") $units = "kardus";
    	if($name == "Susu Kental Bendera 200gr") $units = "kaleng";
    	if($name == "Susu Kental Enak 200gr") $units = "kaleng";
    	if($name == "Margarin Blueband Cup") $units = "kemasan";
    	if($name == "Margarin Blueband Sachet") $units = "kemasan";
      (new Catalog())->addCatalog($name, 1, $units, $price);
    }
    redirect(base_url('index.php/admin/catalog'));
  }

  public function banneduser(){
  	$user = new User_model();
  	$ban = $this->input->post("id_reported");
  	foreach ($ban as $userid) {
  		if(!$user->where('id', $userid)->update('status', "BANNED")){
  			echo "gagal";
  		}
  		$user->clear();
  	}
  	$alert = "<div id='alert-notification' data-message='Banned User Success' data-status='success' class='hidden'></div>";
	$this->session->set_flashdata('alert-admin', $alert);
	redirect(base_url()."index.php/admin/report");
  }

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