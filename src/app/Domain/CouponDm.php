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

        return array(
			'id' =>'1001',
			'pic_address' => 'http://oyboujb2k.bkt.clouddn.com/tlcoupon.png',
			'title' => '迪士尼中秋月饼限量版',
			'id_code' => '4511452',
			'condition' => '请在使用期前到门店兑换商品或在线配送商品',
			'phone'	=> '400-12345678',
			'qrcode' => 'http://oyboujb2k.bkt.clouddn.com/qrcode.png',
			'collar_code' => '578690',
			
		);
    }


	//优惠券的列表。。。
	public function getCouponList($data){
		
		$params['token'] = $data['token'];
		$params['page'] = $data['page'];
		$params['page_size'] = $data['page_num'];
		$params['is_relevance'] = '1';
		
		$res = \App\apiRequest('App.Coupon.QueryList',$params);
		
		/*$return['page'] = $res['page'];
		$return['records'] =  $res['total'];
		
		foreach($res['list'] as $key => $val){
			if ($val['deduction_type'] == 2){
				$name = $val['money'];
			}elseif ($val['deduction_type'] == 3){
				$name = $val['coupon_name'];
			}
			
			$return['data'][$key]['name'] = $name;
			$return['data'][$key]['coupon_code'] = $val['coupon_code'];
			$return['data'][$key]['title'] =$val['coupon_name'];
			$return['data'][$key]['text'] =$val['at_least']==0?'无门槛':'满'.$val['at_least'].'可使用';
			$return['data'][$key]['validity_from'] =$val['start_time'];
			$return['data'][$key]['validity_to'] =$val['end_time'];
			$return['data'][$key]['type'] = $val['deduction_type'];
			$return['data'][$key]['status'] = $val['state'];
			
		}*/
		
		return $res ;

	}
	
}
