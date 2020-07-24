<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/7/24
 * Time: 18:07
 */

namespace app\common\libs\exception;


use think\exception\Handle;

class ApiHandleException extends Handle
{

    // https://blog.csdn.net/qq_43737121/article/details/105637554
    /*
     * http状态码
     */
    public $httpCode = 500;
    public function render(\Exception $e)
    {
        if(config('app_debug') == true){
            return parent::render($e);
        }
        if($e instanceof ApiException){
            $this->httpCode = $e->httpCode;
        }
        return show(0, $e->getMessage(), [], $this->httpCode);
    }

}