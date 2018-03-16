<?php
namespace App\Exception;

/**
 * Api异常类
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class ApiException extends LogException {

  public function __construct($msg, $code) {
 
     parent::__construct( $msg, $code, 'api', $msg );
  
  }

}

