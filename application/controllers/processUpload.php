<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProcessUpload extends CI_Controller {


	public function uploadProfileUser($id){
		$this->load->helper('file');
		$this->load->library('upload');
		$this->load->library('session');
		$config['upload_path'] = './assets/tmp/user/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $id.".jpg";
		$this->upload->initialize($config);

		if($this->session->userdata('user_id')==''){
			if($this->upload->do_upload("photo_user")){
				$configImage['source_image'] = './image/tmp/user/'.$id.'.jpg';
				$configImage['create_thumb'] = TRUE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 360;
				$configImage['height']	= 360;
				$configImage['image_library'] = 'gd2';
				$this->load->library('image_lib', $configImage);
				$this->image_lib->resize();
				if ($this->image_lib->resize())
				{
				    unlink('./image/tmp/user/'.$id.'.jpg');
				    rename ( './image/tmp/user/'.$id.'_thumb.jpg', './image/tmp/user/'.$id.'.jpg');
				    $result = array(
						"status" => 1,
						"message" => "Upload success",
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
		$this->load->helper('file');
		$this->load->library('upload');
		$this->load->library('session');
		$config['upload_path'] = './assets/tmp/recipe';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $id.".jpg";
		$this->upload->initialize($config);

		if($this->session->userdata('user_id')!=''){
			if($this->upload->do_upload($this->input->post('photo_recipe'))){
				$configImage['source_image'] = '/image/tmp/recipe/'.$id.'.jpg';
				$configImage['create_thumb'] = TRUE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 360;
				$configImage['height']	= 360;
				$configImage['image_library'] = 'gd2';
				$this->load->library('image_lib', $configImage);
				$this->image_lib->resize();
				if ($this->image_lib->resize())
				{
					unlink('./image/tmp/recipe/'.$id.'.jpg');
				    rename ( './image/tmp/recipe/'.$id.'_thumb.jpg', './image/tmp/recipe/'.$id.'.jpg');
				    $result = array(
						"status" => 1,
						"message" => "Upload success",
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

	public function uploadStepsRecipe($id, $no_step){
		$this->load->helper('file');
		$this->load->library('upload');
		$this->load->library('session');
		$config['upload_path'] = './assets/tmp/step';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['file_name'] = $id."-".$no_step.".jpg";
		$this->upload->initialize($config);

		if($this->session->userdata('user_id')!=''){
			if($this->upload->do_upload($this->input->post("photo_step"))){
				$configImage['source_image'] = "/image/tmp/step/".$id."-".$no_step.".jpg";
				$configImage['create_thumb'] = TRUE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 200;
				$configImage['height']	= 200;
				$configImage['image_library'] = 'gd2';
				$this->load->library('image_lib', $configImage);
				$this->image_lib->resize();
				if ($this->image_lib->resize())
				{
					unlink("./image/tmp/step/".$id."-".$no_step."jpg");
				    rename ( "./image/tmp/step/".$id."-".$no_step."_thumb.jpg", "./image/tmp/step/".$id."-".$no_step."jpg");
				    $result = array(
						"status" => 1,
						"message" => "Upload success",
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
}