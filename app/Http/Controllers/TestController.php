<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;

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
    public function test002()
    {
        echo 'Hello world 111';
    }
    public function test003()
    {
        $user_info = [
            'user_name' => 'zhangsan',
            'email' => 'zhangsan@qq.com',
            'age' => 11
        ];
        /*两种返回json数据*/
        return $user_info;
        // echo json_encode($user_info);
    }

    /** 
     *  file_get_contents 2-14
     */
    public function getAccessToken()
    {
        $app_id = "wx09d1d54ef09170a9";
        $appsecret = "dd079df2d7127d1ae6429315e518aebb";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$appsecret;
        echo $url;
        echo "<hr>";
        
        /*使用file_get_contents发起GET请求*/
        $response = file_get_contents($url);
        var_dump($response);echo "<hr>";
        $arr = json_decode($response,true);
        // echo "<pre>";print_r($arr);echo "</pre>";
    }
    /**
     * curl 2-14
     */
    public function curl1()
    {
        $app_id = "wx09d1d54ef09170a9";
        $appsecret = "dd079df2d7127d1ae6429315e518aebb";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$appsecret;
        // echo $url;
        // echo "<hr>";

        /*curl 初始化*/
        $ch = curl_init($url);

        /*设置参数选项*/
        curl_setopt($ch,CURLOPT_HEADER,0);
        //1表示关闭浏览器输出  0表示开启浏览器输出
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,0); 

        /*执行会话*/
        $response=curl_exec($ch);
        
        /*捕获错误*/
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        if($errno>0)
        {
            echo "错误码:".$errno;echo "<br>";
            echo "错误码:".$error;die;
            die;
        }

        /*关闭会话*/
        curl_close($ch); 


        var_dump($response);
    }

    /** 
     *  curl post请求
     */
    public function curl2()
    {   
        $access_token = "30_BEqf1WgMBJi8HWBcTgnsbvBSyU5NheC2zplCHJN2hJTOq0ko4GcRDbuJZylZ3eyk63jgp8cA3GKJW8z2QpKeZ1RrHW4CZG3jhcd0kL07Rv9VoYghu4icNWK1gw3RcHhjaX53X_ohBrbIDzCeOGUgADACUI";
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        
        $menu = [
            "button" => [
                [
                    "type" => "click",
                    "name" => "CURL",
                    "key" => "curl001"
                ]
            ]
        ];

        //初始化
        $ch = curl_init($url);

        /*设置参数选项*/
        curl_setopt($ch,CURLOPT_HEADER,0);
        //1表示关闭浏览器输出  0表示开启浏览器输出
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 

        //POST请求
        curl_setopt($ch,CURLOPT_POST,true);
        //发送json数据 非form-data形式
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($menu));

        //执行curl会话
        $response = curl_exec($ch);
        
        //捕获错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        if($errno>0)
        {
            echo "错误码:".$errno;echo "<br>";
            echo "错误码:".$error;die;
            die;
        }

        //关闭会话
        curl_close($ch);


        //数据处理
        var_dump($response);
    }

    /**
     *   guzzle 2-14
     */
    public function guzzle1()
    {
        $app_id = "wx09d1d54ef09170a9";
        $appsecret = "dd079df2d7127d1ae6429315e518aebb";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$appsecret;
        // echo $url;
        echo "<hr>"; 

        $client = new Client();
        $response = $client->request('GET',$url);
        //获取服务端响应的数据
        $data = $response->getBody();
        echo $data;
    }
}
