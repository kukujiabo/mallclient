<?php

namespace App\Api;

use PhalApi\Api;
use App\Service\ActionLog;

/**
 * 接口基础服务
 *
 * @author Meroc Chen <398515393@qq.com> 2017-10-11
 */
class BaseApi extends Api {

  /**
   * domain实例
   */
  protected $dm;

  protected $_xtoken;

  /**
   * 构造函数
   */
  public function __construct() {

    $this->_checkAuth();

    $domainName = explode('\\', get_called_class()); 

    $this->dm = $this->domain($domainName[count($domainName) - 1]);
  
  }

  /**
   * 拼装规则
   */
  protected function rules($array) {

    $rules = array();

    foreach($array as $fname => $funcs) {

      $rules[$fname] = array();
    
      foreach ($funcs as $pName => $regulation) {

        $tmpArr = array();

        if (is_array($regulation)) {

          $tmpArr = $regulation;

        } else {
      
          $reguArr = explode('|', $regulation);
          
          $tmpArr['name'] = $reguArr[0];

          $tmpArr['type'] = $reguArr[1];

          $tmpArr['require'] = $reguArr[2] == 'true' ? true : false;

          $tmpArr['default'] = $reguArr[3];

          $tmpArr['desc'] = $reguArr[4];

        }

        $rules[$fname][$pName] = $tmpArr;
      
      }
    
    }

    return $rules;

  }

  /**
   * 返回api对应的domain实例
   */
  protected function domain($dname) {
  
    $domain = "\App\\Domain\\{$dname}Dm";

    return new $domain();
  
  }

  /**
   * 返回规则配置的请求参数
   */
  protected function retriveRuleParams($func) {

    $rules = $this->getRules();

    $funcRules = $rules[$func];

    $func_rules_public = $rules['*'];

    if (!empty($func_rules_public)) {
      
      if (empty($funcRules)) {

        $funcRules = array();

      }

      $funcRules += $func_rules_public;

    }

    $params = array();

    $paramNames = array_keys($funcRules);

    foreach($paramNames as $paramName) {

      if ($this->$paramName != '' || $funcRules[$paramName]['default'] != '') {
        
        $params[$paramName] = $this->$paramName;

      }
    
    }

    return $params;
  
  }

  /**
   * 鉴权
   */
  protected function _checkAuth() {
  
    $headers = getallheaders();

    if (\PhalApi\DI()->config->get('app.env') == 'pro') {
  
      if (!$headers['WX-TOKEN']) {
      
        exit('无权访问！');

      } else {
      
        $this->_xtoken = $headers['WX-TOKEN'];
      
      }

    }
  
  }

}
