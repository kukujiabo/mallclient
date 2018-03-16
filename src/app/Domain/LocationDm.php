<?php
namespace App\Domain;

/**
 * 地理位置
 */
class LocationDm {

  public function getAddress($params) {
  
    return \App\apiRequest('App.NationwideArea.GetAddress',$params);
  
  }

}
