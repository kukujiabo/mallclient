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
  
    $params['order_status'] = 4;

    $params['sign_time'] = date('Y-m-d H:i:s');

    return \App\apiRequest('App.OrderTakeOut.Update', $params);
  
  }

  public function orderAfterSale($params) {
  
    return \App\apiRequest('App.OrderTakeOut.OrderAfterSale', $params); 
  
  }

  public function cancelOrder($params) {
  
    return \App\apiRequest('App.OrderTakeOut.CancelOrder', $params);
  
  }

  public function getOrderNum($params) {
  
    return \App\apiRequest('App.OrderTakeOut.GetOrderNum', $params);
  
  }

  public function getTransFirstLocation($params) {
  
    return \App\apiRequest('App.OrderTakeOut.GetTransFirstLocation', $params);
  
  }

  public function getOrderAddress($params) {
  
    return \App\apiRequest('App.OrderTakeOutAddress.GetDetail', $params);
  
  }

}
