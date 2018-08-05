<?php
namespace App\Domain;

class HotGoodsDm {

  public function getList($data) {
  
    return \App\apiRequest('App.HotGoods.GetList',$data);
  
  }

}
