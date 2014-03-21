<?php echo Asset::css(['style.css']); ?>
<?php echo Asset::css('member/validfrom_style.css'); ?>
<?php echo Asset::js('Validform_v5.3.2_min.js'); ?>
<script>
    $(function() {
    var location_url = window.location.href;
   
    //$('.left-nav > li').each(function() {
        $('.left-nav > li a[href="' + location_url + '"]').addClass('active');
        console.log($('.left-nav > li a[href="' + location_url + '"]').html());
    //});
    /*
    $('.left-nav > li > ul').each(function() {

        if($(this).index() != 0) {
            var target = $(this).find('a');

            var navlink = target.attr('href').replace(/\//g,'\\/');
            navlink = eval('/'+navlink.replace(/\./g,'\\.') + '/');

            if(navlink.test(location_url)) {
                match = true;
                $('.navbar > ul > li').find('a').removeClass('active');
                target.addClass('active');
            }
        }
    });*/
    });
</script>
<div class="wrapper w">
    <!--获得的商品开始-->
    <div class="left-sidebar fl">
        <div class="img-box">
            <?php echo Html::anchor('u', Html::img($current_user->avatar));?></a>
        </div>
        <ul class="left-nav">
            <li><?php echo Html::anchor('u', '我的主页', ['style'=>'color: #af2812;', 'class'=>'active']);?><s></s></li>
            <li class="dropdown">
                <a href="javascript:void(null)" style="color: #af2812;">我的乐拍<span class="icon-arrow"></span><s></s></a>
                <ul class="dropdown-menu" style="display:block">
                    <li><?php echo Html::anchor('u/orders', '乐拍记录');?></li>
                    <li><?php echo Html::anchor('u/wins', '获得的商品');?></li>
                    <li><?php echo Html::anchor('u/posts', '晒单');?></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(null)" style="color: #af2812;">帐户管理<span class="icon-arrow"></span><s></s></a>
                <ul class="dropdown-menu" style="display:block">
                    <li><?php echo Html::anchor('u/getrecharge', '充值');?></li>
                    <li><?php echo Html::anchor('u/moneylog', '账户明细');?></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(null)" style="color: #af2812;">邀请管理<span class="icon-arrow"></span><s></s></a>
                <ul class="dropdown-menu" style="display:block">
                    <li><?php echo Html::anchor('u/invit', '邀请好友');?></li>
                    <li><?php echo Html::anchor('u/brokerage', '佣金明细');?></li>
                </ul>
            </li>
            <li><?php echo Html::anchor('u/message', '消息管理', ['style'=>'color: #af2812;', 'class'=>'active']);?>
            <?php if ($isnew) { ?>
               <span style="color: red!important;position: absolute;top: 0;right: 30px;">新</span>
            <?php } ?>
            <s></s>
            </li>
            <li><?php echo Html::anchor('u/getprofile', '个人设置', ['style'=>'color: #af2812;']);?>
            <s></s></li>
        </ul>
    </div>
    <!--获得的商品结束-->
    <?php echo $content;?>
</div>
