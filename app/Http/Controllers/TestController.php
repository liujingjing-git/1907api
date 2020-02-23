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

    /** 
     * GET的传参方式 在路径上传参url+?name=liu&age=18
     */
    public  function GetRequest()
    {
        echo "接收到的数据:";echo "<br>";
        echo "<pre>";print_r($_GET);"</pre>";
    }

    /** 
     * POST传参的三种方式
     */
    public function PostRequest()
    {
        echo "<hr>";
        echo "我是API开始";
        echo "<pre>";print_r($_POST);"</pre>";
        echo "<pre>";print_r($_FILES);"</pre>";
        echo "我是API结束";
    }
    public function Posturlencodes()
    {
        echo "<pre>";print_r($_POST);"</pre>";
    }
    /** 
     * POST方法3
     * 不通过key方式传参
     * 可接受json xml
     */
    public function PostRaw()
    {
        //可转为数组格式  接收json或者xml格式
        $json = file_get_contents("php://input");
        echo $json;echo '<hr>';
        $data = json_decode($json,true);
        echo "<pre>";print_r($data);"</pre>";   
        
        // echo "<pre>";print_r($_POST);"</pre>";             
        
    }
    
    /**
     * 接收post 上传文件
     */
    public function upload()
    {
        echo "<pre>";print_r($_POST);"</pre>"; 
        echo "接受文件:";echo "<br>";
        echo "<pre>";print_r($_FILES);"</pre>"; 
    }

    
    /** redis */
    public function redis1()
    {
        $token = 'abcdef';
        $key = 'user_token';

        $goods_info = [
            'id' => 11,
            'goods_name' => "OPPO",
            'price' => 340000,
            'img' => 'wybzushuai.jpg'
        ];
        
        Redis::set($key,$token);

        //monitor  设置过期时间  15s
        Redis::expire($key,15);
    }

    /** 
     * 请求数据
     */
    public function Testmd5()
    {
        $key = '1907'; //发送方 和 接收方都是使用一个key

        //代签名数据
        $str = $_GET['str'];
        echo "签名前的数据".$str;echo "<br>";

        //计算签名 原始数据+key
        $sign = md5($str.$key);
        echo "计算后签名".$sign;

        //发送数据  数据 + 签名

        //!get url传参    
        // echo $_GET['str'];echo "<br>";
        //解密MD5    https://cmd5.com/
        // echo md5($_GET['str']);
    }

    
    
    /*test 接收数据 验证签名*/
    public function verifySign()
    {
        $key = '1907';

        $data = $_GET['data']; //接收到的数据
        $sign = $_GET['sign']; //接收到的签名

        //验签
        $sign1 = md5($data.$key); 
        echo "接收端计算的签名:".$sign1;echo "<br>";
        //与接收到的签名对比
        if($sign1 == $sign)
        {
            echo "验签通过 数据完整";
        }else{
            echo "验签失败 数据损坏";
        }
    }


    /*取模*/
    public function take()
    {
    }

    /**
     * 解密
    */
    public function decrypt()
    {
        $data = $_GET['data']; 

        //解密
        $length = strlen($data); //获取密文的长度

        $str='';
        
        for($i=0;$i<$length;$i++){
            echo  $data[$i].'>'.ord($data[$i]);echo "<br>";
            $code = ord($data[$i])-1;

            echo "解密:".$data[$i].'>'.chr($code);echo "<br>";
            $str .= chr($code);
        }
        echo "解密数据:".$str;
    }

    /** 
     * base64解密
     */
    public function decrypt1()
    {
        //key method iv必须一致
        $key = '1907';
        $method = 'aes-128-cbc'; //加算法
        $iv = '123456abc123456a';  //vi 必须为16个字节 (16个ascii字符)

        echo "<hr>";
        echo "已接收到的数据";
        echo "<pre>";print_r($_GET);echo "</pre>";
        $data = $_GET['data'];

        //base64编码
        $enc_str = base64_decode($data); 

        //解密
        $dec_data = openssl_decrypt($enc_str,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "解密后的数据:";echo "<br>";
        var_dump($dec_data);
    }

    /** 
     *
     */
}
