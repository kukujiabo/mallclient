<?php
namespace App\Domain;

class SmartGoodsDm {

  public function getGoods($data) {
  
    return \App\apiRequest('App.SmartTemplate.GetGoods', $data);
  
  }

}
