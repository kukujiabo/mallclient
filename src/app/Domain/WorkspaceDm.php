<?php
namespace App\Domain;

class WorkspaceDm {

  public function getList($params) {
  
    return \App\apiRequest('App.WorkSpace.GetListByToken', $params);
  
  }

}
