<?php
namespace App\Domain;

class AdverDm {

  public function getDetail($data) {
  
    return \App\apiRequest('App.Adver.GetDetail',$data);
  
  }

}
