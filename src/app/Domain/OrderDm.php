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

  public function removeOrder($params) {
  
    return \App\apiRequest('App.OrderTakeOut.RemoveOrder', $params); 
  
  }

  public function orderReceived($params) {
  
    $params['order_statsu'] = 4;

    $params['sign_time'] = date('Y-m-d H:i:s');

    return \App\apiRequest('App.OrderTakeOut.Update', $params);
  
  }

}
