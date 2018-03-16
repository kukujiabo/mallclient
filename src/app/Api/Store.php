<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 15:13
 */

namespace App\Api;

use App\Api\BaseApi;
use App\Domain\StoreDm;

/**
 * 店铺管理接口
 *
 * @author: xiaoqiang 2017-10-19
 */
 
class Store extends BaseApi {

    public function getRules(){
        return  $this->rules(array(
			//获取店铺列表
            'getNearByStores' => array(
                'district_id' => 'district_id|int|false||地区编码（区/县id）',
                'lat' => 'lat|float|false||纬度 当lon存在时必传',
        				'lon' => 'lon|float|false||经度 当lat存在时必传',
        				'address' => 'address|string|false||地址',
                'page' => 'page|int|false|1|页码',
                'page_num' => 'page_num|int|false|8|每页显示数据条数',
                //'range' => 'range|float|true|3|距离',
            ),
			//获取店铺详细信息
            'getStoreInfo' => array(
                'store_id' => 'store_id|int|true||店铺ID',
            ),

            'getDistance' => array(

              'lng1' => 'lng1|float|true||第一个坐标的经度',

              'lat1' => 'lat1|float|true||第一个坐标的纬度',

              'lng2' => 'lng2|float|true||第二个坐标的经度',

              'lat2' => 'lat2|float|true||第二个坐标的纬度',
            
            ),

        ));
    }

  /**
   * 获取地图上两个坐标的直线距离
   * @desc 获取地图上两个坐标的直线距离
   *
   * @return int ret 操作状态：200表示成功
   * @return float data 距离，单位米
   * @return string msg 错误提示
   */
  public function getDistance() {

    $data = $this->retriveRuleParams('getDistance');

    $regulation = array(
      'lng1' => 'required',
      'lat1' => 'required',
      'lng2' => 'required',
      'lat2' => 'required'
    );

    \App\Verification($data, $regulation);

    return $this->dm->getDistance($data);
  
  }

	/**
   * 店铺列表
   * @desc 店铺列表
   *
   * @param string coupon_code 优惠券编码
   * @return int ret 操作状态：200表示成功
   * @return array data[] 参数集
   * @return int data[].store_id 表序号
   * @return string data[].store_name 店铺名称
   * @return string data[].logo 店铺logo
   * @return string data[].pic_address 店铺横幅
   * @return string data[].address 详细地址
   * @return int data[].province_id 店铺所在省份ID
   * @return int data[].city_id 店铺所在市ID
   * @return int data[].area_id 区/县ID
   * @return float data[].lat 纬度
   * @return float data[].lon 经度
   * @return int data[].phone 商家电话
   * @return string data[].text 介绍（描述）
   * @return float data[].distance 距离（单位：米）
   * @return int data[].is_outside_order 是否可点外卖 1-是 2-否
   * @return string data.thumbnail 门店缩略图
   * @return string msg 错误提示
   */
   
    public function getNearByStores(){
        $params = $this->retriveRuleParams('getNearByStores');
        return $this->dm->getNearbyStores($params);
    }

	/**
   * 门店详情
   * @desc 门店详情接口
   *
   * @param string coupon_code 优惠券编码
   * @return int ret 操作状态：200表示成功
   * @return array data[] 参数集
   * @return array data.Status 1:操作成功;-1:操作出错
   * @return array data.Description 错误信息
   * @return string msg 错误提示
   */
    public function getStoreInfo(){
        $params = $this->retriveRuleParams('getStoreInfo');
        return $this->dm->getStoreInfo($params);

    }
}