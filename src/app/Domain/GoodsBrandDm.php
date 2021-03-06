<?php
namespace App\Domain;

class GoodsBrandDm {

  /**
   * 获取列表
   */
  public function getList($params) {
  
    return \App\apiRequest('App.GoodsBrand.CityList', $params); 
  
  }

  public function getDetail($params) {
  
    return \App\apiRequest('App.GoodsBrand.GetDetail', $params);
  
  }

  public function getAll($params) {

    $params['all'] = 1;

    return \App\apiRequest('App.GoodsBrand.ListQuery', $params);
  
  }

}
