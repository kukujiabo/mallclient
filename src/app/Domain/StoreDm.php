<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 11:46
 */

namespace App\Domain;

use PhalApi\Exception\BadRequestException;

class StoreDm {

    /**
     * 获取地图上两个坐标的直线距离
     */
	public function getDistance($data) {
		  
		return \App\apiRequest('App.Shop.GetDistance', $data);

	}

    public function getNearbyStores($data){
		if ($data['lat']) {
		  $params['member_latitude'] = $data['lat'];
		}
		if ($data['lon']) {
		  $params['member_longitude'] = $data['lon'];
		}
		if ($data['address']) {
		  $params['address'] = $data['address'];
		}
		if ($data['district_id']) {
		  $params['district_id'] = $data['district_id'];
		}
		$params['page'] = $data['page'];
		$params['page_size'] = $data['page_num'];
		  
		$res = \App\apiRequest('App.Shop.QueryList',$params);

		$return['records'] = $res['total'];

		$return['page'] = $res['page'];

		foreach ($res['list'] as $keyword => $values){
			$return['data'][$keyword]['store_id'] = $values['shop_id'];
			$return['data'][$keyword]['store_name'] = $values['shop_name'];
			$return['data'][$keyword]['logo'] = $values['shop_logo'];
			$return['data'][$keyword]['address'] = $values['shop_address'];
			$return['data'][$keyword]['pic_address'] = $values['shop_banner'];
			$return['data'][$keyword]['province_id'] = $values['province_id'];
			$return['data'][$keyword]['city_id'] = $values['city_id'];
			$return['data'][$keyword]['area_id'] = $values['district_id'];
			$return['data'][$keyword]['lat'] = $values['latitude'];
			$return['data'][$keyword]['lon'] = $values['longitude'];
			$return['data'][$keyword]['phone'] = $values['shop_phone'];
			$return['data'][$keyword]['distance'] = $values['distance'] ? $values['distance'] : 0;
			$return['data'][$keyword]['is_outside_order'] = $values['is_outside_order'];
			$return['data'][$keyword]['thumbnail'] = $values['thumbnail'];
			$return['data'][$keyword]['text'] = $values['text'];
		}

		return $return ;
		
    }

    public function getStoreInfo($data){

        return array(
			'store_name' => '人民广场店',
			'province' => '湖南省',
			'city' => '常德市',
			'area' =>  '鼎城区',
			'address' => '上海市浦东新区云台路800号上海市浦东新区云台路800号',
			'lat' => '31.16173',
			'lon' => '121.50816',
			'pic_address' => 'http://oyboujb2k.bkt.clouddn.com/s_big.png',
			'phone' => '13135365563',
			'text' => '<html ></html>',
			
		);
    }

}
