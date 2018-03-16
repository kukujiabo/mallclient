<?php
namespace App\Library;

use App\SDK\PhalApiClient;
use App\Exception\ApiException;

/**
 * 封装对核心api的请求
 *
 * @author Meroc Chen <398515393@qq.com> 2017-10-09　
 */
class ApiRequest {

  /**
   * 请求url
   */
  protected $_url; 

  /**
   * phalapi客户端实例
   */
  protected $_client;

  protected static $_instance;

  protected function __construct() {
  
    $this->_url = \PhalApi\DI()->config->get('api.host');

    $this->_client = PhalApiClient::create()->withHost($this->_url);
  
  }

  /**
   * 请求api
   *
   */
  protected function request($service, $params, $timeout = 3000) {

    $request = $this->_client->reset()->withService($service);
        
    foreach($params as $key => $value) {
    
      $request->withParams($key, $value);
    
    }
  
    $request->withTimeout($timeout);

    $response = $request->request();

    if ($response->getRet() != 200) {

      throw new ApiException($response->getMsg(), $response->getRet());
    
    }  

    return $response;
  
  }

  public static function __callStatic($method, $args) {

    $self = get_called_class();
  
    if (!$self::$_instance) {

      $self::$_instance = new $self();

    }

    return call_user_func_array([$self::$_instance, $method], $args);
  
  }

}
