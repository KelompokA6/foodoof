<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct(){
		$this->load->library('session');
		$this->load->helper('file');
		$config['image_library'] = 'gd2';
		$this->load->library('upload');
		$this->load->library('session');
	}

	public function uploadProfileuser($id){
		$config['upload_path'] = './assets/tmp/user';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['file_name'] = $id.".jpg";
		$this->upload->initialize($config);

		if($this->session->userdata('user_id')!=''){
			if(!$this->upload->do_upload($this->input->post('"ImageName"'))){
				$configImage['source_image'] = '/assets/tmp/user/'.$id.'.jpg';
				$configImage['create_thumb'] = FALSE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 200;
				$configImage['height']	= 200;
				$this->load->library('image_lib', $configImage);
				$this->image_lib->resize();
				if ( ! $this->image_lib->resize())
				{
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

	public function uploadProfileRecipe($id){
		$config['upload_path'] = './assets/tmp/recipe';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['file_name'] = $id.".jpg";
		$this->upload->initialize($config);

		if($this->session->userdata('user_id')!=''){
			if(!$this->upload->do_upload($this->input->post('"ImageName"'))){
				$configImage['source_image'] = '/assets/tmp/recipe/'.$id.'.jpg';
				$configImage['create_thumb'] = FALSE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 200;
				$configImage['height']	= 200;
				$this->load->library('image_lib', $configImage);
				$this->image_lib->resize();
				if ( ! $this->image_lib->resize())
				{
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
		$config['upload_path'] = './assets/tmp/step';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5120';
		$config['file_name'] = $id."-".$no_step.".jpg";
		$this->upload->initialize($config);

		if($this->session->userdata('user_id')!=''){
			if(!$this->upload->do_upload($this->input->post('"ImageName"'))){
				$configImage['source_image'] = '/assets/tmp/step/'.$id."-".$no_step.".jpg";
				$configImage['create_thumb'] = FALSE;
				$configImage['maintain_ratio'] = TRUE;
				$configImage['width']	= 200;
				$configImage['height']	= 200;
				$this->load->library('image_lib', $configImage);
				$this->image_lib->resize();
				if ( ! $this->image_lib->resize())
				{
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