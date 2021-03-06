<?php
namespace App\Api;

/**
 * 商品品牌
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-27
 */
class GoodsBrand extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getList' => array(
      
        'brand_name' => 'brand_name|string|false||品牌名称',

        'city_code' => 'city_code|string|false||城市编码',

        'index_show' => 'index_show|int|false||是否首页展示',

        'all' => 'all|int|false||是否获取全部'
      
      ),

      'getDetail' => array(
      
        'id' => 'id|int|true||品牌id'
      
      ),

      'getAll' => array(
      
        'brand_name' => 'brand_name|string|false||品牌名称',

        'city_code' => 'city_code|string|false||城市编码'

      )
    
    ));
  
  }

  /**
   * 查询列表
   * @desc 查询列表
   *
   * @return array data
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询品牌详情
   * @desc 查询品牌详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }


  /**
   * 获取全部品牌
   * @desc 获取全部品牌
   *
   * @return array list
   */
  public function getAll() {
  
    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));
  
  }

}
