<?php
	
namespace App\Api;

use App\Api\BaseApi;
use App\Domain\ExplainDm;

/**
 * 说明接口
 *
 * @author: xiaoqiang 2017-11-07
 */
 
class Explain extends BaseApi {
	private $ExplainDm;
	
	public function __construct(){
        parent::__construct();
        $this->ExplainDm = new ExplainDm();
    }
	
	public function getRules(){
        return $this->rules(array(
			//冲值说明接口
			'getExplainforRecharge' => array(
				
			),
		));
	}
	
	/**
	 * 获取冲值说明信息
     * @desc 获取冲值说明信息接口服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
	 
	public function getExplainforRecharge(){
		$params = $this->retriveRuleParams('getExplainforRecharge');
        return $this->ExplainDm->getExplainforRecharge($params);
	}
	
	/**
	 * 积分说明
     * @desc 积分说明信息接口服务
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */
	 
	 public function IntegralExplain(){
		$params = $this->retriveRuleParams('IntegralExplain');
		return $this->ExplainDm->IntegralExplain($params);
		
	 }
	 
	 
}
	