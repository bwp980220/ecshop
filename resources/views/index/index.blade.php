<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="{{asset('/images/favicon.ico')}}" />
    
    <!-- Bootstrap -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/css/response.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <div class="head-top">
      <img src="{{asset('/images/head.jpg')}}" />
      <dl>
       <dt><a href="user.html"><img src="{{asset('/images/touxiang.jpg')}}" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="{{asset('index/prolist')}}"><strong></strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
     </form><!--search/-->
     <div id="sliderA" class="slider">
     @foreach($data as $v)
        <img src="{{url('images/goodsLogo/'.$v->goods_img)}}" alt="">
      @endforeach
     </div><!--sliderA/-->
     <ul class="pronav">
     @foreach($cate as $v)
				<li>
					<a href="{{url('index/prolist')}}/{{$v->cate_id}}" id="btnNew">
						<i class="xinpin"></i>
						<span class="title">{{$v->cate_name}}</span>
					</a>
				</li>
				@endforeach

      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
     @foreach($goodsinfo as $k=>$v)
      <div class="index-pro1-list">     
       <dl>
        <dt><a href="{{url('index/proinfo')}}/{{$v->goods_id}}"><img src="{{url('images/goodsLogo/'.$v->goods_img)}}" width="293" height="190" /></a></dt>
        <dd class="ip-text"><a href="proinfo">{{$v->goods_name}}</a></dd>
        <dd class="ip-price"><strong>价值：￥{{$v->self_price}}</strong></dd>
       </dl>
      </div>
      @endforeach
      
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     最热
     @foreach($goodshost as $k=>$v)
     <div class="prolist">
      <dl>
       <dt><a href="{{url('index/proinfo')}}/{{$v->goods_id}}"><img src="{{url('images/goodsLogo/'.$v->goods_img)}}" width="293" height="190" /></a></dt>
       <dd>
        <h3><a href="proinfo">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>价值：￥{{$v->self_price}}</strong></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--prolist/-->
     @endforeach
     <div class="joins"><a href="{{asset('fenxiao.html')}}"><img src="{{asset('/images/jrwm.jpg')}}" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="{{asset('/')}}">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="{{asset('/index/prolist')}}">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="/index/car">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="/index/user">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/style.js')}}"></script>
    <!--焦点轮换-->
    <script src="{{asset('js/jquery.excoloSlider.js')}}"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>