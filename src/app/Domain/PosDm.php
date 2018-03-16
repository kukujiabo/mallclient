<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 11:30
 */ 
namespace App\Domain;
use PhalApi\Exception\BadRequestException;
use App\Library\RedisClient;

class PosDm {
public function getMemInfo($data){
		//return 1;
		
		return array(
			'pic_head'=> '',
			'card_name' =>'路每家会员',
			'card_num' => '952795279527',
			'stars' => '3',			
			'QRcode_url' =>'http://oyboujb2k.bkt.clouddn.com/qrcode.png',
			'validity_from' => '2017.10.23',
			'validity_to' => '2018.10.23',
			'balance' => '2000',
			'balance_url' => 'pages/balance/detail/detail',
			'integral' => '20',
			'integral_url' => 'pages/integral/detail/detail',
			'coupons' => '5',
			'coupons_url' => 'pages/coupon/coupon',
		);

	}
	
	public function getRecargeValues($data){
		
		return array(
			array(
				'value' => 100,
				
			),
			array(
				'value' => 500,
				
			),
			array(
				'value' => 1000,
				
			),
			
		);
	}
    public function recharge($data){
		
		$param['token'] = $data['token'];
		$param['money'] = $data['money'];
		$param['device_info'] = $data['device_info'];
		$param['rule_id'] = $data['rule_id'];

		$res = \App\apiRequest('App.MemberRecharge.MiniRecharge',$param);
		return $res;
		
        /* return array(
			'timeStamp' => '1345654323454324',
			'nonceStr' => 'XODdjihfeXDD1378441',
			'package' => '',
			'signType' => 'MD5',
			'paySign' => '',
			
		); */
    }

	public function getBalance($data){
		$params['token'] = $data['token'];
		
		$res = \App\apiRequest('App.MemberAccount.GetDetail',$params);

		$return['balance'] = $res['balance'];
		$return['integral'] = $res['point'];
		$return['TotalConsumption'] = $res['member_cunsum'] ;
		
		return $return;

		return array(
			'total' => '5262.50',
			
			);
	}

  public function getBalanceList($data) {
		
		$params['token'] = $data['token'] ;

		$params['page'] = $data['page'];

		$params['page_size'] = $data['page_num'];
		
		$params['account_type'] = 2;

		$module = 1;

	  $res = null;

	  if ($module == 1) {

	  	$res = \App\apiRequest('App.MemberAccountRecord.QueryPossList',$params);

	  } elseif($module == 2) {

	  	$res = \App\apiRequest('App.MemberAccountRecord.QueryList',$params);

	  } 

		$return['page'] = $res['page'];

		$return['records'] = $res['total'];
		
		foreach ($res['list'] as $key => $val) {

			switch ($val['from_type']){

				case 1:

				$subject = '商城订单';

				break;

				case 2:

				$subject = '订单退还';

				break;

				case 3:

				$subject = '兑换';

				break;

				case 4:

				$subject = '充值';

				break;

				case 5:

				$subject = '签到';

				break;

				case 6:

				$subject = '分享';

				break;

				case 7:

				$subject = '注册';

				break;

				case 8:

				$subject = '提现';

				break;

				case 9:

				$subject = '提现返还';

				break;

			}
			
			$return['data'][$key]['id'] = $val['id'];
			$return['data'][$key]['subject'] = $val['type_name'];	//这个地方看是前端生成还是后端传过去。
			$return['data'][$key]['time'] = date('m-d H:i:s', strtotime($val['create_time']));
			$return['data'][$key]['amount'] = $val['number'] * $val['sign'];
			$return['data'][$key]['reward'] = $val['reward'];
			$return['data'][$key]['bill_no'] = $val['data_id'];
			$return['data'][$key]['details'] = $val['text'];
			$return['data'][$key]['shop_name'] = $val['shop_name'];

		}
		
		return $return;
		
  }

    public function getBalanceDetail($data){

        return array(
			'type' => '0',
			'time' => '2017-10-11 19:20:21',
			'bill_no' => '123634870897983408575033445',
			'details' => '商城订单123456543246754323',
			'amount' => '200',
		);
    }

    public function getIntegral($data){

        return array(
			'total' => '5262',
			'sum' => '262',
			'consumption' => '207',
			'sign' => '32',
			'games' => '23',
			'others' => '0',
			
			);
    }

    public function getIntegralList($data){

		  $params['token'] = $data['token'];

		  $params['page'] = $data['page'];

		  $params['page_size'] = $data['page_num'];

		  switch ($data['type']) {

		  	case '1':

		  		$params['sign'] = '1';

		  		break;

		  	case '2':

		  		$params['sign'] = '-1';

		  		break;

		  	default:
		  		
		  		break;

		  }

		  $params['account_type'] = 1;

		  $module = RedisClient::get('system_config', 'account_is_poss');

	    $res = null;

	    if ($module == 1) {

	    	$res = \App\apiRequest('App.MemberAccountRecord.QueryPossList',$params);

	    } elseif($module == 2) {

	    	$res = \App\apiRequest('App.MemberAccountRecord.QueryList',$params);

	    } 

		  $return['page'] = $res['page'] ;

		  $return['records'] = $res['total'] ; 
		  
		  foreach ($res['list'] as $key => $val) {
		  	$return['data'][$key]['id'] = $val['id'] ;
		  	$return['data'][$key]['subject'] = $val['type_name'];
		  	$return['data'][$key]['time'] = $val['create_time'] ;
		  	$return['data'][$key]['sum'] = $val['number'] * $val['sign'] ;
		  	$return['data'][$key]['sign'] = $val['sign'];
		  	$return['data'][$key]['type_name'] = $val['type_name'];
		  	$return['data'][$key]['bill_no'] = $val['data_id'] ;
		  	$return['data'][$key]['details'] = $val['text'] ;
		  	$return['data'][$key]['shop_name'] = $val['shop_name'];
		  }
		  
		  return $return;
		
    }

    public function getIntegralDetail($data){

        return 	array(
				'type' => '支出',
				'time' => '2017-10-13 16:30:41',
				'bill_no' => '12534808709870802432',
				'details' => '转盘抽奖活动',
				'integral' => '-200',
		);
    }

    public function getWinningList($data){

        return array(
			'page' => 1,
			'records' =>3,
			'data' => array(
				array(
					'subject' => '满100减10元优惠券',
					'datetime' => '2017-10-20 13:12:12',
					'status' => '0',
					'url' => '',
				),
				array(
					'subject' => 'ipad Air 平板电脑',
					'datetime' => '2017-10-20 13:12:12',
					'status' => '1',
					'url' => '',
				),
				array(
					'subject' => '满100减10元优惠券',
					'datetime' => '2017-10-20 13:12:12',
					'status' => '0',
					'url' => '',
				),
				
			),
		);
    }

    public function getPayRecord($data){

    	$params['token'] = $data['token'];
    	$params['page'] = $data['page'];
    	$params['page_size'] = $data['page_num'];

		//$module = RedisClient::get('system_config', 'account_is_poss');
		$module = 1;

	   	$res = null;

	    if ($module == 1) {

	    	$res = \App\apiRequest('App.ConsumptionRecords.QueryPossList',$params);

	    } elseif($module == 2) {

	    	$res = \App\apiRequest('App.ConsumptionRecords.QueryList',$params);

	    } 

	    $return['page'] = $res['page'];
	    $return['records'] = $res['total'];

	    foreach ($res['list'] as $key => $val){
	    	$return['data'][$key]['id'] = $val['id'];
	    	$return['data'][$key]['subject'] = $val['title'];
	    	$return['data'][$key]['bill_no'] = $val['seq'];
	    	$return['data'][$key]['do_time'] = $val['created_at'];
	    	$return['data'][$key]['total'] = $val['money'];
	    }

	    return $return;

    }

    public function getPayDetail($data){

    	$params['token'] = $data['token'];
    	$params['id'] = $data['id'];

    	$res = \App\apiRequest('App.ConsumptionRecords.GetPossDetail',$params);

    	$return['id'] = $res['id'];
    	$return['bill_no'] = $res['seq'];
      $return['barcode'] = $res['barcode'];
    	$return['total'] = $res['money'];
    	$return['do_time'] = $res['created_at'];
    	$return['subject'] = $res['title'];

    	foreach ($res['goods'] as $key => $val){
    		$return['goods'][$key]['goods_name'] = $val['goods_name'];
    		$return['goods'][$key]['goods_num'] = $val['num'];
    		$return['goods'][$key]['goods_price'] = $val['price'];
    		$return['goods'][$key]['goods_money'] = $val['goods_money'];

    	}

    	foreach ($res['pay'] as $key => $val){
    		$return['pay'][$key]['pay_mode'] = $val['pay_mode'];
    		$return['pay'][$key]['price'] = $val['price'];
    	}

    	return $return;

  }
	
	public function getPayNoticeList($data){
		
			$i = 0;
			$nums = 28;
			$ps = ($data['page']- 1) * $data['page_num'] ;			//数组开始下标。
			$s = $ps + $data['page_num'];
			if ($s>28){
				$s=28;
			}

			$return['page'] = $data['page'];

			$return['records'] = 28 ;
							
 			for ($i = $ps; $i < $s; $i++){
				$return['data'][] = $res['data'][$i];
				
			}
			
			
			return $return;
		
		}

	public function getinfoNotice($data){

		$params['token'] = $data['token'];
		$params['page'] = $data['page'];
		$params['way'] = 1;
		$params['page_size'] = $data['page_num'];

		$res = \App\apiRequest('App.PushMessage.QueryList',$params);
		
		$return['records'] = $res['total'];
		$return['page'] = $res['page'];

		unset($data);
		foreach ($res['list'] as $key => $val){

			$return['data'][$key]['shop_id'] = $val['shop_id'];
			$return['data'][$key]['type'] = $val['type'];
			$return['data'][$key]['content'] = $val['content'];
			$return['data'][$key]['created_at'] = $val['created_at'];

		}

		return $return;


	}

	public function getRechargeRule($data){
		$params['token'] = $data['token'];
		$params['money'] = $data['money'];

		$res = \App\apiRequest('App.MemberRechargeRule.GetRuleByToken',$params);

		return $res;

	}

	public function getGiveMoney($data){
		$params['uid'] = $data['user_id'];
		$params['money'] = $data['money'];

		$res = \App\apiRequest('App.MemberRechargeRule.CalChargeMoneyByRule',$params);

		return $res;


	}
}
