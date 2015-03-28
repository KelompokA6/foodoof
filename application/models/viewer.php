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
    
    // menubar
    $datacomplete['menubar'] = $this->parser->parse(
        $this->session->userdata('login_status') ? 'menubar_login' : 'menubar',
        array('menubar_user_name' => $data['name']),
        TRUE
    );
    // DONE

    // content_website
    // template_content diambil dari template_user_view: butuh sidebar_user dan content_user
    // ambil sidebar
    $data_user_view['sidebar_user'] = $this->parser->parse(
        'sidebar_user_view',
        array('sidebar_user_id' => $data['id']),
        TRUE
    );
    // ambil content_user
    $data_user_view['content_user'] = $this->parser->parse(
        'profile_view',
        array(
            'profile_user_name' => $data['name'],
            'profile_user_gender' => $data['gender'],
            // 'profile_user_age' => $data['age'],
            'profile_user_email' => $data['email'],
            'profile_user_phone' => $data['phone'],
            'profile_user_last_access' => $data['last_access'],
            // 'profile_user_twitter' => $data['twitter'],
            // 'profile_user_facebook' => $data['facebook'],
            // 'profile_user_googleplus' => $data['googleplus'],
            // 'profile_user_path' => $data['path'],
        ),
        TRUE
    );
    // load template_content
    // $datacomplete['content_website'] = $this->parser->parse('template_user_view', $data_user_view, TRUE);
    $datacomplete['content_website'] = $data_user_view['sidebar_user'].$data_user_view['content_user'];

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }
}