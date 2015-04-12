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
			$temp = array(
				'highlight_recipe_id' => $obj->id,
				'highlight_recipe_name' => $obj->name,
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
		//$admin_id = $admin->wajiblogin();
		$recipe = new Recipe_model();
		//print_r($this->input->post("id_highlight"));die;

		$highlight = $this->input->post("id_highlight");
		if (!empty($highlight)){
			foreach($highlight as $selected){
				$recipe->highlightRecipe($selected, TRUE);
			}
		}

		//$highlighted = $recipe->getHighlight();
	}
}