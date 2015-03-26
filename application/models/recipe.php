<?php

class Recipe extends DataMapper {

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
        //$this->$id = $id;
    }

    /*
        Digunakan untuk Validasi sebuh recipe baru dimana user yang membuat harus terdaftar.
    */
    function _member($field){
        if (!empty($this->{$field}))
        {
            $u = new User();
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
            $r = new Recipe();
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
    function createRecipe(){
        if(!empty($this->author)){
            if($this->skip_validation()->save()){
                return $this->db->insert_id();
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
        $rcpSave = new Recipe();
        $rcpSave->get_by_id($id);
        $photo = $rcpSave->photo;
        if(file_exists("image/tmp/recipe/".$id.".jpg")){
            $photo = "image/recipe/".$id.".jpg";
        }
        if(!empty($id) && !empty($name) && !empty($portion) 
            && !empty($duration) && !empty($description) && !empty($last_update)
            && !empty($steps) && !empty($ingredients)){
            
            $arrUpdate = array(
                        'author' => $this->session->userdata('user_id'),
                        'name' => $name,
                        'portion' => $portion,
                        'duration' => $duration,
                        'description' => $description,
                        'last_update' => $last_update,
                        'photo' => $photo
                        );
            if(!$rcpSave->where('id', $id)->update($arrUpdate)){
                return FALSE;
            }
            $data = read_file("images/tmp/recipe/".$id.".jpg");
            if(!write_file("image/recipe/".$id.".jpg", $data)){
                return false;
            }
            unlink("images/tmp/recipe/".$id."-".$x."jpg");
            $this->trans_begin();
            if(is_array($ingredients)){
                $ingres = new Ingredient();
                $ingres->get_by_id($id);
                $ingres->delete();
                foreach ($ingredients as $ingredient) {
                    $ingre = new Ingredient();
                    $ingre->recipe_id = $id;
                    $ingre->recipe_id = $id;
                    $ingre->recipe_id = $id;
                    $ingre->saveIngredient($this->recipe_id, $ingredient->name, $ingredient->quantity, $ingredient->units);
                }
            }
            else{
                $ingres = new Ingredient();
                $ingres->get_by_id($id);
                $ingres->delete();
                $ingre = new Ingredient();
                $ingre->saveIngredient($this->recipe_id, $ingredients->name, $ingredients->quantity, $ingredients->units);
            }
            if(is_array($steps)){
                $x=1;
                $stp = new Step();
                $stp->get_by_id($id);
                $stp->delete();
                foreach ($steps as $step) {
                    $stp = new Step();
                    if(file_exists("images/tmp/step/".$id."-".$x.".jpg")){
                        $stp->photo = "image/step/".$id."-".$x.".jpg";
                        $stp->recipe_id = $id;
                        $stp->description = $step->description;
                        $stp->step = $x;
                        if($stp->save()){
                            $data = read_file("images/tmp/step/".$id."-".$x.".jpg");
                            if(!write_file("image/step/".$id."-".$x.".jpg", $data)){
                                return false;
                            }
                            unlink("images/tmp/step/".$id."-".$x.".jpg");
                        }
                    }
                    $x += 1;
                }
            }
            else{
                $stp = new Step();
                $stp->get_by_id($id);
                $stp->delete();
                $stp = new Step();
                if(file_exists("images/tmp/step/".$id."-".$x."jpg")){
                    $stp->photo = "image/step/".$id."-".$x."jpg";
                    $stp->recipe_id = $this->$id;
                    $stp->description = $step->description;
                    $stp->step = '1';
                    if($stp->save()){
                        $data = read_file("images/tmp/step/".$id."-1.jpg");
                        if(!write_file("image/step/".$id."-".$x."-1.jpg", $data)){
                            return false;
                        }
                        unlink("images/tmp/step/".$id."-".$x."jpg");
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
            else
            {
                // Transaction successful, commit
                $this->trans_commit();
            }
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
            return $this->where('id', $id)->delete();
        }
        else{
            return false;
        }
    }

    /*
        Digunakan untuk memperoleh resep yang merupakan highlight, dengan parameter input limit resep yang ingin ditampilkan
    */
    function getHightlight($limit=10){
        $this->where('highlight', '1');
        $this->where('status', '1');
        $this->get($limit,0);
    }

    /*
        Digunakan untuk memperoleh resep yang merupakan terbaru, dengan parameter input limit resep yang ingin ditampilkan
    */
    function getRecently($limit=10){
        $this->where('status', '1')->order_by("create_date", "desc")->get($limit,0);
    }

    /*
        Digunakan untuk memperoleh resep yang merupakan resep dengan rating tertinggi, dengan parameter input limit resep yang ingin ditampilkan
    */
    function getTopRecipe($limit=10){
        $this->where('status', '1')->order_by("rating", "desc")->get($limit,0);
    }

    /*
        Digunakan untuk memperoleh resep-resep yang dimiliki oleh sebuah user.
    */
    function getUserRecipe($userId){
        $this->get_by_author($userId);
    }

    /*
        Digunakan untuk memperoleh profile sebuah resep. resep yang diperoleh harus berstatus publish atau yang melihat merupakan pemilik resep tersebut.
    */
    function getRecipeProfile($id=NULL, $user_id=NULL){
        if($id == NULL){
            $id = $this->id;
        }
        $this->get_by_id($id);
        if($this->status){
            return true;
        }
        else{
            if(empty($user_id) && $this->author==$user_id){
                $this->get_by_id($id);
                return true;
            }
            else{
                $this->get_by_id('0');
            }
            return false;
        }
    }

    /*
        Digunakan untuk memperoleh bahan-bahan yang digunakan oleh sebuah resep. tidak memiliki kembalian, hasil disimpan pada variabel ingredients
    */
    function getIngredients($id=NULL){
        if($id == NULL){
            $id = $this->id;
        }
        $ingredient = new Ingredient();
        $this->ingredients = $ingredient->get_where(array('recipe_id' => $id));
    }

    /*
        Digunakan untuk memperoleh step yang digunakan oleh sebuah resep. tidak memiliki kembalian, hasil disimpan pada variabel steps
    */
    function getSteps($id=NULL){
        if($id == NULL){
            $id = $this->id;
        }
        $step = new Step();
        $this->steps = $step->get_where(array('recipe_id' => $id));
    }

    /*
        Digunakan untuk memberikan rating pada sebuah resep. nilai kembalian merupakan boolean rating berhasil disimpan. bila telah ada maka akan dioverwrite
    */
    function saveRating($user_id, $value = 0){
        if(!empty($this->id) && !empty($user_id)){
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
                $rat->update('value', $value);
            }
            else{
                return $rat->skip_validation()->save();
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
        if(!empty($id) && !empty($status)){
            return $this->where('id', $id)->update('status', $status);
        }
        else{
            return false;
        }
    }

    /*
        Digunakan untuk menambahkan sebuah category pada sebuah resep
    */
    function addCategory($id=NULL, $category=NULL){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id) && !empty($category)){
            $categorytmp = new Category();
            $categorytmp->where('recipe_id', $id);
            $categorytmp->ilike('name', strtolower($category));
            $category = new Category();
            if(!$categorytmp->count() > 0){
                $category->recipe_id = $id;
                $category->name = strtolower($category);
                return $category->save();
            }
        }
        else{
            return false;
        }
    }

    /*
        Digunakan untuk menghapus sebuah category pada sebuah resep
    */
    function deleteCategory($id=NULL, $category=NULL){
        if($id==NULL){
            $id = $this->id;
        }
        if(!empty($id) && !empty($category)){
            $categorytmp = new Category();
            $categorytmp->where('recipe_id', $id);
            $categorytmp->ilike('name', strtolower($category));
            return $categorytmp->delete();
        }
        else{
            return false;
        }
    }
}

/* End of file recipe.php */
/* Location: ./application/models/recipe.php */