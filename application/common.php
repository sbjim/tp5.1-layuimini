<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function dd(...$var)
{
    foreach ($var as $row) {
        dump($row);
    }
    exit;
}
function _success($data = [], $code = 1, $msg = 'ok')
{
    echo json_encode([
        'data' => $data,
        'code' => $code,
        'msg' => $msg,
    ]);
    exit;
}

function _error($msg = 'error', $code = 0, $data = [])
{
    echo json_encode([
        'data' => $data,
        'code' => $code,
        'msg' => $msg,
    ]);
    exit;
}


function _lists($obj, $code = 0, $msg = '')
{
    $obj_to_arr = $obj->toArray();
    $data = [
        'code' => $code,
        'msg' => $msg,
        'count' => $obj_to_arr['total'],
        'data' => $obj_to_arr['data'],
    ];
    echo json_encode($data);
}





