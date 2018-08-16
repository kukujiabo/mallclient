<?php
namespace App\Api;

/**
 * 项目经理接口
 *
 */
class ManagerWorkspace extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getManagerInfo' => array(
      
        'token' => 'token|string|true||用户令牌'
      
      )
    
    )); 
  
  }

  /**
   * 查询项目经理信息
   * @desc 查询项目经理信息
   *
   * @return 
   */
  public function getManagerInfo() {
  
    return $this->dm->getManagerInfo($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
