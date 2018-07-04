<?php
namespace App\Api;

/**
 * 订单商品
 *
 * @author Meroc Chen
 */
class OrderTakeOutGood extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getAll' => array(
      
        'order_take_out_id' => 'order_take_out_id|int|true||订单id'
      
      )
    
    ));
  
  }

  /**
   * 查询所有商品
   * @desc 查询所有商品
   *
   * @return
   */
  public function getAll() {
  
    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));
  
  }

}
