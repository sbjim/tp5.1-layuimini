<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/7/17
 * Time: 17:05
 */

namespace app\common\model;


use think\Model;

/**
 * model 基类
 * Class Backend
 * @package app\common\model
 */
class Backend extends Model
{

    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    // 列表 搜索的添加
    public function search(){
        $params = input('searchParams');

        $_where = [];
        $_where['code'] = 0;
        if (!empty($params)){
            $_where['code'] = 1;
            $data = json_decode($params,true);
            foreach ($data as $k=>$value){
                $value = trim($value);
                $_where['w'][] = [$k,'like',"%$value%"];
            }
        }

        return $_where;
    }


}