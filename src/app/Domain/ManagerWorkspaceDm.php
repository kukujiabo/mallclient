<?php
namespace App\Domain;

class ManagerWorkspaceDm {

  public function getManagerInfo($data) {
  
    return \App\apiRequest('App.Manager.GetDetail', $data);
  
  }

}
