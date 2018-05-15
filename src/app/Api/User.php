<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-17
 * Time: 14:15
 */

namespace App\Api;
use PhalApi\Api;
use App\Domain\UserDm;

/**
 * 用户管理接口
 *
 * @author: xiao qiang 2017-10-19
 */
 
class User extends BaseApi {

    private $UserDm;
    public function __construct() {
        parent::__construct();
        $this->UserDm = new UserDm;
    }

    public function getRules(){
        return $this->rules(array(
			//微信登陆 
			'wxLogin' => array(
				'code' => 'code|string|true||用户CODE',
			),
			//新增用户
            'add' => array(
                'phone' => 'phone|string|true||手机号码',
                'code' => 'code|string|true||验证码',
            ),
			//编辑用户
            'edit' => array(
                'token' => 'token|string|true||用户令牌',
				'user_id' => 'user_id|string|false||用户ID',
				'user_name' => 'user_name|string|false||用户名称',
				'user_headimg' => 'user_headimg|string|false||头像',
				'nick_name' => 'nick_name|string|false||昵称',
				'openid' => 'openid|string|false||微信的OPENID',
                'phone' =>  'phone|string|false||手机号码',
                'sex' => 'sex|int|false|0|性别 0 保密 1男  2 女',
                'date' => 'date|date|false||生日',
				// 'province' => 'province|string|false||省',
				// 'province_id' => 'province_id|string|false||省id',
				// 'city' => 'city|string|false||市',
				// 'city_id' => 'city_id|string|false||市id',
				// 'area' => 'area|string|false||区',
				// 'area_id' => 'area_id|string|false||区id',
				// 'year' => 'year|string|false|1900|年',
				// 'month' => 'month|string|false|01|月',
				// 'day' => 'day|string|false|01|日',
				// 'city' => 'city|string|false||所在城市',
                // 'tradding' => 'tradding|string|false||商圈',
                // 'occupation' => "occupation|string|false||职业",
			
            ),
			//获取用户信息
			'getUser' =>array(
				'token' => 'token|string|true||用户令牌',
			),
			//签到
            'signup' =>array(
                'token' => 'token|string|true||用户令牌',
                'date' => 'date|string|false||签到日期',

            ),
			//获取签到信息
			'getsignupinfo' =>array(
				'token' => 'token|string|true||用户令牌',
				'date' => 'date|date|false||只要年和月',
				'page' => 'page|int|true|1|页码',
				'page_num' => 'page_num|int|true|20|每页数据条数',
				
			),
			//更换绑定手机
          'bindphone' => array(
    		  'token' => 'token|string|true||用户令牌',
              'phone' => 'phone|string|true||旧手机号码',
              'member_name' => 'member_name|string|false||用户姓名',
              'birthday' => 'birthday|string|true||会员生日',
              'code' => 'code|string|true||验证码',
              'encryptedData' => 'encryptedData|string|false||用户信息加密数据',
              'iv' => 'iv|string|false||用户解密密钥',
              'session_key' => 'session_key|string|false||会员密钥',
              'share_code' => 'share_code|string|false||分享码'
          ),
			//用户分享接口
			'userShare' => array(
				'token' => 'token|string|true||用户令牌',
				'shareTicket' => 'shareTicket|string|false||微信shareTicket',
				'encodeData' => 'encodeData|string|false||微信分享加密信息',
				'iv' => 'iv|string|false||解密密钥',
				'module' => 'module|string|false||分享类型',
				'remark' => 'remark|string|false||分享备注',
				'sessionKey' => 'sessionKey|string|false||sessionKey',
                'openid' => 'openid|string|false||微信的OPENID',
                'share_code' => 'share_code|string|false||分享码',
				
			),
            'register' => array(
                'token' => 'token|string|true||用户令牌',
                'nickName' => 'nickName|string|true||用户昵称',
                'realName' => 'RealName|string|false||用户姓名',
                'headUrl' => 'headUrl|string|true||用户头像',
                'sex' => 'sex|int|true||性别1为男2为女0未知',
                'country' => 'country|string|false||国家',
                'province' => 'province|string|false||省份',
                'city' => 'city|string|false||城市',
                'language' => 'language|string|true|zh_CN|语言',
                'encryptedData' => 'encryptedData|string|true||加密数据',
                'iv' => 'iv|string|true||加密算法的初始向量',
                'session_key' => 'session_key|string|true||会员密钥',
                'shop_id' => 'shop_id|string|false||店铺id',


            ),

            'checkcode' => array(
                'code' => 'code|string|true||验证码',
                'mobile' => 'mobile|string|true||手机号码',

            ),

            'sendVerifyCode' =>array(
                'mobile' => 'mobile|string|true||手机号码',

            ),
            'memberLogin' => array(
              'code'  => 'code|string|true||微信登录code'
            ),
            'getMemberAccountDetail' => array(
              'token' => 'token|string|true||用户token' 
            ),
            'getMemberDetailInfo' => array(
              'token' => 'token|string|true||用户token' 
            ),

            'getSignRewards' => array(
                'token' => 'token|string|true||用户token' 
            ),
			
            'memberEdit' => array(
                'token' => 'token|string|true||用户token',
                'member_name' => 'member_name|string|false||用户名称',
                'member_level' => 'member_level|string|false||会员等级',
                'reg_time' => 'reg_time|string|false||注册时间',
                'memo' => 'memo|string|false||备注',
                'user_name' => 'user_name|string|false||账号（手机号码）',
                'user_password' => 'user_password|string|false||密码明文',
                'user_headimg' => 'user_headimg|string|false||用户头像',
                'real_name' => 'real_name|string|false||真实姓名',
                'nick_name' => 'nick_name|string|false||昵称',
                'user_tel' => 'user_tel|string|false||手机号',
                'birthday' => 'birthday|string|false||会员生日 ',
                'location' => 'location|string|false||所在地',
                'sex' => 'sex|int|false||性别0-保密 1-男 2-女'
            ),

            'memberDetail' => array(
                'token' => 'token|string|true||用户token',

            ),

            'getQRcode'  => array(
                'token' => 'token|string|true||用户token',
            ),

            'getFansList' => array(
               'token' => 'token|string|true||用户token',
               'order' => 'order|string|false||排序',
               'page' => 'page|int|false||页码',
               'pageSize' => 'pageSize|int|false||每页数据条数'
             ),

             'changePhone' => array(

               'token' => 'token|string|true||用户令牌',

               'phone' => 'phone|string|true||用户手机号',

               'code' => 'code|string|true||验证码',
             
             ),

             'getMemberMessage' => array(

               'token' => 'token|string|true||用户令牌',

               'page' => 'page|int|false|1|页码',

               'page_size' => 'page_size|int|false|4|每页数据条数'
             
             ),
        ));
    }
    /**
     * 查询会员消息列表
     * @desc 查询会员消息列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array data[] 结果参数集
     * @return int data.total 数据总条数
     * @return int data.page 当前页码
     * @return array data.list[] 数据队列
     * @return int data.list[].id 表序号
     * @return int data.list[].uid 用户id
     * @return string data.list[].msgid 消息编号
     * @return string data.list[].module 所属模块
     * @return string data.list[].url 跳转链接
     * @return string data.list[].title 标题
     * @return string data.list[].content 内容
     * @return string data.list[].icon 小程序页面url
     * @return string data.list[].ext 内容
     * @return string data.list[].created_at 创建时间
     * @return string data.list[].pagepath 
     * @return string data.list[].appid 
     * @return string msg 错误提示
     */
    public function getMemberMessage(){

        $conditions = $this->retriveRuleParams(__FUNCTION__);

        $regulation = array(
        
          'token' => 'required',

        );

        \App\Verification($conditions, $regulation);

        return $this->dm->getMemberMessage($conditions);
        
    }
    /**
     * 用户登陆
     * @desc 用户登陆接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
    public function wxLogin(){
        $params = $this->retriveRuleParams('wxLogin');
        return $this->UserDm->wxLogin($params);
        
    }
    /**
	 * 用户注册
     * @desc 用户注册接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
    public function add(){
        $params = $this->retriveRuleParams('add');
        return $this->UserDm->add($params);
    }

	/**
	 * 用户编辑
     * @desc 用户编辑接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
	 
    public function edit(){
        $params = $this->retriveRuleParams('edit');
        return $this->UserDm->edit($params);

    }
	
	public function getUser(){
		$params = $this->retriveRuleParams('getUser');
		return $this->UserDm->getUser($params);
		
	}
	/**
	 * 用户签到
     * @desc 用户签到接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
	 
    public function signup(){
        $params = $this->retriveRuleParams('signup');
        return $this->UserDm->signup($params);

    }
	/**
	 * 获取签到信息
     * @desc 获取签到信息接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
	 public function getsignupinfo(){
		 $params = $this->retriveRuleParams('getsignupinfo');
		 return $this->UserDm->getsignupinfo($params);
	 }
	 
	/**
	 * 绑定手机号
     * @desc 绑定手机号接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
	 
    public function bindphone(){
        $params = $this->retriveRuleParams('bindphone');
        return $this->UserDm->bindphone($params);

    }
	
	/**
	 * 用户分享接口
     * @desc 用户分享接口服务
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
	 
	public function userShare(){
		$params = $this->retriveRuleParams('userShare');
		return $this->UserDm->userShare($params);
	}

    /**
     * 用户注册接口
     * @desc 用户注册接口服务
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */

    public function register(){
        $params = $this->retriveRuleParams('register');
        return $this->UserDm->register($params);

    }

    /**
     * 检查验证码接口
     * @desc 检查验证码服务
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */


    public function checkcode(){
        $params =  $this->retriveRuleParams('checkcode');
        return $this->UserDm->checkcode($params);

    }

    /**
     * 发送验证码接口
     * @desc 发送验证码服务
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */

    public function sendVerifyCode(){
        $params = $this->retriveRuleParams('sendVerifyCode');
        return $this->UserDm->sendVerifyCode($params);
        
    }

    /**
     * 会员登录接口
     * @desc 会员登录接口，仅返回权限相关信息
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
    public function memberLogin() {

      $params = $this->retriveRuleParams('memberLogin'); 

      return $this->UserDm->memberLogin($params);

    }

    /**
     * 获取会员帐户信息
     * @desc 获取会员帐户信息
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
    public function getMemberAccountDetail() {
    
      $params = $this->retriveRuleParams('getMemberAccountDetail');

      return $this->UserDm->getMemberAccountDetail($params);
    
    }

    /**
     * 获取会员基本信息
     * @desc 获取会员基本信息
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
    public function getMemberDetailInfo() {
    
      $params = $this->retriveRuleParams('getMemberDetailInfo');

      return $this->UserDm->getMemberDetailInfo($params);
    
    }

    /**
     * 获取签到赠送规则
     * @desc 获取签到赠送规则
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */

    public function getSignRewards(){
        $params = $this->retriveRuleParams('getSignRewards');
        return $this->UserDm->getSignRewards($params);
    }

    /**
     * 会员编辑接口
     * @desc 会员编辑接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */

    public function memberEdit(){
        $params = $this->retriveRuleParams('memberEdit');
        return $this->UserDm->memberEdit($params);
    }

    /**
     * 会员详情接口
     * @desc 会员详情接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
    public function memberDetail(){
        $params = $this->retriveRuleParams('memberDetail');
        return $this->UserDm->memberDetail($params);

    }

    /**
     * 获取加密二维码
     * @desc 获取加密二维码
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
    public function getQRcode(){
        $params = $this->retriveRuleParams('getQRcode');
        return $this->UserDm->getQRcode($params);
        
    }

    /**
     * 获取好友列表
     * @desc 获取好友列表
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.user_headimg: 好友头像
     * @return array data.nick_name: 好友昵称
     * @return array data.reg_time: 加入时间
     * @return string msg: 报错信息
     */
    public function getFansList() {
    
      $params = $this->retriveRuleParams('getFansList');

      $params['page_size'] = $params['pageSize'];

      unset($params['pageSize']);

      return $this->UserDm->getFansList($params);
    
    }

    /**
     * 更换用户手机号
     * @desc 跟换用户手机号
     *
     * @return int ret 操作状态：200表示成功
     * @return int num[] 修改结果：1.成功，0.失败
     * @return string msg: 报错信息
     */
    public function changePhone() {
    
      return $this->dm->changePhone($this->retriveRuleParams(__FUNCTION__));
    
    }

}
