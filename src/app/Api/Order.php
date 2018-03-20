<?php
namespace App\Api;

/**
 * 订单相关接口
 * @desc 订单相关接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class Order extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getOrderDetail' => array(
      
        'token' => 'token|string|true||用户令牌',

        'order_id' => 'order_id|string|true||用户订单号'
      
      )
    
    ));
  
  }

  /**
   * 获取用户订单详情
   * @desc 获取用户订单详情
   *
   * @return int
   */
  public function getOrderDetail() {
  
    return $this->dm->getOrderDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

}
