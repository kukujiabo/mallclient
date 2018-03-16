<?php
namespace App\Api;

/**
 * 文本接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-01-07
 */
class Text extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getMiniPageText' => array(

        'token' => 'token|string|true||用户令牌',
      
        'page_code' => 'page_code|string|true||页面编码',

        'attr_code' => 'attr_code|string|true||属性编码'
      
      )
    
    ));
  
  }

  /**
   * 获取小程序页面本文
   * @desc 获取小程序页面本文
   *
   * @return text
   */
  public function getMiniPageText() {
  
    return $this->dm->getMiniPageText($this->retriveRuleParams(__FUNCTION__));
  
  }


}
