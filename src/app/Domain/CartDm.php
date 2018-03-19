<?php
namespace App\Domain;

/**
 * 购物车处理域
 *
 */
class CartDm {

  /**
   * 添加商品到购物车
   */
  public function addToCart($params) {
  
    $params['way'] = 1;
  
    return \App\apiRequest('App.CartTakeOut.Add', $params);
  
  }

  /**
   * 查询购物车列表
   */
  public function getList($params) {
  
    $params['way'] = 1;
  
    return \App\apiRequest('App.CartTakeOut.queryList', $params); 

  }

  /**
   * 更新购物车
   */
  public function updateCart($params) {
  
    $params['way'] = 1;
  
    return \App\apiRequest('App.CartTakeout.Update', $params);
  
  }

}
