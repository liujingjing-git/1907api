<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsStatisticModel;
use App\Model\GoodsModel;
use App\Model\VisitsModel;
use Illuminate\Support\Facades\Redis;


class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $goods_id = $request->get('id');
        
        $goods_key = 'str:goods:info:'.$goods_id;
        echo 'redis_key:'.$goods_key;echo "<br>";

        //判断是否有缓存信息
        $cache = Redis::get($goods_key);
        if($cache){
            echo "有缓存:";echo "<br>";
            $goods_info = json_decode($cache,true);
            echo "<pre>";print_r($goods_info);echo "</pre>";
        }else{
            echo "无缓存:";echo "<br>";
            $goodsinfo = GoodsModel::where(['id'=>$goods_id])->first();
            // $arr = $goods_info->toArray();
            $j_goods_info  = json_encode($goodsinfo->toArray());
            Redis::set($goods_key,$j_goods_info);
            Redis::expire($goods_key,300);
            echo "<pre>";print_r($goodsinfo);echo "</pre>";
        }
         
        die;
        
        echo 'goods_id:'.$goods_id;echo "<br>";
        echo "商品名: Hello World";echo "<hr>";

        $goods_id = $request->goods_id;
        $goods = GoodsStatisticModel::where('goods_id','=',$goods_id)->get();
        
        $ip = $_SERVER['REMOTE_ADDR']; //获取到地址
        $ua = $_SERVER['HTTP_USER_AGENT'];  //用于标识
        $data = [
            'ip' => $ip,               //访客ip
            'ua' => $ua,               //浏览器标识
            'goods_id' => $goods_id    //商品id
        ];
        $data1 = GoodsStatisticModel::insert($data);
        // dd($data1);

        //计算页面访问量
        $pv = GoodsStatisticModel::where(['goods_id'=>$goods_id])->count();
        echo "当前页面访问量:".$pv;echo "<br>";

        //计算个人访问量
        $uv = GoodsStatisticModel::where(['goods_id'=>$goods_id])->distinct('ua')->count('ua');
        echo "当前访客:".$uv;echo "<br>";

        // echo "<pre>";print_r($_SERVER['QUERY_STRING']);echo "</pre>";die;
    }

    /**限制访问量 */
    public function  visits(Request $request)
    {   
        $id = $request->get('id');
        $info = VisitsModel::where(['id'=>$id])->first();
        echo "<pre>";print_r($info->toArray());echo "</pre>";
        
        // $visi = Redis::get('visi'.$id);
        // Redis::incr('visi'.$id);
    }
    


}
