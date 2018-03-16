<?php

namespace App\Api;

use App\Api\BaseApi;
use App\Domain\PosDm;

/**
 * POS接口
 *
 * @author: xiaoqiang 2017-10-19
 */
 
class Pos extends BaseApi {
    private $PosDm;

    public function __construct(){
        parent::__construct();
        $this->PosDm = new PosDm();
    }

    public function getRules(){
        return $this->rules(array(
			//获取会员卡
			'getMemInfo' =>array(
				'user_id' => 'user_id|int|true|0|用户ID',
			),
			//获取可冲值面值
			'getRecargeValues' => array(
				'user_id' => 'user_id|int|true|0|用户ID',
			),
			//冲值接口
            'recharge' => array(
                'token' => 'token|string|true||用户令牌',
                'money' => 'money|float|true||冲值金额',
                'device_info' => 'device_info|string|false||设备信息',
                'rule_id' => 'rule_id|int|false|0|充值规则id',
            ),
			//获取余额
			'getBalance' => array(
				'token' => 'token|string|true||用户令牌',
				
			),
			//余额明细
            'getBalanceList' =>array(
                'token' => 'token|string|true||用户令牌',
				'page' => 'page|int|false|1|页码',
				'page_num' => 'page_num|int|false|8|每页显示数据条数'
				
            ),
			//余额使用详情
            'getBalanceDetail' =>array(
                'user_id' => 'user_id|int|true||用户ID',
                'bill_no' => 'bill_no|string|true||订单编号',

            ),
			//获取积分情况
            'getIntegral' => array(
                'user_id' => 'user_id|int|true||用户ID',

            ),
			//获取积分明细
            'getIntegralList' =>array(
                'token' => 'token|string|true||用户令牌',
                'type' => 'type|string|false||积分变动类型，0全部,1获取，2使用',
                'page' => 'page|int|false|1|页码',
                'page_num' => 'page_num|int|false|8|每页显示数据条数'
				
            ),
			//获取积分使用详情
            'getIntegralDetail' => array(
                'user_id' => "user_id|int|true|0|用户ID",
                'bill_no' => 'bill_no|string|true||订单编号',

            ),
			//中奖记录
            'getWinningList' => array(
                'user_id' => 'user_id|int|true|0|用户ID',
            ),
			//消费记录
            'getPayRecord' => array(
                'token' => 'token|string|true||用户令牌',
                'page' => 'page|int|false|1|页码',
                'page_num' => 'page_num|int|false|8|每页显示数据条数',
                // 'from_date' => 'fom_Date|date|false||起始时间',
                // 'to_date' => 'to_Date|date|false||结束时间',

            ),
			//消费明细
            'getPayDetail' => array(
                'token' => 'token|string|true||用户令牌',
                'id' => 'id|string|true||订单ID',

            ),
			
			//消费通知
			'getPayNoticeList' => array(
				'user_id' => 'user_id|int|true|0|用户ID',
				'page' => 'page|int|false|1|页码',
				'page_num' => 'page_num|int|false|8|每页显示数据条数'
				
			),

			//消息通知

			'getinfoNotice' => array(
				'token' => 'token|string|true||用户令牌',
				'page' => 'page|int|false|1|页码',
				'page_num' => 'page_num|int|false|8|每页显示数据条数',

			),

			//获取冲值规则

			'getRechargeRule' => array(
				'token' => 'token|string|true||用户令牌',
				'money' => 'money|float|false||金额',

			),

			//通过token 获取用户 冲值规则

			'getGiveMoney' => array(
				'user_id' =>  'user_id|int|true||用户令牌',
				'money' => 'money|float|true||充值金额'
			),
        ));
    }
	/**
	 * 获取会员卡信息
     * @desc 获取会员卡信息接口服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
	 public function getMemInfo(){
		 $params = $this->retriveRuleParams('getMemInfo');
		 return $this->PosDm->getMemInfo($params);
		 
	 }
	 /**
	 * 获取可冲值面额
     * @desc 获取可冲值面额服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 **/
	 public function getRecargeValues(){
		 $params = $this->retriveRuleParams('getRecargeValues');
		 return $this->PosDm->getRecargeValues($params);
	 }
	 
	/**
	 * 余额冲值
     * @desc 余额冲值接口服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
    public function recharge(){
        $params = $this->retriveRuleParams('recharge');
        return $this->PosDm->recharge($params);
    }
	/**
	 * 余额获取
     * @desc 余额获取接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
	 
	 public function getBalance(){
		 $params = $this->retriveRuleParams('getBalance');
		 return $this->PosDm->getBalance($params);
	 }
	 
	/**
	 * 余额明细
     * @desc 余额明细接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
	 
    public function getBalanceList(){
        $params = $this->retriveRuleParams('getBalanceList');
        return $this->PosDm->getBalanceList($params);
    }

	/**
	 * 余额详情
     * @desc 余额详情接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
    public function getBalanceDetail(){
        $params = $this->retriveRuleParams('getBalanceDetail');
        return $this->PosDm->getBalanceDetail($params);
    }

	/**
	 * 获取积分情况
     * @desc 获取积分情况接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
    public function getIntegral(){
        $params = $this->retriveRuleParams('getIntegral');
        return $this->PosDm->getIntegral($params);

    }

	/**
	 * 获取积分明细
     * @desc 获取积分明细接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
    public function getIntegralList(){
        $params = $this->retriveRuleParams('getIntegralList');
        return $this->PosDm->getIntegralList($params);

    }
	
	/**
	 * 获取积分使用详情
     * @desc 获取积分接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
    public function getIntegralDetail(){
        $params = $this->retriveRuleParams('getIntegralDetail');
        return $this->PosDm->getIntegralDetail($params);
    }

	/**
	 * 中奖记录
     * @desc 中奖记录接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
    public function getWinningList(){
        $params = $this->retriveRuleParams('getWinningList');
        return $this->PosDm->getWinningList($params);

    }
	/**
	 * 消费记录
     * @desc 消费记录接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
	 
    public function getPayRecord(){
        $params = $this->retriveRuleParams('getPayRecord');
        return $this->PosDm->getPayRecord($params);
    }

	/**
	 * 消费详情
     * @desc 消费详情接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
    public function getPayDetail(){
        $params = $this->retriveRuleParams('getPayDetail');
        return $this->PosDm->getPayDetail($params);

    }
	
	/**
	 * 获取消费通知列表
     * @desc 获取消费通知接口服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
	 public function getPayNoticeList(){
		 $params = $this->retriveRuleParams('getPayNoticeList');
		 return $this->PosDm->getPayNoticeList($params);
		 
	 }


	 /**
	 * 获取消息通知列表
     * @desc 获取消息通知接口服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */

	 public function getinfoNotice(){
	 	$params = $this->retriveRuleParams('getinfoNotice');
	 	return $this->PosDm->getinfoNotice($params);
	 }

	 /**
	 * 获取冲值规则
     * @desc 获取充值规则接口服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */

	 public function getRechargeRule(){
	 	$params = $this->retriveRuleParams('getRechargeRule');
	 	return $this->PosDm->getRechargeRule($params);

	 }

	 /**
	 * 通过token获取用户可用的充值规则
     * @desc 获取用户可用的充值规则服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */

	 public function getGiveMoney(){
	 	$params = $this->retriveRuleParams('getGiveMoney');
	 	return $this->PosDm->getGiveMoney($params);

	 }
	 
}
