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
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select" id="ulOrderBy">
      <li  class="pro-selCur" _type="update_time" class="current"><a href="javascript:;">新品 <span>↑</span></a></li>
      <li _type="goods_num"><a href="javascript:;">库存 <span>↑</span></a></li>
      <li _type="self_price"><a href="javascript:;">价格 <span>↑</span></a></li>
     </ul><!--pro-select/-->
     <div class="prolist" id="box">
     @foreach($data as $v)
      <dl>
      
       <dt><a href="{{url('index/proinfo')}}/{{$v->goods_id}}"><img src="{{url('images/goodsLogo/'.$v->goods_img)}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('index/proinfo')}}/{{$v->goods_id}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>价值：￥{{$v->self_price}}</strong></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>

       <div class="clearfix"></div>
      </dl>
      @endforeach
      <div class="menu-list-wrapper" id="divSortList">
        </div>
     </div><!--prolist/-->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="/">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl class="ftnavCur">
       <a href="/index/prolist">
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
    <script src="/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>
<script>
    //点击搜索类
    $("#ulOrderBy li").click(function(){
        $(this).addClass('current').siblings('li').removeClass('current');
        var _this=$(this);
        var _type=_this.attr('_type');
        var _token=$("#_token").val();
        var cate_id=$("#sortListUl li[class='cateId current']").attr('cate_id');
        var top=_this.children('a').children('span').text();
        $.ajax({
            type:'post',
            url:"{{url('index/sortshop')}}",
            data:{_type:_type,_token:'{{csrf_token()}}',cate_id:cate_id,top:top}
        }).done(function (res) {
            $("#box").html(res);
            if(top=='↑'){
                _this.children('a').children('span').text('↓');
            }else{
                _this.children('a').children('span').text('↑');
            }

        })
    })
</script>