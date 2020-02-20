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

    /*天气接口*/
    public function  weather()
    {       
        //防止用户看到报错信息
        if(empty($_GET['city']))
        {
            echo "请输入地理位置";die;
        }

        $city = $_GET['city'];
        //调用天气接口
        $url = "https://free-api.heweather.net/s6/weather/now?location=".$city."&key=c3b1cbca3b03464e87ff970f9a863238";
        $data = file_get_contents($url);
        $arr = json_decode($data,true);//转为数组
        print_r($arr);

        return $arr;
    }
}
