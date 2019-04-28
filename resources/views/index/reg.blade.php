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
     <form action="javascript:;" method="get" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="login">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号" name="asscord" id="asscord"/></div>
       <div class="lrList2"><input type="text" name="verifycode" id="verifycode" placeholder="输入短信验证码" /><button id="btn">获取验证码</button></div>
       <div class="lrList"><input type="text" name="user_pwd" id="user_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name="user_pwd1" id="user_pwd1" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" id="btnNext" value="立即注册" />
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
    <script src="/js/style.js"></script>
  </body>
</html>
<script>
    $(function(){
      // $("#asscord").blur(function(){
      //   _this=$(this);
      //   var asscord=_this.val();
      //   var tel=/^1[34578]\d{9}$/;
      //   var email = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
      //     if(!tel.test(asscord)){
      //       alert('手机号码格式有误，请重填');
      //       return false;
      //     }else{
      //       type=1;
      //     }
      //     if(type=1){
      //       return false;
      //     }else{
      //       if(!email.test(asscord)){
      //         alert('邮箱格式有误，请重填');
      //       }
      //     }  
      // })
      //验证码
      $("#btn").click(function(){
          var asscord=$('#asscord').val();
          if(!asscord){
            alert('手机号或者邮箱不能为空');
            return false;
          } 
          var tel=/^1[34578]\d{9}$/;
          var email = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
          if(tel.test(asscord)){
            $.post(
              "/index/telcode",
              {asscord:asscord,_token:'{{csrf_token()}}'},
              function(res){
                  console.log(res)
              }
            )
          }else if(email.test(asscord)){
            $.post(
              "/index/emailcode",
              {asscord:asscord,_token:'{{csrf_token()}}'},
              function(res){
                  console.log(res)
              }
            )
          }else{
            alert('手机号或者邮箱格式错误');
            return false;
          }
          
      })
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
      //确认密码
      $('#user_pwd1').blur(function(){
          var user_pwd1=$(this).val();
          var user_pwd=$('#user_pwd').val();
          if(user_pwd1!=user_pwd){
            alert('两次密码输入不一致');
            return false;
          }
      })
      $("#btnNext").click(function (){
          if($('#asscord').val()==''){
            alert('请输入您的手机号或者邮箱！');
            return false;
          }else if($('#user_pwd').val()==''){
            alert('请输入您的密码!');
            return false;
          }else if($('#user_pwd1').val()==''){
            alert('请您再次输入密码！!');
            return false;
          }
          var asscord = $("#asscord").val();
          var user_pwd = $("#user_pwd").val();
          var verifycode=$("#verifycode").val();
          $.post(
              "{{url('index/regdo')}}",
              {asscord: asscord, user_pwd: user_pwd,_token:'{{csrf_token()}}',verifycode:verifycode},
              function (res) {
                  if (res == 1) {
                      alert('用户名已注册');
                      return false;
                  } else if (res == 2) {
                      alert('注册成功');
                      location.href = "{{url('index/login')}}";
                  } else if (res == 3) {
                      alert('注册失败');
                      return false;
                  }else if(res == 4){
                      alert("验证码错误");
                      return false;
                  }
              }
          )
      })
  })
</script>