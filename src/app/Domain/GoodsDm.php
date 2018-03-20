<?php
namespace App\Domain;

class GoodsDm {

  /**
   * 查询列表
   */
  public function getList($params) {
  
    return \App\apiRequest('App.Goods.QueryList', $params); 
  
  }

  /**
   * 获取详情
   */
  public function getDetail($params) {
  
    $good = \App\apiRequest('App.Goods.GetDetail', $params);

    $brand = \App\apiRequest('App.GoodsBrand.GetDetail', array('id' => $good['brand_id']));

    $category = \App\apiRequest('App.GoodsCategory.GetDetail', array('category_id' => $good['category_id']));

    $goodImages = \App\apiRequest('App.GoodsImages.GetAll', array('goods_id' => $good['goods_id']));

    $good['brand'] = $brand;

    $good['category'] = $category;

    $good['goods_image'] = $goodImages;

    return $good;
  
  }

  /**
   * 获取sku详情
   */
  public function getSkuDetail($params) {

    return \App\apiRequest('App.GoodsSku.GetDetail', $params);
  
  }

  /**
   * 获取商品规格 + 规格值列表
   */
  public function getGoodsAttributeCombineValueList($data) {
  
    /**
     * 获取规格列表
     */
    $attributes = self::getAttributeList($data);

    if (empty($attributes)) {
    
      return null;
    
    }

    /**
     * 获取规格值列表
     */
    $attributeValues = self::getAttributeValueList($data);

    /**
     * 拼接属性列表
     */
    foreach($attributes as $key => $attribute) {
    
      if (!$attribute['values']) {
      
        $attribute['values'] = array();

      }

      foreach($attributeValues as $attributeValue) {
      
        if ($attributeValue['attr_id'] == $attribute['attr_id']) {
        
          array_push($attribute['values'], $attributeValue);
        
        }
      
      }

      $attributes[$key] = $attribute;
    
    }

    return $attributes;
  
  }

  public function getAttributeList($data) {
    
    return \App\apiRequest('App.GoodsAttribute.GetAll', $data);
  
  }

  public function getAttributeValueList($data) {
    
    return \App\apiRequest('App.GoodsAttributeValue.GetAll', $data);
  
  }

  public function getSkuGoods($data) {
  
    return \App\apiRequest('App.GoodsSku.GetAll', $data); 
  
  }

  public function pay($data) {

    $data['way'] = 1;
  
    return \App\apiRequest('App.OrderTakeOut.Purchase', $data);
  
  }

  public function cartPay($data) {

    $data['way'] = 1;

    return \App\apiRequest('App.OrderTakeOut.Add', $data);

  }

}
