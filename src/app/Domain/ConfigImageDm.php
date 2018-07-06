<?php
namespace App\Domain;

class ConfigImageDm {

  public function getList($data) {

    $data['module'] = 1;

    $data['type'] = 1;

    $data['state'] = 1;
  
    return \App\apiRequest('App.ConfigImage.GetList', $data);  
  
  }

}
