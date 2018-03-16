<?php
namespace App\Domain;

/**
 * 文本服务
 */
class TextDm {

  /**
   * 小程序页面配置文本
   */
  public function getMiniPageText($params) {

    $data = \App\apiRequest('App.Content.GetMiniPageText',$params);

    echo $data;

    exit;
  
  }

}
