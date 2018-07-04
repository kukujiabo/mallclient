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
      
      ),

      'orderList' => array(
      
        'token' => 'token|string|true||用户令牌',

        'keyword' => 'keyword|string|true||关键字',

        'order_status' => 'order_status|int|false||订单状态',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|100|每页条数'
      
      ),

      'rebuyOrder' => array(
      
        'token' => 'token|string|true||用户令牌',

        'city_code' => 'city_code|int|true||城市编码',
      
        'order_id' => 'order_id|string|true||用户订单id'
      
      ),

      'removeOrder' => array(
      
        'token' => 'token|string|true||用户令牌',
        'order_id' => 'order_id|string|true||用户订单id'
      
      ),

      'orderReceived' => array(
      
        'token' => 'token|string|true||用户令牌',
        'order_id' => 'order_id|string|true||订单编号'
      
      ),

      'orderAfterSale' => array(
      
        'token' => 'token|string|true||用户令牌',
        'sn' => 'sn|string|true||订单编号',
        'sku_id' => 'sku_id|int|true||skuid',
        'num' => 'num|int|true||数量'
      
      ),

      'cancelOrder' => array(
      
        'token' => 'token|string|true||用户令牌', 
        'sn' => 'sn|string|true||订单编号', 
        'comment' => 'comment|string|true||备注'
      
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

  /**
   * 获取用户订单列表
   * @desc 获取用户订单列表
   *
   * @return list
   */
  public function orderList() {
  
    return $this->dm->orderList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 重新下单
   * @desc 重新下单
   *
   * @return
   */
  public function rebuyOrder() {
  
    return $this->dm->rebuyOrder($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 删除订单
   * @desc 删除订单
   *
   * @return
   */
  public function removeOrder() {
  
    return $this->dm->removeOrder($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 签收订单
   * @desc 签收订单
   *
   * @return 
   */
  public function orderReceived() {
  
    return $this->dm->orderReceived($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 售后服务
   * @desc 售后服务
   *
   * @return
   */
  public function orderAfterSale() {
  
    return $this->dm->orderAfterSale($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 取消订单
   * @desc 取消订单
   *
   * @return 
   */
  public function cancelOrder() {
  
    return $this->dm->canceOrder($this->retriveRuleParams(__FUNCTION__));  
  
  }

}
