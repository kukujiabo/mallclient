<?php
namespace App\Domain;

class OrderDm {

  public function getOrderDetail($params) {
  
    return \App\apiRequest('App.OrderTakeOut.GetDetail', $params);
  
  }

  public function orderList($params) {
  
    return \App\apiRequest('App.OrderTakeOut.OrderList', $params);
  
  }

  public function rebuyOrder($params) {
  
    return \App\apiRequest('App.OrderTakeOut.RebuyOrder', $params); 
  
  }

}
