<?php
namespace App\Domain;

class HouseLayoutDm {

  public function create($data) {
  
    return \App\apiRequest('App.HouseLayout.Create', $data); 
  
  }

  public function getAll($data) {
  
    $data['get_attr'] = 1;

    return \App\apiRequest('App.HouseLayout.GetAll', $data); 
  
  }

}
