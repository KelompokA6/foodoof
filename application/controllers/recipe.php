<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipe extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('user_viewer');
	}

	public function edit($id){
		$this->load->library('parser');
		$recipe = new Recipe_model();
		$user = new User_model();
		$user_id = $user->wajiblogin();
		$auth = $recipe->authEditRecipe($id, $user_id);
		if ($auth){
			$r = $recipe->getRecipe($id, $user_id);
			$data = array();
			$this->load->model('home_viewer');
			$menubar = $this->home_viewer->getMenubar();
			$ingre = array();
			if (!empty($r->ingredients)){
				foreach ($r->ingredients as $obj) {
					$temp = array(
							'edit_recipe_ingredient_subject' => htmlspecialchars($obj->name),
							'edit_recipe_ingredient_quantity' => $obj->quantity,
							'edit_recipe_ingredient_unit' => htmlspecialchars($obj->units),
							'edit_recipe_ingredient_info' => htmlspecialchars($obj->info),
						);
					array_push($ingre, $temp);
				}
			}
			// print_r($ingre);
			// die()
			$steps = array();
			if (!empty($r->steps)){
				$i = 1;
				foreach ($r->steps as $obj) {
					$temp = array(
							'edit_recipe_step_title' => $id+"-"+$i++,
							'edit_recipe_step_no_step' => $obj->no_step,
							'edit_recipe_step_description' => htmlspecialchars($obj->description),
							'edit_recipe_step_photo' => $obj->photo.$this->session->flashdata('version'),
						);
					array_push($steps, $temp);
				}
			}
			$data = array(
						'edit_recipe_id' => $id,
						'edit_recipe_photo' => $r->photo.$this->session->flashdata('version'),
						'edit_recipe_title' => htmlspecialchars($r->name),
						'edit_recipe_portion' => $r->portion,
						'edit_recipe_description' => htmlspecialchars($r->description),
						'edit_recipe_duration' => $r->duration,
						'edit_recipe_ingredient_entries' => $ingre,
						'edit_recipe_step_entries' => $steps,
					);
			$categories = $recipe->getCategories($id);
			if(!empty($categories)){
				foreach ($categories as $obj) {
					$data['edit_recipe_'.str_replace(" ","_",$obj->name).'_checked'] = "checked";
					// $temp = array(
					// 	'{edit_recipe_'.$obj->name.'_checked}' => "checked",
					// );
					// array_push($listCategories, $temp);
				}
			}

			//$data = array_map("htmlspecialchars", $data);
			$content_website = $this->parser->parse('edit_recipe_view', $data, TRUE);
			$data = array(
						"menubar" => $menubar,
						"content_website" => $content_website,
					);
			//$data = array_map("htmlspecialchars", $data);
			$this->parser->parse('template_content', $data);
		} else {
			redirect(base_url()."index.php/recipe/get/$id");
		}
		
	}

	// ini pake post, lihat registration
	public function save($id){
		$recipe = new Recipe_model();
		$user = new User_model();
		$user_id = $user->wajiblogin();
		$name = htmlspecialchars($this->input->post("recipe_title"));
		$description = htmlspecialchars($this->input->post("recipe_description"));
		$portion = htmlspecialchars($this->input->post("recipe_portion"));
		$duration = htmlspecialchars($this->input->post("recipe_duration"));
		$category = $this->input->post("recipe_category");
		// print_r($category);
		// die();
		$subjek =  $this->input->post("ingredient_subject");
		// print_r($subjek);
		// die;
		$quantity =  $this->input->post("ingredient_quantity");
		$unit =  $this->input->post("ingredient_unit");
		$info =  $this->input->post("ingredient_info");
		// print_r($category);
		// for ($i=0; $i < sizeof($category) ; $i++) { 
		// 	$recipe->addCategory($id, $category[$i]);
		// }
		$ingredients = array();
		for ($i=0; $i < sizeof($subjek) ; $i++) { 
			$temp['name'] = htmlspecialchars($subjek[$i]);
			$temp['quantity'] = htmlspecialchars($quantity[$i]);
			$temp['units'] = htmlspecialchars($unit[$i]);
			$temp['info'] = htmlspecialchars($info[$i]);
			array_push($ingredients, $temp);
		}
		$stdes =  $this->input->post("step-description");
		$poto =  $this->input->post("photo-step");
		$steps = array();
		for ($i=0; $i < sizeof($stdes); $i++) { 
			$temp['description'] = htmlspecialchars($stdes[$i]);
			array_push($steps, $temp);
		}
		// print_r($steps);
		// die();
		date_default_timezone_set ('Asia/Jakarta');
		if (ctype_space($name)){
			$alert = "<div id='alert-notification' data-message='Failed Edit Recipe' data-status='failed' class='hidden'></div>";
			$this->session->set_flashdata('alert-notification', $alert);
			$isSuccess = $recipe->saveRecipe($id, $name, $portion, $duration, $description, strftime("%Y-%m-%d %H:%M:%S"), $ingredients, $steps);
			$recipe->where('id',$id)->update('tmp_status', '1');
			redirect(base_url()."index.php/recipe/edit/$id");
		}
		if (! preg_match("/^[a-zA-Z0-9$%@\\*()\& '-]{1,100}$/", trim($name))){
			$alert = "<div id='alert-notification' data-message='Failed Edit Recipe' data-status='failed' class='hidden'></div>";
			$this->session->set_flashdata('alert-notification', $alert);
			$isSuccess = $recipe->saveRecipe($id, $name, $portion, $duration, $description, strftime("%Y-%m-%d %H:%M:%S"), $ingredients, $steps);
			$recipe->where('id',$id)->update('tmp_status', '1');
			redirect(base_url()."index.php/recipe/edit/$id");
		}
		
		$isSuccess = $recipe->saveRecipe($id, $name, $portion, $duration, $description, strftime("%Y-%m-%d %H:%M:%S"), $ingredients, $steps);
		if($isSuccess === false){
			$alert = "<div id='alert-notification' data-message='Edit Recipe Failed' data-status='failed' class='hidden'></div>";
			$this->session->set_flashdata('alert-notification', $alert);
		} else{
			if (!empty($category)){
				$recipe->deleteAllCategory($id);
				foreach($category as $selected){
					$res = $recipe->addCategory($id, $selected);
				}
			}
			else{
				$recipe->deleteAllCategory($id);
				$res = $recipe->addCategory($id, "other");
			}
			$this->load->helper('string');
			$this->session->set_flashdata('version', "?version=".random_string('numeric', 8));
			$alert = "<div id='alert-notification' data-status='success' data-message='Successfully Edit Recipe' class='hidden'></div>";
			$this->session->set_flashdata('alert-notification', $alert);
		}
		redirect(base_url()."index.php/recipe/edit/$id");
	}

	public function create(){
		$recipe = new Recipe_model();
		$id = $recipe->createRecipe_model(); 
		if ($id != 0) {
			redirect(base_url()."index.php/recipe/edit/".$id);
		} else {

		}
	}

	public function get($id, $print=FALSE){
		$recipe = new Recipe_model();
		$recipe->incrementViews($id);
		$user = new User_model();
		$user_id = $this->session->userdata('user_id');
		$r = $recipe->getRecipe($id, $user_id);
		if($r){
			$data = array();
			$this->load->library('parser');
			// $menubar = $this->parser->parse('menubar_login', $data, TRUE);
			$this->load->model('home_viewer');
			$menubar = $this->home_viewer->getMenubar();
			$ingre = array();
			if (!empty($r->ingredients)){
				foreach ($r->ingredients as $obj) {
					$quantity = ($obj->quantity > 0.00) ? $obj->quantity : "";
					if(!empty($quantity)){
						if($quantity-(round($quantity,2)) >= 0.00){
							$quantity=(round($quantity,2));
							if(abs((round($quantity,1)-$quantity)) == 0.0){
								$quantity = round($obj->quantity,1);
								if($quantity == round($obj->quantity,0)){
									$quantity = round($obj->quantity,0);
								}
							}
						}	
					}
					$temp = array(
							'ingre_name' => $obj->name,
							'ingre_quantity' => $quantity,
							'ingre_units' => $obj->units,
							'ingre_info' => $obj->info,
						);
					array_push($ingre, $temp);
				}
			}
			$steps = array();
			if (!empty($r->steps)){
				foreach ($r->steps as $obj) {
					$temp = array(
							'steps_number' => $obj->no_step,
							'steps_description' => htmlspecialchars($obj->description),
							'steps_photo' => $obj->photo.$this->session->flashdata('version'),
						);
					array_push($steps, $temp);
				}
			}
			$category = array();
			if (!empty($r->category)){
				foreach ($r->category as $obj) {
					$temp = array(
						'recipe_category' => htmlspecialchars($obj->name),
					);
					array_push($category, $temp);
				}
			}
			$related = array();
			if (!empty($recipe->getRelatedRecipe($id))){
				foreach ($recipe->getRelatedRecipe($id) as $obj) {
					$temp = array(
							'related_recipe_name' => $obj->name,
							'related_recipe_photo' => $obj->photo.$this->session->flashdata('version'),
							'related_recipe_id' => $obj->id,
						);
					array_push($related, $temp);
				}
			}
			$comments = array();
			if (!empty($r->comments)){
				foreach ($r->comments as $obj) {
					$temp = array(
							'comment_user_id' => $obj->user_id,
							'comment_description' => nl2br($obj->description),
							'comment_submit' => strtotime($obj->submit),
							'comment_user_name' => $user->getProfile($obj->user_id)->name,
							'comment_user_photo' => $user->getProfile($obj->user_id)->photo.$this->session->flashdata('version'),
						);
					array_push($comments, $temp);
				}
			}
			if($this->session->userdata("user_id")!=""){
				$user_photo = $user->getProfile($this->session->userdata('user_id'))->photo.$this->session->flashdata('version');	
			}
			else{
				$user_photo = "";	
			}
			$data = array(
						'recipe_name' => htmlspecialchars($r->name),
						'recipe_description' => htmlspecialchars($r->description),
						'recipe_portion' => $r->portion,
						'recipe_duration' => $r->duration,
						'recipe_author_name' => htmlspecialchars($user->getProfile($r->author)->name),
						'recipe_last_update' => $r->last_update,
						'recipe_author' => $r->author,
						'recipe_id' => $id,
						'recipe_ingredients' => $ingre,
						'recipe_steps' => $steps,
						'recipe_rating' => $r->rating,
						'recipe_photo' => $r->photo.$this->session->flashdata('version'),
						'recipe_category_entries' => $category,
						'recipe_author_id' => ($r->author),
						'related_recipe_entries' => $related,
						'user_photo' => $user_photo.$this->session->flashdata('version'),
						'comments_recipe_entries' => $comments,
					);

			//$data = array_map("htmlspecialchars", $data);
			$data['URL'] = rawurlencode(current_url());
			$content_website = $this->parser->parse('recipe_view', $data, TRUE);
			
			// $data = array_map("htmlspecialchars", $data);
			if ($print){
				return $this->parser->parse('print_views', $data, TRUE);
			} else {
				$data = array(
						"menubar" => $menubar,
						"content_website" => $content_website,
					);
				$this->parser->parse('template_content', $data);
			}
			
		} else {
			$this->pageNotFound();
		}	
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
		// $data = array_map("htmlspecialchars", $data);
		$this->parser->parse('template_content', $data);
	}

	public function category($name){
		$name=urldecode($name);
		$user = new User_model();
		$page= empty($this->input->get("page")) ? 1 : $this->input->get("page");
		$this->load->library('parser');
		$this->load->model('home_viewer');
		$menubar = $this->home_viewer->getMenubar();
		$recipe = new Recipe_model();
		$arr = $recipe->getCategoryRecipe($name, 10, ($page-1)*10);
		$total = $arr['total'];
		array_pop($arr);
		$entries = array();
		foreach ($arr as $obj) {
			$temp = array(
				'category_recipe_id' => $obj->id,
				'category_recipe_author_name' => htmlspecialchars($user->getProfile($obj->author)->name),
				'category_recipe_author_id' => ($obj->author),
				'category_recipe_photo' => $obj->photo,
				'category_recipe_name' => htmlspecialchars($obj->name),
				'category_recipe_last_update' => $obj->last_update,
				'category_recipe_rating' => $obj->rating,
			);
			array_push($entries, $temp);
		}
		$entries = array_map(function($row){return $row = array_map("htmlspecialchars", $row);}, $entries);

		$data = array(
			'category_name' =>$name,
			'category_recipe_entries' => $entries,
			'category_recipe_name' => $name,
			'category_recipe_page_now' => $page,
			'category_recipe_page_size' =>  ceil($total/10),
		);
		// $data = array_map("htmlspecialchars", $data);
		$content_page = $this->parser->parse('category_view', $data, TRUE);
		$r = new Recipe_model();
	    $countCat = $r->getCountEachCategory();
	    foreach ($countCat as $row) {
	      $str = "category_".str_replace(" ", "_", $row->name)."_count";
	      $dataCat[$str] = $row->count;
	    }	
		$category_home = $this->parser->parse('category_home', $dataCat, TRUE);
		$data = array(
			'content_page' => $content_page,
			'category_home' => $category_home,
		);

		// $data = array_map("htmlspecialchars", $data);
		$content_website = $this->parser->parse('content_page', $data, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		// $data = array_map("htmlspecialchars", $data);
		$this->parser->parse('template_content', $data);

		// var_dump($total);
	}
	
	public function addComment($recipe_id){
		$comment = $this->input->post("comment");
		$r = new Recipe_model();
		if($r->addComment($this->session->userdata("user_id"), $recipe_id, $comment)){
			$alert = "<div id='alert-notification' data-status='success' data-message='Successfully Add Comment' class='hidden'></div>";
			$this->session->set_flashdata('alert-notification', $alert);
		}
		else{
			$alert = "<div id='alert-notification' data-status='failed' data-message='Failed Add Comment' class='hidden'></div>";
			$this->session->set_flashdata('alert-notification', $alert);
		}
		redirect(base_url()."index.php/recipe/get/$recipe_id");
	}

	public function print($id){
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = "./assets/recipe$id.pdf";
		$data['page_title'] = 'Hello world'; // pass data to the view
		 
		if (file_exists($pdfFilePath) == FALSE)
		{
		    ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
		    $html = $this->get($id, TRUE); // render the view into HTML
		    $this->load->library('pdf');
		    $pdf = $this->pdf->load();
		    $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
		    $pdf->WriteHTML($html); // write the HTML into the PDF
		    $pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."/assets/recipe$id.pdf");
	}
	
	public function uploadProfileRecipe($id=null){
		$config['upload_path'] = './images/tmp/recipe';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $id.".jpg";
		$this->upload->initialize($config);
		if(empty($id)){
			if(!empty($this->input->get("id"))){
				$id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$id = $this->input->post("id");
			}
		}
		if($this->session->userdata('user_id')!='' && !empty($id)){
			if($this->upload->do_upload('photo-recipe')){
				$configImage['source_image'] = './images/tmp/recipe/'.$id.'.jpg';
				$configImage['create_thumb'] = TRUE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 400;
				$configImage['height']	= 400;
				$configImage['image_library'] = 'gd2';
				$this->load->library('image_lib', $configImage);
				if ($this->image_lib->resize())
				{
					unlink('./images/tmp/recipe/'.$id.'.jpg');
					rename ( './images/tmp/recipe/'.$id.'_thumb.jpg', './images/tmp/recipe/'.$id.'.jpg');
					$p1 = "<img src='".base_url()."images/tmp/recipe/".$id.".jpg' class='file-preview-image'>";
					$p2 = ['caption' => "recipe-".$id , 'width' => '120px', 'url' => base_url()."images/tmp/recipe/".$id.".jpg"];
					$result = array(
							"status" => 1,
							"message" => "Upload success",
							'initialPreview' => $p1,
							'initialPreviewConfig' => $p2,
							'append' => false
					);
				}
				else{
					$result = array(
							"status" => 0,
							"message" => "Web server error",
					);
				}
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "Upload failed",
				);
			}
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "Please login first",
			);
		}
		echo json_encode($result);
	}
	
	public function uploadStepsRecipe($id, $no_step=null){
		if(empty($no_step)){
			if(!empty($this->input->get('no_step'))){
				$no_step = $this->input->get('no_step');
			}
			if(!empty($this->input->post('no_step'))){
				$no_step = $this->input->post('no_step');
			}
		}
		if(empty($id)){
			if(!empty($this->input->get("id"))){
				$id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$id = $this->input->post("id");
			}
		}
		$config['upload_path'] = './images/tmp/step';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $id."-".$no_step.".jpg";
		$this->upload->initialize($config);
	
		if($this->session->userdata('user_id')!=''){
			if($this->upload->do_upload("photo-step")){
				$configImage['source_image'] = "./images/tmp/step/".$id."-".$no_step.".jpg";
				$configImage['create_thumb'] = TRUE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 360;
				$configImage['height']	= 360;
				$configImage['image_library'] = 'gd2';
				$this->load->library('image_lib', $configImage);
				if ($this->image_lib->resize())
				{
					rename ( "./images/tmp/step/".$id."-".$no_step."_thumb.jpg", "./images/tmp/step/".$id."-".$no_step.".jpg");
					$p1 = "<img src='".base_url()."images/tmp/step/".$id."-".$no_step.".jpg' class='file-preview-image'>";
					$p2 = ['caption' => "recipe-".$id."-".$no_step , 'width' => '120px', 'url' => base_url()."images/tmp/step/".$id."-".$no_step.".jpg"];
					if(file_exists("./images/tmp/step/".$id."-".$no_step."-default.jpg")){
						unlink("./images/tmp/step/".$id."-".$no_step."-default.jpg");
					}
					$result = array(
							"status" => 1,
							"message" => "Upload success",
							'initialPreview' => $p1,
							'initialPreviewConfig' => $p2,
							'append' => false
					);
				}
				else{
					$result = array(
							"status" => 0,
							"message" => "Web server error",
					);
				}
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "Upload failed",
				);
			}
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "Please login first",
			);
		}
		echo json_encode($result);
	}
	
	public function addStepImage($recipe_id = null, $no_step=null){
		if(empty($no_step)){
			if(!empty($this->input->get('no_step'))){
				$no_step = $this->input->get('no_step');
			}
			if(!empty($this->input->post('no_step'))){
				$no_step = $this->input->post('no_step');
			}
		}
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		if(copy( "./assets/img/step-default.jpg", "./images/tmp/step/".$recipe_id."-".$no_step."-default.jpg")){
			$result = array(
					"status" => 1,
					"message" => "Add Success",
			);
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "Add Failed",
			);
		}
		echo json_encode($result);
	}
	
	public function removeStepImage($recipe_id = null, $no_step=null){
		if(empty($no_step)){
			if(!empty($this->input->get('no_step'))){
				$no_step = $this->input->get('no_step');
			}
			if(!empty($this->input->post('no_step'))){
				$no_step = $this->input->post('no_step');
			}
		}
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		if(file_exists("./images/tmp/step/".$recipe_id."-".$no_step."-default.jpg")){
			if(unlink("./images/tmp/step/".$recipe_id."-".$no_step."-default.jpg")){
				$result = array(
						"status" => 1,
						"message" => "Remove Success",
				);
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "Remove Failed",
				);
			}
		}
		else if(file_exists("./images/tmp/step/".$recipe_id."-".$no_step.".jpg")){
			if(unlink("./images/tmp/step/".$recipe_id."-".$no_step.".jpg")){
				$result = array(
						"status" => 1,
						"message" => "Remove Success",
				);
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "Remove Failed",
				);
			}
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "Remove Failed",
			);
		}
		echo json_encode($result);
	}
	
	public function setPublish($recipe_id=null){
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id) && !empty($recipe_id)){
			$recipe = new Recipe_model();
			$tmp = $recipe->get_by_id($recipe_id);
			if($recipe->publishRecipe($recipe_id, !($tmp->status))){
				if($tmp->status){
					$result = array(
							"status" => 1,
							"message" => "<div class='text-center'></div>",
					);
				}
				else{
					$result = array(
							"status" => 1,
							"message" => "<div class='text-center'>Success To Published Your Recipe.</div>",
					);
				}
			}
			else{
				if($tmp->status){
					$result = array(
							"status" => 0,
							"message" => "<div class='text-center'>Failed To Unpublished Your Recipe.</div>",
					);
				}
				else{
					$result = array(
							"status" => 0,
							"message" => "<div class='text-center'>Failed To Published Your Recipe.</div>",
					);
				}
			}
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "<div class='text-center'>Please Login First</div>",
			);
		}
		echo json_encode($result);
	}
	
	public function setFinished($recipe_id=null){
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id) && !empty($recipe_id)){
			$c = new Cooklater();
			if($c->setFinishedCookLater($user_id, $recipe_id, '1')){
				$result = array(
						"status" => 1,
						"message" => "<div class='text-center'>Your recipe has been moved to finished recipe.</div>",
				);
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "<div class='text-center'>Failed To Unpublished Your Recipe.</div>",
				);
			}
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "<div class='text-center'>Please Login First</div>",
			);
		}
		echo json_encode($result);
	}
	
	public function setRating($recipe_id=null, $value = 0){
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		if(!empty($this->input->get("value"))){
			$value = $this->input->get("value");
		}
		if(!empty($this->input->post("value"))){
			$value = $this->input->post("value");
		}
		$user_id = $this->session->userdata('user_id');
		if($value <= 0){
			$result = array(
					"status" => 0,
					"message" => "Please rate seriously.",
			);
		}
		else if(!empty($user_id) && !empty($recipe_id)){
			$recipe = new Recipe_model();
			if($recipe->saveRating($user_id, $recipe_id, $value)){
				$result = array(
						"status" => 1,
						"message" => "Rating Saved!",
				);
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "There are error in server",
				);
			}
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "Please login first",
			);
		}
		echo json_encode($result);
	}
	
	public function checkFavorite($recipe_id=null){
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		$user_id = $this->session->userdata('user_id');
		$result=array();
		if(!empty($user_id) && !empty($recipe_id)){
			$favorite = new Favorite();
			if($favorite->where('recipe_id', $recipe_id)->where("user_id", $user_id)->count()>0){
				$result = array(
						"statusFav" => 1,
				);
			}
			else{
				$result = array(
						"statusFav" => 0,
				);
			}
		}
		echo json_encode($result);
	}
	public function setFavorite($recipe_id=null){
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id) && !empty($recipe_id)){
			$recipe = new Recipe_model();
			$status = $recipe->addFavorite($user_id, $recipe_id);
			if($status){
				if(strtolower($status['action']) === "delete"){
					$result = array(
							"status" => 1,
							"message" => "Delete Recipe from Favorite Success",
					);
				}
				if(strtolower($status['action']) === "add"){
					$result = array(
							"status" => 1,
							"message" => "Successfully Added Recipe to Your Favorite",
					);
				}
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "There are error in server",
				);
			}
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "Please login first",
			);
		}
		echo json_encode($result);
	}
	
	public function setCookLater($recipe_id=null){
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id) && !empty($recipe_id)){
			$recipe = new Recipe_model();
			$status = $recipe->addCookLater($user_id, $recipe_id);
			if($status){
				if(strtolower($status['action']) === "delete"){
					$result = array(
							"status" => 1,
							"message" => "Delete Recipe from Cook Later Success",
					);
				}
				if(strtolower($status['action']) === "add"){
					$result = array(
							"status" => 1,
							"message" => "Recipe Added to Your Cook Later",
					);
				}
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "There are error in server",
				);
			}
		}
		else{
			$result = array(
					"status" => 0,
					"message" => "Please login first",
			);
		}
		echo json_encode($result);
	}
	public function checkCL($recipe_id=null){
		if(empty($recipe_id)){
			if(!empty($this->input->get("id"))){
				$recipe_id = $this->input->get("id");
			}
			if(!empty($this->input->post("id"))){
				$recipe_id = $this->input->post("id");
			}
		}
		$user_id = $this->session->userdata('user_id');
		$result=array();
		if(!empty($user_id) && !empty($recipe_id)){
			$CL = new Cooklater();
			if($CL->where('recipe_id', $recipe_id)->where("user_id", $user_id)->count()>0){
				$result = array(
						"statusCL" => 1,
				);
			}
			else{
				$result = array(
						"statusCL" => 0,
				);
			}
		}
		echo json_encode($result);
	}
	
	/*
	 memperoleh semua daftar bahan pada katalog
	 */
	public function getAllIngredient(){
		$ingre = new Catalog();
		$ingre->group_by('name');
		$ingre->get();
		$data = array();
		$x = 0;
		foreach ($ingre as $obj) {
			array_push($data, ucfirst($obj->name));
			$x++;
		}
		echo json_encode($data);
	}
	
	/*
	 memperoleh perkiraan harga dari sebuah resep
	 */
	public function generatePrice($recipe_id){
		$r = new Recipe_model();
		$price = $r->generatePrice($recipe_id);
		/*setlocale(LC_MONETARY, 'en_US');
			$x =  money_format('%i', $X);*/
		$pricestr = number_format($price,2,',',".");
		$data = array(
				"status"=>1,
				"price"=> $price,
				"pricestr"=> $pricestr,
		);
		echo json_encode($data);
	}
}