<?php
namespace App\Api;

/**
 * 系统配置图片接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-01
 */
class ConfigImage extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getList' => array(
      
        'city_code' => 'city_code|string|false||城市编码'
      
      )
    
    ));
  
  }

  /**
   * 查询首页广告图列表
   * @desc 查询首页广告图列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));  
  
  }


}
