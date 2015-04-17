<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_viewer extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('parser');
  }

  function showHome($listTopRecipe, $listHightlight, $listRecently)
  {
    foreach ($listHightlight as $key => $value) {
      $value->num = $key;
    }
    if(@$listHightlight[0]) $listHightlight[0]->isactive = "active";

    foreach ($listTopRecipe as $row) {
      $row->top_recipe_id = $row->id;
      $row->top_recipe_photo = $row->photo;
      $row->top_recipe_name = $row->name;
      $row->top_recipe_author = $row->author;
      $row->top_recipe_author_name = $row->author_name;
      $row->top_recipe_views = $row->views;
      $row->top_recipe_rating = $row->rating;
    }

    foreach ($listRecently as $row) {
      $row->recently_recipe_id = $row->id;
      $row->recently_recipe_photo = $row->photo;
      $row->recently_recipe_name = $row->name;
      $row->recently_recipe_author = $row->author;
      $row->recently_recipe_author_name = $row->author_name;
      $row->recently_recipe_create_date = strftime("%c", strtotime($row->create_date));
    }
  	/*print_r($listTopRecipe);
  	print_r($listHightlight);
  	print_r($listRecently);
    die;*/
    $listHightlight = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $listHightlight);
    $listTopRecipe = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $listTopRecipe);
    $listRecently = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $listRecently);
    $datalist['list_recipes1'] = $listHightlight;
    $datalist['list_recipes2'] = $listHightlight;
    // print_r($listHightlight); die();
    $datalist['top_recipe_entries'] = $listTopRecipe;
    $datalist['recently_recipe_entries'] = $listRecently;

    $datacomplete['menubar'] = $this->getMenubar();

    // content_homepage butuh: carousel_highlight, top_recipe_home, recently_recipe_home, dan category_home
    $data_content_homepage['carousel_highlight'] = $this->parser->parse('carousel_highlight', $datalist, TRUE);
    $data_content_homepage['top_recipe_home'] = $this->parser->parse('top_recipe_home', $datalist, TRUE);
    $data_content_homepage['recently_recipe_home'] = $this->parser->parse('recently_recipe_home', $datalist, TRUE);
    $r = new Recipe_model();
    $countCat = $r->getCountEachCategory();
    foreach ($countCat as $row) {
      $str = "category_".str_replace(" ", "_", $row->name)."_count";
      $dataCat[$str] = $row->count;
    }
    $data_content_homepage['category_home'] = $this->parser->parse('category_home', $dataCat, TRUE);

    // load content_website, isinya dari content_homepage
    $datacomplete['content_website'] = $this->parser->parse('content_homepage', $data_content_homepage, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  function showHighlight($listHightlight)
  {
    $datalist['highlight_recipe_result'] = sizeof($listHightlight);
    $datalist['highlight_recipe_key'] = 'Highlight Recipes';
    $datalist['highlight_recipe_page_size'] = 0;
    $datalist['highlight_recipe_page_now'] = 1;
    foreach ($listHightlight as $row) {
      $row->highlight_recipe_id = $row->id;
      $row->highlight_recipe_photo = $row->photo;
      $row->highlight_recipe_name = $row->name;
      $row->highlight_recipe_rating = $row->rating;
      $row->highlight_recipe_author_id = $row->author;
      $row->highlight_recipe_author_name = $row->author_name;
      $row->highlight_recipe_views = $row->views;
      $row->highlight_recipe_last_update = strftime("%c", strtotime($row->last_update));
    }
    $listHightlight = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $listHightlight);
    $datalist['highlight_recipe_entries'] = $listHightlight;

    $datacomplete['menubar'] = $this->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('highlight_view', $datalist, TRUE);
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

  function showTop($listTopRecipe)
  {
    $datalist['top_recipe_result'] = sizeof($listTopRecipe);
    $datalist['top_recipe_key'] = 'Top Recipes';
    $datalist['top_recipe_page_size'] = 0;
    $datalist['top_recipe_page_now'] = 1;
    foreach ($listTopRecipe as $row) {
      $row->top_recipe_id = $row->id;
      $row->top_recipe_photo = $row->photo;
      $row->top_recipe_name = $row->name;
      $row->top_recipe_rating = $row->rating;
      $row->top_recipe_author_id = $row->author;
      $row->top_recipe_author_name = $row->author_name;
      $row->top_recipe_views = $row->views;
      $row->top_recipe_last_update = strftime("%c", strtotime($row->last_update));
    }
    $listTopRecipe = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $listTopRecipe);
    $datalist['top_recipe_entries'] = $listTopRecipe;

    $datacomplete['menubar'] = $this->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('top_recipe_view', $datalist, TRUE);
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

  function showRecently($listRecently)
  {
    $datalist['recently_recipe_result'] = sizeof($listRecently);
    $datalist['recently_recipe_key'] = 'Recently Recipes';
    $datalist['recently_recipe_page_size'] = 0;
    $datalist['recently_recipe_page_now'] = 1;
    foreach ($listRecently as $row) {
      $row->recently_recipe_id = $row->id;
      $row->recently_recipe_photo = $row->photo;
      $row->recently_recipe_name = $row->name;
      $row->recently_recipe_rating = $row->rating;
      $row->recently_recipe_author_id = $row->author;
      $row->recently_recipe_author_name = $row->author_name;
      $row->recently_recipe_views = $row->views;
      $row->recently_recipe_last_update = strftime("%c", strtotime($row->last_update));
    }
    $listRecently = array_map(function($row){return $row = (object)array_map("htmlspecialchars", (array)$row);}, $listRecently);
    $datalist['recently_recipe_entries'] = $listRecently;

    $datacomplete['menubar'] = $this->getMenubar();

    $data_content_homepage['content_search'] = $this->parser->parse('recently_recipe_view', $datalist, TRUE);
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

  function showLogin($data)
  {
    $data['menubar'] = $this->getMenubar();
    // $data = array_map("htmlspecialchars", $data);
    $data['content_website'] = $this->parser->parse('login_view', $data, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $data);
  }

  function getMenubar()
  {
    $this->load->helper('text');
    if($this->session->userdata('user_id') > 0) {
        $oneword = explode(" ", $this->session->userdata('user_name'))[0];
        if (strlen($oneword) > 7) $oneword = ellipsize($oneword, 8, 1);
        return $this->parser->parse(
            'menubar_login',
            array(
                'menubar_user_name' =>  htmlspecialchars($oneword),
                'menubar_user_photo' => $this->session->userdata('user_photo'),
            ),
            TRUE
        );
    } else return $this->parser->parse('menubar', array(), TRUE);
  }
}