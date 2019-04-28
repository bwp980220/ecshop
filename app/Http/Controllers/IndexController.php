<?php

namespace App\Http\Controllers;

use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Cate;
use App\Models\Address;
use App\Models\Area;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller{
    //展示
    public function index()
    {
        //轮播图
        $goodsmodel=new Goods;
        $data=$goodsmodel->orderBy('update_time','desc')->select('goods_img')->paginate(5);
        //最热商品
        $goodshost=$goodsmodel->where(['is_hot'=>1])->orderBy('update_time','desc')->paginate(2);
        //商品列表
        $goodsinfo=$goodsmodel->orderBy('update_time','desc')->paginate(10);
        //分类
        $catemodel=new Cate;
        $cate=$catemodel->where('pid','=',0)->get();
        return view('index/index',['data'=>$data],['goodshost'=>$goodshost])
            ->with('goodsinfo',$goodsinfo)
            ->with('cate',$cate);
    }
    //收货地址
    public function address(){
        $addressmodel=new Address;
        $data=$addressmodel->get();
        return view('index/address',['res'=>$data]);
    }
    //添加收货地址
    public function addaddress(){
        //查询所有省收货地址
        $provinceInfo=$this->getAreaInfo(0);
        //dump($provinceInfo);die;
        //展示添加视图
        $addressInfo=$this->getAddressInfo();
        return view('index/addaddress',['provinceInfo'=>$provinceInfo,'addressInfo'=>$addressInfo]);
    }
    //执行添加收货地址
    public function addaddressdo(Request $request){
        $data=$request->all();
        //dump($data);die;
        $address_model=new Address;
        $data['user_id']=$this->getUserId();
        if($data['address_default']==1){
            $where=[
                'user_id'=>$this->getUserId()
            ];
            //print_r($where);die;
            $result=$address_model->where($where)->update(['address_default'=>2]);//改
            $res=$address_model->insert($data);//增
            //dump($res);exit;
            if($result!==false&&$res){
               echo 1;
            }else{
                echo 2;
            }
        }else{
            $res=DB::table('address')->insert($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
    }
    //地址删除
    public function addressDel(Request $request){
        $address_id=$request->address_id;
        //dd($address_id);
        $address_model=new Address();
        //print_r($address_model);die;
        $res=$address_model->where('address_id',$address_id)->delete();//增
        print_r($res);die;
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //地址修改
    public function addressUpd($id){
        //$address_id=$request->address_id;
        //dump($address_id);die;
        //dump($id);die;
        //查询所有省收货地址
        $provinceInfo=$this->getAreaInfo(0);
        //dump($provinceInfo);die;
        //展示添加视图
        $addressInfo=$this->getAddressInfo();
        //dump($address_id);die;
        $address_model=new Address();
        $data=$address_model->where('address_id',$id)->get();//查询
        return view('index/addressUpd',['provinceInfo'=>$provinceInfo,'addressInfo'=>$addressInfo,'res'=>$data]); 
    }
    //执行地址修改
    public function addressUpddo(Request $request){
        $data=$request->all();
        //dump($data);die;
        $address_model=new Address;
        $data['user_id']=$this->getUserId();
        $address_id=$data['address_id'];
        unset($data['address_id']);
        //dump($data['address_default']);exit;
        $addresswhere=[
            'address_id'=>$address_id
        ];
        if($data['address_default']==1){
            $where=[
                'user_id'=>$this->getUserId()
            ];
            //print_r($addresswhere);die;
            $result=$address_model->where($where)->update(['address_default'=>2]);//改
            //dump($result);exit;
            $res=$address_model->where($addresswhere)->update($data);//改
            //dump($res);exit;
            if($result!==false&&$res){
               echo 1;
            }else{
                echo 2;
            }
        }else{
            $res=$address_model->where($addresswhere)->update($data);//改 
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
    }
    public function getAreaInfo($pid){
        $where=[
            'pid'=>$pid,
        ];
        $area_model=new Area;
        $data=$area_model->where($where)->get();
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }    
    }
    public function getAddressInfo(){
        $where=[
            'user_id'=>$this->getUserId(),
            'address_status'=>1
        ];
        $address_model=new Address;
        $area_model=new Area;
        $addressInfo=$address_model->where($where)->get();
        if(!empty($addressInfo)){
            //处理收货地址的省市区
            foreach($addressInfo as $k=>$v){
                $addressInfo[$k]['province']=$area_model->where(['id'=>$v['province']])->value('name');
                $addressInfo[$k]['city']=$area_model->where(['id'=>$v['city']])->value('name');
                $addressInfo[$k]['area']=$area_model->where(['id'=>$v['area']])->value('name');    
            }
            return $addressInfo;
        }else{
            return false;
        }

    } 
    //获取下一级区域信息
    public function getarea(Request $request){
        $id=$request->id;
        //dump($id);die;
        if(empty($id)){
            fail('请必须选择一项');
        }
        $areaInfo=$this->getAreaInfo($id);
        //print_r($areaInfo);exit;
        echo json_encode(['areaInfo'=>$areaInfo,'icon'=>1]);   
    }
    //获取用户id
    public function getUserId(){
        return session('user_id');
    }
    //购物车
    public function car(){
        $user_id=session('user_id');
        if($user_id!=''){
            //dd($user_id);
            $res=DB::table('cart')
            ->join('goods','goods.goods_id','=','cart.goods_id')
            ->where(['user_id'=>$user_id,'cart_status'=>1])
            ->orderBy('cart_id','desc')
            ->get();
            //dd($res);
            return view('index/car',['res'=>$res]);
        }else{
            return redirect('index/login');
        }
        
    }
    //商品详情
    public function proinfo($id)
    {
        $goodsmodel=new Goods;
        $goods=$goodsmodel->where('goods_id','=',$id)->first()->toArray();
        $goods['goods_imgs']=rtrim($goods['goods_imgs'],'|');
        $goods['goods_imgs']=explode('|',$goods['goods_imgs']);
        return view('index/proinfo',['goods'=>$goods]);
    }
    //获取总价格
    public function getallprice(){
        $goods_id = \request()->goods_id;
        // dump($goods_id);
        if($goods_id==''){
            return 0;
        }
        if(strpos($goods_id,',')==false){
            $allprice = DB::table('goods as g')
                ->join('cart as c', 'c.goods_id', '=', 'g.goods_id')
                ->get()
                ->toArray();
            foreach ($allprice as $k => $v) {
                if($v->goods_id==$goods_id){
                    $price=$v->self_price*$v->buy_number;
                }
            }
        }else{
            $goods_id = explode(',',$goods_id);
            $allprice = DB::table('goods as g')
                ->select('g.self_price', 'c.buy_number','g.goods_id')
                ->join('cart as c', 'c.goods_id', '=', 'g.goods_id')
                ->get()
                ->toArray();
            // dd($allprice);
            $price = 0;
            foreach ($allprice as $k => $v) {
                foreach ($goods_id as $key => $val) {
                    if ($v->goods_id == $val) {
                        $price += $v->self_price * $v->buy_number;
                    }
                }
            } 
        }
        return $price;
    }
    /*
     * @content 所有商品
     */
    //定义静态属性 ，做递归
    protected static $arrCate;
    //全部商品
    public function prolist($pid=0)
    { 
        //memcache缓存
        $data=Cache::get('res_');
        //Cache::flush($data);
        if(!$data){
            //var_dump(123);
            //商品
            $goodsmodel=new Goods;
            //查询所有分类
            $catemodel=new Cate;
            $cateinfo=$catemodel->get();

            $arr=$this->getCateIdInfo($cateinfo,$pid);

            $data=$goodsmodel->where('is_up','=',1)->whereIn('cate_id',$arr)->orderBy('update_time','desc')->get();
            Cache::put(['res_'=>$data],60*24);
        }
        return view('index/prolist',['data'=>$data])
            ->with('id',$pid);
    }
    //点击排序搜索
    public function sortshop(Request $request)
    {
        $goodsmodel=new Goods;
        $cate_id=$request->input('cate_id');
        $type=$request->input('_type');
        $top=$request->input('top');
        if($top=='↑'){
            $top='asc';
        }else{
            $top='desc';
        }
        if($cate_id==0){
            $data=$goodsmodel->where('is_up','=',1)->orderBy($type,$top)->get();
        }else{
            $this->getCateIdInfo($cate_id);
            $cateId=self::$arrCate;
            $data=$goodsmodel->where('is_up','=',1)->whereIn('cate_id',$cateId)->orderBy($type,$top)->get();
        }
        return view('index/div',['data'=>$data]);
    }
     //结算
     public function pay($id){
        $user=request()->session()->get('user_id');
        //dd($user);
        if($user==''){
            echo "<script>alert('请先登录');location.href='/index/login'</script>>";
        }
        $address = DB::table('address')->where('user_id',$user['user_id'])->get()->toArray();
        //dd($address);
        if(!$address){
        //dd(111);
            echo "<script>alert('请添加收货地址');location.href='/index/address/$id'</script>";
        }
        $goods_id=explode(',',$id);
        $data=DB::table('goods')->whereIn('goods_id',$goods_id)->get()->toArray();
        //如果没找到则提示没有商品信息
        if($data==''){
            echo "<script>alert('暂无商品信息');location.href='/index/car'</script>>";
        }
        //查询购物车的相应商品的购买数量
        $cart=DB::table('cart')->whereIn('goods_id',$goods_id)->get()->toArray();
        $allprice=0;
        foreach($data as $k => $v){
            foreach($cart as $key=>$val){
                if($v->goods_id == $val->goods_id){
                    $data[$k]->buy_number=$val->buy_number;
                    $allprice+=$data[$k]->buy_number * $v->self_price;
                }
            }
        }
        //默认收货人
        $address = DB::table('address')->where('address_default',1)->get()->toArray();
        //dd($address);
        if(!$address){
            $address_id = DB::table('address')->select('address_id')->where('user_id',$user['user_id'])->orderBy('address_id','desc')->first();
            $data =DB::table('address')->where('address_id',$address_id->address_id)->update(['is_result'=>1]);
            $address = DB::table('address')->where('address_default',1)->get()->toArray();
        }
            foreach ($address as $k=> $v){
                $v->province=DB::table('area')->where('id',$v->province)->value('name');
                $v->city= DB::table('area')->where('id',$v->city)->value('name');
                $v->area=DB::table('area')->where('id',$v->area)->value('name');

        }//dd($address);
        return view('/index/pay',compact('data','allprice','address'));
    }
    //提交订单
    public function paydo(){
        $user = \request()->session()->get('user_id');
        if(!$user){
            return ['msg'=>'请先登录','code'=>4];die;
        }
        DB::beginTransaction();
        try {
            //加入订单表
            $user = \request()->session()->get('user');
            $data['user_id'] = $user['user_id'];//用户id
            $data['order_no']=time().rand(10000,99999);//订单号
            $data['order_amount'] = \request()->allprice;//总价格
            $data['create_time']=time();//添加时间
            $res1 = DB::table('order')->insert($data);
            if($res1 ==false){
                  throw new \Exception('加入订单表失败');
            }
            //订单收货地址表
            $order_id=DB::getPdo()->lastInsertId();//订单id
            $order_address = DB::table('address')->select('address_name','address_tel','address_desc','address_mail','province','city','area')->where('address_default',1)->first();
            $order_address->order_id =$order_id;
            $order_address->user_id = $user['user_id'];//用户id
            $order_address->create_time = time();//添加时间
            $order_address = json_decode(json_encode($order_address),true);
            $res2 = DB::table('order_address')->insert($order_address);
            if($res2 ==false){
                throw new \Exception('加入订单收货地址表失败');
            }
            //加入商品详情表
            $goods_id = explode(',',\request()->goods_id);
            $data = DB::table('cart')
                ->select('buy_number','goods.goods_id','self_price','goods_name','goods_img')
                ->join('goods','cart.goods_id','=','goods.goods_id')
                ->get();
            $date=[];
            foreach ($data as $k=>$v){
                foreach ($goods_id as $key=>$val){
                    if($v->goods_id == $val){
                        $v->order_id=$order_id;
                        $v->create_time=time();
                        $v->user_id=$user['user_id'];
                        $date[]=$v;
                    }
                }
            }
            $date = json_decode(json_encode($date),true);
           $res3 = DB::table('order_detial')->insert($date);
            if($res3 ==false){
                throw new \Exception('加入商品详情表失败');
            }
            //减少商品对应库存
            $data2 = DB::table('cart')
                ->select('cart.buy_number','goods.goods_num','cart.goods_id')
                ->join('goods','cart.goods_id','=','goods.goods_id')
                ->where(['cart_status'=>1,'user_id'=>$user])
                ->get();
            foreach($data2 as $k=>$v){
                foreach ($goods_id as $key=>$val){
                    if($v->goods_id == $val){
                        $v->goods_num = $v->goods_num - $v->buy_number;
                        $res = DB::table('goods')->where('goods_id',$val)->update(['goods_num'=>$v->goods_num]);
                    }
                }
            }
            if($res ==0){
                throw new \Exception('减少库存失败');
            }
            //删除购物车相应数据
            $id= \request()->goods_id;
            //dd(strpos($goods_id,','));
            if(strpos($id,',') == false){
                $res4 = DB::table('cart')->where('goods_id',$id)->update(['cart_status'=>2]);
            }else{
                $res4 = DB::table('cart')->whereIn('goods_id',$goods_id)->update(['cart_status'=>2]);
            }
            if($res4 ==0){
                throw new \Exception('删除购物车数据失败');
            }
            DB::commit();
            request()->session()->put('order',['order_id'=>$order_id,'allprice'=>\request()->allprice]);
            return ['msg'=>'提交订单成功','code'=>6];
        } catch (\Exception $e) {
            DB::rollback();
            $message = report($e);
            return ['msg'=>$e->getMessage(),'code'=>5];
        };
    }
    //去支付
    public function gopay($id){
        //总价格
        $allprice = DB::table('order')->where('order_no',$id)->value('order_amount');
        if(!$allprice){
            echo "<script>alert('没有此订单信息');location.href='/index/car'</script>";die;
        }
        if($allprice<=0){
            echo "<script>alert('此订单无效');location.href='/index/car'</script>";die;
        }
        //dd($allprice);
        //require_once app_path(dirname(__FILE__)).'/config.php';
        //dd(app_path('libs/alipay/pagepay/service/AlipayTradeService.php'));
        require_once app_path('libs/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('libs/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no =$id;
        //dd($out_trade_no);
        //订单名称，必填
        $subject = '1810支付测试';

        //付款金额，必填
        $total_amount = $allprice;

        //商品描述，可空
        $body = '';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService(config('alipay'));

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,config('alipay.return_url'),config('alipay.notify_url'));
        //dd($response);
        //输出表单
        var_dump($response);

    }
    //同步跳转
    public function treturn(){
        $arr=$_GET;
        $out_trade_no = trim($_GET['out_trade_no']);//订单号
        $total_amount = trim($_GET['total_amount']);//订单金额
        require_once app_path('libs/alipay/pagepay/service/AlipayTradeService.php');
        $alipaySevice = new \AlipayTradeService(config('alipay'));
        $result = $alipaySevice->check($arr);

        $data=DB::table('order')->where(['order_no'=>$out_trade_no,'order_amount'=>$total_amount])->first();
        if(!$data){
            echo "<script>alert('付款错误，此订单不存在');location.href='/index/paydo'</script>";
        }
        if(trim($_GET['seller_id']) !=config('alipay.seller_id') || trim($_GET['app_id']) != config('alipay.app_id')){
            echo "<script>alert('付款错误，商家或买家错误');location.href='/index/paydo'</script>";
        }
        echo "//验证成功<br />支付宝交易号：".$out_trade_no;
        return redirect('/index/car');
    }
    //异步跳转
    public function notify(){
        dd(222);
    }
    //递归查询主分类下子类
    private function getCateIdInfo($cateinfo,$pid=0){
        
        if( !$cateinfo){ 
            return;
        }

        foreach($cateinfo as $key=>$v){
            if($v->pid==$pid){
                self::$arrCate[]=$v->cate_id;
                $this->getCateIdInfo($cateinfo,$v->cate_id);
            }
        }
        return self::$arrCate;
        
        // if(count($cateinfo)!=0){
        //     foreach ($cateinfo as $k =>$v){

        //         $cateid=$v->cate_id;
        //         $cateIds=$this->getCateIdInfo($cateid);
        //         self::$arrCate[]=$cateIds;
        //     }
        // }else{
        //     return $cate_id;
        // }
    }
    //提交订单
    public function success(){
        $user = \request()->session()->get('user_id');
        if(!$user){
            return ['msg'=>'请先登录','code'=>4];
        }
        $order = request()->session()->get('order');
        $order_id = $order['order_id'];
        $allprice = $order['allprice'];
        $data = DB::table('order')->where('order_id',$order_id)->first();
//        dd($data);
        return view('index/success',compact('data','allprice'));
    }
    //我的
    public function user(){
        $user_id=session('user_id');
        if($user_id!=''){
            return view('index/user');
        }else{
            return redirect('index/login');
        }
        
    }
    //退出
    public function edit(){
        $session=session(['user_name'=>null,'user_id'=>null]);
        if($session){
            alert('退出成功');
        }
        return redirect('index/login');
    }
}
