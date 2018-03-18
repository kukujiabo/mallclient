<?php
namespace App\Domain;

/**
 * 地理位置
 */
class LocationDm {

  public function getAddress($params) {
  
    return \App\apiRequest('App.NationwideArea.GetAddress',$params);
  
  }

  public function getCity($params) {
  
    return \App\apiRequest('App.NationwideArea.QueryCity', $params);
  
  }

}
