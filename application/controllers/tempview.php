<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tempview extends CI_Controller {
	
	public function recipe()
	{	
		$this->load->library('parser');
		$data = array("recipe_author_id"=> 1);
		$menubar = $this->parser->parse('menubar', $data, TRUE);
		$data1 = array("recipe_category_entries"=> array(
												array("recipe_category"=> "Pedas"), 
												array("recipe_category"=> "Chinese Food")),
		);
		$content_website = $this->parser->parse('recipe_view', $data1, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);

	}	
	public function footer(){
		$this->load->view('footer');
	}

	public function editrecipe(){
		$this->load->library('parser');
		$data = array("recipe_author_id"=> 1);
		$menubar = $this->parser->parse('menubar', $data, TRUE);
		$content_website = $this->parser->parse('edit_recipe_view', $data, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);
	}
	public function editprofile(){
		$this->load->view('edit_profile_view');
	}
	public function login()
	{	
		$this->load->library('parser');
		$data = array("recipe_author_id"=> 1);
		$menubar = $this->parser->parse('menubar_login', $data, TRUE);
		$content_website = $this->parser->parse('login_view', $data, TRUE);
		$data = array(
					"menubar" => $menubar,
					"content_website" => $content_website,
				);
		$this->parser->parse('template_content', $data);

	}	
	public function getR(){
		$recipe = new Recipe_model();
		$t = $recipe->getRecipeProfile(1)->name;
		print_r($t);
	}
	public function search(){
		$recipe = new Recipe_model();
		print_r($recipe->searchRecipeByTitle('ayam', 10, 0));
	}
	public function searchIngredient(){
		$recipe = new Recipe_model();
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
	public function coba($a){
		$a = urldecode($a);
		echo $a;
	}
	public function anagram(){
		$string = array();
		array_push($string, array("anagram", "garanam"));
		array_push($string, array("diba", "abid"));
		array_push($string, array("anagram", "g1ranam"));
		array_push($string, array("saya abid ", "saya   abid"));
		array_push($string, array("saya abid ", "saya   abid nurul"));
		for ($i=0; $i < sizeof($string); $i++) { 
			$key = str_replace(" ", "", strtolower($string[$i][0]));
			$text = str_replace(" ", "", strtolower($string[$i][1]));
			if(strlen($key) != strlen($text)){
				echo "string ke-".($i+1)." bernilai false karena panjang string tidak sama<br>";
			}
			else{
				$valid = true;
				for ($j=0; $j < strlen($key); $j++) { 
					$char = substr($key, $j, 1);
					$pos = strpos($text, $char);
					if($pos ===  false){
						echo "string ke-".($i+1)." bernilai false <br>";
						$valid = false;
						break;
					}
					else{
						$text1 = substr($text, 0, $pos);
						$text2 = substr($text, $pos+1);
						$text = $text1.$text2;
					}
				}
				if($valid){
					echo "string ke-".($i+1)." bernilai true <br>";
				}
			}
		}
	}
	public function test1($input){
		$size = (($input*2)-1);
		for ($i=1; $i <= $size; $i++) { 
			$arra = array();
			$x = abs($input-$i)+1;
			$inc = $input - (abs($input-$i)+1);
			for ($j=0 ; $j < $input-1 ; $j++) { 
				if($j>=$inc){
					echo $input-$inc;
					array_push($arra, $input-$inc);
				}else{
					echo $input-$j;
					array_push($arra, $input-$j);
				}
			}
			echo $x;
			for ($j=sizeof($arra)-1 ; $j >= 0 ; $j--) { 
				echo $arra[$j];
			}
			echo "<br>";
		}
	}
}