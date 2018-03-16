<?php

namespace App\Domain;


use PhalApi\Exception\BadRequestException;
//use App\Library\wxBizDataCrypt;

class WxConfigDm {
	function GetCrmPageBoundConfigs($data){
		if (isset($data['page_code']) && $data['page_code'] != ''){
			$params['page_code'] = $data['page_code'];
		}

		$res = \App\apiRequest('App.WxproPage.GetCrmPageBoundConfigs',$params);
		return $res;
	}

	function GetCrmPageConfigs($data){
		if (isset($data['page_code']) && $data['page_code'] != ''){
			$params['page_code'] = $data['page_code'];
		}

		$res = \App\apiRequest('App.WxproPage.GetCrmPageConfigs',$params);
		return $res;
	}

	function DecryptData($data){
		$params['encryptedData'] = $data['encryptedData'];
		$params['iv'] = $data['iv'];
		$params['session_key'] = $data['session_key'];
		$params['appid'] = $data['appid'];
		
    return $params;
		$res = \App\apiRequest('App.Member.DecryptData',$params);
		return $res;

	}
}
