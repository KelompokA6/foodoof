<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewer extends CI_Model
{
  public function show($view, $data = array())
  {
    $this->load->library('parser');
    $this->load->library('session');

    // buat judul. kalau gak dikasih tau, tulis aja judulnya Foodoof
    $datafinal['title'] = @$data['title'] ? $data['title'] : 'FoodooF';

    // load css tema 1 (t1) apa tema 2 (t2)? default t1 ya...
    $data['theme'] = $this->session->userdata('theme');
    if($data['theme'] === FALSE) $data['theme'] = 't1';
    $datafinal['css'] = $this->parser->parse('css', $data, TRUE);

    // sudah login? load menubar apa menubar_login?
    $hasLogin = $this->session->userdata('login_status');
    $datafinal['menubar'] = $this->parser->parse($hasLogin ? 'menubar_login' : 'menubar', $data, TRUE);

    // konten utama. misal home_view, user_timeline_view, dll.
    // tolong ini dibuat 1 file php aja yang isinya sidebar sama bagian tengahnya. oke?
    $datafinal['content'] = $this->parser->parse($view, $data, TRUE);

    // js di-load di akhir aja gpp. (katanya "best practice" di bootstrap)
    $datafinal['js'] = $this->parser->parse('js', $data, TRUE);

    // oke, sudah semua? LOAD!
    $this->parser->parse('final_view', $datafinal);
  }

  public function showProfile($data = array())
  {
    $this->load->library('parser');
    $this->load->library('session');
    $category_home = $this->parser->parse('category_home', $data, TRUE);
    $top_recipe_home = $this->parser->parse('top_recipe_home', $data, TRUE);
    $recently_recipe_home = $this->parser->parse('recently_recipe_home', $data, TRUE);
    $data= array(
                    "category_home"=> $category_home,
                    "top_recipe_home"=> $top_recipe_home,
                    "recently_recipe_home"=> $recently_recipe_home,
                    );
    $content_website = $this->parser->parse('content_homepage', $data, TRUE);
    $datacomplete = array(
                    "menubar"=> $menubar,
                    "content_website"=> $content_website,
                    );
    $this->parser->parse('template_content', $datacomplete);
  }
}