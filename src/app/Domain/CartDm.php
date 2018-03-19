<?php
namespace App\Domain;

/**
 * 购物车处理域
 *
 */
class CartDm {

  /**
   * 添加商品到购物车
   *
   */
  public function addToCart($params) {
  
    $params['way'] = 1;
  
    return \App\apiRequest('App.CartTakeOut.Add', $params);
  
  }

}
