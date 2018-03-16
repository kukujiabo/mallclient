<?php
namespace App\Api;

/**
 * 商品分类接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-27
 */
class GoodsCategory extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(

      'getList' => array(
    
        'category_name' => 'category_name|string|false||分类名称',

        'index_show' => 'index_show|int|false||首页展示'

      )
    
    ));
  
  }

  /**
   * 查询分类列表
   * @desc 查询分类列表
   *
   * @return  array data
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
