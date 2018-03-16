<?php
namespace App\Domain;

class GoodsBrandDm {

  /**
   * 获取列表
   */
  public function getList($params) {
  
    return \App\apiRequest('App.GoodsBrand.ListQuery', $params); 
  
  }

  public function getDetail($params) {
  
    return \App\apiRequest('App.GoodsBrand.GetDetail', $params);
  
  }

}
