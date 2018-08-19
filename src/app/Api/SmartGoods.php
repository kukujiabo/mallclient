<?php
namespace App\Api;

/**
 * 智能下单商品接口
 *
 */
class SmartGoods extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getGoods' => array(

        'token' => 'token|string|false||用户令牌',
      
        'sid' => 'sid|int|true||样式id',

        'measure' => 'measure|int|true||面积',
      
        'selectAttr' => 'selectAttr|string|true||选择属性',

        'layoutIds' => 'layoutIds|string|true||布局id'
      
      )
    
    )); 
  
  }

  /**
   * 查询智能下单模版商品
   * @desc 查询智能下单模版商品
   *
   * @return array list
   */
  public function getGoods() {
  
    return $this->dm->getGoods($this->retriveRuleParams(__FUNCTION__));
  
  }

}
