<?php

class Recipe_model extends DataMapper {

    var $table = "recipes"; 
    var $has_many = array('ingredient', 'comments', 'category');
    var $has_one = array('user');

    var $validation = array(
        'name' => array(
            'label' => 'Recipe Name',
            'rules' => array('required', 'trim', 'min_length' => 1)
        ),
        'author' => array(
            'label' => 'Author Recipe',
            'rules' => array('required', 'member')
        ),
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
        $ci = &get_instance();
        $ci->load->library('session');
        $this->session = $ci->session;
    }

    /*
        Digunakan untuk Validasi sebuh recipe baru dimana user yang membuat harus terdaftar.
    */
    function _member($field){
        if (!empty($this->{$field}))
        {
            $u = new User_model();
            // Get email have used.
            if($u->where('id', $this->{$field})->count() !== 0){
                return true;
            }
            else{
                $this->error_message('notmember', 'ID Author is not member');
                return false;
            }
        }
        else{
            return false;
        }
    }

    /*
        Digunakan otentifikasi bahwa sebuah resep dimiliki oleh sebuah user yang mengkasesnya.
    */
    function authEditRecipe($recipe_id=NULL, $user_id=NULL){
        if($recipe_id==NULL){
            $recipe_id = $this->id;
        }
        if(!empty($recipe_id) && !empty($user_id)){
            $r = new Recipe_model();
            $r->where('id', $recipe_id);
            $r->where('author', $user_id);
            if($r->count()>0){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        return FALSE;
    }

    /*
        Digunakan untuk membuat sebuah Recipe pada database. return value merupakan id dari recipe yang berhasil dibuat, -1 merupakan indikasi bahwa recipe tidak
        berhasil dibuat.
    */
    function createRecipe_model($user_id=null){
        if(!empty($user_id)){
            $this->author = $user_id;
        }
        else if(empty($user_id)){
            $this->author = $this->session->userdata('user_id');   
        }
        if(!empty($this->author)){
            $u = new User_model();
            if($u->where("id", $this->author)->count() == 1){
                if($this->skip_validation()->save()){
                    return $this->db->insert_id();
                }
                return -1;    
            }
            else{
                return -1;
            }    
        }
        return -1;
    }

    /*
        Digunakan untuk menyimpan data sebuah Recipe pada database. return value merupakan boolean resep berhasil dibuat.
    */
    function saveRecipe($id=NULL, $name=NULL, $portion=NULL, $duration=NULL, $description=NULL, $last_update=NULL, $ingredients=NULL, $steps=NULL){
        $this->load->helper('file');
        if($id ==  NULL){
            $id = $this->id;
        }
        if($name ==  NULL){
            $name = $this->$name;
        }
        if($portion ==  NULL){
            $portion = $this->$portion;
        }
        if($duration ==  NULL){
            $duration = $this->$duration;
        }
        if($description ==  NULL){
            $description = $this->$description;
        }
        if($last_update ==  NULL){
            $last_update = $this->$last_update;
        }
        $rcpSave = new Recipe_model();
        $rcpSave->get_by_id($id);
        $photo = $rcpSave->photo;
        if(file_exists("./images/tmp/recipe/".$id.".jpg")){
            $photo = "images/recipe/".$id.".jpg";
        }
        if(!empty($id) && !empty($name) && !empty($portion) 
            && !empty($duration) && !empty($last_update)
            && !empty($steps) && !empty($ingredients)){
            $arrUpdate = array(
                        'author' => $this->session->userdata('user_id'),
                        'name' => $name,
                        'portion' => $portion,
                        'duration' => $duration,
                        'description' => $description,
                        'last_update' => $last_update,
                        'photo' => $photo,
                        'tmp_status' => false,
                        );
            if(!$rcpSave->where('id', $id)->update($arrUpdate)){
                return FALSE;
            }
            if(file_exists("./images/tmp/recipe/".$id.".jpg")){
                if(!rename("./images/tmp/recipe/".$id.".jpg", "./images/recipe/".$id.".jpg")){
                    return false;
                }
            }
            $this->trans_begin();
            if(is_array($ingredients)){
                $this->db->delete('ingredients', array('recipe_id' => $id));
                foreach ($ingredients as $ingredient) {
                    $ingre = new Ingredient();
                    $ingre->recipe_id = $id;
                    $ingre->name = $ingredient["name"];
                    $ingre->quantity = $ingredient["quantity"];
                    $ingre->units = $ingredient["units"];
                    if(!$ingre->skip_validation()->save()){
                        return false;
                    }
                }
            }
            if(!is_array($ingredients)){
                $this->db->delete('ingredients', array('recipe_id' => $id)); 
                $ingre = new Ingredient();
                $ingre->recipe_id = $id;
                $ingre->name = $ingredients["name"];
                $ingre->quantity = $ingredients["quantity"];
                $ingre->units = $ingredients["units"];
                if(!$ingre->skip_validation()->save()){
                    return false;
                }
            }
            if(is_array($steps)){
                $xStep=0;
                $stp = new Step();
                $countStep = $stp->where("recipe_id", $id)->count(); 
                foreach ($steps as $step) {
                    $xStep++;
                    $stptmp = new Step();
                    $stptmp->where('recipe_id', $id);
                    $stptmp->where('no_step', $xStep);
                    $stptmp->get();
                    if(!$stptmp->exists()){
                        $stp = new Step();
                        if(file_exists("./images/tmp/step/".$id."-".$xStep.".jpg")){
                            $stp->photo = "images/step/".$id."-".$xStep.".jpg";
                        }
                        else{
                            if(file_exists("./images/tmp/step/".$id."-".$xStep."-default.jpg")){
                                $stp->photo = 'assets/img/step-default.jpg';
                                unlink("./images/tmp/step/".$id."-".$no_step."-default.jpg");     
                            }
                            else{
                                $stp->photo = $stptmp->photo;       
                            }
                        }
                        $stp->recipe_id = $id;
                        $stp->description = $step["description"];
                        $stp->no_step = $xStep;
                        if(!$stp->skip_validation()->save()){
                            return false;
                        }
                        if(file_exists("./images/tmp/step/".$id."-".$xStep.".jpg")){
                            if(!rename("./images/tmp/step/".$id."-".$xStep.".jpg", "./images/step/".$id."-".$xStep.".jpg")){
                                return false;
                            }
                        }
                    }
                    else{
                        if(file_exists("./images/tmp/step/".$id."-".$xStep.".jpg")){
                            $photo = "images/step/".$id."-".$xStep.".jpg";
                        }
                        else{
                            if(file_exists("./images/tmp/step/".$id."-".$xStep."-default.jpg")){
                                $photo = 'assets/img/step-default.jpg'; 
                                unlink("./images/tmp/step/".$id."-".$no_step."-default.jpg");   
                            }
                            else{
                                $photo = $stptmp->photo;       
                            }
                        }
                        $dataUpdate = array(
                                        'description' => $step["description"],
                                        'photo' => $photo);
                        if(!$stptmp->update($dataUpdate)){
                            return false;
                        }
                        if(file_exists("./images/tmp/step/".$id."-".$xStep.".jpg")){
                            if(!rename("./images/tmp/step/".$id."-".$xStep.".jpg", "./images/step/".$id."-".$xStep.".jpg")){
                                return false;
                            }
                        }
                    }
                }
                if( $xStep < $countStep ){
                    $this->db->where('recipe_id',$id)->where('no_step >', $xStep)->delete('steps');
                }
            }
            if(!is_array($steps)){
                $stptmp = new Step();
                $stptmp->where('recipe_id', $id);
                $stptmp->where('no_step', "0");
                $stptmp->get();
                if(!$stptmp->exists()){
                    $stp = new Step();
                    if(file_exists("./images/tmp/step/".$id."-1.jpg")){
                        $stp->photo = "images/step/".$id."-1.jpg";
                    }
                    else{
                        $stp->photo = $stptmp->photo;   
                    }
                    $stp->recipe_id = $id;
                    $stp->description = $step["description"];
                    $stp->no_step = "1";
                    if(!$stp->skip_validation()->save()){
                        return false;
                    }
                    if(file_exists("./images/tmp/step/".$id."-1.jpg")){
                        $data = read_file("./images/tmp/step/".$id."-1.jpg");
                        if(!write_file("./images/step/".$id."-1.jpg", $data)){
                            return false;
                        }
                        unlink("./images/tmp/step/".$id."-1.jpg");
                    }
                }
                else{
                    if(file_exists("./images/tmp/step/".$id."-1.jpg")){
                        $photo = "images/step/".$id."-1.jpg";
                    }
                    else{
                        $photo = $stptmp->photo;   
                    }
                    $dataUpdate = array(
                                    'description' => $step["description"],
                                    'photo' => $photo);
                    if(!$stptmp->update($dataUpdate)){
                        return false;
                    }
                    if(file_exists("./images/tmp/step/".$id."-1.jpg")){
                        $data = read_file("./images/tmp/step/".$id."-1.jpg");
                        if(!write_file("./images/step/".$id."-1.jpg", $data)){
                            return false;
                        }
                        unlink("./images/tmp/step/".$id."-1.jpg");
                    }
                }
            }
           if ($this->trans_status() === FALSE)
            {
                // Transaction failed, rollback
                $this->trans_rollback();
                // Add error message
                $this->error_message('transaction', 'The transaction failed to save (insert)');
                return false;
            }
            if ($this->trans_status() === TRUE)
            {
                // Transaction successful, commit
                $this->trans_commit();
                return true;
            }
            return true;
        }
        return false;
    }

    /*
        Digunakan untuk delete sebuah Recipe pada database. return value merupakan boolean.
    */
    function deleteRecipe($id=NULL){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id)){
            return $this->db->where('id', $id)->delete();
        }
        else{
            return false;
        }
    }

    /*
        Digunakan untuk memperoleh resep yang merupakan list resep highlight, dengan parameter input limit resep yang ingin ditampilkan
    */
    function getHightlight($limit=10, $offset=0){
        $recipe = new Recipe_model();
        $recipe->where('highlight', '1');
        $recipe->where('status', '1');
        $recipe->get($limit, $offset);
        $arrResult = array();
        foreach ($recipe as $recipes) {
            $data = new stdClass();
            $data->id = $recipes->id;
            $data->name = $recipes->name;
            $data->description = $recipes->description;
            $data->portion = $recipes->portion;
            $data->duration = $recipes->duration;
            $data->author = $recipes->author;
            $data->create_date = $recipes->create_date;
            $data->last_update = $recipes->last_update;
            $data->rating = $recipes->rating;
            $data->status = $recipes->status;
            $data->views = $recipes->views;
            $data->photo = $recipes->photo;
            $data->highlight = $recipes->highlight;
            array_push($arrResult, $data);
        }
        return $arrResult;
    }

    /*
        Digunakan untuk memperoleh resep yang merupakan terbaru, dengan parameter input limit resep yang ingin ditampilkan
    */
    function getRecently($limit=10, $offset=0){
        $recipe = new Recipe_model();
        $recipe->where('status', '1')->order_by("create_date", "desc")->get($limit, $offset);
        $arrResult = array();
        foreach ($recipe as $recipes) {
            if($recipe->status){}
            $data = new stdClass();
            $data->id = $recipes->id;
            $data->name = $recipes->name;
            $data->description = $recipes->description;
            $data->portion = $recipes->portion;
            $data->duration = $recipes->duration;
            $data->author = $recipes->author;
            $data->create_date = $recipes->create_date;
            $data->last_update = $recipes->last_update;
            $data->rating = $recipes->rating;
            $data->status = $recipes->status;
            $data->views = $recipes->views;
            $data->photo = $recipes->photo;
            $data->highlight = $recipes->highlight;
            array_push($arrResult, $data);
        }
        return $arrResult;
    }

    /*
        Digunakan untuk memperoleh resep yang merupakan resep dengan rating tertinggi, dengan parameter input limit resep yang ingin ditampilkan.
        kembalian list resep yang menjadi top
    */
    function getTopRecipe($limit=10, $offset=0){
        $recipe = new Recipe_model();
        $recipe->where('status', '1')->order_by("rating", "desc")->order_by("views", "desc")->get($limit, $offset);
        $arrResult = array();
        foreach ($recipe as $recipes) {
            $data = new stdClass();
            $data->id = $recipes->id;
            $data->name = $recipes->name;
            $data->description = $recipes->description;
            $data->portion = $recipes->portion;
            $data->duration = $recipes->duration;
            $data->author = $recipes->author;
            $data->create_date = $recipes->create_date;
            $data->last_update = $recipes->last_update;
            $data->rating = $recipes->rating;
            $data->status = $recipes->status;
            $data->views = $recipes->views;
            $data->photo = $recipes->photo;
            $data->highlight = $recipes->highlight;
            array_push($arrResult, $data);
        }
        return $arrResult;
    }

    /*
        Digunakan untuk memperoleh resep berdasarkan category, dengan parameter input limit resep yang ingin ditampilkan 
        dan parameter category. kembalian list resep dan jumlah yang berada resep pada kategori tersebut di database
    */
    function getCategoryRecipe($category1 = "other", $limit=10, $offset=0){
        $arrResult = array();
        $category = new Category();
        $category->ilike('name', $category1)->order_by("recipe_id", "asc")->get();
        $x = 0;
        foreach ($category as $categories){
            if($x >= $offset && $limit > 0){
                $recipes = new Recipe_model();
                $recipes->get_by_id($categories->recipe_id);
                if($recipes->status=='1'){
                    $data = new stdClass();
                    $data->id = $recipes->id;
                    $data->name = $recipes->name;
                    $data->description = $recipes->description;
                    $data->portion = $recipes->portion;
                    $data->duration = $recipes->duration;
                    $data->author = $recipes->author;
                    $data->create_date = $recipes->create_date;
                    $data->last_update = $recipes->last_update;
                    $data->rating = $recipes->rating;
                    $data->status = $recipes->status;
                    $data->views = $recipes->views;
                    $data->photo = $recipes->photo;
                    $data->highlight = $recipes->highlight;
                    array_push($arrResult, $data);
                    $limit--;
                }
            } 
            $x++;
        }
        $arrResult["total"] = $x;
        return $arrResult;
    }

    /*
        Digunakan untuk memperoleh resep-resep yang dimiliki oleh sebuah user.
    */
    function getUserRecipe($userId, $flag = 'all',$limit=10, $offset=0){
        $recipe = new Recipe_model();
        if(strtolower($flag) != 'all'){
            $recipe->where('status','1');    
        }
        $recipe->get_by_author($userId);
        $arrResult = array();
        $x = 0;
        foreach ($recipe as $recipes) {
            if($x >= $offset && $limit > 0){
                $data = new stdClass();
                $data->id = $recipes->id;
                $data->name = $recipes->name;
                $data->description = $recipes->description;
                $data->portion = $recipes->portion;
                $data->duration = $recipes->duration;
                $data->author = $recipes->author;
                $data->create_date = $recipes->create_date;
                $data->last_update = $recipes->last_update;
                $data->rating = $recipes->rating;
                $data->status = $recipes->status;
                $data->views = $recipes->views;
                $data->photo = $recipes->photo;
                $data->highlight = $recipes->highlight;
                array_push($arrResult, $data);
                $limit--;
            }
            $x++;
        }
        return $arrResult;
    }

    /*
        Digunakan untuk memperoleh profile sebuah resep. resep yang diperoleh harus berstatus publish atau yang melihat merupakan pemilik resep tersebut.
        Kalau status tidak publish maka return false, tapi bila tidak publish dan yg request pemilik return object resep.
    */
    function getRecipeProfile($id=NULL, $user_id=NULL){
        if($id == NULL){
            $id = $this->id;
        }
        $recipes = new Recipe_model();
        $recipes->get_by_id($id);
        if($recipes->status){
            $data = new stdClass();
            $data->id = $recipes->id;
            $data->name = $recipes->name;
            $data->description = $recipes->description;
            $data->portion = $recipes->portion;
            $data->duration = $recipes->duration;
            $data->author = $recipes->author;
            $data->create_date = $recipes->create_date;
            $data->last_update = $recipes->last_update;
            $data->rating = $recipes->rating;
            $data->status = $recipes->status;
            $data->views = $recipes->views;
            $data->photo = $recipes->photo;
            $data->highlight = $recipes->highlight;
            $data->category = $recipes->getCategories($recipes->id);
            $data->ingredients = $recipes->getIngredients($recipes->id);
            $data->steps = $recipes->getSteps($recipes->id);
            return $data;
        }
        else{
            if(!empty($user_id) && $recipes->author==$user_id){
                $data = new stdClass();
                $data->id = $recipes->id;
                $data->name = $recipes->name;
                $data->description = $recipes->description;
                $data->portion = $recipes->portion;
                $data->duration = $recipes->duration;
                $data->author = $recipes->author;
                $data->create_date = $recipes->create_date;
                $data->last_update = $recipes->last_update;
                $data->rating = $recipes->rating;
                $data->status = $recipes->status;
                $data->views = $recipes->views;
                $data->photo = $recipes->photo;
                $data->highlight = $recipes->highlight;
                $data->category = $recipes->getCategories($recipes->id);
                $data->ingredients = $recipes->getIngredients($recipes->id);
                $data->steps = $recipes->getSteps($recipes->id);
                return $data;
            }
            return FALSE;
        }
    }
    /*
    input merupakan string title, limit yang merupakan jumlah resep yang ditampilkan, offset merupakan mulai dari berapa resep ditampilkan 
    kembalian aray dengan dua element element total merupakan total pencarian dan element resep_list merupakan list resep yang sesuai dengan title.
    bila tidak ada yang memenuhi maka mengembalikan array dengan sebuah element total yang bernilai nol.
    */
    function searchRecipeByTitle($search_key=NULL, $limit=10, $offset=0, $category=NULL){
        if(!empty($search_key)){
            $recipe = new Recipe_model();
            $sql = "SELECT * FROM recipes WHERE MATCH (name) AGAINST ('".$search_key."') order by MATCH (name) AGAINST ('".$search_key."')";
            $recipe->query($sql);
            $recipeList = array();
            $total = 0;
            foreach ($recipe as $recipes) {
                $validRecipe = true;
                if($total >= $offset && $limit > 0){
                    if(!empty($category)){
                        $categories = new Category();
                        $categories->where('recipe_id', $recipes->id);
                        if(is_array($category)){
                            for ($i=0; $i <$category ; $i++) { 
                                $categories->or_ilike('name', $category[$i]);
                            }
                        }
                        else{
                            $categories->or_ilike('name', $category);
                        }
                        if($categories->count()==0){
                            $validRecipe = false;
                            $total--;
                        }
                    }                    
                    if($validRecipe){
                        $data = new stdClass();
                        $data->id = $recipes->id;
                        $data->name = $recipes->name;
                        $data->description = $recipes->description;
                        $data->portion = $recipes->portion;
                        $data->duration = $recipes->duration;
                        $data->author = $recipes->author;
                        $data->create_date = $recipes->create_date;
                        $data->last_update = $recipes->last_update;
                        $data->rating = $recipes->rating;
                        $data->status = $recipes->status;
                        $data->views = $recipes->views;
                        $data->photo = $recipes->photo;
                        $data->highlight = $recipes->highlight;
                        array_push($recipeList, $data);
                        $limit--;
                    }
                }
                $total++;
            }
            $arrResult = array(
                                "total" => $total,
                                "recipe_list" => $recipeList,
                                );
            return $arrResult;
        }
        return $arrResult = array("total" => 0);
    }
    /*
    search_key merupakan array string bahan, limit yang merupakan jumlah resep yang ditampilkan, offset merupakan mulai dari berapa resep ditampilkan 
    kembalian aray dengan dua element element total merupakan total pencarian dan element resep_list merupakan list resep yang sesuai dengan title.
    bila tidak ada yang memenuhi maka mengembalikan array dengan sebuah element total yang bernilai nol.
    */
    function searchRecipeByIngredients($search_key=NULL, $threshold=0.3, $limit=0, $offset=0, $category=NULL){
        $arrResult = array();
        if(!empty($search_key) && is_numeric($threshold)){
            $searchkey = "";
            $thresholdCounter = floor(sizeof($search_key)*floatval($threshold));
            for ($i=0; $i < sizeof($search_key) ; $i++) { 
                if($i == 0){
                    $searchkey .= "name LIKE '%".$search_key[$i]."%'"; 
                } 
                $searchkey .= " OR name LIKE '%".$search_key[$i]."%'"; 
            }
            $ingredient = new Ingredient();
            $sql = "SELECT recipe_id, COUNT(*) as counter FROM ingredients WHERE ".$searchkey." group by recipe_id having counter >= ".$thresholdCounter." order by counter desc";
            $ingredient->query($sql);
            $recipeList = array();
            $total = 0;
            foreach ($ingredient as $ingredients) {
                $validRecipe = true;
                if($total >= $offset && $limit > 0){
                    if(!empty($category)){
                        $categories = new Category();
                        $categories->where('recipe_id', $recipes->id);
                        if(is_array($category)){
                            for ($i=0; $i <$category ; $i++) { 
                                $categories->or_ilike('name', $category[$i]);
                            }
                        }
                        else{
                            $categories->or_ilike('name', $category);
                        }
                        if($categories->count()==0){
                            $validRecipe = false;
                            $total--;
                        }
                    }                    
                    if($validRecipe){
                        $recipes = new Recipe_model();
                        $recipes->get_by_id($ingredients->recipe_id);
                        $data = new stdClass();
                        $data->id = $recipes->id;
                        $data->name = $recipes->name;
                        $data->description = $recipes->description;
                        $data->portion = $recipes->portion;
                        $data->duration = $recipes->duration;
                        $data->author = $recipes->author;
                        $data->create_date = $recipes->create_date;
                        $data->last_update = $recipes->last_update;
                        $data->rating = $recipes->rating;
                        $data->status = $recipes->status;
                        $data->views = $recipes->views;
                        $data->photo = $recipes->photo;
                        $data->highlight = $recipes->highlight;
                        array_push($recipeList, $data);
                        $limit--;
                    }
                }
                $total++;
            }
            $arrResult = array(
                                "total" => $total,
                                "recipe_list" => $recipeList,
                                );
            return $arrResult;
        }
        return $arrResult = array("total" => 0);
    }

    /*
        Digunakan untuk memperoleh bahan-bahan yang digunakan oleh sebuah resep. kembalian list object bahan
    */
    function getIngredients($id=NULL){
        if($id == NULL){
            $id = $this->id;
        }
        $ingredient = new Ingredient();
        $ingredient->get_where(array('recipe_id' => $id));
        $arrResult = array();
        foreach ($ingredient as $ingredients) {
            $data = new stdClass();
            $data->recipe_id = $ingredients->recipe_id;
            $data->name = $ingredients->name;
            $data->quantity = $ingredients->quantity;
            $data->units = $ingredients->units;
            $data->info = $ingredients->info;
            array_push($arrResult, $data);
        }
        return $arrResult;
    }

    /*
        Digunakan untuk memperoleh step yang digunakan oleh sebuah resep. kembalian list object langkah
    */
    function getSteps($id=NULL){
        if($id == NULL){
            $id = $this->id;
        }
        $step = new Step();
        $step->get_where(array('recipe_id' => $id));
        $arrResult = array();
        foreach ($step as $steps) {
            $data = new stdClass();
            $data->recipe_id = $steps->recipe_id;
            $data->no_step = $steps->no_step;
            $data->description = $steps->description;
            $data->photo = $steps->photo;
            array_push($arrResult, $data);
        }
        return $arrResult;
    }

    /*
        Digunakan untuk memperoleh kategori yang dimiliki oleh sebuah resep. kembalian list object kategori
    */
    function getCategories($id=NULL){
        if($id == NULL){
            $id = $this->id;
        }
        $category = new Category();
        $category->get_where(array('recipe_id' => $id));
        $arrResult = array();
        foreach ($category as $categories) {
            $data = new stdClass();
            $data->recipe_id = $categories->recipe_id;
            $data->name = $categories->name;
            array_push($arrResult, $data);
        }
        return $arrResult;
    }

    /*
        Digunakan untuk memberikan rating pada sebuah resep. nilai kembalian merupakan boolean rating berhasil disimpan. bila telah ada maka akan dioverwrite
    */
    function saveRating($user_id=null, $recipe_id=null, $value = 0){
        if(empty($recipe_id)){
            $recipe_id = $this->id;
        }
        if(!empty($recipe_id) && !empty($user_id)){
            $rat = new Rating();
            $rat->recipe_id = $this->id;
            $rat->user_id = $user_id;
            $rat->value = $value;
            $ratmp = new Rating();
            $ratmp->where('recipe_id', $this->id);
            $ratmp->where('user_id', $user_id);
            if($ratmp->count() > 0){
                $rat->where('recipe_id', $this->id);
                $rat->where('user_id', $user_id);
                return $rat->update('value', $value);
            }
            else{
                return $rat->skip_validation()->save();
            }
        }
        return false;
    }

    /*
        Digunakan melakukan penambahan viewer sebuah resep. kembalian boolean
    */
    function incrementViews($recipe_id=null){
        if(empty($recipe_id)){
            $recipe_id = $this->id;
        }
        $recipe = new Recipe_model();
        $recipe->get_by_id($recipe_id);
        $countViews = $recipe->views;
        $countViews++;
        $recipe->clear();
        return $recipe->where('id', $recipe_id)->update('views', $countViews);
    }

    /*
        Digunakan untuk menyimpan recipe to favorite list, bila sudah ada maka akan dihapus dari list
    */
    function addFavorite($user_id=null, $recipe_id=null){
        if(empty($recipe_id)){
            $recipe_id = $this->id;
        }
        if(!empty($recipe_id) && !empty($user_id)){
            $favorite = new Fovorite();
            $favorite->recipe_id = $recipe_id;
            $favorite->user_id = $user_id;
            $favoritetmp = new Fovorite();
            $favoritetmp->where('recipe_id', $recipe_id);
            $favoritetmp->where('user_id', $user_id);
            if($favoritetmp->count() > 0){
                if($this->db->delete('favorites', array('recipe_id' => $recipe_id, 'user_id' => $user_id ))){
                    $result['status'] = true;
                    $result['action'] = "delete";
                    return $result;
                }
                else{
                    return false;
                } 
            }
            else{
                if($favorite->skip_validation()->save()){
                    $result['status'] = true;
                    $result['action'] = "add";
                    return $result;
                }
                else{
                    return false;
                }
            }
        }
        return false;
    }

    /*
        Digunakan untuk menyimpan recipe to cook later list, bila sudah ada maka akan dihapus dari list
    */
    function addCookLater($user_id=null, $recipe_id=null){
        if(empty($recipe_id)){
            $recipe_id = $this->id;
        }
        if(!empty($recipe_id) && !empty($user_id)){
            $CL = new cooklater();
            $CL->recipe_id = $recipe_id;
            $CL->user_id = $user_id;
            $CLtmp = new cooklater();
            $CLtmp->where('recipe_id', $recipe_id);
            $CLtmp->where('user_id', $user_id);
            if($CLtmp->count() > 0){
                if($this->db->delete('cooklater', array('recipe_id' => $recipe_id, 'user_id' => $user_id ))){
                    $result['status'] = true;
                    $result['action'] = "delete";
                    return $result;
                }
                else{
                    return false;
                } 
            }
            else{
                if($CL->skip_validation()->save()){
                    $result['status'] = true;
                    $result['action'] = "add";
                    return $result;
                }
                else{
                    return false;
                }
            }
        }
        return false;
    }
    
    /*
        Digunakan untuk mengubah status publish dari sebuah resep. nilai kembalian merupakan boolean berhasil mengubah status.
    */
    function publishRecipe($id=NULL, $status=FALSE){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id)){
            return $this->where('id', $id)->update('status', $status);
        }
        else{
            return false;
        }
    }

     /*
        Digunakan untuk mengubah status publish dari sebuah resep. nilai kembalian merupakan boolean berhasil mengubah status.
    */
    function highlightRecipe($id=NULL, $status=FALSE){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id)){
            return $this->where('id', $id)->update('hightlight', $status);
        }
        else{
            return false;
        }
    }

    /*
        Digunakan untuk menambahkan sebuah category pada sebuah resep, kembalian berhasil atai tidak
    */
    function addCategory($id=NULL, $category1=NULL){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id) && !empty($category1)){
            $categorytmp = new Category();
            $categorytmp->where('recipe_id', $id);
            $categorytmp->ilike('name', strtolower($category1));
            $category = new Category();
            if(!$categorytmp->count() > 0){
                $category->recipe_id = $id;
                $category->name = strtolower($category1);
                return $category->skip_validation()->save();
            } else{
                return true;         
            }
        }
        else{
            return false;
        }
    }

    /*
        Digunakan untuk menghapus sebuah category pada sebuah resep, kembalian boolean berhasil atau tidak
    */
    function deleteAllCategory($id=NULL){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id)){
            return $this->db->delete('categories', array('recipe_id' => $id));
        }
        else{
            return false;
        }
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */