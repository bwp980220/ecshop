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
    <link href="/layui/css/layui.css" rel="stylesheet">
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
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="25%" align="center" style="background:#fff url(/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="quan"/> 全选</a></td>
       </tr>
       @foreach($res as $v)
       <tr>
        <td width="4%"><input type="checkbox" id="xuan" class="xuan" goods_id="{{$v->goods_id}}">
        </td>
        <td class="dingimg" width="15%"><img src="{{url('images/goodsLogo/'.$v->goods_img)}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <em>剩余{{$v->goods_num}}件库存</em>
        </td>
        <td align="right"><input type="text" name="num" class="spinnerExample" self="{{$v->self_price}}" value="{{$v->buy_number}}"/></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">￥{{$v->self_price}}</strong></th>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：¥<strong class="orange" id="total">0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/style.js"></script>
    <!--jq加减-->
    <script src="/js/jquery.spinner.js"></script>
    <script src="/layui/layui.js"></script>
   <script>
	    $('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<script>
  $(function(){
    layui.use('layer',function(){
        var layer = layui.layer;
        //点击全选
        $('#quan').click(function () {
                var checked = $(this).prop('checked');
                $('.xuan').prop('checked',checked);
                var check=$('.xuan');
                var id='';
                check.each(function (index) {
                    if($(this).prop('checked')==true){
                        id +=$(this).attr('goods_id')+',';
                    }
                })
                goods_id=id.substr(0,id.length-1);
                //  console.log(goods_id);
                getallprice(goods_id);
            })
            //点击单选
            $('.xuan').click(function () {
                var check=$('.xuan');
                var id='';
                check.each(function (index) {
                    if($(this).prop('checked')==true){
                        id +=$(this).attr('goods_id')+',';
                    }
                })
                goods_id=id.substr(0,id.length-1);
                console.log(goods_id);
                getallprice(goods_id);
            })
      //获取总价格
      function getallprice(goods_id) {
                $.post(
                    "/index/getallprice",
                    {goods_id:goods_id,_token:'{{csrf_token()}}'},
                    function (res) {
                       $('#total').text(res);
                        // console.log(res);
                    }
                )
            }
            //点击结算
            $('.jiesuan').click(function () {
                var check=$('.xuan');
                var allprice=$('.allprice').text();
                var id='';
                check.each(function (index) {
                    if($(this).prop('checked')==true){
                        id +=$(this).attr('goods_id')+',';
                    }
                })
                goods_id=id.substr(0,id.length-1);
                if(goods_id==''){
                    layer.msg('至少选择一件商品结算',{icon:5});
                    return false;
                }
                location.href="/index/pay/"+goods_id;
            })
    })
  })
</script>