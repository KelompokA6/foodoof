<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index(){
		$this->load->library('parser');
		$data = array("recipe_author_id"=> 1);
		$menubar = $this->parser->parse('menubar', $data, TRUE);
		
		$r = new Recipe_model();
		$list = $r->getAllRecipe();
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
		$highlight = $this->input->post("id_highlight");
		if (!empty($highlight)){
			foreach($highlight as $selected){
				$recipe->highlightRecipe($selected, TRUE);
			}
		}

		//$highlighted = $recipe->getHighlight();
	}
}