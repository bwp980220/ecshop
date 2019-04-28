<?php

namespace App\Http\Controllers;

use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller{
    //加入购物车
    public function caradd(Request $request)
    {
        $goods_id=$request->goods_id;
        $user_id=session('user_id');
        $where=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id,
            'cart_status'=>1
        ];
        $data=DB::table('cart')->where($where)->first();
        $goodsInfo=DB::table('goods')->where(['goods_id'=>$goods_id])->first();
        if($data){
            //已添加到购物车
            $buy_number=$data->buy_number+1;
            $this->num($goodsInfo->goods_num,$buy_number);
            $num=[
                'buy_number'=>$buy_number
            ];
            $cartInfo=DB::table('cart')->update($num,$where);
        }else{
            $this->num($goodsInfo->goods_num,1);
            $where['buy_number']=1;
            $cartInfo=DB::table('cart')->insert($where);
        }
        if($cartInfo){
            return 1;
        }else{
            return 2;
        }
    }

    public function num($goods_num,$cart_num)
    {
        if($cart_num>$goods_num){
            echo 3;die;
        }
    }
}
