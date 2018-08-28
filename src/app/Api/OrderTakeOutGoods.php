<?php
namespace App\Api;

/**
 * 订单商品接口
 *
 * @author Meroc Chen
 */
class OrderTakeOutGoods extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getAll' => array(
      
        'order_take_out_id' => 'order_take_out_id|int|true||订单id'
      
      ),

      'batchReturnGoods' => array(
      
        'order_take_out_id' => 'order_take_out_id|int|true||订单id',

        'goods_id' => 'goods_id|string|true||商品id',

        'num' => 'num|string|true||商品数量'
      
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

  /**
   * 批量退货
   * @desc 批量退货
   *
   * @return int num
   */ 
  public function batchReturnGoods() {
  
    return $this->dm->batchReturnGoods($this->retriveRuleParams(__FUNCTION__));
  
  }

}
