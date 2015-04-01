<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_viewer extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('parser');
  }

  public function show($view, $data = array())
  {
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

  public function showProfile($profile)
  {
    // menubar
    $datacomplete['menubar'] = $this->session->userdata('user_id') > 0 ?
        $this->parser->parse(
            'menubar_login',
            array(
                'menubar_user_name' => $this->session->userdata('user_name'),
                'menubar_user_photo' => $this->session->userdata('user_photo'),
            ),
            TRUE
        ) : 
        $this->parser->parse('menubar', array(), TRUE);
    // DONE

    // content_website
    // template_content diambil dari template_user_view: butuh sidebar_user dan content_user
    // ambil sidebar
    $data_user_view['sidebar_user'] = $this->getSidebar($profile);
    // ambil content_user dari profile_view
    $data_user_view['content_user'] = $this->getContentUser($profile);
    // load template_content
    $datacomplete['content_website'] = $this->parser->parse('template_user_view', $data_user_view, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  public function showUserTimeline($profile, $listRecipes)
  {
    // menubar
    $datacomplete['menubar'] = $this->session->userdata('user_id') > 0 ?
        $this->parser->parse(
            'menubar_login',
            array(
                'menubar_user_name' => $this->session->userdata('user_name'),
                'menubar_user_photo' => $this->session->userdata('user_photo'),
            ),
            TRUE
        ) :
        $this->parser->parse('menubar', array(), TRUE);
    // DONE

    // content_website
    // template_content diambil dari template_user_view: butuh sidebar_user dan content_user
    // ambil sidebar
    $data_user_view['sidebar_user'] = $this->getSidebar($profile);
    // ambil content_user dari user_timeline_view
    foreach ($listRecipes as $row) {
        $row->user_timeline_recipe_id = $row->id;
        $row->user_timeline_recipe_photo = $row->photo;
        $row->user_timeline_recipe_name = $row->name;
        $row->user_timeline_recipe_last_update = $row->last_update;
        // $row->rating = $row->rating;
        $row->user_timeline_recipe_view = $row->views;
        $row->checked_status = $row->status ? "checked" : "";
    }

    $data_user_view['content_user'] = $this->parser->parse(
        'user_timeline_view',
        array(
            'user_timeline_recipe_entries' => $listRecipes,
        ),
        TRUE
    );

    // load template_content
    $datacomplete['content_website'] = $this->parser->parse('template_user_view', $data_user_view, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  public function showChangePassword($profile, $data = array())
  {
    // menubar
    $datacomplete['menubar'] = $this->parser->parse('menubar_login',
        array(
            'menubar_user_name' => $this->session->userdata('user_name'),
            'menubar_user_photo' => $this->session->userdata('user_photo'),
        ),
        TRUE
    );
    // DONE

    // content_website
    // template_content diambil dari template_user_view: butuh sidebar_user dan content_user
    // ambil sidebar
    $data_user_view['sidebar_user'] = $this->getSidebar($profile);
    // ambil content_user dari user_timeline_view
    $data_user_view['content_user'] = $this->parser->parse(
        'change_password_view',
        array(),
        TRUE
    );

    // load template_content
    $datacomplete['content_website'] = $this->parser->parse('template_user_view', $data_user_view, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  public function showRegister($data = array())
  {
    // menubar
    $datacomplete['menubar'] = $this->parser->parse('menubar', array(), TRUE);
    // DONE

    // content_website
    // ambil dari registration_view
    $datacomplete['content_website'] = $this->parser->parse('join_view', $data, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  public function showEditProfile($profile)
  {
    // menubar
    $datacomplete['menubar'] = $this->session->userdata('user_id') > 0 ?
        $this->parser->parse(
            'menubar_login',
            array(
                'menubar_user_name' => $this->session->userdata('user_name'),
                'menubar_user_photo' => $this->session->userdata('user_photo'),
            ),
            TRUE
        ) : 
        $this->parser->parse('menubar', array(), TRUE);
    // DONE

    // content_website
    // template_content diambil dari template_user_view: butuh sidebar_user dan content_user
    // ambil sidebar
    $data_user_view['sidebar_user'] = $this->getSidebar($profile);
    // ambil content_user dari profile_view
    $data_user_view['content_user'] = $this->getContentUser($profile);
    // load template_content
    $datacomplete['content_website'] = $this->parser->parse('template_user_view', $data_user_view, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  function showForgotPassword($data)
  {
    // menubar
    $datacomplete['menubar'] = $this->parser->parse('menubar', array(), TRUE);
    // DONE

    // content_website
    // ambil dari registration_view
    $datacomplete['content_website'] = $this->parser->parse('forget_password_view', $data, TRUE);

    // butuh menubar dan content_website
    $this->parser->parse('template_content', $datacomplete);
  }

  function getContentUser($profile)
  {
    return $this->parser->parse(
        'profile_view',
        array(
            'profile_user_name' => $profile->name,
            'profile_user_gender' => $profile->gender == 'm' ? 'male' : 'female',
            'profile_user_age' => (new DateTime())->diff(new DateTime($profile->bdate))->y,
            'profile_user_email' => $profile->email,
            'profile_user_phone' => $profile->phone,
            'profile_user_last_access' => $profile->last_access,
            'profile_user_twitter' => $profile->twitter,
            'profile_user_facebook' => $profile->facebook,
            'profile_user_googleplus' => $profile->googleplus,
            'profile_user_path' => $profile->path,
        ),
        TRUE
    );
  }

  function getSidebar($profile)
  {
    return $this->parser->parse(
        'sidebar_user_view',
        array(
            'sidebar_user_id' => $profile->id,
            'sidebar_user_photo' => $profile->photo ? $profile->photo : 'images/user/0.jpg',
        ),
        TRUE
    );
  }

}