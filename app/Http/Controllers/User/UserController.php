<?php

namespace App\Http\Controllers\User;

use DemeterChain\C;
use Illuminate\Http\Request;
use Mail;
use App\Models\Users;
use App\Http\Controllers\Controller;

class UserController extends Controller{
    //注册
    public function reg(){
        return view('index/reg');
    }
    //发送短信验证码
    public function telcode(){
        $tel=request()->asscord;
        $code=rand(100000,999999);
        session(['code'=>$code]);
        $this->sendMobile($code,$tel);
    }
    /*
     * @content 手机验证码
     * @params  $mobile  要发送的手机号
     *
     * */
    private function sendMobile($code,$tel)
    {
        $host = env("MOBILE_HOST");
        $path = env("MOBILE_PATH");
        $method = "POST";
        $appcode = env("MOBILE_APPCODE");
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$tel;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));
    }
    //发送邮箱验证码
    public function emailcode(){
        $email=request()->asscord;
        //dd($email);
        $code=rand(100000,999999);
        session(['code'=>$code]);
        $this->sendMail($code,$email);
    }
    /*
     * @params  $mobile  要发送的邮箱
     */
    private function sendMail($code,$email){

        if($email){
            //在闭包函数内部不能直接使用闭包函数外部的变量  使用use导入闭包函数外部的变量$email               
            Mail::send('index.email' , ['code'=>$code], function($message)use($email){
                $message->subject("邮件标题");
                $message->to($email);
            });
            $data=['email'=>$email,'code'=>$code];
            session(['email'=>$data]);
            return ['msg'=>'发送邮件成功','code'=>6];
        }else{
            return ['msg'=>'请选择一个邮箱注册','code'=>5];
        }  
    }
    //执行注册
    public function regdo(Request $request)
    {
        $arr=$request->all();
        $asscord=$request->asscord;
        $verifycode=$request->verifycode;
        $code=session('code');
        if($verifycode!=$code){
            return 4;exit;
        }
        if (preg_match("/^1[34578]\d{9}$/i",$asscord)) {
            $where=[
                'user_tel'=>$asscord
            ];
            $arr['user_tel']=$asscord;
        } else {
            $where=[
                'user_email'=>$asscord
            ];
            $arr['user_email']=$asscord;
        }
        unset($arr['asscord']);
        $user_pwd=$request->user_pwd;
        $arr['user_code']=$code;
        $res=Users::where($where)->first();
        if($res){
            return 1;
            //用户名已存在
        }else{
            unset($arr['verifycode']);
            unset($arr['_token']);
            $arr['user_pwd']=encrypt($arr['user_pwd']);
            $data=Users::insert($arr);
            if($data){
                return 2;
                //注册成功
            }else{
                return 3;
                //注册失败
            }
        }
    }
    //登陆
    public function login(){
        return view('index/login');
    }
    //手机号登录
    public function tellogin(Request $request)
    {

        $usersmodel=new Users;
        if(empty($request->asscord)){
            echo json_encode(['font'=>'手机号或者邮箱不能为空', 'code'=>2]);exit;
        }
        if(empty($request->user_pwd)){
            echo json_encode(['font'=>'密码不能为空', 'code'=>2]);exit;
        }
        $where=[
            'user_tel'=>$request->asscord
        ];
        $data=$usersmodel->where($where)->first();
        //$pwd=$data->user_pwd;

        //$pwd=decrypt($pwd);
        //dd($request->asscord);
        if(!empty($data)){
            if(decrypt($data->user_pwd)==$request->user_pwd){
                // 存储数据到 session...
                session(['user_id' =>$data->user_id,'asscord'=>$request->asscord]);
                echo json_encode(['font'=>'登陆成功', 'code'=>1]);
            }else{
                echo json_encode(['font'=>'账号密码错误', 'code'=>2]);exit;
            }
        }else{
            echo json_encode(['font'=>'账号密码错误', 'code'=>2]);exit;
        }
    }
    //邮箱登录
    public function emaillogin(Request $request)
    {
        $usersmodel=new Users;
        if(empty($request->asscord)){
            echo json_encode(['font'=>'手机号或者邮箱不能为空', 'code'=>2]);exit;
        }
        if(empty($request->user_pwd)){
            echo json_encode(['font'=>'密码不能为空', 'code'=>2]);exit;
        }
        $where=[
            'user_email'=>$request->asscord
        ];
        $data=$usersmodel->where($where)->first();
        //$pwd=$data->user_pwd;

        //$pwd=decrypt($pwd);
        //dd(decrypt($data->user_pwd));
        if(!empty($data)){
            if(decrypt($data->user_pwd)==$request->user_pwd){
                // 存储数据到 session...
                session(['user_id' =>$data->user_id,'asscord'=>$request->asscord]);
                echo json_encode(['font'=>'登陆成功', 'code'=>1]);
            }else{
                echo json_encode(['font'=>'账号密码错误', 'code'=>2]);exit;
            }
        }else{
            echo json_encode(['font'=>'账号密码错误', 'code'=>2]);exit;
        }
    }
    //退出
    public function edit(){
        $session=session(['asscord'=>null,'user_id'=>null]);
        if($session){
            alert('退出成功');
        }
        return redirect('index/login');
    }
}
