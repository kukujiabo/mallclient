<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-18
 * Time: 17:23
 */

namespace App\Api;

use App\Api\BaseApi;
use App\Domain\ModuleDm;

/**
 * 用户功能模块接口
 *
 * @author: xiao qiang 2017-10-19
 */
 
class Module extends BaseApi{
    private $ModuleDm;

    public function  __construct(){
        parent::__construct();
        $this->ModuleDm= new ModuleDm();
    }

    public function getRules(){
        return $this->rules(array(
			//用户功能模块接口
            'index' => array(
                  'token' => 'token|string|false||用户令牌',
            ),
        ));
    }
	
public function index(){
		$params = $this->retriveRuleParams('index');
        return $this->ModuleDm->index($params);
		
	}
}