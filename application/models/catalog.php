<?php

class Catalog extends DataMapper {
  var $table = "catalogs";

  /*function __construct($data)
  {
    parent::__construct();
    $this->name = $data->name;
    $this->units = $data->units;
    $this->price = $data->price;
  }*/

  function ins($name, $units, $price)
  {
    $this->where("name", $name)->where("units", $units);
    if($this->count() > 0)
    {
      $this->where("name", $name)->where("units", $units)->update("price", $price);
    } else {
      $this->name = $name;
      $this->units = $units;
      $this->price = $price;
      $this->save();
    }
  }
}