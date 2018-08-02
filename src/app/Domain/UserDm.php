<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 11:03
 */

namespace App\Domain;


use PhalApi\Exception\BadRequestException;
use App\Library\RedisClient;
//use App\Library\wxBizDataCrypt;

class UserDm {

    /**
     * 查询会员消息列表
     */
    public function getMemberMessage ($conditions) {

      $conditions['way'] = 1;

      $response = \App\apiRequest('App.MemberMessage.queryList',$conditions);

      $list = $response['list'];

      foreach($list as $key => $item) {
      
        $time = strtotime($item['created_at']);

        $today = strtotime(date('Y-m-d'));

        if ($time >= $today) {
        
          $item['created_at'] = date('H:i:s', $time);
        
        } elseif ($time > ($today - 3600 * 24)) {
        
          $item['created_at'] = '昨天 ' . date('H:i:s', $time);

        } else {
        
          $item['created_at'] = date('m-d H:i:s', $time);
        
        }

        $response['list'][$key] = $item;
      
      }

      return $response;

    }
    
  /**
   * 用户微信登录
   *
   * @param array $data
   *
   * @return array $response
   */
    public function wxLogin($data){

        $auth = $this->memberLogin($data);

        $userinfo = $this->getMemberDetailInfo($auth);

        $response = array(
        
          'auth' => $auth,

          'userinfo' => $userinfo
        
        );

        return $response;
        
    }

  /**
   * 用户登录
   *
   * @param array $data
   *
   * @return array $mapping
   */
  public function memberLogin($data) {
  
   $params = array('code' => $data['code']);

   if ($data['recommend']) {
   
     $params['recommend'] = $data['recommend'];
   
   }
   
   $res = \App\apiRequest('App.Member.Login', $params);

   return $res;

  }

  /**
   * 获取用户优惠券数量
   *
   * @param array $data
   *
   * @return array $count
   */
  public function getCouponCount($data) {

    $params = array('way' => 1, 'token' => $data['token']);

    if ($data['state']) {
        $params['state'] = $data['state'];
    }
  
    $res = \App\apiRequest('App.Coupon.QueryCount',$params);

    return $res ? $res : 0;
  
  }

  /**
   * 获取用户帐户详情
   *
   * @param array $data
   *
   * @return array $mapping
   */
  public function getMemberAccountDetail($data) {

    $res = \App\apiRequest('App.MemberAccount.GetDetail',$data);
    
    $data['state'] = 1;

    $mapping = array(

      'user_id' => $res['uid'],
      'balance' => $res['balance'],
      'intergral' => $res['point'],
      'card_id' => $res['card_id'],
      'qrcode' => $res['card_id_qr_code'],
      'acc_cunsum' => $res['member_cunsum'],
      'acc_intergral' => $res['member_sum_point'],
      'barcode' => $res['bar_code'],
      'coupons' => $this->getCouponCount($data),

    );

    return $mapping;
  
  }

  /**
   * 获取用户基本信息
   * 
   * @param array $data
   *
   * @param array $mapping
   */
  public function getMemberDetailInfo($data) {

    $params = array('way' => 1, 'token' => $data['token']);

    $res = \App\apiRequest('App.Member.GetDetail',$params);

    $mapping = array(
      'member_name' => $res['member_name'],
      'level' => $res['member_level'],
      'reg_time' => $res['reg_time'],
      'pic_head' => $res['user_headimg'],
      'phone' => $res['user_tel'],
      'openid' => $res['wx_openid'],
      'sex' => $res['sex'],
      'birthday' => $res['birthday'],
      'location' => $res['location'],
      'nick_name' => $res['nick_name'],
      'provider' => $res['provider']
    );
  
    return $mapping;

  }
    

  public function add($data){
    
    // $pc = new WXBizDataCrypt($appid, $sessionKey);
    // $errCode = $pc->decryptData($data['encryptedData'], $data['iv'], $data );
    
      return true;
  }

  public function edit($data){
    
      $params['token'] = $data['token'];

      if (isset($data['user_id']) && $data['user_id'] != ''){
          $params['uid']  = $data['user_id'] ;
      }
      if (isset($data['real_name']) && $data['user_name'] != ''){
          $params['real_name']  = $data['user_name'];
      }
      if (isset($data['user_headimg']) && $data['user_headimg'] != ''){
          $params['user_headimg']  = $data['user_headimg'];
      }
      if (isset($data['nick_name']) && $data['nick_name'] !=''){
          $params['nick_name'] = $data['nick_name'];
      }
      if (isset($data['openid']) &&  $data['openid'] != ''){
          $params['openid'] = $data['openid'];
      }
      if (isset($data['sex']) && $data['sex'] != ''){
          $params['sex'] = $data['sex'];
      }
      if (isset($data['date']) && $data['date']){
          $params['birthday'] = $data['date'];
      }
      
      return \App\apiRequest('App.User.Update',$params);
      
  }

    public function getUser($data){
        
        $params['way'] = 1;
        $params['token'] = $data['token'];
        
        $res = \App\apiRequest('App.User.GetUser', $params);
        
        $result = \App\apiRequest('App.Coupon.QueryCount',$params);

        if ($result){
            $coupons = $result;
        }

        $return['card_name'] ='路每家会员';
        $return['card_num'] = '952795279527';
        $return['stars'] = '3';            
        $return['QRcode_url'] ='http://oyboujb2k.bkt.clouddn.com/qrcode.png';
        $return['validity_from'] = '2017.10.23';
        $return['validity_to'] = '2018.10.23';

        $return['user_id'] = $res['uid'];
        $return['user_name'] = $res['real_name'];
        $return['phone'] = $res['user_tel'];
        $return['pic_head'] = $res['user_headimg'];
        $return['nick_name'] = $res['nick_name'];
        $return['openid'] = $res['wx_openid'];
        $return['sex'] = $res['sex'];
        $return['birthday'] = $res['birthday'];
        $return['balance'] = $res['balance'];
        $return['integral'] = $res['point'];
        $return['coupons'] = $coupons;


        return $return;
        
    }
    
    public function signup($data){
        
        $params['token'] = $data['token'];
        
        $res = \App\apiRequest('App.MemberSign.Add',$params);
        
        //return $res;
        if (is_numeric($res)){
            return array('result' => true ,'integral' =>30);
        }
        
        //return array('result' => true ,'days' =>3,'integral' =>10);
    }

    public function getsignupinfo($data){
        
        $params['token'] = $data['token'];
        $params['way'] = 1;
        $params['page'] = $data['page'];
        $params['page_size'] = $data['page_num'];
        
        $sDate = time();
        
        $params['sign_time'] = 'eg|'.strtotime(date('Y-m-01',time()));

        $res = \App\apiRequest('App.MemberSign.QueryList',$params);
        
        $day = (int)date('d',time()) ;
        
        $i=0;
        $d ;
        $isSigned ;
        
        $isBreak = false;
        $isFind = false;
        
        for ($v=$day;$v>=1;$v--){

            foreach($res['list'] as $key => $val ){
                
                if ($val['sign_time'] >= strtotime(date('Y-m-'.$v,$sDate)) && $val['sign_time'] <= strtotime(date('Y-m-'.$v.' 23:59:59',$sDate))) {
                    $isFind =true;
                    if ($v==$day){
                        $isSigned=true ;
                    }
                    if ($v==$day-1){
                        $isBreak=false;

                    }
                    if ($isBreak == false ){
                        $i++;
                    }
                    
                    $d[] = $v ;
                    //$d[] =   $v;
                    break;
                }
            }
            
            
            if ($isFind== true){
                $isFind =false;
            }else{
                $isBreak=true;
            }
            
        }
        
        //return $data['date'];
        if (date('Y-m',strtotime($data['date'])) != date('Y-m',time()) && isset($data['date']) && $data['date'] != ''){
            //return '不等于';
            
            unset($params);
            unset($res);
            
            $params['token'] = $data['token'];
            $params['way'] = 1;
            //$params['sign_time'] = 'eg|'.strtotime(date('Y-m-d 0:0:0')).';el|'.strtotime(date('Y-m-d 23:59:59'));
            $params['sign_time'] = 'eg|'.strtotime(date('Y-m-01',strtotime($data['date']))).';l|'.strtotime(date('Y-m-01',strtotime($data['date'].' +1 month')))   ;
            
            //return $params;
            $res =\App\apiRequest('App.MemberSign.QueryList',$params);
            unset ($d);
            unset ($sDate);
            
            $sDate= strtotime($data['date']);
            //return $res;
            for ($v=$day;$v>=1;$v--){
                foreach($res['list'] as $key => $val ){
                    
                    if ($val['sign_time'] >= strtotime(date('Y-m-'.$v,$sDate)) && $val['sign_time'] <= strtotime(date('Y-m-'.$v.' 23:59:59',$sDate))) {
                        
                        $d[] = $v ;
                        
                        break;
                    }
                }
                
            } 
            
            
            
        }
        //return $d;
        
        return array(
            'dayList' => $d,
            'days' => $i,
            'isSigned' => $isSigned,
            'integral' => 30,
        );
        
        return array(
            'dayList' => array(1,2,3,4,5,9,10,11,
            ),
            'days' => 3,
            'isSigned' => true,
            'integral' => 30,
            
        );
    }
  public function bindphone($data){

      $params['token'] = $data['token'];

      $params['phone'] = $data['phone'];

      $params['code'] = $data['code'];

      $params['birthday'] = $data['birthday'];

      $params['member_name'] = $data['member_name'];

      $params['encryptedData'] = $data['encryptedData'];

      $params['iv'] = $data['iv'];

      $params['session_key'] = $data['session_key'];

      $params['share_code'] = $data['share_code'];

      $res = \App\apiRequest('App.User.BindingsPhone',$params);

    $account = self::getMemberAccountDetail(array( 'token' => $data['token'] ));

    $res['account'] = $account;
    
      if ($res){

          return $res;

      } elseif($res==false){

          return false;

      }else{

          throw new BadRequestException('绑定手机失败！', 1);

      }
  }
    
    public function userShare($data){
        
        //return $data;
        
        $res = \App\apiRequest('App.ShareRecord.Add',$data);
        
        return $res;
        
    }

    public function register($data){
        $params['token'] = $data['token'] ;
        $params['nickName'] = $data['nickName'];
        $params['avatarUrl'] = $data['headUrl'];
        $params['gender'] = $data['sex'];
        $params['country'] = $data['country'];
        $params['province'] = $data['province'];
        $params['city'] = $data['city'];
        $params['language'] = $data['language'];
        $params['encryptedData'] = $data['encryptedData'];
        $params['iv'] = $data['iv'];
        $params['session_key'] = $data['session_key'];
        $params['shop_id'] = $data['shop_id'];
        $params['member_name'] = $data['realName'];

        $res = \App\apiRequest('App.Member.Register',$params);

        return $res;


    }

    public function checkcode($data){
        $params['code'] = $data['code'];
        $params['mobile'] = $data['mobile'];

        $res = \App\apiRequest('App.MobileVerifyCode.CheckCode',$params);

        return $res;

    }
    
    public function sendVerifyCode($data){
        $params['mobile'] = $data['mobile'];

        $res = \App\apiRequest('App.Sms.SendVerify',$params);

        return $res;

    }

    public function getSignRewards($data){
        $params['token'] = $data['token'];
        $res = \App\apiRequest('App.MemberSign.GetSignRewards',$params);

        return $res;

    }

    public function memberEdit($data){
        $params['token'] = $data['token'];
        $params['way'] = 1;
        if (isset($data['member_name']) && $data['member_name'] !=''){
            $params['member_name'] = $data['member_name'];
        }
        
        if (isset($data['member_level']) && $data['member_level'] !=''){
            $params['member_level'] = $data['member_level'];
        }

        if (isset($data['reg_time']) && $data['reg_time'] !=''){
            $params['reg_time'] = $data['reg_time'];
        }

        if (isset($data['memo']) && $data['memo'] !=''){
            $params['memo'] = $data['memo'];
        }

        if (isset($data['user_password']) && $data['user_password'] !=''){
            $params['user_password'] = $data['user_password'];
        }

        if (isset($data['user_headimg']) && $data['user_headimg'] !=''){
            $params['user_headimg'] = $data['user_headimg'];
        }

        if (isset($data['nick_name']) && $data['nick_name'] !=''){
            $params['nick_name'] = $data['nick_name'];
        }
        if (isset($data['birthday']) && $data['birthday'] !=''){
            $params['birthday'] = $data['birthday'];
        }
        if (isset($data['locaton']) && $data['locaton'] !=''){
            $params['location'] = $data['locaton'];
        }
        if (isset($data['sex']) && $data['sex'] !=''){
            $params['sex'] = $data['sex'] ;
        }
        if (isset($data['user_tel']) && $data['user_tel'] != '') {
            $params['user_tel'] = $data['user_tel'];
        }


        $res = \App\apiRequest('App.Member.Update',$params);

        //return $res ;

        if ($res > 0){

            unset($params);
            $params['token'] = $data['token'];
            return $this->memberDetail($params) ;
        }else{
            return false;
        }


    }

    public function memberDetail($data){
        $params['token'] = $data['token'];
        $params['way'] = 1;
        $params['status'] = 2;

        $res = \App\apiRequest('App.Member.GetDetail',$params);

        //return $res;

        $return['uid'] = $res['uid'];
        $return['member_name'] = $res['member_name'];
        $return['member_level'] = $res['member_level'];
        //$return['user_name'] = $res['user_name'];
        $return['user_headimg'] = $res['user_headimg'];
        $return['phone'] = $res['user_tel'];
        $return['openid'] = $res['wx_openid'];
        //$return['real_name'] = $res['real_name'];
        $return['sex'] = $res['sex'] ;
        $return['birthday'] = $res['birthday'];
        $return['nick_name'] = $res['nick_name'];
        $return['card_url'] =$res['card_url'];
        return $return;

    }

    public function getQRcode($data){
        return \App\apiRequest('App.Member.GetQrCode',$data);
        
    }

  /**
   * 获取粉丝列表
   *
   * @param array $data
   *
   * @return array $list
   */
  public function getFansList($data) {
  
    return \App\apiRequest('App.Member.GetFansList', $data);
  
  }

  /**
   * 更换用户手机号
   *
   * @param array $data
   *
   * @return array $list
   */
  public function changePhone($data) {
  
    return \App\apiRequest('App.User.ChangePhone', $data);
  
  }

  /**
   * 获取用户推荐二维码
   *
   * @param array $data
   *
   * @return array $list
   */
  public function getMiniQrCode($data) {
  
    return \App\apiRequest('App.Wechat.GetMiniTempCode', $data);
  
  }

}
