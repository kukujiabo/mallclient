<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 11:56
 */

namespace App\Domain;


class SMSDm {

    public function sendSMS($data){
		$param['phone'] = $data['phone'];
		$param['type'] = $data['type'];
		
		$res = \App\apiRequest('App.ShortMessage.Send',$param); 
        return $res ;
    }
}
