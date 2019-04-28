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
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/images/head.jpg" />
     </div><!--head-top/-->
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="收货人" name="address_name" id="address_name"/></div>
       <div class="lrList"><input type="text" placeholder="详细地址" name="address_desc" id="address_desc"/></div>
       <em>地址</em>
        <select class="area" id="province">
        <option value="" selected="selected">--请选择--</option>
         @foreach($provinceInfo as $v)
          <option value="{{$v->id}}">{{$v->name}}</option>
        @endforeach
        </select>
        <select class="area" id="city">
         <option>请选择</option>
        </select>
        <select class="area" id="area">
         <option>请选择</option>
        </select>
       <div class="lrList"><input type="text" placeholder="手机" name="address_tel" id="address_tel"/></div>
       <div class="lrList2">设为默认<input type="checkbox"  id="address_default"></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="javascript:;" id="tianjia" value="添加" />
      </div>
     
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
    <script src="{{url('layui/layui.js')}}"></script>
   <script>
	$('.spinnerExample').spinner({});
   </script>
  </body>
</html>
<script>
    $(function(){
      layui.use('layer',function(){
        var layer = layui.layer;
        //三级联动        
        $(".area").change(function(){
              var _this=$(this);
              //console.log(_this);  
              var _id=_this.val();
              //console.log(id);
              var _option="<option selected value=''>请选择</option>"
              _this.nextAll('select').html(_option);
              $.get(
                "{{url('index/getarea')}}"+"/"+_id,
                {id:_id,_token:'{{csrf_token()}}'},
                function(res){
                  if(res.icon==1){
                    for(var i in res['areaInfo']){
                      _option+="<option value='"+res['areaInfo'][i]['id']+"'>"+res['areaInfo'][i]['name']+"<option>"
                    }
                     //console.log(_option);
                    _this.next('select').html(_option);
                  }else{
                    layer.msg(res.font,{icon:res.icon})
                  }
                  //console.log(res);
                }
                ,'json'
              )
            })
            /* 默认 */
        })
            //添加
    $(document).on('click','#tianjia',function(){
            var obj={};
            //var province=$('#province').val();
            obj.province=$('#province').val();
            //console.log(obj.province);
            obj.city=$('#city').val();
            obj.area=$('#area').val();
            obj.address_name=$('#address_name').val();
            obj.address_tel=$('#address_tel').val();
            console.log(obj.address_tel);
            obj.address_desc=$('#address_desc').val();
            var address_default=$('#address_default').prop('checked');
            if(address_default==true){
              obj.address_default=1;
            }else{
              obj.address_default=2; 
            }
            console.log(obj.address_default);
            //console.log(obj);
            //验证
            if(obj.province==''){
                layer.msg('选择完整的配送地区');
                return false;  
            }
            //添加
            $.get(
              "{{url('index/addaddressdo')}}",
              obj,
              function(res){
                //console.log(res);
                  if(res==1){
                    layer.msg('添加成功',{icon:res},function(){  
                      location.href="{{url('index/address')}}";                 
                    });
                  }else{
                    layer.msg('添加失败',{icon:res},function(){                     
                    });
                  }
              }
              ,'json'
            )        
        })
  })
</script>