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
    
      'getList' => array()
    
    ));
  
  }

  public function getList() {
  
    return $this->dm->getList();  
  
  }


}
