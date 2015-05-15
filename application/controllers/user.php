<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('user_viewer');
	}

	public function index(){
		$this->timeline();
	}

	public function profile($id = -1){
		if ($id == -1) {
			$id = $this->user_model->wajiblogin();
		}
		$profile = $this->user_model->getProfile($id);
		$this->user_viewer->showProfile($profile);
	}

	public function timeline($id = -1){
		if ($id == -1) {
			$id = $this->user_model->wajiblogin();
		}
		$profile = $this->user_model->getProfile($id);
		$r = new Recipe_model();
		$page = $this->input->get('page');
		if($page === FALSE) $page = 1;
		$limit = 5;
		$flag = $id == $this->session->userdata('user_id') ? 'all' : '';
		$listRecipe = $r->getUserRecipe($id, $flag, $limit, $limit * $page - $limit);
		/*if ($id != $this->session->userdata('user_id')) {
			$listRecipe = array_filter($listRecipe, function($row){return $row->status == 1;});
		}*/
		$totalpage = ceil(sizeof( $r->getUserRecipe($id, $flag, 1000111) )/$limit);
		$this->user_viewer->showUserTimeline($profile, $listRecipe, $page, $totalpage);
	}

	public function favorite($id = -1){
		if ($id == -1) {
			$id = $this->user_model->wajiblogin();
		}
		$profile = $this->user_model->getProfile($id);
		$page = $this->input->get('page');
		if($page === FALSE) $page = 1;
		$limit = 5;
		$rcp = new Recipe_model();
		$r = new Favorite();
		$listrecipeid = $r->getFavoriteRecipeByUser($id, $limit, $limit * $page - $limit);
		$listRecipe = array();
		print_r($listrecipeid);
		foreach ($listrecipeid as $obj) {
			$x = $rcp->getRecipeProfile($obj, $id);
			if($x){
				array_push($listRecipe,$x);
			}
		}
		$totalpage = ceil(sizeof( $r->getFavoriteRecipeByUser($id, 1000111) )/$limit);
		$this->user_viewer->showFavorite($profile, $listRecipe, $page, $totalpage);
	}

	public function cooklater(){
		$id = $this->user_model->wajiblogin();
		$profile = $this->user_model->getProfile($id);
		$r = new Recipe_model();
		$listRecipe = $r->getCooklaterRecipe($id);
		$this->user_viewer->showUserTimeline($profile, $listRecipe);
	}

	public function changepassword(){
		$data['id'] = $this->user_model->wajiblogin();
		$data['change_password_alert'] = '';
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data['oldPass'] = $this->input->post("old_password");
			$data['newPass'] = $this->input->post("new_password");
			$data['confirmPass'] = $this->input->post("confirm_new_password");

			if($this->_is_valid_changepassword($data)){
				$success = $this->user_model->updatePassword($data['id'], $data['newPass']);
				$data['change_password_alert'] = $success ? "<div class=\"alert alert-success\">password has been changed successfully</div>" : "<div class=\"alert alert-danger\">change password failed</div>";
			}
			else{
				$data['change_password_alert'] = "<div class=\"alert alert-danger\">old password or confirm password doesn't match</div>";
			}
		}

		$profile = $this->user_model->getProfile($data['id']);

		$this->user_viewer->showChangePassword($profile, $data);
	}

	private function _is_valid_changepassword($data)
	{
		$u = new User_model();
		if($u->where('id', $data['id'])->count() > 0)
		{
			$u->where('id', $data['id'])->get();
			$email = $u->email;
			if($u->login($email, $data['oldPass']) !== FALSE)
			{
				return $data['newPass'] == $data['confirmPass'] && strlen($data['newPass']) >= 5;
			}
		}
		return FALSE;
	}

	public function join(){
		$data['join_alert'] = '';
		$data['name'] = '';
		$data['email'] = '';
		$data['gender'] = '';
		$data['checked_male'] = '';
		$data['checked_female'] = '';

		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['name'] = $this->input->post("name");
			$data['email'] = $this->input->post("email");
			$data['gender'] = $this->input->post("genderOptions");
			$data['photo'] = $data['gender'] == 'M' ? 'assets/img/user-male.png' : 'assets/img/user-female.png';
			$data['password'] = $this->input->post("password"); 
			$data['confirm_password'] = $this->input->post("confirm_password");

			if ($this->_validate_join($data) === TRUE) {
				if($this->_send_email($data)) {
					if($this->user_model->createUser($data)) {
						$profile_menubar = $this->user_model->login($data['email'], $data['password']);
						foreach ($profile_menubar as $key => $value) {
							$this->session->set_userdata($key, $value);
						}
						$alert = "<div id='alert-notification' data-status='success' data-message='Welcome to Foodoof' class='hidden'></div>";
						$this->session->set_flashdata('alert-notification', $alert);
						redirect(base_url().'index.php/user');
						die;
					} else {
						$data['join_alert'] = '<div class="alert alert-warning">Join Failed!</div>';
					}
				} else {
					$data['join_alert'] = '<div class="alert alert-warning">Sending Email Failed!</div>';
				}
			} else {
				$data['join_alert'] = '<div class="alert alert-danger">'.$this->_validate_join($data).'</div>';
			}
		}
		$data['checked_male'] = $data['gender'] == 'M' ? 'checked="checked"' : '';
		$data['checked_female'] = $data['gender'] == 'F' ? 'checked="checked"' : '';
		$this->user_viewer->showRegister($data);
	}

	public function edit(){
		$data['id'] = $this->user_model->wajiblogin();

		$data['edit_profile_alert'] = '';
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if (file_exists('images/tmp/user/'.$data['id'].'.jpg')) {
				rename('images/tmp/user/'.$data['id'].'.jpg', 'images/user/'.$data['id'].'.jpg');
				$data['photo'] = 'images/user/'.$data['id'].'.jpg';
			}
			$data['name'] = $this->input->post('user_name');
			$data['phone'] = $this->input->post('user_phone');
			$data['bdate'] = $this->input->post('user_bdate');
			$data['twitter'] = $this->input->post('user_twitter');
			$data['facebook'] = $this->input->post('user_facebook');
			$data['googleplus'] = $this->input->post('user_gplus');
			$data['path'] = $this->input->post('user_path');
			$message = $this->_validate_edit_profile($data);
			if ($message === TRUE) { // jika data editan benar
				unset($data['edit_profile_alert']);
				if($this->user_model->updateProfile($data['id'], $data)) {
					$data['edit_profile_alert'] = "<div class=\"alert alert-success\">profile has been updated successfully</div>";
					$this->session->set_userdata('user_name', $data['name']);
					if(file_exists('images/user/'.$data['id'].'.jpg')) {
						$this->session->set_userdata('user_photo', 'images/user/'.$data['id'].'.jpg');
					}
					$alert = "<div id='alert-notification' data-status='success' data-message='Success edit profile' class='hidden'></div>";
					$this->session->set_flashdata('alert-notification', $alert);
					 redirect(base_url()."index.php/user/edit/".$data['id']);
				}
				else
					$data['edit_profile_alert'] = "<div class=\"alert alert-warning\">update profile failed</div>";
			} else $data['edit_profile_alert'] = "<div class=\"alert alert-danger\">$message</div>";
		}
		$profile = $this->user_model->getProfile($data['id']);
		foreach ($data as $key => $value) $profile->$key = $value;
		$this->user_viewer->showEditProfile($profile);
	}

	private function _validate_edit_profile($profile)
	{
		// trim all
		$profile = array_map("trim", $profile);
		// cek bdate
		if ( !preg_match("/^[a-zA-Z '-]{1,51}$/", $profile['name']) ) return 'invalid name';
		if( (new DateTime($profile['bdate'])) > (new DateTime) ) return 'invalid birth date';
		# 083...10-12 length
		if( strlen($profile['phone']) > 0 && !preg_match('/^08\\d{8,10}$/', $profile['phone']) ) return 'invalid phone number';
		return TRUE;
	}

	public function forgotpassword(){ //dari sequence lupa password, buat minta password nya dr userManager
		$data['forget_password_alert'] = '';
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$email = $this->input->post('email_user');
			$data['email'] = $email;
			$password = $this->user_model->getPasswordByEmail($email);
			if($password !== FALSE) {
				$sendreport = $this->_sendPassword($email, $this->user_model->getNameByEmail($email), $password);
				if ($sendreport == TRUE) {
					$data['forget_password_alert'] = "<div class=\"alert alert-success\">your password has been sent to ".htmlspecialchars($email).".</div>";
				}else $data['forget_password_alert'] = '<div class="alert alert-warning">sending email failed</div>';
			} else $data['forget_password_alert'] = "<div class=\"alert alert-danger\">".htmlspecialchars($email)." not registered</div>";
		}
		$this->user_viewer->showForgotPassword($data);
	}

	private function _validate_join($profile){
		// email sudah kedaftar belum?
		$u = new User_model();
		if($u->where('email', $profile['email'])->count() > 0) return $profile['email']." has been registered";
		if(!filter_var($profile['email'], FILTER_VALIDATE_EMAIL)) return "invalid email";
		if($profile['password'] !== $profile['confirm_password']) return "password doesn't match";
		if(strlen($profile['password']) < 5) return "minimum password length is 5";
		return TRUE;
	}

	private function _send_email($profile)
	{
		extract($profile);
		return $this->_send_smtp_email([
			"sender" => "foodoofa6@gmail.com",
			"sender_name" => "FoodooF Administrator",
			"receiver" => $email,
			"receiver_name" => $name,
			"subject" => "Welcome to FoodooF",
			"message" => "Hello $name! Nice to glad you in Foodoof.\nYour account has been created. You can login in FoodooF page using this email and your password is $password.",
			]);
	}

	private function _sendPassword($email, $name, $password) {
		return $this->_send_smtp_email([
			"sender" => "foodoofa6@gmail.com",
			"sender_name" => "FoodooF Administrator",
			"receiver" => $email,
			"receiver_name" => $name,
			"subject" => "Your FoodooF Password",
			"message" => "You said that you have forgotten your password.\nHere you are! Your password is $password.",
			]);
	}

	function _send_smtp_email($data)
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
		$mail->SetFrom ($sender, @$sender_name);
		$mail->Subject = @$subject;
		$mail->ContentType = 'text/html';
		$mail->IsHTML(TRUE);
		$mail->Body = @$message; 
		// you may also use $mail->Body = file_get_contents('your_mail_template.html');
		$mail->AddAddress ($receiver, @$receiver_name);
		// you may also use this format $mail->AddAddress ($recipient);
		return $mail->Send();
	}

	public function setonline($id)
	{
		$u = new User_model();
		date_default_timezone_set("Asia/Jakarta");
		echo $u->where('id', $id)->update('last_access', date("Y-m-d H:i:s"));
	}

	public function getonline($user_id = FALSE)
	{
	    $u = new User_model();
	    date_default_timezone_set("Asia/Jakarta");
	    $one_minute_ago = (new DateTime())->modify("-20 second")->format("Y-m-d H:i:s");
	    $res = $u->where('last_access >', $one_minute_ago)->get();
	    $online_users = [];
	    foreach ($res as $obj)
	      if($obj->id != $user_id)
	        $online_users[] = (object)["id" => $obj->id, "name" => $obj->name, "photo" => $obj->photo];
	    echo json_encode($online_users);
	}

	public function message($conversation_id=-1)
	{
		$id = $this->user_model->wajiblogin();
		if($id)
		{
			$u = new User_model();
			$this->load->model('home_viewer');
			$listConversation = $u->getAllConversationUser($id);
			$conversations = new Conversation();
			$dataConversation = array();
			foreach ($listConversation as $conversation_item) {
				if($conversation_id<0){
					redirect(base_url()."index.php/user/message/$conversation_item->id");
				}
			}
			$data = array("sidebar_conversation_entries" => $dataConversation);
			$content_sidebar_conversation = $this->parser->parse("sidebar_conversation", $data, true);
			$listMessages = $conversations->getAllMessages($conversation_id, $id, true);
			$u = new User_model();
			$datamessage = array();
			for ($i=sizeof($listMessages)-1; $i >=0 ; $i--) { 
				$dataTmp=array(
					"conversation_message_user_photo"=> $u->getProfile($listMessages[$i]->sender_id)->photo,
					"conversation_message_user_id" =>$listMessages[$i]->sender_id,
					"conversation_message_user_name" => $u->getProfile($listMessages[$i]->sender_id)->name,
					"conversation_message_submit" => strtotime($listMessages[$i]->submit),
					"conversation_message_description" => nl2br($listMessages[$i]->description),
					);
				array_push($datamessage, $dataTmp);
			}
			$con = new Conversation();
			$listMember = $con->getMembers($conversation_id, $id);
			$dataMember = array();
			foreach ($listMember as $obj) {
				$dataTmp = array(
					"conversation_member_name" => $u->getProfile($obj)->name,
					"conversation_member_photo" => $u->getProfile($obj)->photo,
					"conversation_member_id" => $u->getProfile($obj)->id,
					);
				array_push($dataMember, $dataTmp);
			}
			$subject = $con->subject;
			if(empty($subject)){
				$subject .="You";
				$i = 0;
				while($i<2 && $i<(sizeof($listMember))) {
					$subject .=", ".$u->getProfile($listMember[$i])->name;
					$i++;
				}
				if(sizeof($listMember)>2){
					$subject .= " and ";
				}
			}
			$data = array(
				"conversation_member_entries" => $dataMember,
				"conversation_subject" => $subject,
				"conversation_message_entries"=>$datamessage,
				"conversation_id" => $conversation_id,
				);

			$content_conversation = $this->parser->parse("conversation_view", $data, true);
			$dataConversation = array();
			foreach ($listConversation as $conversation_item) {
				$tmp = array(
					"sidebar_conversation_id" => $conversation_item->id,
					"sidebar_conversation_unread" => $conversations->getCountUnreadMessage($conversation_item->id,"3"),
					"sidebar_conversation_sender_photo" => $u->getProfile($conversation_item->sender_id)->photo,
					"sidebar_conversation_subject" => $conversation_item->subject,
					"sidebar_conversation_submit" => $conversation_item->time_last_message,
					"sidebar_conversation_last_message" => $conversation_item->last_message,
				);
				array_push($dataConversation, $tmp);
			}
			$data = array("sidebar_conversation_entries" => $dataConversation);
			$content_sidebar_conversation = $this->parser->parse("sidebar_conversation", $data, true);
			$data = array(
					"content_conversation" => $content_conversation,
					"content_sidebar_conversation" => $content_sidebar_conversation
				);
			$content_website = $this->parser->parse('template_conversation', $data, TRUE);
			$menubar = $this->home_viewer->getMenubar();
			$data = array(
						"menubar" => $menubar,
						"content_website" => $content_website,
					);
			$this->parser->parse('template_content', $data);
		}else redirect(base_url('index.php/home/login'));
	}
	
	public function createconversation()
	{
		$id = $this->user_model->wajiblogin();
		if($id)
		{
			$u = new User_model();
			$conversations = new Conversation();
			$content_conversation = $this->parser->parse("new_conversation_view", array(), true);
			$listConversation = $u->getAllConversationUser($id);
			$dataConversation = array();
			foreach ($listConversation as $conversation_item) {
				$tmp = array(
					"sidebar_conversation_id" => $conversation_item->id,
					"sidebar_conversation_unread" => $conversations->getCountUnreadMessage($conversation_item->id,"3"),
					"sidebar_conversation_sender_photo" => $u->getProfile($conversation_item->sender_id)->photo,
					"sidebar_conversation_subject" => $conversation_item->subject,
					"sidebar_conversation_submit" => $conversation_item->time_last_message,
					"sidebar_conversation_last_message" => $conversation_item->last_message,
				);
				array_push($dataConversation, $tmp);
			}
			$data = array("sidebar_conversation_entries" => $dataConversation);
			$content_sidebar_conversation = $this->parser->parse("sidebar_conversation", $data, true);
			$data = array(
					"content_conversation" => $content_conversation,
					"content_sidebar_conversation" => $content_sidebar_conversation
				);
			$content_website = $this->parser->parse('template_conversation', $data, TRUE);
			$menubar = $this->home_viewer->getMenubar();
			$data = array(
						"menubar" => $menubar,
						"content_website" => $content_website,
					);
			$this->parser->parse('template_content', $data);
		}else redirect(base_url('index.php/home/login'));
	}
	public function addconversation(){
		$users = explode(",", $this->input->post("users"));
		$subject = $this->input->post("subject");
		$message = $this->input->post("message");
		$user_id = $this->session->userdata("user_id");
		$u = new User_model();
		$conversations = new Conversation();
		$listConversation = $u->getAllConversationUser($user_id);
		$find_conversation = null;
		$success = true;
		foreach ($listConversation as $conversation) {
			$listMember = $conversations->getMembers($conversation->id, $user_id);
			$all_member_found = true;
			if(sizeof($users)==sizeof($listMember)){
				foreach ($users as $member) {
					if(!in_array($member, $listMember)){
						$all_member_found = false;
					}
				}
				if($all_member_found){
					$find_conversation = $conversation->id;
				}
			}
		}
		if(!empty($find_conversation)){
			$this->addmessage($find_conversation);
		}
		else{
			$conversation_id = $conversations->addConversation($subject, $user_id);
			foreach ($users as $user) {
				if(!$conversations->addConversation($subject, $user, $conversation_id)){
					$success = false;
				}
			}
			$messages = new Message();
			if($messages->addMessage($conversation_id, $message, $user_id)){
				$success = true;
			}
			else{
				$success = false;
			}
		}
		if($success){
			$alert = "<div id='alert-notification' data-message='Success Create New Conversation' data-status='success' class='hidden'></div>";	
		}
		else{
			$alert = "<div id='alert-notification' data-message='Failed Create New Conversation' data-status='failed' class='hidden'></div>";
		}
		$this->session->set_flashdata('alert-notification', $alert);
		redirect(base_url()."index.php/user/message");
	}
	public function addmessage($conversation_id){
		$message = $this->input->post("message");
		$messages = new Message();
		if($messages->addMessage($conversation_id, $message, $this->session->userdata("user_id"))){
			$alert = "<div id='alert-notification' data-message='Success Send Message' data-status='success' class='hidden'></div>";	
		}
		else{
			$alert = "<div id='alert-notification' data-message='Failed Send Message' data-status='failed' class='hidden'></div>";
		}
		$this->session->set_flashdata('alert-notification', $alert);
		redirect(base_url()."index.php/user/message");
	}
}
