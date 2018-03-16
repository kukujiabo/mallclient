<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 11:58
 */

namespace App\Domain;


class ModuleDm {
    public function index($data){
		
		$params['token'] = $data['token'];

		 $res = \App\apiRequest('App.Module.CrmModList',$params);

		$total =count($res);
		
		//return $total ;
		for ($i=0 ; $i<$total; $i++){
			$k = (int)($i / 8) ;
			$return[$k][$i%8]['id'] = $res[$i]['module_id'];
			$return[$k][$i%8]['name'] = $res[$i]['module_name'];
			$return[$k][$i%8]['img'] = $res[$i]['module_picture'];
			$return[$k][$i%8]['url'] = $res[$i]['url'];

		}
		
		return $return ; 
		
        $return = array(
					array(
						array(
							'id' => '001',
							'name' => '会员资料',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/Diamonds.png',
							'url' => 'pages/member/user/user',
							),
						array(
							'id' =>	'002',
							'name' => '提领券兑换',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/coupon.png',
							'url' => 'pages/TLcoupon/TLcoupon'
								),
						array(
							'id' =>	'003',
							'name' => '附近门店',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/store.png',
							'url' => 'pages/store/store'
								),
						array(
							'id' =>	'004',
							'name' => '推荐',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/Recommend.png',
							'url' => 'pages/recommend/recommend'
								),
						array(
							'id' =>	'005',
							'name' => '外卖',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/waimai1.png',
							'url' => 'pages/takeout/shop/shop'
								),
						array(
							'id' =>	'006',
							'name' => '签到',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/box.png',
							'url' => 'pages/signIn/signIn'
								),
						
						array(
							'id' =>	'007',
							'name' => '订单列表',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/%E8%AE%A2%E5%8D%95%E5%88%97%E8%A1%A8.png',
							'url' => 'pages/takeout/order/order'
								),
						array(
							'id' =>	'008',
							'name' => '收货地址',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/car.png',
							'url' => 'pages/address/address'
							)
						),
            /*
					array(
						array(
							'id' =>	'009',
							'name' => '消费记录',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/payRecord.png',
							'url' => 'pages/consume/consume'
								),
						array(
							'id' =>	'010',
							'name' => '刮刮乐',
							'img' => 'http://oyboujb2k.bkt.clouddn.com/coupon.png',
							'url' => ''
								),
								
						)
             */
					);
				
		return $return;
		
    }

}
