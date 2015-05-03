<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProcessAjax extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->helper('file');
	}

	public function uploadProfileUser($id){
		$config['upload_path'] = './images/tmp/user';
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
			if($this->upload->do_upload('photo-user')){
				$configImage['source_image'] = './images/tmp/user/'.$id.'.jpg';
				$configImage['create_thumb'] = TRUE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 360;
				$configImage['height']	= 360;
				$configImage['image_library'] = 'gd2';
				$this->load->library('image_lib', $configImage);
				if ($this->image_lib->resize())
				{
					unlink('./images/tmp/user/'.$id.'.jpg');
				    rename ( './images/tmp/user/'.$id.'_thumb.jpg', './images/tmp/user/'.$id.'.jpg');
				   	$p1 = "<img src='".base_url()."images/tmp/user/".$id.".jpg' class='file-preview-image'>";
					$p2 = ['caption' => "user-".$id , 'width' => '120px', 'url' => base_url()."images/tmp/user/".$id.".jpg"];
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
						"message" => "<div class='text-center'>Success To Unpublished Your Recipe.</div>",
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

	public function setHighlight($recipe_id=null){
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
			$recipe->get_by_id($recipe_id);
			$recipetmp = new Recipe_model();
			if($recipetmp->highlightRecipe($recipe_id, ($recipe->status != 1))){
				$result = array(
						"status" => 1,
						"message" => "Set Highlight Success",
						);
			}
			else{
				$result = array(
						"status" => 0,
						"message" => "Set Highlight Failed",
						);
			}
		}
		$result = array(
						"status" => 0,
						"message" => "Please Login First",
						);
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
		if(!empty($user_id) && !empty($recipe_id)){
			$recipe = new Recipe_model();
			if($recipe->saveRating($user_id, $recipe_id, $value)){
				$result = array(
					"status" => 1,
					"message" => "Your rating was save",
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
						"message" => "The Recipe Was Delete To Your Favorite",
					);
				}
				if(strtolower($status['action']) === "add"){
					$result = array(
						"status" => 1,
						"message" => "The Recipe Was Add To Your Favorite",
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
						"message" => "The Recipe Was Delete To Your Cook Later",
					);
				}
				if(strtolower($status['action']) === "add"){
					$result = array(
						"status" => 1,
						"message" => "The Recipe Was Add To Your Cook Later",
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
	public function getAllIngredient(){
		$ingre = new Ingredient();
		$ingre->group_by('name');
		$ingre->get();
		$data = array();
		$x = 0;
		foreach ($ingre as $obj) {
			array_push($data, $obj->name);
			$x++;
		}
		echo json_encode($data);
	}
	public function schedulercleantmp(){
		$now = date("Y-m-d H:i:s");
		$now = new DateTime($now);
		$filesuser = scandir("./images/tmp/user");
		$filesstep = scandir("./images/tmp/step");
		$filesrecipe = scandir("./images/tmp/recipe");
		for ($i=2; $i < sizeof($filesuser) ; $i++) { 
			if($filesuser[$i]!=="index.html"){
				$filetime = date("Y-m-d H:i:s", filemtime("./images/tmp/user/".$filesuser[$i]));
				$filetime = new DateTime($filetime);
				$diff = date_diff($filetime, $now);
				$diff = $diff->format("%a"); 
				if($diff>2){
					unlink("./images/tmp/user/".$filesuser[$i]);
				}
			}
		}
		for ($i=2; $i < sizeof($filesstep) ; $i++) { 
			if($filesuser[$i]!=="index.html"){
				$filetime = date("Y-m-d H:i:s", filemtime("./images/tmp/step/".$filesstep[$i]));
				$filetime = new DateTime($filetime);
				$diff = date_diff($filetime, $now);
				$diff = $diff->format("%a"); 
				if($diff>2){
					unlink("./images/tmp/step/".$filesstep[$i]);
				}
			}
		}
		for ($i=2; $i < sizeof($filesrecipe) ; $i++) { 
			if($filesrecipe[$i]!=="index.html"){
				$filetime = date("Y-m-d H:i:s", filemtime("./images/tmp/recipe/".$filesrecipe[$i]));
				$filetime = new DateTime($filetime);
				$diff = date_diff($filetime, $now);
				$diff = $diff->format("%a"); 
				if($diff>2){
					unlink("./images/tmp/recipe/".$filesuser[$i]);
				}
			}
		}
	}
}