<?php echo Asset::css(['product.css', 'jquery.jqzoom.css', 'customBootstrap.css', 'style.css']); ?>
<?php echo Asset::js(['jquery.jqzoom-core.js', 'bootstrap.min.js','jquery.pin.js', 'Xslider.js' , 'item/view.js']); ?>
<?php echo Asset::js(['jquery.validate.js','additional-methods.min.js']); ?>
<div class="bread">
     <ul>
     <?php echo $getBread($item);?>
     </ul>
</div>
<?php $this->title = $item->title; ?>
<div class="panel w">
        <div class="title">
            <h2>
                <?php echo $item->title; ?>
            </h2>
        </div>
        <div class="img-wide fl flsl">
            <!--商品图片切换开始-->
            <div class="lantern-slide">
                <div class="slide-img">
                    <a href="<?php echo \Helper\Image::showImage($item->image, '600x600');?>" class="jqzoom" rel="zoom">
                        <img src="<?php echo \Helper\Image::showImage($item->image, '400x400');?>"/>
                    </a>
                </div>
                <ul class="slide-list" id="thumblist">
                    <?php
                        $images = unserialize($item->images);
                        $images = array_slice($images, 0, 5);
                        foreach($images as $image):
                    ?>
                    <li>
                        <a class="<?php echo $image == $item->image ? 'zoomThumbActive' : ''; ?>" rel='<?php echo str_replace('\/', '/', $getZoom($image));?>'>
                            <img src="<?php echo \Helper\Image::showImage($image, '80x80');?>"/>
                            <span></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!--商品图片切换结束-->
        </div>
        <?php
            Config::load('common');
            $unit = Config::get('unit');
        ?>
        <div class="product-column fr columnw">
            <div class="state-heading">
                <span class="icon icon-horn"></span>
            </div>
            <div class="middle">
              <div class="price" style="margin-left: 57px"><strong>价格:￥<?php echo sprintf('%.2f', $item->price); ?></strong></div>
              <form action="<?php echo Uri::create('/cart/add'); ?>" method="post">
                  <div class="btn-menu" style="margin-left: 57px; margin-top: 7px">
                      <span class="left" style="height: 30px; font-size: 14px;line-height: 30px">购买数量：</span>
                      <a class="add btn-jian" href="javascript:void(0);" style="height: 30px;line-height: 30px;width:30px">-</a>
                      <input style="margin: 0;border: 1px solid #e5e5e5;font-size: 14px;height:28px" type="text" value="1" name="qty" amount="<?php echo $item->price;?>" remain="99999">
                      <a class="add btn-jia" style="height: 30px; font-size: 14px; line-height: 30px" href="javascript:void(0);">+</a>
                  </div>
                  <div class="btn-group" style="margin-left: 57px">
                      <input type="hidden" value="<?php echo $item->id ?>" name="id"/>
                      <button type="submit" class="btn btn-red btn-w" style="margin: 8px 0; height: 40px; line-height: 40px; width: 158px;font-size: 18px">立即购买</button>
                      <a class="btn btn-y btn-w doAddCart" style="margin-left: 28px; height: 40px; line-height: 40px; width: 158px;font-size: 18px" href="javascript:void(0);" phaseId="<?php echo $item->id; ?>">加入购物车</a>
                  </div>
              </form>
              <ul class="security-list" style="width: 83%">
                  <li><a href="<?php echo Uri::create('/h/safeguard'); ?>" class="01">全场包邮</a></li>
                  <li><a href="<?php echo Uri::create('/h/promise'); ?>" class="02">100%正品保证</a></li>
                  <li><a href="<?php echo Uri::create('/h/expressinfo'); ?>" class="03">全国免费配送</a></li>
              </ul>
            </div>
            <div class="new-buyer">
                <div class="new-buyer-header">
                    <ul class="tab">
                        <li class="active"><a href="#help" data-toggle="tab">如何乐淘</a></li>
                    </ul>
                 </div>
                <div class="new-buyer-body tab-content">
                    <div class="tab-pane active" id="help">
                        <p>乐乐淘是指只需1元就有机会买到想要的商品。即每件商品被平分成若干“等份”出售，每份1元，
                         当一件商品所有“等份”售出后，根据乐淘规则产生一名幸运者，该幸运者即可获得此商品。
                        </p>
                        <p>
                            乐乐淘以“独乐乐，不如众乐乐”为宗旨，力求打造一个100%公平公正、100%正品保障、寄娱乐与购物一体化的新型购物网站。
                        </p>
                        <div class="tr"><a href="<?php echo Uri::create('h/new'); ?>" class="link">更多详情></a></div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="wrapper w">
    <!--商品信息开始-->
	<div class="bd w">
	    <div class="sub-nav" id="bigNav">
            <ul class="fl">
                <li><a href="#desc" data-toggle="tab" class="active">商品详情</a></li>
            </ul>
            <div class="online-qq fr"><span class="icon icon-qq"></span><a class="chance" href="http://wpa.qq.com/msgrd?v=3&uin=2698744419&site=qq&menu=yes">在线客服</a></div>
        </div>
        <div class="tab-content" id="tab-content">
            <!--商品详情开始-->
            <div class="tab-pane active" id="desc">
                <div class="product-details">
                    <?php echo $item->desc; ?>
                </div>
            </div>
            <!--商品详情结束-->
        </div>
	</div>
</div>
<style>
#descJoined .pagination {
    margin: 10px 0;
}
#handleJoineds tbody span{
    margin: 0 10px;
}
</style>
<!--今日热门开始-->
<div class="date-hot w">
    <div class="title"><h3>今日热门</h3></div>
    <div class="scrollleft" >
         <div class="scrollcontainer">
             <ul>
                 <?php $hotItems = $getHots();
                        if(isset($hotItems)) {
                        foreach($hotItems as $item) { ?>
                      <li>
                          <div class="img-box img-md">
                            <a href="<?php echo Uri::create('/m/'.$item->id); ?>" rel="nofollow">
                                <img src="<?php echo \Helper\Image::showImage($item->image, '200x200');?>"/>
                             </a>
                             <div class="price fr">价格<b>￥<?php echo sprintf('%.2f', $item->price); ?></b></div>
                          </div>
                          <h4 class="caption"><?php echo $item->title; ?></h4>
                          <div class="btn-group">
                                <form action="<?php echo Uri::create('cart/add'); ?>" method="post">
                                    <input name="id" value="<?php echo $item->id; ?>" type="hidden">
                                    <input name="qty" value="1" type="hidden">
                                    <button class="btn btn-red hot-buy" type="submit">立即购买</button>
                                </form>
                          </div>
                      </li>
                      <?php }} ?>
                 </ul>
            </div>
            <a class="abtn aleft" href="#left"></a>
            <a class="abtn aright" href="#right"></a>
        </div>
    </div>
    <!--今日热门结束-->
</div>
<script>
    BUYLOG_URL   = '<?php echo Uri::create('l/joined'); ?>';
    POSTLOG_URL  = '<?php echo Uri::create('l/posts'); ?>';
    PHASELOG_URL = '<?php echo Uri::create('l/phases'); ?>';
</script>
<script>
$(function(){
    $(".sub-nav").pin({
        containerSelector: ".bd"
    })

    jQuery.validator.addMethod("codemobile", function(value,element) {
      var code = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
      var mobile = /^1[3,4,5,8][0-9]{9}$/
      if(code.test(value) || mobile.test(value))
        return true;
      return false;
    },"error zhanghao");

    $(".signinfrom").validate({
        rules:{
            username:{
                required:true,
                codemobile:true
            },
            password:{
                required:true
            }
        },
        messages:{
            username:{
                required:"请输入注册手机/邮箱",
                codemobile:"手机/邮箱格式不正确"
            },
            password:{
                required:"请输入密码"
            }
        },
        errorPlacement: function(error, element) {
            error.css({"display":"inline-block","line-height":"29px"});
            
            error.appendTo(element.parent());
        }
    });
});
</script>
