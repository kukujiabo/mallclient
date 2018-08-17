<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 15:35
 */

namespace App\Api;

use App\Domain\CouponDm;
use PhalApi\Exception; 

/**
 * 优惠券接口
 *
 * @author: Xiao Qiang <2938922@qq.com> 2017-10-20
 */
 
class Coupon extends BaseApi {
  
  private $CouponDm;

  public function __construct(){
      parent::__construct();
      $this->CouponDm = new CouponDm();
  }

  public function getRules(){
      return $this->rules(array(
          '*' => array(
              'token' => 'token|string|true||用户令牌'
          ),
		      //获取提领券列表
          'getExchangeList' => array(
      				'page' => 'page|int|false|1|页码',
      				'page_num' => 'page_num|int|false|8|每页显示数据条数'
          ),
		      //卡提领券兑换
          'exChange' =>array(
              'address_id' => 'address_id|int|true||地址库ID',
              'id_code' => 'id_code|string|true||识别码',
              'code' => 'code|string|false||验证码',
              'dis_type' => 'dis_type|int|true|0|配送方式 0送货上门  1自提',
              'name' => 'name|string|false||姓名',
              'phone' => 'phone|int|false||手机号',

          ),
		      //提领券明细
          'getDetail' => array(
              'code' => 'code|string|true||识别码',
          ),
          //获取优惠券列表
          'getCouponList' => array(
              'page' => 'page|int|false|1|页码',
              'page_num' => 'page_num|int|false|8|每页显示数据条数',
          ),
          'getCouponQrCode' => array(
              'coupon_code' => 'coupon_code|string|true||优惠券编码',
          ),
          'getAvailableCoupon' => array(
            'shop_id' => 'shop_id|int|true||门店id',
            'type' => 'type|int|true|1|下单类型 1-购物车下单 2-立即购买',
            'cart_id' => 'cart_id|string|false||购物车id（多个用英文逗号隔开）',
            'goods_id' => 'goods_id|int|false||商品id',
            'sku_id' => 'sku_id|int|false||sku商品id',
            'num' => 'num|int|false||购买数量',
          ),
          'getAllType' => array(
          
          
          ),
          'exchangeCoupon' => array(
          
            'coupon_type_id' => 'coupon_type_id|int|true||优惠券类型id'
          
          )
      ));
  }

  /**
   * 获取满足订单条件的优惠券
   * @desc 获取满足订单条件的优惠券。如果typr 为1则 cart_id 必传，为2 goods_id 和 num 必传
   *
   * @return int ret 操作状态：200表示成功
   * @return array data[] 参数集
   * @return int data[].coupon_id 优惠券id
   * @return int data[].coupon_type_id 优惠券类型id
   * @return int data[].shop_id 店铺Id
   * @return syting data[].coupon_code 优惠券编码
   * @return int data[].uid 领用人
   * @return int data[].use_order_id 优惠券使用订单id
   * @return int data[].create_order_id 创建订单id
   * @return float data[].money 面额
   * @return string data[].fetch_time 领取时间
   * @return string data[].use_time 使用时间
   * @return int data[].state 优惠券状态：0未领用，1已领取（未使用），2已使用，3已过期
   * @return string data[].start_time 有效期开始时间
   * @return string data[].end_time 有效期结束时间
   * @return int data[].get_type 获取方式1订单2.首页领取
   * @return int data[].wx_bind 是否绑定了微信卡券:0-否，1-是
   * @return string data[].coupon_name 优惠券名称
   * @return int data[].deduction_type 抵扣类型：1-折扣，2-现金，3-包邮
   * @return float data[].percentage 折扣
   * @return int data[].at_least 满多少元使用，0代表无限制
   * @return int data[].all_store 所有门店可用
   * @return int data[].last_long 是否长期有效：0，否；1，是
   * @return int data[].qr_code 优惠券二维码
   * @return string msg 错误提示
   */
  public function getAvailableCoupon() {

    $regulation = array(

      'token' => 'required',

      'shop_id' => 'required',

      'type' => 'required',
    
    );

    $conditions = $this->retriveRuleParams(__FUNCTION__);

    \App\Verification($conditions, $regulation);

    if ($conditions['type'] == 1 && !isset($conditions['cart_id'])) {

      throw new Exception("cart_id必传", 710101);

    } elseif ($conditions['type'] == 2 && (!isset($conditions['goods_id']) || !isset($conditions['num']))) {

      throw new Exception("goods_id和num必传", 710102);
      
    }
  
    return $this->dm->getAvailableCoupon($conditions);
  
  }

  /**
   * 获取优惠券二维码
   * @desc 获取优惠券二维码
   *
   * @return int ret 操作状态：200表示成功
   * @return array data[] 参数集
   * @return string data.qr_code 二维码地址
   * @return string msg 错误提示
   */
  public function getCouponQrCode() {

    $regulation = array(

      'token' => 'required',

      'coupon_code' => 'required',
    
    );

    $conditions = $this->retriveRuleParams(__FUNCTION__);

    \App\Verification($conditions, $regulation);
  
    return $this->dm->getCouponQrCode($conditions);
  
  }
	
  /**
   * 获提领券券列表
   * @desc 获取提领券列表接口
   *
   * @return int ret 操作状态：200表示成功
   * @return array data[] 结果参数集
   * @return int data.total 数据总条数
   * @return int data.page 当前页码
   * @return array data.list[] 提领券队列
   * @return int data.list[].id 表序号
   * @return string data.list[].serial_number 序列号
   * @return string data.list[].heading_code 识别码
   * @return string data.list[].coupons_code 提领码
   * @return int data.list[].type 种类 1-提领券 2-电子券
   * @return int data.list[].status 状态 1-已激活 2-已注销 3-已停用 4-已过期 5-未激活
   * @return string data.list[].create_time 创建时间
   * @return string data.list[].modified_time 修改时间
   * @return string data.list[].start_time 有效期开始时间
   * @return string data.list[].end_time 有效过期时间
   * @return int data.list[].owner_id 当前拥有者
   * @return int data.list[].member_id 购买者
   * @return int data.list[].user_id 管理员id
   * @return int data.list[].cancel_id 核销码id
   * @return string data.list[].cancel_after_verification 核销码
   * @return string data.list[].cancel_time 核销时间
   * @return int data.list[].order_id 兑换商品的订单id
   * @return int data.list[].electronic_order_id 购买电子券时的订单id
   * @return int data.list[].on_line 线上 1-支持 2-不支持
   * @return int data.list[].offline 线下 1-支持 2-不支持
   * @return int data.list[].is_postage 是否包邮 1-否 2-是
   * @return int data.list[].is_voucher 代金券 1-否 2-是
   * @return string data.list[].img 电子券二维码图片路径
   * @return string data.list[].comment 备注
   * @return string data.list[].goods_id 兑换的商品id
   * @return string data.list[].price 兑换的商品价格
   * @return string data.list[].picture 兑换的商品图片
   * @return string data.list[].goods_name 兑换的商品名称
   * @return string msg 错误提示
   */
   public function getExchangeList(){
	   $params = $this->retriveRuleParams('getExchangeList');
	   return $this->CouponDm->getExchangeList($params);
   }
  /**
   * 提领券兑换
   * @desc 提领券兑换接口
   *
   * @param int user_id 用户ID
   * @param int address_id 地址库ID
   * @param string id_code 识别码
   * @param string code 验证码
   * @param int dis_type 配送方式 0 快递，1自提
   * @return int ret 操作状态：200表示成功
   * @return array data[] 参数集
   * @return array data.Status 1:操作成功;-1:操作出错
   * @return array data.Description 错误信息
   * @return string msg 错误提示
   */
   
   public function exChange(){
	   $params = $this->retriveRuleParams('exChange');
	   return $this->CouponDm->exChange($params);
	   
   }
   
  /**
   * 获取提领券卡券详情
   * @desc 获取提领券详情接口
   *
   * @param int user_id 用户ID
   * @param string id_code 卡券识别码
   * @return int ret 操作状态：200表示成功
   * @return array data[] 参数集
   * @return array data.Status 1:操作成功;-1:操作出错
   * @return array data.Description 错误信息
   * @return string msg 错误提示
   */
   public function getDetail(){

	   $params = $this->retriveRuleParams('getDetail');

	   return $this->CouponDm->getDetail($params);
	   
   }
   /**
   * 获取优惠券列表
   * @desc 获取优惠券列接口接口
   *
   * @param int user_id 用户ID
   * @param string id_code 卡券识别码
   * @return int ret 操作状态：200表示成功
   * @return array data[] 参数集
   * @return int data.total 数据总条数
   * @return int data.page 当前页码
   * @return array data.list[] 优惠券列表
   * @return int data.list[].coupon_id 优惠券id
   * @return int data.list[].coupon_type_id 优惠券类型id
   * @return int data.list[].shop_id 店铺Id
   * @return syting data.list[].coupon_code 优惠券编码
   * @return int data.list[].uid 领用人
   * @return int data.list[].use_order_id 优惠券使用订单id
   * @return int data.list[].create_order_id 创建订单id
   * @return float data.list[].money 面额
   * @return string data.list[].fetch_time 领取时间
   * @return string data.list[].use_time 使用时间
   * @return int data.list[].state 优惠券状态：0未领用，1已领取（未使用），2已使用，3已过期
   * @return string data.list[].start_time 有效期开始时间
   * @return string data.list[].end_time 有效期结束时间
   * @return int data.list[].get_type 获取方式1订单2.首页领取
   * @return int data.list[].wx_bind 是否绑定了微信卡券:0-否，1-是
   * @return string data.list[].coupon_name 优惠券名称
   * @return int data.list[].deduction_type 抵扣类型：1-折扣，2-现金，3-包邮
   * @return float data.list[].percentage 折扣
   * @return int data.list[].at_least 满多少元使用，0代表无限制
   * @return string msg 错误提示
   */
   public function getCouponList(){
	   $params = $this->retriveRuleParams('getCouponList');
	   return $this->CouponDm->getCouponList($params);
	   
   }


   /**
    * 获取全部优惠券种类
    * @desc 获取全部优惠券种类
    *
    * @return array list
    */
   public function getAllType() {
   
     return $this->CouponDm->getAllType($this->retriveRuleParams(__FUNCTION__));   
   
   }

   /**
    * 兑换优惠券
    * @dexc 兑换优惠券
    *
    * @return int num
    */
   public function exchangeCoupon() {
   
     return $this->CouponDm->exchangeCoupon($this->retriveRuleParams(__FUNCTION__));
   
   }

}
