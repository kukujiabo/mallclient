<?php
namespace App\Domain;

class OrderDm {

  public function getOrderDetail($params) {
  
    return \App\apiRequest('App.OrderTakeOut.GetDetail', $params);
  
  }

}
