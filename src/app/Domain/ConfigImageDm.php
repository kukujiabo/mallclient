<?php
namespace App\Domain;

class ConfigImageDm {

  public function getList() {

    $data = array(
    
      'module' => 1,

      'type' => 1,

      'state' => 1
    
    );
  
    return \App\apiRequest('App.ConfigImage.GetList', $data);  
  
  }

}
