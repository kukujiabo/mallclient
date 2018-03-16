<?php
namespace App;

use App\Library\ApiRequest;
use App\Library\Verification;
use PhalApi\Exception;

function hello() {
    return 'Hey, man~';
}

/**
 * 内部调用
 */
function apiRequest($service, $params, $timeout = 3000) {

	$response = ApiRequest::request($service, $params, $timeout);
    
	return $response->getData();

}

/**
 * 验证字段
 * @param array $array 被验证的数组
 * @param array $data 验证的字段数组
 */
function Verification($array, $data) {

    try{

        Verification::index($array, $data);

    } catch (\Exception $e){

        throw new Exception($e->getMessage(), 1001);

    }

}
