<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 11:03
 */

namespace App\Domain;


use PhalApi\Exception\BadRequestException;
//use App\Library\wxBizDataCrypt;

class OfflineInterfaceDm {

	public function getPayRecords($data){
		$params['token'] = $data['token'];
		if (isset($data['page']) && $data['page'] != ''){
			$params['page'] = $data['page'];
		}
		if (isset($data['page_num']) && $data['page_num'] != ''){
			$params['page_size'] = $data['page_num'];
		}

		$res = \App\apiRequest('App.ConsumptionRecords.QueryPossList',$params);

		return $res;

	}
	public function getPayDetail($data){
		$params['token'] = $data['token'];
		$params['id'] = $data['id'];

		$res = \App\apiRequest('App.ConsumptionRecords.GetPossDetail',$params);

		return $res;

	}
}