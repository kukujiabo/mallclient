<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 17:17
 */

namespace App\Api;
use App\Api\BaseApi;
use App\Domain\SMSDm;

/**
 * 短信接口
 *
 * @author: xiaoqiang 2017-10-19
 */
 
class SMS extends BaseApi{
    private $SMSDm;
    public function __construct(){
        parent::__construct();
        $this->SMSDm = new SMSDm();
    }

    public function getRules(){
        return $this->rules(array(
			//短信发送接口
            'sendSMS' => array(
                'phone' => 'phone|string|true||手机号码',
                'type' => 'type|string|false||类型 0-不标记 1-注册 2-旧手机验证 3-新手机验证 4-找回密码',
            ),
        ));
    }
	
  /**
   * 短信发送接品
   * @desc 短信发送接口
   *
   * @param string coupon_code 优惠券编码
   * @return int ret 操作状态：200表示成功
   * @return array data[] 参数集
   * @return array data.Status 1:操作成功;-1:操作出错
   * @return array data.Description 错误信息
   * @return string msg 错误提示
   */
   
	public function sendSMS(){
		$params = $this->retriveRuleParams('sendSMS');
		return $this->SMSDm->sendSMS($params);
	}
}