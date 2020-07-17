<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/7/17
 * Time: 17:02
 */

namespace app\common\validate;


use think\Validate;

/**
 * 验证器 基类
 * Class Backend
 * @package app\common\validate
 */
class Backend extends Validate
{
    protected $rule =   [
    ];

    protected $message  =   [
    ];

    protected $scene = [
        'store'=>[],
        'update'=>[],
    ];

}