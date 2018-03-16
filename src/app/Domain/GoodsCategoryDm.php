<?php
namespace App\Domain;

class GoodsCategoryDm {

  public function getList($params) {

    $params['is_visible'] = 1;
  
    return \App\apiRequest('App.GoodsCategory.GetAll', $params);
  
  }

}
