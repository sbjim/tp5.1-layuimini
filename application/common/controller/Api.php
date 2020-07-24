<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/7/17
 * Time: 9:50
 */

namespace app\common\controller;


use think\Controller;

/**
 * API 基础类
 * Class Api
 * @package app\common\controller
 */
class Api extends Controller
{
    use \app\api\libs\traits\Api;

}