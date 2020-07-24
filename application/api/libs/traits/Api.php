<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/7/24
 * Time: 17:14
 */

namespace app\api\libs\traits;

use app\api\libs\auth\Auth;

/**
 * API 基础
 * Trait Api
 * @package app\api\libs\traits
 */
trait Api
{


    /**
     * 无需登录的方法,同时也就不需要鉴权了
     * @var array
     */
    public $noNeedLogin = [];

    /**
     * 无需鉴权的方法,但需要登录
     * @var array
     */
    public $noNeedRight = [];

    /**
     * 权限控制类
     * @var Auth
     */
    public $auth = null;

    /**
     * 模型对象
     * @var \think\Model
     */
    public $model = null;

    /**
     * Validate验证
     */
    public $_validate = false;

    /**
     * 数据获取最大的数量
     * 默认为禁用,若启用请务必保证表中存在admin_id字段
     */
    public $dataLimitCount = 100;



}