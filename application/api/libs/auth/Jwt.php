<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/7/25
 * Time: 11:05
 */

namespace app\api\libs\auth;


use app\common\libs\exception\ApiException;
use think\Controller;

/**
 * api 授权码管理
 * Class Jwt
 * @package app\common\libs
 */
class Jwt extends Controller
{

    /**
     * jwt 加密密钥
     * @var string
     */
     protected static $key = '';

    /**
     * jwt 加密算法
     * @var string
     */
     protected static $alg = '';

    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        self::$key = '1234';
        self::$alg = 'HS256';
    }


    /**
     * 估计要完善一下
     * 生成授权码  加密
     * @param array $userInfo
     */
    public  static function getToken(array $userInfo){
        $datas= [
            "iss"=>"",  //签发者 可以为空
            "aud"=>"", //面象的用户，可以为空
            "iat" => time(), //签发时间
            "nbf" => time()+100, //在什么时候jwt开始生效  （这里表示生成100秒后才生效）
            "exp" => time()+7200, //token 过期时间
            "uid" => 123 //记录的userid的信息，这里是自已添加上去的，如果有其它信息，可以再添加数组的键值对
        ];

        $jwt = \Firebase\JWT\JWT::encode($datas,self::$key,self::$alg); //根据参数生成了 token

        $result = [
            'code'=>1,
            'msg'=>'ok',
            'token'=>$jwt,
        ];
        return json($result);
    }


    /**
     * 解密授权码
     */
    public static function checkToken($authorization){
        $datas = \Firebase\JWT\JWT::decode($authorization,self::$key,[self::$alg]);

        // 检测授权码
        if ($datas == false){
            throw new ApiException('非法授权码');
        }

        // 返回解密的信息[用户的信息]
        return $datas;
    }
}