<?php

class Catalog extends DataMapper {
  var $table = "catalogs";

  function __construct()
  {
    parent::__construct();
  }

  function addCatalog($name="", $units="", $quantity="", $price=0)
  {
    $this->name = $name;
    $this->units = $units;
    $this->quantity = $quantity;
    $this->price = $price;
    if($this->skip_validation()->save()){
      $this->clear();
      return true;
    }
    else{
      $this->clear();
      return false;
    }  
  }

  function updateCatalog($id=null, $name="", $units="", $quantity="", $price=0){
    if(empty($id)){
      $id=$this->$id;
    }
    if(!empty($id)){
      $this->where("id", $id);
      $data = array('name' => strtolower($name),
                    'units' => strtolower($units),
                    'quantity' => strtolower($quantity),
                    'price' => $price
              );
      if($this->update($data)){
        $this->clear();
        return true;
      }
      else{
       $this->clear();
        return false; 
      }
    }
    else{
      return false;
    }
  }

  function getCatalog(){
    $catalog = new Catalog();
    $arrResult = array();
    $catalog->get();
    foreach ($catalog as $catalogs){
      $data = new StdClass();
      $data->id = $catalogs->id;
      $data->name = $catalogs->name;
      $data->units = $catalogs->units;
      $data->quantity = $catalogs->quantity;
      $data->price = $catalogs->price;
      array_push($arrResult, $data);
    }
    return $arrResult;
  }
}