<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index(){
		$this->load->library('parser');
		$data = array("recipe_author_id"=> 1);
		$menubar = $this->parser->parse('menubar', $data, TRUE);
		
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
				'highlight_recipe_name' => $obj->name,
				'highlight_status' => $obj->highlight,
				'highlight_checked' => $check,
			);
			array_push($entries, $temp);
		}

		$data1 = array(
			'highlighted_recipe_entries' => $entries,
			);
		$content_website = $this->parser->parse('admin_page', $data1, TRUE);	
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);
	}

	public function save(){
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
		redirect(base_url()."admin");
	}
}