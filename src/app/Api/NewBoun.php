<?php
namespace App\Api;

/**
 * 新手礼包接口
 *
 *
 */
class NewBoun extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(

      '*' => array(

          'token' => 'token|string|true||用户令牌'

      ),
    
      'grantNew' => array(

        'sequence' => 'sequence|string|true||序列号'
      
      )
    
    )); 
  
  }

  /**
   * 领取新手礼包
   * @desc 领取新手礼包
   *
   * @return int num
   */
  public function grantNew() {
  
    return $this->dm->grantNew($this->retriveRuleParams(__FUNCTION__));
  
  }

  public function checkFetched() {
  
    return $this->dm->checkFetched($this->retriveRuleParams(__FUNCTION__));
  
  }

}
