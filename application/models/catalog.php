<?php

class Catalog extends DataMapper {
  var $table = "catalogs";

  function __construct()
  {
    parent::__construct();
  }

  function addCatalog($name, $quantity, $units, $price)
  {
    $this->name = $name;
    $this->quantity = $quantity;
    $this->units = $units;
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

  function updateCatalog($id=null, $name="", $quantity="", $units="", $price=0){
    if(empty($id)){
      $id=$this->$id;
    }
    if(!empty($id)){
      $this->where("id", $id);
      $data = array('name' => strtolower($name),
                    'units' => strtolower($units),
                    'price' => $price,
                    'quantity' => strtolower($quantity)
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
      $data->quantity = $catalogs->quantity;
      $data->units = $catalogs->units;
      $data->price = $catalogs->price;
      array_push($arrResult, $data);
    }
    return $arrResult;
  }
}