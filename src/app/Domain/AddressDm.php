<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 11:54
 */

namespace App\Domain;
use PhalApi\Exception\BadRequestException;

class AddressDm {

    public function add($data){
        $params['token'] = $data['token'];
        $params['consigner'] = $data['name'];
        $params['mobile'] = $data['phone'];
        $params['province'] = $data['province'];
        $params['province_name'] = $data['province_name'];
        $params['city'] = $data['city'];
        $params['city_name'] = $data['city_name'] ;
        $params['district'] = $data['area'];
        $params['district_name'] = $data['area_name'];
        $params['address'] = $data['address'];
        $params['is_default'] = $data['default']==true?1:2;
        
        return \App\apiRequest('App.UserAddress.AddAddress',$params);
        
    }

    public function edit($data){
        $params['token'] = $data['token'];
        $params['address_id'] = $data['address_id'];
        if (isset($data['name']) && $data['name'] != ''){
            $params['consigner'] = $data['name'];
        }
        if (isset($data['phone']) && $data['phone'] != ''){
            $params['mobile'] = $data['phone'];
        }
        if (isset($data['province']) && $data['province'] != ''){
            $params['province'] = $data['province'] ;
        }
        if (isset($data['province_name']) && $data['province_name'] != ''){
            $params['province_name'] = $data['province_name'] ;
        }
        if (isset($data['city']) && $data['city'] != '') {
            $params['city'] = $data['city'];
        }
        if (isset($data['city_name']) && $data['city_name']!= '') {
            $params['city_name'] = $data['city_name'];
        }
        if (isset($data['area']) && $data['area'] != ''){
            $params['district'] = $data['area'];
        }
        if (isset($data['area_name']) && $data['area_name'] != ''){
            $params['district_name'] = $data['area_name'];
        }
        if (isset($data['address']) && $data['address'] != ''){
            $params['address'] = $data['address'];
        }
        if (isset($data['default']) ){
            $params['is_default'] = $data['default']==true?1:2;
        }
        //return $params;
        //$res = \App\apiRequest('App.UserAddress.UpdateAddress',$params);
        return \App\apiRequest('App.UserAddress.UpdateAddress',$params);
        
    }
    public function del($data){
        $params['token'] = $data['token'];
        $params['address_id'] = $data['address_id'];
        
        return \App\apiRequest('App.UserAddress.Remove',$params);
        
    }
    public function getAddressDetail($data){
        
        $params['token'] = $data['token'];
        $params['address_id'] = $data['address_id'];
        if ($data['shop_id']) {
            $params['shop_id'] = $data['shop_id'];
        }
        $params['is_default'] = $data['default'] == true?1:2;
        
        $res = \App\apiRequest('App.UserAddress.GetAddressDetails',$params);

        if (!empty($res)) {
        
          $return['address_id'] = $res['id'];
          $return['name'] = $res['consigner'];
          $return['phone'] = $res['mobile'];
          $return['province'] = $res['province'];
          $return['province_name'] = $res['province_name'];
          $return['city'] = $res['city'];
          $return['city_name'] = $res['city_name'];
          $return['area'] = $res['district'];
          $return['area_name'] = $res['district_name'];
          $return['address'] = $res['address'];
          $return['latitude'] = $res['latitude'];
          $return['longitude'] = $res['longitude'];
          $return['default'] = ($res['is_default'] == '1')?true:false;
          $return['is_out_of_range'] = $res['is_out_of_range'] ? $res['is_out_of_range'] : 2;
          $return['distance'] = $res['distance'] ? $res['distance'] : 0;
            
          return $return;

        } else {
        
          return $res;
        
        }


    }
    
    public function getAddressList($data){
        
        $params['token'] = $data['token'];
        if ($data['shop_id']) {
            $params['shop_id'] = $data['shop_id'];
        }
        $params['page'] = $data['page'];
        $params['page_size'] = $data['page_size'];
        
        $res = \App\apiRequest('App.UserAddress.GetAddressList',$params);
        
        $return['page'] = $res['page'];
        $return['records'] = $res['total'];
        
        foreach ($res['list'] as $key => $val){
            
            $return['data'][$key]['address_id'] = $val['id'];
            $return['data'][$key]['name'] = $val['consigner'];
            $return['data'][$key]['phone'] = $val['mobile'];
            $return['data'][$key]['province'] = $val['province'];
            $return['data'][$key]['province_name'] =$val['province_name'];
            $return['data'][$key]['city'] = $val['city'];
            $return['data'][$key]['city_name'] = $val['city_name'];
            $return['data'][$key]['area'] = $val['district'];
            $return['data'][$key]['area_name'] = $val['district_name'];
            $return['data'][$key]['address'] = $val['address'];
            $return['data'][$key]['longitude'] = $val['longitude'];
            $return['data'][$key]['latitude'] = $val['latitude'];
            $return['data'][$key]['default'] = $val['is_default']==1?true:false;
            $return['data'][$key]['is_out_of_range'] = $val['is_out_of_range'] ? $val['is_out_of_range'] : 2;
            $return['data'][$key]['distance'] = $val['distance'] ? $val['distance'] : 0;
            
        }
        
        return $return;
    }

    public function getAddressLib(){
        
        $params['type'] = 2;
        $res = \App\apiRequest('App.NationwideArea.QueryList', $params);
        $params['type'] = 3;
        $res1 = \App\apiRequest('App.NationwideArea.QueryList', $params);
        $params['type'] = 4;
        $res2 = \App\apiRequest('App.NationwideArea.QueryList', $params);
        
        $resback[] = $res;
        $resback[] = $res1;
        $resback[] = $res2;
        return $resback;
    }


    public function editDefault($data){
        $params['token'] = $data['token'];
        $params['address_id'] = $data['address_id'];
        
        $res = \App\apiRequest('App.UserAddress.EditDefault',$params);
        
        return $res;
        
        
    }

    public function searchAllAddress($params) {
    
        return \App\apiRequest('App.UserAddress.SearchAllAddress',$params);

    }
    
}
