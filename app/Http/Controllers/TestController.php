<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    /**
     * 测试
     */
    public function testRedis()
    {
        echo "111";
        $key = '1907';
        $val = time();
        Redis::set($key,$val);  //set 一个 健 并赋值
        $value = Redis::get($key);  //获取 key 的值
        echo 'value:'.$value;
    }

    /**
     * 测试
     */
    public function test002(){
        echo 'Hello world 111';
    }
    public function test003(){
        $user_info = [
            'user_name' => 'zhangsan',
            'email' => 'zhangsan@qq.com',
            'age' => 11
        ];
        /*两种返回json数据*/
        return $user_info;
        // echo json_encode($user_info);
    }
}
