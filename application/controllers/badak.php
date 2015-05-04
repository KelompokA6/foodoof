<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Badak extends CI_Controller {
  public function index($view = 'welcome_message')
  {
    $this->load->model('viewer');
    $this->viewer->show('recipe_view');
    // $this->output->enable_profiler(TRUE);
  }

  public function show($view)
  {
    $this->index($view);
  }

  public function tes($id = 1, $name = 'bebek')
  {
    echo "masuk tes--";
    // $this->user = new User();
    $this->load->model('user');
    $x = 1;
    $x = $this->user->updateProfile($id, array('name' => $name));
    echo $x ? "string" : "no";
  }

  public function updateharga()
  {
    $now = (new DateTime());
    $m = (int)$now->format("m");
    $y = $now->format("Y");
    # UPDATE DARI 2010 COBA -_-

    $all = [];
    foreach (range(1,13) as $i) {
      $sumber = "http://infopangan.jakarta.go.id/api/price/series_by_location?type=market&lid=$i&m=$m&y=$y";
      $data = json_decode(file_get_contents($sumber))->data;
      // ambil name sama average aja
      $data = array_map(function($x){
        return (object)["name"=>$x->name, "price"=>$x->average];
      }, $data);
      foreach ($data as $d) {
        $all[$d->name] = $d->price;
      }
      echo "$sumber -- OK\n";
    }

    $all = [];
    foreach (range(1,5) as $i) {
      $sumber = "http://infopangan.jakarta.go.id/api/price/series_by_location?type=city&lid=$i&m=$m&y=$y";
      $data = json_decode(file_get_contents($sumber))->data;
      // ambil name sama average aja
      $data = array_map(function($x){
        return (object)["name"=>$x->name, "price"=>$x->average];
      }, $data);
      foreach ($data as $d) {
        $all[$d->name] = $d->price;
      }
      echo "$sumber -- OK\n";
    }

    $catalog = new Catalog();
    foreach ($all as $name => $price) {
      $catalog->ins($name, "Rp/Kg", $price);
    }

    print_r(sizeof($all));
  }
}