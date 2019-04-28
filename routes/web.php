<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//首页
route::any('/',"IndexController@index"); 
//路由组
route::prefix('index')->group(function(){
    //注册
    route::any('reg',"User\UserController@reg");
    route::any('regdo',"User\UserController@regdo");
    //手机号验证
    route::any('telcode',"User\UserController@telcode");
    //邮箱验证
    route::any('emailcode',"User\UserController@emailcode");
    route::any('sendemail',"User\UserController@sendemail");
    //登陆
    route::any('login',"User\UserController@login");
    route::any('tellogin',"User\UserController@tellogin");
    route::any('emaillogin',"User\UserController@emaillogin"); 
    //收货地址
    route::any('address',"IndexController@address");
    route::any('addaddress',"IndexController@addaddress");
    route::any('getarea/{id}','IndexController@getarea');
    route::any('addaddressdo','IndexController@addaddressdo');
    route::any('addressDel','IndexController@addressDel');
    route::any('addressUpd/{id}','IndexController@addressUpd');
    route::any('addressUpddo','IndexController@addressUpddo');
    route::any('getallprice','IndexController@getallprice');
    route::any('pay/{id}','IndexController@pay');
    route::any('paydo','IndexController@paydo');
    route::any('success','IndexController@success');
    //去支付
    route::any('gopay/{id}','IndexController@gopay');
    //同步跳转
    route::any('returnpay','IndexController@treturn');
    //异步跳转
    route::any('notify','IndexController@notify');
    //购物车添加
    route::any('caradd',"CartController@caradd");
    //购物车
    route::any('car',"IndexController@car");
    //详情页
    route::any('proinfo/{id?}','IndexController@proinfo');
    //全部商品
    route::any('prolist/{id?}',"IndexController@prolist");
    route::any('div',"IndexController@div");
    route::any('sortshop',"IndexController@sortshop");
    //我的
    route::any('user',"IndexController@user");
    //退出
    route::any('edit',"IndexController@edit");
    
});
    