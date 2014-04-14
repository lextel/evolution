<?php echo Asset::css(['style.css']); ?>
<?php echo Asset::css('member/validfrom_style.css'); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<style>

.acquire-box, .record-box,.record{
    overflow: visible;
}
.content-inner{
    overflow: visible;
}
.wrapper {
    overflow: visible;
}
/*
.w {
    overflow: visible;
}*/
</style>
<script>
    $(function() {
    var location_url = window.location.href;
    var patten = new RegExp(/http:\/\/[^\/]+\/u(\/\w+|)/);
    var location_url = patten.exec(location_url)[0];

    if ($('.left-nav > li > a[href="' + location_url + '"]')){
        $('.left-nav > li > a[href="' + location_url + '"]').addClass('active');
    }
    if ($('.left-nav > li > ul > li > a[href="' + location_url + '"]')){
        $('.left-nav > li > ul > li > a[href="' + location_url + '"]').parent().parent().parent().find('.ali').addClass('active');
        $('.left-nav > li > ul > li > a[href="' + location_url + '"]').addClass('active');
    }
    });
</script>
<div class="wrapper w">
    <!--获得的商品开始-->
    <div class="left-sidebar fl">
        <div class="img-box">
            <a href="<?php echo Uri::create('u/getavatar'); ?>">
              <img src="<?php echo \Helper\Image::showImage($current_user->avatar, '160x160');?>"/>
            </a>
        </div>
        <ul class="left-nav">
            <li><?php echo Html::anchor('u', '我的主页<s></s>', ['style'=>'color: #af2812;']);?></li>
            <li class="dropdown">
                <a href="javascript:void(null)" style="color: #af2812;" class="ali">我的乐淘<span class="icon-arrow"></span><s></s></a>
                <ul class="dropdown-menu" style="display:block">
                    <li><?php echo Html::anchor('u/orders', '乐淘记录');?></li>
                    <li><?php echo Html::anchor('u/wins', '获得的商品');?></li>
                    <li><?php echo Html::anchor('u/posts', '晒单');?></li>
                    <li><?php echo Html::anchor('u/noposts', '未晒单', ['style'=>'display:none']);?></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(null)" style="color: #af2812;" class="ali">帐户管理<span class="icon-arrow"></span><s></s></a>
                <ul class="dropdown-menu" style="display:block">
                    <li><?php echo Html::anchor('u/getrecharge', '充值');?></li>
                    <li><?php echo Html::anchor('u/moneylog', '账户明细');?></li>
                    <li><?php echo Html::anchor('u/moneylog', '消费记录', ['style'=>'display:none']);?></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(null)" style="color: #af2812;" class="ali">邀请管理<span class="icon-arrow"></span><s></s></a>
                <ul class="dropdown-menu" style="display:block">
                    <li><?php echo Html::anchor('u/invit', '邀请好友');?></li>
                    <li><?php echo Html::anchor('u/brokerage', '佣金明细');?></li>
                </ul>
            </li>
            <li><?php echo Html::anchor('u/code', '乐淘码<s></s>', ['style'=>'color: #af2812;']);?><s></s></li>
            <li><?php echo Html::anchor('u/message', '消息管理<s></s>', ['style'=>'color: #af2812;']);?></li>
            <li><?php echo Html::anchor('u/getprofile', '个人设置<s></s>', ['style'=>'color: #af2812;']);?><s></s></li>
        </ul>
    </div>
    <!--获得的商品结束-->
    <?php echo $content;?>
</div>
