<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url'));
    $this->load->library(array('session'));
    $this->load->model(array('home_viewer'));
  }

  public function index()
  {
    # ?q=&searchby=on
    $q = $this->input->get('q');
    $searchby = $this->input->get('searchby');
    if (@$q && @$searchby) {
      $q = urldecode($q);
      $page = $this->input->get('page');
      if ($page === FALSE) $page = 1;
      $limit = 2;
      $r = new Recipe_model();
      $u = new Recipe_model();

      if ($searchby == 'title') {
        $result = $r->searchRecipeByTitle($q, $limit, $limit * $page - $limit);
        $this->show_search_by_title($q, $result['recipe_list'], ceil($result['total']/$limit), $page);
      } elseif ($searchby == 'ingredient') {
        $qs = array_map(function($x){return trim($x);}, explode(",", $q));
        $result = $r->searchRecipeByIngredients($qs, 0.3, $limit, $limit * $page - $limit);
        // print_r($result); die();
        $this->show_search_by_ingredient($q, $result['recipe_list'], ceil($result['total']/$limit), $page);
      } else {
        $result = $u->searchAccountByName($q, $limit, $limit * $page - $limit);
        $this->show_search_by_account($q, $result['account_list'], ceil($result['total']/$limit), $page);
      }
    }else redirect(base_url());
  }

  private function show_search_by_title($key, $list_recipe, $total, $pagenow)
  {
    $datalist['search_by_title_recipe_result'] = sizeof($list_recipe);
    $datalist['search_by_title_recipe_key'] = $key;
    $datalist['search_by_title_recipe_page_size'] = $total;
    $datalist['search_by_title_recipe_page_now'] = $pagenow;
    $u = new User_model();
    foreach ($list_recipe as $row) {
      $row->search_by_title_recipe_id = $row->id;
      $row->search_by_title_recipe_photo = $row->photo;
      $row->search_by_title_recipe_name = $row->name;
      $row->search_by_title_recipe_rating = $row->rating;
      $row->search_by_title_recipe_author_id = $row->author;
      $u->get_by_id($row->author);
      $row->search_by_title_recipe_author_name = $u->name;
      $row->search_by_title_recipe_views = $row->views;
      $row->search_by_title_recipe_last_update = strftime("%c", strtotime($row->last_update));
    }
    $datalist['search_by_title_recipe_entries'] = $list_recipe;

    $datacomplete['menubar'] = $this->home_viewer->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('search_by_title_view', $datalist, TRUE);
    $data_content_homepage['category_home'] = $this->parser->parse('category_home', array(), TRUE);

    // load content_website, isinya dari content_homepage
    $datacomplete['content_website'] = $this->parser->parse('content_search', $data_content_homepage, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  private function show_search_by_ingredient($key, $list_recipe, $total, $pagenow)
  {
    $datalist['search_by_ingredient_recipe_result'] = sizeof($list_recipe);
    $datalist['search_by_ingredient_recipe_key'] = $key;
    $datalist['search_by_ingredient_recipe_page_size'] = $total;
    $datalist['search_by_ingredient_recipe_page_now'] = $pagenow;
    $u = new User_model();
    foreach ($list_recipe as $row) {
      $row->search_by_ingredient_recipe_id = $row->id;
      $row->search_by_ingredient_recipe_photo = $row->photo;
      $row->search_by_ingredient_recipe_name = $row->name;
      $row->search_by_ingredient_recipe_rating = $row->rating;
      $row->search_by_ingredient_recipe_author_id = $row->author;
      $u->get_by_id($row->author);
      $row->search_by_ingredient_recipe_author_name = $u->name;
      $row->search_by_ingredient_recipe_views = $row->views;
      $row->search_by_ingredient_recipe_last_update = strftime("%c", strtotime($row->last_update));
    }
    $datalist['search_by_ingredient_recipe_entries'] = $list_recipe;

    $datacomplete['menubar'] = $this->home_viewer->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('search_by_ingredient_view', $datalist, TRUE);
    $data_content_homepage['category_home'] = $this->parser->parse('category_home', array(), TRUE);

    // load content_website, isinya dari content_homepage
    $datacomplete['content_website'] = $this->parser->parse('content_search', $data_content_homepage, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  private function show_search_by_account($key, $list_account, $total, $pagenow)
  {
    $datalist['search_by_account_result'] = sizeof($list_account);
    $datalist['search_by_account_key'] = $key;
    $datalist['search_by_account_page_size'] = $total;
    $datalist['search_by_account_page_now'] = $pagenow;
    foreach ($list_account as $row) {
      $row->search_by_account_id = $row->id;
      $row->search_by_account_photo = $row->photo;
      $row->search_by_account_name = $row->name;
      $row->search_by_account_gender = $row->gender;
      $row->search_by_account_age = (new DateTime())->diff(new DateTime($row->bdate))->y,;
    }
    $datalist['search_by_account_entries'] = $list_account;

    $datacomplete['menubar'] = $this->home_viewer->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('search_by_account_view', $datalist, TRUE);
    $data_content_homepage['category_home'] = $this->parser->parse('category_home', array(), TRUE);

    // load content_website, isinya dari content_homepage
    $datacomplete['content_website'] = $this->parser->parse('content_search', $data_content_homepage, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

}