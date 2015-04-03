<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipe extends CI_Controller {

	public function publish($id, $isPublished){
		$recipe  = new Recipe();
		$recipe->get_by_id($id)->update('status', $isPublished);
	}

	public function edit($id){
		$this->load->library('parser');
		$recipe = new Recipe_model();
		$user = new User_model();
		$auth = $recipe->authEditRecipe($id);
		if ($auth){
			$r = $recipe->getRecipeProfile($id);
			$data = array();
			$this->load->model('home_viewer');
			$menubar = $this->home_viewer->getMenubar();
			$ingre = array();
			foreach ($r->ingredients as $obj) {
				$temp = array(
						'edit_recipe_ingredient_subject' => $obj->name,
						'edit_recipe_ingredient_quantity' => $obj->quantity,
						'edit_recipe_ingredient_unit' => $obj->units,
					);
				array_push($ingre, $temp);
			}
			//print_r($ingre);
			$steps = array();
			foreach ($r->steps as $obj) {
				$temp = array(
						'edit_recipe_step_no_step' => $obj->no_step,
						'edit_recipe_step_description' => $obj->description,
						'edit_recipe_step_photo' => $obj->photo,
					);
				array_push($steps, $temp);
			}
			$data = array(
						'edit_recipe_title' => $r->name,
						'edit_recipe_portion' => $r->portion,
						'edit_recipe_description' => $r->description,
						'edit_recipe_uration' => $r->duration,
						'edit_recipe_ingredient_entries' => $ingre,
						'edit_recipe_step_entries' => $steps,
					);
			$content_website = $this->parser->parse('edit_recipe_view', $data, TRUE);
			$data = array(
						"menubar" => $menubar,
						"content_website" => $content_website,
					);
			$this->parser->parse('template_content', $data);
		}
		
	}

	// ini pake post, lihat registration
	public function save($id){
		$recipe = new Recipe();
		$name = $this->input->post("title");
		$description = $this->input->post("description");
		$portion = $this->input->post("portion");
		$duration = $this->input->post("duration");
		$author = $this->input->post("author");
		$n = (int) $this->input->post("n");
		$ingredients = array();
		for ($i=0; $i < $n; $i++) { 
			$temp['bahan'] = $this->input->post("bahan".$i."");
			$temp['takaran'] = $this->input->post("takaran".$i."");
			$temp['unit'] = $this->input->post("unit".$i."");
			array_push($ingredients, $temp);
		}
		$m = (int) $this->input->post("m");
		$steps = array();
		for ($i=0; $i < $m; $i++) { 
			$temp['no_step'] = $i+1;
			$temp['description'] = $this->input->post("description".$i."");
			$temp['photo'] = $this->input->post("photo".$i."");
			array_push($steps, $temp);
		}
		$recipe->saveRecipe($id, $name, $portion, $duration, $description, $last_update, $ingredients, $steps);
		
		$this->load->model('viewer');
		$this->viewer->show('coba_top_recipe', ($SUCCESS=1));
	}

	// 
	public function create(){
		$recipe = new Recipe();
		$id = $recipe->createRecipe_model(); 
		if ($id != 0) {
			$this->edit($id);
		} else {

		}
	}

	// ini buat ambil resep dengan input id
	public function recipes($id){
		$recipe = new Recipe();
		$this->load->library(session);
		$userid = $this->session->userdata("user_id");
		if (empty($userid)){
			$data['profile']= $recipe->getRecipeProfile($id);
			$data['ingredients'] = $recipe->getIngredients($id);
			$data['steps'] = $recipe->getSteps($id);
			$data['categories']= $recipe->getCategories($id);
		} else {
			$data['profile']= $recipe->getRecipeProfile($id, $userid);
			$data['ingredients'] = $recipe->getIngredients($id, $userid);
			$data['steps'] = $recipe->getSteps($id, $userid);
			$data['categories']= $recipe->getCategories($id, $userid);
		}

		$this->load->model('viewer');
		$this->viewer->show('coba_top_recipe', $data);
	}

	// top resep untuk halaman top Page.
	// kalo buat ditampilin di home, cuma ambil 5 resep aja. 
	// kalo buat ditampilin di page sendiri, diambil 10 resep.
	public function top($isOnHome = true){
		$recipe = new Recipe();
		if ($isOnHome === 'true'){
			$data=$recipe->getTopRecipe(5);
		} else {
			$data=$recipe->getTopRecipe(10);
		}
		$arr = array();
		foreach ($data as $obj) {
			array_push($arr, $obj);
		}
		$data1=array(
			'data' => $arr
			);
		$this->load->library('parser');
		$this->parser->parse("coba_top_recipe", $data1);
	}

	// ini buat ambil highlight resep
	public function highlight($isOnHome = true){
		$recipe = new Recipe();
		if ($isOnHome === 'true'){
			$data=$recipe->getHightlight(5);
		} else {
			$data=$recipe->getHightlight(10);
		}
		$arr = array();
		foreach ($data as $obj) {
			array_push($arr, $obj);
		}
		$data1=array(
			'data' => $arr
			);
		$this->load->library('parser');
		$this->parser->parse("coba_top_recipe", $data1);
	}

	// ini buat ambil recent resep
	// kalo buat ditampilin di home, cuma ambil 5 resep aja. 
	// kalo buat ditampilin di page sendiri, diambil 10 resep.
	public function recent($isOnHome = 'true'){
		$recipe = new Recipe();
		if ($isOnHome === 'true'){
			$data=$recipe->getRecently(5);
		} else {
			$data=$recipe->getRecently(10);
		}
		$arr = array();
		foreach ($data as $obj) {
			array_push($arr, $obj);
		}
		$data1=array(
			'data' => $arr
			);
		$this->load->library('parser');
		$this->parser->parse("coba_top_recipe", $data1);
	}
	public function get($id){
		$recipe = new Recipe_model();
		$user = new User_model();
		$r = $recipe->getRecipeProfile($id);
		$data = array();
		$this->load->library('parser');
		// $menubar = $this->parser->parse('menubar_login', $data, TRUE);
		$this->load->model('home_viewer');
		$menubar = $this->home_viewer->getMenubar();
		$ingre = array();
		foreach ($r->ingredients as $obj) {
			$temp = array(
					'ingre_name' => $obj->name,
					'ingre_quantity' => $obj->quantity,
					'ingre_units' => $obj->units,
					'ingre_info' => $obj->info,
				);
			array_push($ingre, $temp);
		}
		//print_r($ingre);
		$steps = array();
		foreach ($r->steps as $obj) {
			$temp = array(
					'steps_number' => $obj->no_step,
					'steps_description' => $obj->description,
					'steps_photo' => $obj->photo,
				);
			array_push($steps, $temp);
		}
		$data = array(
					'recipe_name' => $r->name,
					'recipe_description' => $r->description,
					'recipe_portion' => $r->portion,
					'recipe_duration' => $r->duration,
					'recipe_author_name' => $user->getProfile($r->author)->name,
					'recipe_last_update' => substr($r->last_update, 0, -8),
					'recipe_ingredients' => $ingre,
					'recipe_steps' => $steps,
					'recipe_rating' => $r->rating,
				);
		$content_website = $this->parser->parse('recipe_view', $data, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);

	}
}