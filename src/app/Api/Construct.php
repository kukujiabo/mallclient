<?php
namespace App\Api;

/**
 * 住房施工阶段接口
 *
 */
class Construct extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getAll' => array(
      
        'token' => 'token|string|true||用户令牌'
      
      ) 
    
    ));  
  
  }

  public function getAll() {
  
    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__)); 
  
  }


}
