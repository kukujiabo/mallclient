<?php
namespace App\Domain;

	/**
     * 说明接口
     */
	 
class ExplainDm {
	
	public function getExplainforRecharge($data){
		$param['status'] = 1;
		$param['type'] = 1;
		
		$res = \App\apiRequest('App.Description.GetDetails',$param);
		return $res['content'];
		
	}
	
	public function IntegralExplain($data){
		
		$return['explain'] = 	'1．客户可以用积分至 "积分商城"频道免费兑换或积分+现金的形式购买特惠专享商品
				2．积分还可至券平台兑换抵用券，但请注意抵用券有有效期限，请在有效期内使用，积分所兑换的抵用券逾期不使用，积分将不予退还。
				3．积分不可用于兑换现金，仅限参加指定兑换物品、参与积分抽奖活动。
				4．如客户在网站上作出违反服务协议的行为，将有权利取消注销客户用户的账户及积分';
		$return['obtain'] = '1．在商城内消费可按订单金额获得积分，订单完成后自动加入积分
				2．每日签到可获得积分
				3．参加商家发布的活动，可获得积分，具体规则参照活动说明';
		return $return;
		
		$param['status'] =1;
		$param['type'] =2 ;
		$res =\App\apiRequest('App.Description.GetDetails',$param);
		
		$return['explain'] = $res['content'];
		
		$param['status'] =1;
		$param['type'] =3 ;
		$res =\App\apiRequest('App.Description.GetDetails',$param);
		$return['obtain'] = $res['content'];
		
		return $return;
		
	}
	
}