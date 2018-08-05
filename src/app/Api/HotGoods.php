<?php
namespace App\Api;

/**
 * 爆款商品接口
 *
 */
class HotGoods extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getList' => array(
      
        'city_code' => 'city_code|string|true||城市编码',
        'page' => 'page|int|false|1|页码|',
        'page_size' => 'page_size|int|false||每页条数',
      
      )
    
    )); 
  
  }


  /**
   * 查询城市爆款
   * @desc 查询城市爆款
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
