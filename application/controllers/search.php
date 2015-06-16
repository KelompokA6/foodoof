<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url'));
    $this->load->library(array('session'));
    $this->load->model(array('home_viewer'));
  }

  /*
    digunakan untuk menampilkan pencarian resep maupun akun
  */
  public function index()
  {
    # ?q=&searchby=on
    $q = ($this->input->get('q'));
    $q2 = $this->db->escape_str($q);
    $searchby = $this->input->get('searchby');
    if(!empty(($this->input->get('ex2')))){
      $cat = ($this->input->get('ex2'));
    } else {
      $cat = NULL;
    }
    // $cat = ($this->input->get('ex2'));
    // echo "$searchby";
    // echo "$cat";
    // echo "$q";
    // die();
    if (@$q && @$searchby) {
      $q = urldecode($q);
      $page = $this->input->get('page');
      if ($page === FALSE) $page = 1;
      $limit = 10;
      $r = new Recipe_model();
      $u = new User_model();

      if ($searchby == 'title') {
        $result = $r->searchRecipeByTitle($q2, $limit, $limit * $page - $limit, $cat);
        $this->show_search_by_title($q, $result['recipe_list'], ceil($result['total']/$limit), $page, $result['total'], $cat);
      } elseif ($searchby == 'ingredient') {
        $qs = array_map(function($x){return trim($x);}, explode(",", $q2));
        $result = $r->searchRecipeByIngredients($qs, 0.3, $limit, $limit * $page - $limit,$cat);
        // print_r($result); die();
        $this->show_search_by_ingredient($q, $result['recipe_list'], ceil($result['total']/$limit), $page, $result['total'], $cat);
      } else {
        $q2 = str_replace("*", "", $q2);
        $temp = $u->searchAccountByName($q2, $limit, $limit * $page - $limit);
        $result['account_list'] = $temp;
        $result['total'] = sizeof($u->searchAccountByName($q2,1000000));
        $this->show_search_by_account($q, $result['account_list'], ceil($result['total']/$limit), $page, $result['total']);
      }
    }else redirect(base_url());
  }

  /*
    digunakan untuk menampilkan pencarian resep berdasarkan judul
  */
  private function show_search_by_title($key, $list_recipe, $total, $pagenow, $countall, $cat)
  {
    $datalist['search_by_title_recipe_result'] = $countall;
    $datalist['search_by_title_recipe_key'] = htmlspecialchars($key);
    $datalist['search_by_title_recipe_page_size'] = $total;
    $datalist['search_by_title_recipe_page_now'] = $pagenow;
    $datalist['search_by_title_recipe_category'] = $cat;
    $u = new User_model();
    foreach ($list_recipe as $row) {
      $row->search_by_title_recipe_id = $row->id;
      $row->search_by_title_recipe_photo = $row->photo;
      $row->search_by_title_recipe_name = $row->name;
      $row->search_by_title_recipe_rating = $row->rating;
      $row->search_by_title_recipe_author_id = $row->author;
      $u->get_by_id($row->author);
      $row->search_by_title_recipe_author_name = $u->name;
      $row->search_by_title_recipe_author_photo = $u->photo;
      $row->search_by_title_recipe_views = $row->views;
      $row->search_by_title_recipe_last_update = strftime("%c", strtotime($row->last_update));
    }
    $list_recipe = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $list_recipe);
    $datalist['search_by_title_recipe_entries'] = $list_recipe;

    $datacomplete['menubar'] = $this->home_viewer->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('search_by_title_view', $datalist, TRUE);
    $r = new Recipe_model();
    $countCat = $r->getCountEachCategory();
    foreach ($countCat as $row) {
      $str = "category_".str_replace(" ", "_", $row->name)."_count";
      $dataCat[$str] = $row->count;
    }
    $data_content_homepage['category_home'] = $this->parser->parse('category_home', $dataCat, TRUE);

    // load content_website, isinya dari content_homepage
    $datacomplete['content_website'] = $this->parser->parse('content_search', $data_content_homepage, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  /*
    digunakan untuk menampilkan pencarian resep berdasarkan bahan
  */
  private function show_search_by_ingredient($key, $list_recipe, $total, $pagenow, $countall, $cat)
  {
    $datalist['search_by_ingredient_recipe_result'] = $countall;
    $datalist['search_by_ingredient_recipe_key'] = htmlspecialchars($key);
    $datalist['search_by_ingredient_recipe_page_size'] = $total;
    $datalist['search_by_ingredient_recipe_page_now'] = $pagenow;
    $datalist['search_by_title_recipe_category'] = $cat;
    $u = new User_model();
    foreach ($list_recipe as $row) {
      $row->search_by_ingredient_recipe_id = $row->id;
      $row->search_by_ingredient_recipe_photo = $row->photo;
      $row->search_by_ingredient_recipe_name = htmlspecialchars($row->name);
      $row->search_by_ingredient_recipe_rating = $row->rating;
      $row->search_by_ingredient_recipe_author_id = $row->author;
      $u->get_by_id($row->author);
      $row->search_by_ingredient_recipe_author_name = htmlspecialchars($u->name);
      $row->search_by_ingredient_recipe_author_photo = $u->photo;
      $row->search_by_ingredient_recipe_views = $row->views;
      $row->search_by_ingredient_recipe_last_update = strftime("%c", strtotime($row->last_update));
      $row->search_by_ingredient_recipe_found = htmlspecialchars(implode(", ", $row->found_ingredient));
    }
    //$list_recipe = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $list_recipe);
    $datalist['search_by_ingredient_recipe_entries'] = $list_recipe;

    $datacomplete['menubar'] = $this->home_viewer->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('search_by_ingredient_view', $datalist, TRUE);
    $r = new Recipe_model();
    $countCat = $r->getCountEachCategory();
    foreach ($countCat as $row) {
      $str = "category_".str_replace(" ", "_", $row->name)."_count";
      $dataCat[$str] = $row->count;
    }
    $data_content_homepage['category_home'] = $this->parser->parse('category_home', $dataCat, TRUE);

    // load content_website, isinya dari content_homepage
    $datacomplete['content_website'] = $this->parser->parse('content_search', $data_content_homepage, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  /*
    digunakan untuk menampilkan pencarian akun
  */
  private function show_search_by_account($key, $list_account, $total, $pagenow, $countall)
  {
    $datalist['search_by_account_result'] = $countall;
    $datalist['search_by_account_key'] = htmlspecialchars($key);
    $datalist['search_by_account_page_size'] = $total;
    $datalist['search_by_account_page_now'] = $pagenow;
    foreach ($list_account as $row) {
      $row->search_by_account_id = $row->id;
      $row->search_by_account_photo = $row->photo;
      $row->search_by_account_name = $row->name;
      $row->search_by_account_gender = $row->gender;
      $row->search_by_account_age = $row->bdate == '1970-01-01' ? '' : (new DateTime())->diff(new DateTime($row->bdate))->y . " years old";
    }
    $list_account = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $list_account);
    $datalist['search_by_account_entries'] = $list_account;

    $datacomplete['menubar'] = $this->home_viewer->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('search_by_account_view', $datalist, TRUE);
    $r = new Recipe_model();
    $countCat = $r->getCountEachCategory();
    foreach ($countCat as $row) {
      $str = "category_".str_replace(" ", "_", $row->name)."_count";
      $dataCat[$str] = $row->count;
    }
    $data_content_homepage['category_home'] = $this->parser->parse('category_home', $dataCat, TRUE);

    // load content_website, isinya dari content_homepage
    $datacomplete['content_website'] = $this->parser->parse('content_search', $data_content_homepage, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

}