<?php
namespace App\Api;

/**
 * 商品接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-09
 */
class Goods extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getList' => array(

        'token' => 'token|string|false||用户令牌',

        'city_code' => 'city_code|int|false||城市代码',

        'user_level' => 'user_level|int|false|用户等级',
      
        'index_show' => 'index_show|int|false||首页展示',

        'category_id' => 'category_id|int|false||分类id',

        'sign' => 'sign|string|false||标签',

        'brand_id' => 'brand_id|int|false||品牌id',

        'goods_name' => 'goods_name|string|false||商品名称',

        'city_code' => 'city_code|int|false||城市代码',

        'user_level' => 'user_level|int|false||用户等级',

        'state' => 'state|int|false||状态',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|100|每页数据条数'
      
      ),

      'getRecommendGoodsList' => array(
      
        'sn' => 'sn|string|true||订单编号'
      
      ),

      'getDetail' => array(
      
        'city_code' => 'city_code|int|false||城市代码',

        'user_level' => 'user_level|int|false|用户等级',
      
        'goods_id' => 'goods_id|int|true||商品id'
      
      ),

      'getSkuDetail' => array(
      
        'sku_id' => 'sku_id|int|true||商品sku id',

        'city_code' => 'city_code|int|false||城市代码',

        'user_level' => 'user_level|int|false|用户等级'

      
      ),

      'getGoodsAttributeCombineValueList' => array(
      
        'goods_id' => 'goods_id|int|true||商品id，必传'
      
      ),
    
      'getSkuGoods' => array(
      
        'goods_id' => 'goods_id|int|true||商品id',
      
        'city_code' => 'city_code|int|false||城市代码',

        'user_level' => 'user_level|int|false|用户等级'
        
      ),

      'pay' => array(
      
        'token' => 'token|string|false||用户令牌（way为1则必传）',

        'shop_id' => 'shop_id|int|true||卖家店铺id',

        'address_id' => 'address_id|int|true||收货地址id',

        'goods_id' => 'goods_id|int|true||商品ID',

        'sku_id' => 'sku_id|int|false||商品skuID',

        'quantity' => 'quantity|int|true||商品数量',

        'user_money' => 'user_money|float|false||使用的余额',

        'point' => 'point|int|false||使用的积分',

        'buyer_message' => 'buyer_message|string|false||买家附言（备注）',

        'buyer_invoice' => 'buyer_invoice|string|false||买家发票信息',

        'coupon_id' => 'coupon_id|int|false||使用的优惠券id',

        'pay_type' => 'pay_type|int|false|1|支付方式',

        'workspace_id' => 'workspace_id|int|false|1|所属工地',

        'city_code' => 'city_code|int|false||城市编码',

        'invoice' => 'invoice|int|false|0|发票'
      
      ),

      'cartPay' => array(
      
        'way' => 'way|int|true|1|途径 1-前台会员 2-后台管理员',

        'token' => 'token|string|false||用户令牌（way为1则必传）',

        'buyer_id' => 'buyer_id|int|false||用户id（way为2则必传）',

        'shop_id' => 'shop_id|int|true||卖家店铺id',

        'address_id' => 'address_id|int|true||收货地址id',

        'cart_id' => 'cart_id|string|true||购物车商品id（英文逗号隔开）',

        'user_money' => 'user_money|float|false||使用的余额',

        'point' => 'point|int|false||使用的积分',

        'buyer_message' => 'buyer_message|string|false||买家附言（备注）',

        'city_code' => 'city_code|int|false||城市编码',

        'workspace_id' => 'workspace_id|int|false||城市编码',

        'pay_type' => 'pay_type|int|false|1|支付方式',

        'invoice' => 'invoice|int|false|0|发票'

      )

    ));
  
  }

  /**
   * 商品列表接口
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 商品详情
   * @desc 商品详情
   *
   * @return array info
   */
  public function getDetail() {

    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询商品列表
   * @desc 查询商品列表
   *
   * @return int ret 操作状态：200表示成功
   * @return array data[] 结果参数集
   * @return string msg 错误提示
   */
  public function getGoodsAttributeCombineValueList() {
  
    return $this->dm->getGoodsAttributeCombineValueList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询商品sku
   * @desc 查询商品sku
   *
   * @return int ret 
   */
  public function getSkuGoods() {
  
    return $this->dm->getSkuGoods($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询sku详情
   * @desc 查询sku详情
   *
   * @return int 
   */
  public function getSkuDetail() {
  
    return $this->dm->getSkuDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 结算
   * @desc 结算
   *
   * @return
   */
  public function pay() {
  
    return $this->dm->pay($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 购物车结算
   * @desc 购物车结算
   *
   * @return
   */
  public function cartPay() {
  
    return $this->dm->cartPay($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询订单推荐商品
   * @desc 查询订单推荐商品
   *
   */
  public function getRecommendList() {
  
    return $this->dm->getRecommendList($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
