<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tempview extends CI_Controller {
	
	public function recipe()
	{	
		$this->load->library('parser');
		$data = array();
		$menubar = $this->parser->parse('menubar_login', $data, TRUE);
		$content_website = $this->parser->parse('recipe_view', $data, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);

	}	
	public function search(){
		$recipe = new Recipe();
		print_r($recipe->searchRecipeByTitle('goreng nasi', 10, 1));
	}
	public function searchIngredient(){
		$recipe = new Recipe();
		print_r($recipe->searchRecipeByIngredients(array('bawang merah', 'cabai'), 0.3, 10, 1));
	}
	public function searchByTitle(){
		$this->load->library('parser');
		$data = array();
		$menubar = $this->parser->parse('menubar_login', $data, TRUE);
		$category_home = $this->parser->parse('category_home', $data, TRUE);
		$data = array(
					"search_by_title_recipe_result" => 2,
					"search_by_title_recipe_key" => "nasi goreng",
					"search_by_title_recipe_name" => "nasi goreng",
					"search_by_title_recipe_page_size" => 4,
					"search_by_title_recipe_page_now" => 2,
				);
		$content_search = $this->parser->parse('search_by_title_view', $data, TRUE);
		$data = array(
					"category_home" => $category_home,
					"content_search" => $content_search,
				);
		$content_website = $this->parser->parse('content_search', $data, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);
	}
}