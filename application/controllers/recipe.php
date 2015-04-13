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
		$user_id = $user->wajiblogin();
		$auth = $recipe->authEditRecipe($id, $user_id);
		if ($auth){
			$r = $recipe->getRecipeProfile($id, $user_id);
			$data = array();
			$this->load->model('home_viewer');
			$menubar = $this->home_viewer->getMenubar();
			$ingre = array();
			if (!empty($r->ingredients)){
				foreach ($r->ingredients as $obj) {
					$temp = array(
							'edit_recipe_ingredient_subject' => $obj->name,
							'edit_recipe_ingredient_quantity' => $obj->quantity,
							'edit_recipe_ingredient_unit' => $obj->units,
						);
					array_push($ingre, $temp);
				}
			}
			print_r($ingre);
			die();
			$steps = array();
			if (!empty($r->steps)){
				$i = 1;
				foreach ($r->steps as $obj) {
					$temp = array(
							'edit_recipe_step_title' => $id+"-"+$i++,
							'edit_recipe_step_no_step' => $obj->no_step,
							'edit_recipe_step_description' => $obj->description,
							'edit_recipe_step_photo' => $obj->photo,
						);
					array_push($steps, $temp);
				}
			}
			$data = array(
						'edit_recipe_id' => $id,
						'edit_recipe_photo' => $r->photo,
						'edit_recipe_title' => $r->name,
						'edit_recipe_portion' => $r->portion,
						'edit_recipe_description' => $r->description,
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

			$content_website = $this->parser->parse('edit_recipe_view', $data, TRUE);
			$data = array(
						"menubar" => $menubar,
						"content_website" => $content_website,
					);
			$this->parser->parse('template_content', $data);
		} else {
			redirect(base_url()."recipe/get/$id");
		}
		
	}

	// ini pake post, lihat registration
	public function save($id){
		$recipe = new Recipe_model();
		$user = new User_model();
		$user_id = $user->wajiblogin();
		$name = $this->input->post("recipe_title");
		$description = $this->input->post("recipe_description");
		$portion = $this->input->post("recipe_portion");
		$duration = $this->input->post("recipe_duration");
		$category = $this->input->post("recipe_category");
		//print_r($category);
		$subjek =  $this->input->post("ingredient_subject");
		// print_r($subjek);
		// die;
		$quantity =  $this->input->post("ingredient_quantity");
		$unit =  $this->input->post("ingredient_unit");
		// print_r($category);
		// for ($i=0; $i < sizeof($category) ; $i++) { 
		// 	$recipe->addCategory($id, $category[$i]);
		// }

		$ingredients = array();
		for ($i=0; $i < sizeof($subjek) ; $i++) { 
			$temp['name'] = $subjek[$i];
			$temp['quantity'] = $quantity[$i];
			$temp['units'] = $unit[$i];
			array_push($ingredients, $temp);
		}
		
		$stdes =  $this->input->post("step-description");
		$poto =  $this->input->post("photo-step");
		$steps = array();
		for ($i=0; $i < sizeof($stdes); $i++) { 
			$temp['description'] = $stdes[$i];
			array_push($steps, $temp);
		}
		date_default_timezone_set ('Asia/Jakarta');
		$isSuccess = $recipe->saveRecipe($id, $name, $portion, $duration, $description, strftime("%Y-%m-%d %H:%M:%S"), $ingredients, $steps);
		if($isSuccess === false){
			echo "gagal";
		} else{
			if (!empty($category)){
				$recipe->deleteAllCategory($id);
				foreach($category as $selected){
					$res = $recipe->addCategory($id, $selected);
				}
			}
			redirect(base_url()."recipe/get/$id");
		}
	}

	public function create(){
		$recipe = new Recipe_model();
		$id = $recipe->createRecipe_model(); 
		if ($id != 0) {
			redirect(base_url()."recipe/edit/".$id);
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
		$recipe->incrementViews($id);
		$user = new User_model();
		$user_id = $this->session->userdata('user_id');
		$r = $recipe->getRecipeProfile($id, $user_id);
		if($r){
			$data = array();
			$this->load->library('parser');
			// $menubar = $this->parser->parse('menubar_login', $data, TRUE);
			$this->load->model('home_viewer');
			$menubar = $this->home_viewer->getMenubar();
			$ingre = array();
			if (!empty($r->ingredients)){
				foreach ($r->ingredients as $obj) {
					$temp = array(
							'ingre_name' => $obj->name,
							'ingre_quantity' => $obj->quantity,
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
							'steps_description' => $obj->description,
							'steps_photo' => $obj->photo,
						);
					array_push($steps, $temp);
				}
			}
			$category = array();
			if (!empty($r->category)){
				foreach ($r->category as $obj) {
					$temp = array(
						'recipe_category' => $obj->name,
					);
					array_push($category, $temp);
				}
			}
			$data = array(
						'recipe_name' => $r->name,
						'recipe_description' => $r->description,
						'recipe_portion' => $r->portion,
						'recipe_duration' => $r->duration,
						'recipe_author_name' => $user->getProfile($r->author)->name,
						'recipe_last_update' => substr($r->last_update, 0, -8),
						'recipe_author' => $r->author,
						'recipe_id' => $id,
						'recipe_ingredients' => $ingre,
						'recipe_steps' => $steps,
						'recipe_rating' => $r->rating,
						'recipe_photo' => $r->photo,
						'recipe_category_entries' => $category,
						'recipe_author_id' => ($r->author),
					);
			$content_website = $this->parser->parse('recipe_view', $data, TRUE);
			$data = array(
						"menubar" => $menubar,
						"content_website" => $content_website,
					);
			$this->parser->parse('template_content', $data);
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
		$this->parser->parse('template_content', $data);
	}

	function category($name){
		$name=urldecode($name);
		$page=$this->input->get("page");
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
				'category_recipe_photo' => $obj->photo,
				'category_recipe_name' => $obj->name,
				'category_recipe_last_update' => $obj->last_update,
				'category_recipe_rating' => $obj->rating,
			);
			array_push($entries, $temp);
		}

		$data = array(
			'category_name' =>$name,
			'category_recipe_entries' => $entries,
			'category_recipe_name' => $name,
			'category_recipe_page_now' => $page,
			'category_recipe_page_size' =>  ceil($total/10),
		);
		$content_page = $this->parser->parse('category_view', $data, TRUE);	
		$category_home = $this->parser->parse('category_home', array(), TRUE);
		$data = array(
			'content_page' => $content_page,
			'category_home' => $category_home,
		);

		$content_website = $this->parser->parse('content_page', $data, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);

		var_dump($total);
	}
}