<?php
namespace App\Api;

/**
 * 房屋布局接口
 *
 */
class HouseLayout extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(

      'create' => array(
    
        'layout_name' => 'layout_name|string|true||布局名称',

        'info' => 'info|string|false||其他信息'

      ),

      'getAll' => array(
      
      )
    
    ));
  
  }

  /**
   * 新建布局项目
   * @decs 新建布局项目
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询全部
   * @desc 查询全部
   *
   * @return array data
   */
  public function getAll() {

    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));
  
  }

}
