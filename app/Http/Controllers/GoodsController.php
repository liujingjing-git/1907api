<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsStatisticModel;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
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
        dd($data1);
        // echo "<pre>";print_r($_SERVER['QUERY_STRING']);echo "</pre>";
    }
}
