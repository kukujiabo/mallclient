<?php
namespace App\Api;

/**
 * 地理位置相关接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class Location extends BaseApi {

  public function getRules() {
  
    return $this->rules(array(
    
      'getAddress' => array(

        'latitude' => 'latitude|string|true||纬度',

        'longitude' => 'longitude|string|true||经度',
      
      ),

      'getCity' => array(
      
        'name' => 'name|string|false||城市名称',
      
        'id' => 'id|int|false||城市id'
      
      )
    
    ));
  
  }

  /**
   * 修改默认地址接口
   * @desc 修改默认地址接口
   *
   * @return int ret 操作状态：200表示成功
   * @return array data[] 结果参数集
   * @return array data.nation 国家名称
   * @return array data.province 省名称
   * @return array data.city 市名称
   * @return array data.district 区/县名称
   * @return array data.street 街道地址
   * @return array data.street_number 街道号码
   * @return array data.province_code 省 行政区划代码
   * @return array data.city_code 市 行政区划代码
   * @return array data.district_code 区/县 行政区划代码
   * @return string msg 错误提示
   */
  public function getAddress() {
  
    $params = $this->retriveRuleParams('getAddress');

    return $this->dm->getAddress($params);
  
  }

  /**
   * 查询城市列表
   * @desc 查询城市列表
   *
   * @return array list
   */
  public function getCity() {
  
    $params = $this->retriveRuleParams('getAddress');  

    return $this->dm->getCity($params);
  
  }

}
