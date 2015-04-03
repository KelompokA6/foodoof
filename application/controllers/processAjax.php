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
		$config['upload_path'] = './images/tmp/user/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $id.".jpg";
		$this->upload->initialize($config);

		if($this->session->userdata('user_id')!=''){
			if($this->upload->do_upload("photo-user")){
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
					echo $this->image_lib->display_errors();
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

	public function uploadProfileRecipe($id){
		$config['upload_path'] = './images/tmp/recipe';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $id.".jpg";
		$this->upload->initialize($config);

		if($this->session->userdata('user_id')!=''){
			if($this->upload->do_upload('photo-recipe')){
				$configImage['source_image'] = './images/tmp/recipe/'.$id.'.jpg';
				$configImage['create_thumb'] = TRUE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 360;
				$configImage['height']	= 360;
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
			$no_step = $this->input->post('no_step');
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
				$configImage['width']	= 200;
				$configImage['height']	= 200;
				$configImage['image_library'] = 'gd2';
				$this->load->library('image_lib', $configImage);
				if ($this->image_lib->resize())
				{
					unlink("./images/tmp/step/".$id."-".$no_step.".jpg");
				    rename ( "./images/tmp/step/".$id."-".$no_step."_thumb.jpg", "./images/tmp/step/".$id."-".$no_step.".jpg");
				    $p1 = "<img src='".base_url()."images/tmp/step/".$id."-".$no_step.".jpg' class='file-preview-image'>";
					$p2 = ['caption' => "recipe-".$id."-".$no_step , 'width' => '120px', 'url' => base_url()."images/tmp/step/".$id."-".$no_step.".jpg"];
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
	public function setRating($recipe_id=null, $value = 0){
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id) && !empty($recipe_id)){
			$recipe = new Recipe();
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
}