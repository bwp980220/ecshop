<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/images/head.jpg" />
     </div><!--head-top/-->
     <form action="user" method="get" class="reg-login">
      <h3>还没有三级分销账号？点此<a class="orange" href="reg">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="asscord" id="asscord" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="text" name="user_pwd" id="user_pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="javascript:;" id="btn" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="/">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/style.js"></script>
    <script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
    <script src="{{url('layui/layui.js')}}"></script>
  </body>
</html>
<script>
    $(function(){
      layui.use(['layer'],function () {
      var layer=layui.layer;
        //验证密码
      $('#user_pwd').blur(function(){
          var reg=/[a-z0-9]{6,16}/;
          var user_pwd=$(this).val();
          if(user_pwd==''){
            alert('密码不能为空');
            return false;
          }
          if(!reg.test(user_pwd)){
            alert('密码格式错误');
            return false;
          }
      })
            //登陆
        $("#btn").click(function(){
          var asscord=$('#asscord').val();
          var user_pwd=$('#user_pwd').val();
          if(!asscord){
            alert('手机号或者邮箱不能为空');
            return false;
          } 
          var tel=/^1[34578]\d{9}$/;
          var email = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
          if(tel.test(asscord)){
            $.post(
              "/index/tellogin",
              {asscord:asscord,user_pwd:user_pwd,_token:'{{csrf_token()}}'},
              function(res){
                    if(res.code==1){
                        layer.msg(res.font,{icon:res.code,time:2000},function(){
                            location.href="{{url('/')}}"
                        });
                    }else{
                        layer.msg(res.font,{icon:res.code});
                    }
              }
              ,'json'
            )
          }else if(email.test(asscord)){
            $.post(
              "/index/emaillogin",
              {asscord:asscord,user_pwd:user_pwd,_token:'{{csrf_token()}}'},
              function(res){
                if(res.code==1){
                    layer.msg(res.font,{icon:res.code,time:2000},function(){
                      location.href="{{url('/')}}"
                    });
                  }else{
                      layer.msg(res.font,{icon:res.code});
                  }
              }
              ,'json'
            )
          }else{
            alert('手机号或者邮箱格式错误');
            return false;
          }
        })
      })
    })
</script>