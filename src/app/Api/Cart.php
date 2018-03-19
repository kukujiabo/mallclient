<?php
namespace App\Api;

/**
 * 购物车接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-19
 */
class Cart extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'addToCart' => array(
      
        'token' => 'token|string|true||用户令牌',

        'buyer_id' => 'buyer_id|int|false||用户id',

        'shop_id' => 'shop_id|int|false||卖家店铺id',

        'shop_name' => 'shop_name|string|false||店铺名称',

        'goods_id' => 'goods_id|int|true||商品id',

        'goods_name' => 'goods_name|string|false||商品名称',

        'sku_id' => 'sku_id|int|false||商品的skuid',

        'sku_name' => 'sku_name|string|false||商品的sku名称',

        'price' => 'price|float|false||商品价格',
        
        'num' => 'num|int|true||商品数量',

        'goods_picture' => 'goods_picture|string|false||商品图片',

        'bl_id' => 'bl_id|int|false||组合套装ID'
      
      ),

      'getList' => array(
      
        'token' => 'token|string|false||用户令牌（way为1则必传）',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|true|1|页码',

        'page_size' => 'page_size|int|true|20|每页数据条数'
      
      )
    
    ));
  
  }

  /**
   * 添加购物车
   * @desc 添加商品到购物车
   *
   * @return 
   */
  public function addToCart() {
  
    return $this->dm->addToCart($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询购物车列表商品
   * @desc 查询购物车列表商品
   *
   * @return
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
