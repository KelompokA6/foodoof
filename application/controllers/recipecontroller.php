<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RecipeController extends CI_Controller {

	public function publish($id, $isPublished){
		$recipe  = new Recipe();
		$recipe->get_by_id($id)->update('status', $isPublished);
	}

	public function edit($id){
		$recipe  = new Recipe();
		$recipe->id = $id;
		
	}

	// ini pake post, lihat registration
	public function save(){
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
		$recipe->saveRecipe($id, $name, $portion, $duration, $description, $last_update, $ingredients, $steps)
		
		$this->load->model('viewer');
		$this->viewer->show('coba_top_recipe', ($SUCCESS=1));
	}

	// 
	public function create(){
		$recipe = new Recipe();
		$id = $recipe->createRecipe(); 
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
}