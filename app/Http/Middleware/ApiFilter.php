<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class ApiFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        echo date("Y-m-d H:i:s");echo "<br>";
        $uri = $_SERVER['REQUEST_URI'];
        // echo "当前路径:".$uri;echo "<br>";
        
        $ua = $_SERVER['HTTP_USER_AGENT'];
        // echo "当前标识:".$ua;die;
        
        $md5_ua = substr(md5($ua),5,8);
        $md5_uri = substr(md5($ua),5,8);

        $key = 'count:uri'.$md5_uri.':'.$md5_ua;
        echo $key;echo "<hr>";

        $count = Redis::get($key);
        echo "访问次数:".$count;echo "<br>";
        $max = env('API_ACCESS_COUNT');

        if($count > $max)
        {   
            echo "已上限 请停止";

            //设置超时
            Redis::expire($key,env('API_TIMEOUT_SECOND'));

            die;
        }
        Redis::incr($key);
        echo "<hr>";echo '<br>';

        return $next($request);
    }
}
