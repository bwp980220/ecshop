<div class="prolist" id="box">
     @foreach($data as $v)
      <dl>
      
       <dt><a href="{{url('index/proinfo')}}/{{$v->goods_id}}"><img src="{{url('images/goodsLogo/'.$v->goods_img)}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('shopcontent')}}/{{$v->goods_id}}index/proinfo">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>价值：￥{{$v->self_price}}</strong></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>

       <div class="clearfix"></div>
      </dl>
      @endforeach
      <div class="menu-list-wrapper" id="divSortList">
        </div>