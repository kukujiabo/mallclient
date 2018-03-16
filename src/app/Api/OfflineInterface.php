<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-17
 * Time: 14:15
 */

namespace App\Api;
use PhalApi\Api;
use App\Domain\OfflineInterfaceDm;

/**
 * 线下POS系统接口
 *
 * @author: xiao qiang 2017-10-19
 */
 
class OfflineInterface extends BaseApi {

    private $OfflineInterfaceDm;
    public function __construct() {
        parent::__construct();
        $this->OfflineInterfaceDm = new OfflineInterfaceDm();
    }

    public function getRules(){
        return $this->rules(array(
        	'getPayRecords' => array(
        		'token' => 'token|string|true||用户令牌',
        		'page' => 'page|int|false||页码',
        		'page_num' => 'page_num|int|false||每页显示记录数',

        	),
        	'getPayDetail' => array(
        		'token' => 'token|string|true||用户令牌',
        		'id' => 'id|string|true||表字段',

        	),

        )
    );
 	}
     /**
	 * 用户登陆
     * @desc 用户登陆接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
     public function getPayRecords(){
     	$params = $this->retriveRuleParams('getPayRecords');
     	return $this->OfflineInterfaceDm->getPayRecords($params);
     }

     /**
	 * 用户登陆
     * @desc 用户登陆接口
     *
     * @return int ret 操作状态：200表示成功
     * @return array params[] 参数集
     * @return array data.Status 1:操作成功;-1:操作出错
     * @return array data.Description 错误信息
     * @return string msg 错误提示
     */
     public function getPayDetail(){
     	$params = $this->retriveRuleParams('getPayDetail');
     	return $this->OfflineInterfaceDm->getPayDetail($params);

     }



   

}
