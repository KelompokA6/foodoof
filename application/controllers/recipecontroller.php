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
		$recipe->name = $this->input->post("title");
		$recipe->description = $this->input->post("description");
		$recipe->portion = $this->input->post("portion");
		$recipe->duration = $this->input->post("duration");
		$recipe->author = $this->input->post("author");
		if($recipe->save()){
			echo "Success";
		}
		else{
			echo "Failed";
		}
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
		$data = array();
		if (empty($userid)){
			$recipe->getRecipeProfile($id);
			array_push($data, $recipe);
		} else {
			$recipe->getRecipeProfile($id, $userid);
			array_push($data, $recipe);
		}
		print_r($data);
	}

	// top resep untuk halaman top Page.
	// kalo buat ditampilin di home, cuma ambil 5 resep aja. 
	// kalo buat ditampilin di page sendiri, diambil 10 resep.
	public function top($isOnHome = true){
		$recipe = new Recipe();
		if ($isOnHome === true){
			$recipe->getTopRecipe(5);
		} else {
			$recipe->getTopRecipe(10);
		}
		$this->load->library('parser');
		$arr = array();
		foreach ($recipe as $obj)
		{
			$data = array(
				'judul' => $obj->name,
				'author' => $obj->author,
				'date' => $obj->last_update,
				'rating' => $obj->rating,
				'views' => $obj->views,
				'photo' => $obj->photo
				);
			array_push($arr, $data);
		}
		$data1=array(
			'data' => $arr
			);

		$this->parser->parse("coba_top_recipe", $data1);
	}

	// ini buat ambil highlight resep
	public function highlight($isOnHome = true){
		$recipe = new Recipe();
		$recipe->getHightlight(10);
		$this->load->library('parser');
		$arr = array();
		foreach ($recipe as $obj)
		{
			$data = array(
				'judul' => $obj->name,
				'author' => $obj->author,
				'date' => $obj->last_update,
				'rating' => $obj->rating,
				'views' => $obj->views,
				'photo' => $obj->photo
				);
			array_push($arr, $data);
		}
		$data1=array(
			'data' => $arr
			);

		$this->parser->parse("coba_top_recipe", $data1);
	}

	// ini buat ambil recent resep
	// kalo buat ditampilin di home, cuma ambil 5 resep aja. 
	// kalo buat ditampilin di page sendiri, diambil 10 resep.
	public function recent($isOnHome = true){
		$recipe = new Recipe();
		if ($isOnHome === true){
			$recipe->getRecently(5);
		} else {
			$recipe->getRecently(10);
		}
		$this->load->library('parser');
		$arr = array();
		foreach ($recipe as $obj)
		{
			$data = array(
				'judul' => $obj->name,
				'author' => $obj->author,
				'date' => $obj->last_update,
				'rating' => $obj->rating,
				'views' => $obj->views,
				'photo' => $obj->photo
				);
			array_push($arr, $data);
		}
		$data1=array(
			'data' => $arr
			);

		$this->parser->parse("coba_top_recipe", $data1);
	}
}