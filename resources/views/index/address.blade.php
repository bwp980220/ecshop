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
    <!-- HTML5 shim and Respond./js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond./js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.boot/css.com/html5shiv/3.7.2/html5shiv.min./js"></script>
      <script src="http://cdn.boot/css.com/respond./js/1.4.2/respond.min./js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><a href="addaddress" class="hui"><strong class="">+</strong> 新增收货地址</a></td>
       <td width="25%" align="center" style="background:#fff url(/images/xian.jpg) left center no-repeat;"></td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
      @foreach($res as $v)
       <tr address_id="{{$v->address_id}}">
        <td width="50%">
         <h3>{{$v->address_name}}</h3>
         <time>{{$v->address_desc}}</time>
        </td>
        <td align="right"><a href="javascript:;" class="edit"><span class="glyphicon glyphicon-check"></span> 删除信息</a></td>
        <td align="right"><a href="javascript:;" class="ramove"><span class="glyphicon glyphicon-check"></span> 修改信息</a></td>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="/">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
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
      <dl class="ftnavCur">
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
    <!--jq加减-->
    <script src="/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
   </script>
  </body>
</html>
<script>
  // 删除地址
  $(document).on('click','.edit', function (){
        var address_id=$(this).parents("tr").attr('address_id');
        console.log(address_id);
                $.post(
                    "{{url('index/addressDel')}}",
                    {address_id:address_id,_token:'{{csrf_token()}}'},
                    function(res){
                        //console.log(res);
                        if(res==1){
                            alert('删除成功');
                            location.href="{{url('index/address')}}"
                        }else{
                            alert('删除失败');
                            location.href="{{url('/')}}"
                        }
                    }
                  )
    });
    // 修改地址
    $(document).on('click','.ramove', function (){
        var address_id=$(this).parents("tr").attr('address_id');  
        
        location.href="{{url('index/addressUpd')}}/"+address_id;
        
    });
</script>