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
  	/*print_r($listTopRecipe);
  	print_r($listHightlight);
  	print_r($listRecently);
    die;*/

    foreach ($listTopRecipe as $row) {
      $row['recently_recipe_id'] = $row['id'];
      $row['recently_recipe_photo'] = $row['photo'];
      $row['recently_recipe_name'] = $row['name'];
      $row['recently_recipe_author'] = $row['author'];
      $row['recently_recipe_author_name'] = $row['author_name'];
    }
    $datatop['top_recipe_entries'] = $listTopRecipe;

  	$datacomplete['menubar'] = $this->getMenubar();

  	// content_homepage butuh: carousel_highlight, top_recipe_home, recently_recipe_home, dan category_home
  	$data_content_homepage['carousel_highlight'] = $this->parser->parse('carousel_highlight', array(), TRUE);
  	$data_content_homepage['top_recipe_home'] = $this->parser->parse('top_recipe_home', array(), TRUE);
  	$data_content_homepage['recently_recipe_home'] = $this->parser->parse('recently_recipe_home', array(), TRUE);
  	$data_content_homepage['category_home'] = $this->parser->parse('category_home', array(), TRUE);

  	// load content_website, isinya dari content_homepage
    $datacomplete['content_website'] = $this->parser->parse('content_homepage', $data_content_homepage, TRUE);

  	// butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  function showLogin($data)
  {
    $data['menubar'] = $this->getMenubar();
    $data['content_website'] = $this->parser->parse('login_view', $data, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $data);
  }

  function getMenubar()
  {
  	return $this->session->userdata('user_id') > 0 ?
        $this->parser->parse(
            'menubar_login',
            array(
                'menubar_user_name' => $this->session->userdata('user_name'),
                'menubar_user_photo' => $this->session->userdata('user_photo'),
            ),
            TRUE
        ) : 
        $this->parser->parse('menubar', array(), TRUE);
  }
}