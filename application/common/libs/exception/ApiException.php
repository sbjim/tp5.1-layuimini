<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/7/24
 * Time: 18:07
 */

namespace app\common\libs\exception;


use think\Exception;

class ApiException extends Exception
{

    /**
     * 可以定义一下错误信息 以及 错误code
     * @var string
     */


    public $message = '';
    public $httpCode = 500;
    public $code = 0;

    public function __construct($message = "", $httpCode = 0, $code = 0)
    {
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->code = $code;
    }

}