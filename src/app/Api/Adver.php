<?php
namespace App\Api;

/**
 * 广告位接口
 *
 *
 */
class Adver extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getDetail' => array(
      
        'token' => 'token|string|true||用户令牌',

        'id' => 'id|int|true||广告id'
      
      )
    
    ))
  
  }

  /**
   * 查询广告位详情
   * @decs 查询广告位详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));  
  
  }

}
