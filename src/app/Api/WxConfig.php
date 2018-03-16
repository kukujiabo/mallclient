<?php

namespace App\Api;

use App\Api\BaseApi;
use App\Domain\WxConfigDm;
/**
 * 配置文件接口
 *
 * @author: Xiao Qiang <2938922@qq.com> 2017-12-07
 */
class WxConfig extends BaseApi{

    private $WxconfigDm;

    public function __construct(){
        parent::__construct();
        $this->WxconfigDm = new WxConfigDm();
    }

    public function getRules(){
        return $this->rules(array(
        	'GetCrmPageBoundConfigs' =>array(
        		'page_code' => 'page_code|string|false||页面配置',

        	),
        	'GetCrmPageConfigs' =>array(
        		'page_code' => 'page_code|string|false||页面配置',
        	),
            'DecryptData' => array(
                'encryptedData' => 'encryptedData|string|true||加密数据',
                'iv' => 'iv|string|true||加密算法的初始向量',
                'session_key' => 'session_key|string|true||会员密钥',
                'appid' => 'appid|string|false||小程序appid',

            ),

        ));
    }

    /**
	 * 获取crm小程序页面和页面配置
     * @desc 获取crm小程序页面和页面配置
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */

    public function GetCrmPageBoundConfigs(){
    	$params = $this->retriveRuleParams('GetCrmPageBoundConfigs');
    	return $this->WxconfigDm->GetCrmPageBoundConfigs($params);

    }

    /**
	 * 获取crm小程序页面配置
     * @desc 获取crm小程序页面配置
	 * @params string xxxx 参数
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
	 */

    public function GetCrmPageConfigs(){
    	$params = $this->retriveRuleParams('GetCrmPageConfigs');
    	return $this->WxconfigDm->GetCrmPageConfigs($params);

    }

    /**
     * 小程序解密
     * @desc 小程序解密
     * @params string xxxx 参数
     * @return string title 标题
     * @return string content 内容
     * @return string version 版本，格式：X.X.X
     * @return int time 当前时间戳
     */

    public function DecryptData(){
        $params = $this->retriveRuleParams('DecryptData');
        return $this->WxconfigDm->DecryptData($params);
        
    }

}