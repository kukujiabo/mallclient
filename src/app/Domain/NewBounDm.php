<?php
namespace App\Domain;

class NewBounDm {

  public function grantNew($data) {
  
		return \App\apiRequest('App.NewBoun.GrantNew', $data);
  
  }

}
