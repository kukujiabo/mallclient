<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 11:50
 */

namespace App\Domain;

use PhalApi\Exception\BadRequestException;
class CouponDm {

	/**
	 * 获取可用优惠券
	 */
    public function getAvailableCoupon($conditions){
		
		return  \App\apiRequest('App.Coupon.getAvailableCoupon',$conditions);

    }

	/**
	 * 获取优惠券二维码
	 */
    public function getCouponQrCode($conditions){
		
		return  \App\apiRequest('App.Coupon.GetCouponQrCode',$conditions);

    }

    public function getExchangeList($data){
		$params['token'] = $data['token'];
		$params['way'] = 1;
		$params['page'] = $data['page'] ;
		$params['page_size'] = $data['page_num'];
		
		$res = \App\apiRequest('App.CouponExchange.QueryList',$params);
		
		//return $res;
		
		$return['page'] = $res['page'];
		$return['records'] = $res['total'];
		
		foreach ($res['list'] as $key => $val){
			$return['data'][$key]['id'] = $val['id'];
			$return['data'][$key]['price'] = $val['price'];
			$return['data'][$key]['serial_number'] = $val['serial_number'];
			$return['data'][$key]['id_code'] = $val['heading_code'];
			$return['data'][$key]['validity_from'] = $val['start_time'];
			$return['data'][$key]['validity_to'] = $val['end_time'];
			$return['data'][$key]['status'] = $val['status'];
			$return['data'][$key]['pic_address'] = $val['picture'];
			$return['data'][$key]['title'] = $val['goods_name'];
			$return['data'][$key]['condition'] = $val['这个要从说明里面获取'];
			$return['data'][$key]['phone'] = $val['400800123456'];
			$return['data'][$key]['qrcode'] = $val['img'];
			$return['data'][$key]['collar_code'] = $val['coupons_code'];
			
		}

		return $return;

    }

    public function exChange($data){

        return true ;
    }

    public function getDetail($data){

      return \App\apiRequest('App.Coupon.GetDetail', $data);

    }


	//优惠券的列表。。。
	public function getCouponList($data){

    if (!$data['token'] || $data['token'] === 'undefined') {
    
      return null;
    
    }
		
		$params['token'] = $data['token'];

		$params['page'] = $data['page'];

		$params['page_size'] = $data['page_num'];

		$params['is_relevance'] = '1';
		
		return \App\apiRequest('App.Coupon.QueryList',$params);

	}

  public function getAllType($params) {
  
    return \App\apiRequest('App.CouponType.GetAll', $params); 
  
  }

  public function exchangeCoupon($params) {
    
    return \App\apiRequest('App.CouponType.ExchangeCoupon', $params);
    
  }
	  
}   
    
    
