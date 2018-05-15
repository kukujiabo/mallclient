<?php
namespace App\Api;

/**
 * 工地接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class Workspace extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getList' => array(

        'token' => 'token|string|true||用户令牌',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|页码'
      
      ) 
    
    )); 
  
  }

  /**
   * 获取工地列表接口
   * @desc 获取工地列表接口
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
