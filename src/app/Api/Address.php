<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 16:48
 */

namespace App\Api;

use App\Api\BaseApi;
use App\Domain\AddressDm;
/**
 * 收货地址接口
 *
 * @author: Xiao Qiang <2938922@qq.com> 2017-10-20
 */
class Address extends BaseApi{

     public function getRules(){
         return $this->rules(array(
              // 新增收货地址
              'add' => array(
                            'token' => 'token|string|true||用户令牌',
                  'name' => 'name|string|true||收货人',
                  'phone' => 'phone|string|true||收货人电话',
                  'province' => 'province|string|false||省ID',
                  'province_name' => 'province_name|string|false||省名称',
                  'city' => 'city|string|false||市ID',
                  'city_name' => 'city_name|string|false||市名称',
                  'area' => 'area|string|false||区/县ID',
                  'area_name' => 'area_name|string|false||区/县名称',
                  'address' => 'address|string|false||详细地址',
                  'default' => 'default|boolean|true|false|是否为默认地址',
              ),
                     //修改收货地址
              'edit' => array(
                  'token' => 'token|string|true||用户令牌',
                  'address_id' => 'address_id|int|true|0|地址库ID',
                  'name' => 'name|string|true||收货人',
                  'phone' => 'phone|string|true||收货人电话',
                  'province' => 'province|string|false||省ID',
                  'province_name' => 'province_name|string|false||省名称',
                  'city' => 'city|string|false||市ID',
                  'city_name' => 'city_name|string|false||市名称',
                  'area' => 'area|string|false||区ID',
                  'area_name' => 'area_name|string|false||区/县名称',
                  'address' => 'address|string|false||详细地址',
                  'default' => 'default|boolean|true|false|是否为默认地址',
                  //'is_deleted' => 'is_deleted|boolean|true|false|是否删除 0正常 1已删除',
                  
              ),
               //删除收货地址
               'del' => array(
                   'token' => 'token|string|true||用户令牌',
                   'address_id' => 'address_id|int|true|0|地址库ID',
                   
               ),
               //获取收货地址明细
               'getAddressDetail' => array(
                  'token' => 'token|string|true||用户令牌',
                  'address_id' => 'address_id|int|false||地址库ID',
                  'default' => 'default|boolean|false||默认地址',
                  'shop_id' => 'shop_id|int|false||门店id',
               ),
               //获取收货地址列表=
              'getAddressList' => array(
                  'token' => 'token|string|true||用户令牌',
                  'shop_id' => 'shop_id|int|false||门店id',
                  'page' => 'page|int|true|1|当前页码',
                  'page_num' => 'page_num|int|true|20|每页数据条数',
              ),
              
               //全国地址库接口
               'getAddressLib' => array(
                   // 'type' => 'type|string|true|2|1区域 2省 3市 4区',
                   // 'parent_id' => 'parent_id|int|false||父级ID（TYPE为3 或4  时 parent_id 必传)',
                   //'province' => 'province|int|false|9|省ID',
                   //'city' => 'city|int|false|73|市',
               ),
               //
               'editDefault' => array(
                   'token' => 'token|string|true||用户令牌',
                   'address_id' => 'address_id|int|true||地址库ID',
                   
               ),
         ));
     }

  /**
    * 收货地址新增接口
    * @desc 收货地址新增接口
    *
    * @return int ret 操作状态：200表示成功
    * @return array data[] 参数集
    * @return array data.Status 1:操作成功;-1:操作出错
    * @return array data.Description 错误信息
    * @return string msg 错误提示
    */
    
     public function add(){

         $params = $this->retriveRuleParams(__FUNCTION__);

         $regulation = array(
         
            'token' => 'required',

         );

         \App\Verification($params, $regulation);

         return  $this->dm->add($params);

     }
     
  /**
    * 收货地址编辑接口
    * @desc 收货地址编辑接口
    *
    * @return int ret 操作状态：200表示成功
    * @return array data[] 参数集
    * @return array data.Status 1:操作成功;-1:操作出错
    * @return array data.Description 错误信息
    * @return string msg 错误提示
    */
     public function edit(){

         $params = $this->retriveRuleParams(__FUNCTION__);

         $regulation = array(
         
            'token' => 'required',

         );

         \App\Verification($params, $regulation);

         return $this->dm->edit($params);

     }

  /**
    * 删除收货地址
    * @desc 删除收货地址接口
    *
    * @param int user_id 用户ID
    * @return int ret 操作状态：200表示成功
    * @return array data[] 参数集
    * @return array data.Status 1:操作成功;-1:操作出错
    * @return array data.Description 错误信息
    * @return string msg 错误提示
    */
     public function del(){

         $params = $this->retriveRuleParams(__FUNCTION__);

         $regulation = array(
         
            'token' => 'required',

         );

         \App\Verification($params, $regulation);

         return $this->dm->del($params);

     }
  /**
    * 收货地址列表
    * @desc 获取收货地址列表接口
    *
    * @return int ret 操作状态：200表示成功
    * @return array data[] 参数集
    * @return int data.page 页码
    * @return int data.records 总条数
    * @return array data.data[] 地址数据
    * @return int data.data[].address_id 地址id
    * @return string data.data[].name 收件人
    * @return string data.data[].phone 手机号
    * @return int data.data[].province 省id
    * @return string data.data[].province_name 省名称
    * @return int data.data[].city 市id
    * @return string data.data[].city_name 市名称
    * @return int data.data[].area 区/县id
    * @return string data.data[].area_name 区/县名称
    * @return string data.data[].address 详细地址
    * @return boolean data.data[].default 默认收货地址
    * @return float data.list[].latitude 纬度
    * @return float data.list[].longitude 经度
    * @return int data.list[].is_out_of_range 是否超出配送范围 1-是 2-否
    * @return float data.list[].distance 距离，单位：米
    * @return string msg 错误提示
    */
     public function getAddressList(){

         $params = $this->retriveRuleParams(__FUNCTION__);

         $regulation = array(
         
            'token' => 'required',

         );

         \App\Verification($params, $regulation);

         return $this->dm->getAddressList($params);

     }

     /**
    * 获取收货地址明细
    * @desc 获取收货地址明细接口
    *
    * @return int ret 操作状态：200表示成功
    * @return array data[] 参数集
    * @return int data.address_id 地址id
    * @return string data.name 收件人
    * @return string data.phone 手机号
    * @return int data.province 省id
    * @return string data.province_name 省名称
    * @return int data.city 市id
    * @return string data.city_name 市名称
    * @return int data.area 区/县id
    * @return string data.area_name 区/县名称
    * @return string data.address 详细地址
    * @return boolean data.default 默认收货地址
    * @return float data.latitude 纬度
    * @return float data.longitude 经度
    * @return int data.is_out_of_range 是否超出配送范围 1-是 2-否
    * @return float data.distance 距离，单位：米
    * @return string msg 错误提示
    */
    public function getAddressDetail(){

        $params = $this->retriveRuleParams(__FUNCTION__);

        return $this->dm->getAddressDetail($params);

        
    }
    /**
    * 全国地址库接口
    * @desc 全国地址库接口
    *
    * @return int ret 操作状态：200表示成功
    * @return array data[] 参数集
    * @return array data.Status 1:操作成功;-1:操作出错
    * @return array data.Description 错误信息
    * @return string msg 错误提示
    */
    public function getAddressLib(){

        $params = $this->retriveRuleParams(__FUNCTION__);

        return $this->dm->getAddressLib($params);

    }
    /**
    * 修改默认地址接口
    * @desc 修改默认地址接口
    *
    * @return int ret 操作状态：200表示成功
    * @return array data[] 参数集
    * @return array data.Status 1:操作成功;-1:操作出错
    * @return array data.Description 错误信息
    * @return string msg 错误提示
    */
    public function editDefault(){

        $params = $this->retriveRuleParams(__FUNCTION__);

         $regulation = array(
         
            'token' => 'required',

         );

         \App\Verification($params, $regulation);

        return $this->dm->editDefault($params);

        
    }
}
