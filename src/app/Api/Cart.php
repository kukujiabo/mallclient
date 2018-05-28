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

        'bl_id' => 'bl_id|int|false||组合套装ID',

        'city_code' => 'city_code|int|false||城市编码'
      
      ),

      'getList' => array(
      
        'token' => 'token|string|false||用户令牌（way为1则必传）',

        'selected_id' => 'selected_id|string|false||选中的商品',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|true|1|页码',

        'page_size' => 'page_size|int|true|20|每页数据条数'
      
      ),

      'updateCart' => array(
      
        'token' => 'token|string|true||用户令牌',
        
        'cart_id' => 'cart_id|int|true||购物车id',
      
        'num' => 'num|int|true||商品数量'
      
      ),

      'removeCart' => array(
      
        'token' => 'token|string|true||用户令牌',

        'cart_id' => 'cart_id|int|true||购物车id'
      
      ),

      'cartCount' => array(
      
        'token' => 'token|string|true||用户令牌',
      
      ),

      'emptyCart' => array(
      
        'token'  => 'token|string|true||用户令牌'
      
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

  /**
   * 更新购物车商品
   * @desc 更新购物车商品
   *
   * @return int
   */
  public function updateCart() {
  
    return $this->dm->updateCart($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 删除购物车商品
   * @desc 删除购物车商品
   *
   * @return int
   */
  public function removeCart() {
  
    return $this->dm->removeCart($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 购物车数量
   * @desc 购物车数量
   *
   * @return int 
   */
  public function cartCount() {
  
    return $this->dm->cartCount($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 清空购物车
   * @desc 清空购物车
   *
   * @return int
   */
  public function emptyCart() {

    return $this->dm->emptyCart($this->retriveRuleParams(__FUNCTION__));

  }


}
