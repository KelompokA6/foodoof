<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$this->load->library('encrypt');
		$msg = 'My secret message';
		$encrypted_string = $this->encrypt->encode($msg);
		echo $encrypted_string.' -- ini apa Bid? -_-';
		$this->load->view('welcome_message');
	}
	public function register(){
		$user = new User();
		$user->email = "abidnurulhakim@gmail.com";
		$user->password = "abidnurulhakim";
		$user->name = "Abid Nurul Hakim";
		$user->phone = "+6285714883607";
		if($user->save()){
			echo "Register success";
		}
		else{
			echo $user->error->member;
		}
	}
	public function login(){
		$user = new User();
		$user->user_email = "abidnurulhakim@gmail.com";
		$user->user_password = "abidnurulhakim";
		if($user->login()){
			 echo "Login Success";
			 echo $this->session->userdata('user_id');
		}
		else{
			echo "Login Failed";
		}
	}
	public function addRecipe(){
		$recipe = new Recipe();
		$recipe->name = "Nasi Goreng";
		$recipe->author = "1";
		$recipe_id = $recipe->saveRecipe();
		if($recipe_id != 0){
			$i = new Ingredient();
			$i->recipe_id = $recipe_id;
			$i->name = "Bawang Putih";
			$i->quantity = 1;
			$i->price = 1000;
			$i->units = "Buah";
			$i->save();
			$i->recipe_id = $recipe_id;
			$i->name = "Bawang Merah";
			$i->quantity = 2;
			$i->price = 1500;
			$i->units = "Buah";
			$i->save();
			$i->recipe_id = $recipe_id;
			$i->name = "Cabai";
			$i->quantity = 3;
			$i->price = 1000;
			$i->units = "Buah";
			$i->save();
			echo "Add Recipe Success";
		}
		else{
			echo "Failed Nambah Bahan";
		}
	}

	public function addRecipe2(){
		$recipe = new Recipe();
		$recipe->name = "Nasi Goreng 2";
		$recipe->author = "1";
		$recipe_id = $recipe->saveRecipe();
		if($recipe_id != 0){
			$i = new Ingredient();
			$i->recipe_id = $recipe_id;
			$i->name = "Bawang Putih";
			$i->quantity = 1;
			$i->price = 1000;
			$i->units = "Buah";
			$i->save();
			$i->recipe_id = $recipe_id;
			$i->name = "Bawang Merah";
			$i->quantity = 2;
			$i->price = 1500;
			$i->units = "Buah";
			$i->save();
			$i->recipe_id = $recipe_id;
			$i->name = "Cabai";
			$i->quantity = 3;
			$i->price = 1000;
			$i->units = "Buah";
			$i->save();
			echo "Add Recipe Success";
		}
		else{
			echo "Failed Nambah Bahan";
		}
	}

	public function highlight(){
		$this->load->library('parser');

		
		$recipe = new Recipe();
		$user = new User();
		$recipe->getHightlight();
		$listRecipe = array();

		foreach ($recipe as $r)
        {
            $user->id = $r->author;
            $tmp = array(
            		'id' => $r->id,
            		'name' => $r->name,
            		'author' => $user->get_by_id()->name
            	);
            array_push($listRecipe, $tmp);
        }
        $data = array(
		              'blog_title'   => 'Recipe Highlight',
		              'blog_heading' => 'Recipe Highlight',
		              'blog_entries' => $listRecipe,
		              
		            );
        $this->parser->parse('temp', $data);
	}
	public function recently(){
		$recipe = new Recipe();
		$user = new User();
		$recipe->getRecently();
		foreach ($recipe as $r)
        {
        	$user->id = $r->author;
            echo 'ID: ' . $r->id . '<br />';
            echo 'Name: ' . $r->name . '<br />';
            echo 'Author: ' . $user->get_by_id()->name . '<br />';
            echo '<br />';
        }
	}
	public function toprecipe(){
		$recipe = new Recipe();
		$user = new User();
		$recipe->getTopRecipe();
		foreach ($recipe as $r)
        {
        	$user->id = $r->author;
            echo 'ID: ' . $r->id . '<br />';
            echo 'Name: ' . $r->name . '<br />';
            echo 'Author: ' . $user->get_by_id()->name . '<br />';
            echo '<br />';
        }
	}
	public function addRating(){
		$recipe = new Recipe('2');
		if($recipe->addRating('1',3.5)){
			echo "berhasil ngerating";
		}	
		else{
			echo "gagal ngerating";
		}
	}
	public function getRecipe($id){
		$r = new Recipe();
		if($r->getRecipeProfile($id, '1')){
			echo "berhsail";
			echo $r->name."<br>";
			echo $r->id."<br>";
		}
		$r1 = new Recipe();
		$r1->id = '2';
		$r1->getIngredients();
		$r1->getSteps();
		print_r($r1->ingredients->name);
		print_r($r1->steps->description);
		//echo $r1->createRecipe();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */