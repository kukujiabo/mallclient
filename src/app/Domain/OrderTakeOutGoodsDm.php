<?php
namespace App\Domain;

class OrderTakeOutGoodsDm {

  public function getAll($params) {
  
    return \App\apiRequest('App.OrderTakeOutGoods.GetAll',$params);
  
  }

}
