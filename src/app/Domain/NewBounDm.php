<?php
namespace App\Domain;

class NewBounDm {

  public function grantNew($data) {
  
		return \App\apiRequest('App.NewBoun.GrantNew', $data);
  
  }

  public function checkFetched($data) {
  
		return \App\apiRequest('App.NewBoun.CheckFetched', $data);
  
  }

}
