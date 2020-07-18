<?php
namespace app\index\controller;

use app\common\controller\Frontend;
use think\Db;

class Index extends Frontend
{
    public function index()
    {
        return 'index/index';
    }


}
