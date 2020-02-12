<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;

class UserController extends Controller
{
    /** 
     *  获取用户信息 2-12
     */
    public function info()
    {
        $user_info = [
            'user_name' => 'zhangsan',
            'sex' => 1,
            'email' => 'zhangsan@qq.com',
            'age' => 11,
            'date' => date('Y-md H:i:s')
        ];
        return $user_info;
    }
    /**
     *  用户注册 2-12
     */
    public function reg(Request $request)
    {
        //接收数据
        // $data = $request->input();
        // $user_name = $request->input('user_name');
        // echo 'user_name:'.$user_name;
       
        $user_info = [
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'pass' => '123456abc..',
        ];
        
        //将数据添加到数据库
        $id = UserModel::insertGetId($user_info);
        echo "自增ID:".$id;
        
        //echo "<pre>";print_r($_POST);echo "</pre>";
    }
}
