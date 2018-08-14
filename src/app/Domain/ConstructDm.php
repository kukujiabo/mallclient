<?php
namespace App\Domain;

class ConstructDm {

  public function getAll($data) {

    $data['get_attr'] = 1;
  
    return \App\apiRequest('App.ConstructType.GetAll', $data);  
  
  }

}
